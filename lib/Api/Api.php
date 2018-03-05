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
    protected $secret_key;

    /**
     * @param $data
     * @throws ApiExeption
     */
    public function __construct()
    {
        $this->version = Configuration::getApiVersion();
        $this->secret_key = Configuration::getSecretKey();
        $this->mid = Configuration::getMerchantId();
        $this->client = Configuration::getHttpClient();
    }

    public function Request($method, $url, $headers, $params)
    {

        $headers = Helper\RequestHelper::parseHeadres($headers, 'json');
        $url = $this->createUrl($url);

        if (!$this->version)
            throw new ApiExeption('Unknown api version');
        return $this->client->request($method, $url, $headers, $params);

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