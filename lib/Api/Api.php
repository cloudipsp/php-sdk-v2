<?php

namespace Fondy\Api;

use Fondy\Configuration;
use Fondy\Exeption\ApiExeption;
use Fondy\Helper;

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

    public function Request($method, $url, $headers, $data)
    {

        $headers = Helper\RequestHelper::parseHeadres($headers, $this->requestType);
        $url = $this->createUrl($url);

        if (!$this->version)
            throw new ApiExeption('Unknown api version');
        $data = $this->converData($data);
        $response = $this->client->request($method, $url, $headers, $data);
        if (!$response)
            throw new ApiExeption('Unknown error.');

        return $response;

    }

    /**
     * @param $url
     * @return string
     */
    private function converData($data)
    {
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
     * @param $params
     * @return string
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
        if (!isset($prepared_params['signature'])) {
            $prepared_params['signature'] = Helper\ApiHelper::generateSignature($prepared_params, $this->secretKey, $this->version);
        }

        return $prepared_params;
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