<?php

namespace Fondy\Api;

use Fondy\Configuration;
use Fondy\Exeption\ApiExeption;
use Fondy\Helper as Helper;

class Api
{
    /**
     * @var string request client
     */
    protected $client;
    /**
     * @var string
     */
    protected $version;
    /**
     * @var int
     */
    protected $mid;
    /**
     * @var string
     */
    protected $secretKey;
    /**
     * @var string
     */
    protected $requestType;

    /**
     * @param $data
     * @throws ApiExeption
     */
    public function __construct()
    {
        $this->version = Configuration::getApiVersion();
        $this->secretKey = Configuration::getSecretKey();
        $this->mid = Configuration::getMerchantId();
        $this->client = Configuration::getHttpClient();
        $this->requestType = Configuration::getRequestType();
    }

    /**
     * @param $method
     * @param $url
     * @param $headers
     * @param $data
     * @return mixed
     * @throws ApiExeption
     */
    public function Request($method, $url, $headers, $data)
    {
        $url = $this->createUrl($url);
        $data = $this->getDataByVersion($data);
        $headers = Helper\RequestHelper::parseHeadres($headers, $this->requestType);
        $response = $this->client->request($method, $url, $headers, $data);

        if (!$response)
            throw new ApiExeption('Unknown error.');

        return $response;

    }

    /**
     * @param $data
     * @return string or array
     */
    private function converDataV1($data)
    {
        if (!isset($data['signature'])) {
            $data['signature'] = Helper\ApiHelper::generateSignature($data, $this->secretKey, $this->version);
        }
        switch ($this->requestType) {
            case 'xml':
                $data = Helper\ApiHelper::toXML(['request' => $data]);
                break;
            case 'form':
                $data = Helper\ApiHelper::toFormData($data);
                break;
            case 'json':
                $data = Helper\ApiHelper::toJSON(['request' => $data]);
                break;
        }

        return $data;
    }

    /**
     * @param $data
     * @return string
     */
    private function converDataV2($data)
    {
        $prepared_data = [
            "version" => "2.0",
            "data" => base64_encode(Helper\ApiHelper::toJSON(['order' => $data]))
        ];

        $prepared_data["signature"] = Helper\ApiHelper::generateSignature($prepared_data["data"], $this->secretKey, $this->version);

        return Helper\ApiHelper::toJSON(['request' => $prepared_data]);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function prepareParams($params)
    {
        $prepared_params = $params;

        if (!isset($prepared_params['merchant_id'])) {
            $prepared_params['merchant_id'] = $this->mid;
        }
        if (!isset($prepared_params['order_id'])) {
            $prepared_params['order_id'] = Helper\ApiHelper::generateOrderID($this->mid);
        }
        if (!isset($prepared_params['order_desc'])) {
            $prepared_params['order_desc'] = Helper\ApiHelper::generateOrderDesc($prepared_params['order_id']);
        }
        if (isset($prepared_params['merchant_data']) && is_array($prepared_params['merchant_data'])) {
            $prepared_params['merchant_data'] = Helper\ApiHelper::toJSON($prepared_params['merchant_data']);
        }
        return $prepared_params;
    }

    /**
     * @param $data
     * @return string
     * @throws ApiExeption
     */
    public function getDataByVersion($data)
    {
        if (!$this->version)
            throw new ApiExeption('Unknown api version');

        switch ($this->version) {
            case '1.0':
                $data = $this->converDataV1($data);
                break;
            case '2.0':
                if ($this->requestType != 'json') {
                    Configuration::setRequestType('json');
                    trigger_error('Api protocol v2 can accept only json.', E_USER_NOTICE);
                }
                $data = $this->converDataV2($data);
                break;
        }
        return $data;
    }

    /**
     * @param $url
     * @return string
     */
    public function createUrl($url)
    {
        return Configuration::getApiUrl() . $url;
    }
}