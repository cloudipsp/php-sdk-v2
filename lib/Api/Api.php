<?php

namespace Fondy\Api;

use Fondy\Configuration;
use Fondy\Exeption\ApiExeption;
use Fondy\Helper;

class Api
{
    /**
     * @var array
     */
    protected $params = [];
    /**
     * @var array request headers
     */
    protected $headers = [];
    /**
     * @var string request url
     */
    protected $url;
    /**
     * @var string request method
     */
    protected $method;
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
    protected $secret_key;

    public function __construct($method = 'POST', $url, $headers, $params)
    {
        $this->method = $method;
        $this->url = $url;
        $this->client = Configuration::getHttpClient();
        $this->headers = Helper\RequestHelper::parseHeadres($headers, 'json');
        $this->version = Configuration::getApiVersion();
        $this->secret_key = Configuration::getSecretKey();
        $this->mid = Configuration::getMerchantId();
        $this->params = $this->prepareParams($params);
    }

    /**
     * @param $data
     * @throws ApiExeption
     */
    public function doRequest()
    {
        $version = $this->version;
        if (!$version)
            throw new ApiExeption('Unknown api version');
        return $this->client->request($this->method, $this->url, $this->headers, $this->params);

    }

    /**
     * @param $params
     * @return mixed
     */
    private function prepareParams($params)
    {
        $prepared_params = $params;
        if (!array_key_exists('merchant_id', $prepared_params)){
            $prepared_params['merchant_id'] = $this->mid;
        }
        if (!array_key_exists('signature', $prepared_params)){
            $prepared_params['signature'] = Helper\ApiHelper::generateSignature($prepared_params, $this->secret_key, $this->version);
        }

        return json_encode(['request' => $prepared_params]);
    }
}