<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;

class Token extends Api
{
    private $url = '/checkout/token/';
    /**
     * Minimal required params to get checkout
     * @var array
     */
    private $requiredParams = [
        'merchant_id' => 'integer',
        'signature' => 'string',
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
    public function get($data, $headers = [])
    {
        $requestData = $this->prepareParams($data);
        return parent::Request($method = 'POST', $this->url, $headers, $requestData);
    }

}