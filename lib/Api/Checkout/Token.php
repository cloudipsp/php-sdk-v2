<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Exeption\ApiExeption;

class Token extends Api
{
    private $url = '/checkout/token/';
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
        if ($this->requestType != 'json')
            throw new ApiExeption('Invalid request type. In this method only \'json\' allowed.');
        if (!empty($requiredParams))
            $this->requiredParams = array_merge($requiredParams, $this->requiredParams);
        $requestData = $this->prepareParams($data);
        $this->validate($requestData, $this->requiredParams);
        return $this->Request($method = 'POST', $this->url, $headers, $requestData);
    }

}