<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Helper\ApiHelper;

class Form extends Api
{
    private $url = '/checkout/redirect/';
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
     * @return string
     */
    public function get($data)
    {
        $requestData = $this->prepareParams($data);
        $url = $this->createUrl($this->url);
        parent::validate($requestData, $this->requiredParams);
        return ApiHelper::generatePaymentForm($requestData, $url);
    }
}