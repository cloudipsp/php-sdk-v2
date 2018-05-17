<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;

class Url extends Api
{
    private $url = '/checkout/url/';
    /**
     * Minimal required params to get checkout
     * @var array
     */
    private $requiredParams = [
        'merchant_id' => 'integer',
        'order_desc' => 'string',
        'amount' => 'integer',
        'currency' => 'string'
    ];

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     * @throws \Fondy\Exeption\ApiExeption
     */
    public function get($data, $headers = [], $requiredParams = [])
    {
        if ($requiredParams)
            $this->requiredParams = array_merge($requiredParams, $this->requiredParams);
        $requestData = $this->prepareParams($data);
        parent::validate($requestData, $this->requiredParams);
        return parent::Request($method = 'POST', $this->url, $headers, $requestData);
    }

}