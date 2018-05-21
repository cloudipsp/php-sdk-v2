<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Helper\ApiHelper;

class Form extends Api
{
    private $requiredApiVersion = '1.0';
    private $url = '/checkout/redirect/';
    /**
     * Minimal required params to get checkout
     * @var array
     */
    private $requiredParams = [
        'merchant_id' => 'integer',
        'order_desc' => 'string',
        'amount' => 'integer',
        'currency' => 'string',
        'signature' => 'string'
    ];

    /**
     * @param $data
     * @return string
     */
    public function get($data)
    {

        if (\Fondy\Configuration::getApiVersion() !== $this->requiredApiVersion) {
            trigger_error('Form method allowed only for api version \'1.0\'', E_USER_NOTICE);
            \Fondy\Configuration::setApiVersion($this->requiredApiVersion);
        }
        $requestData = $this->prepareParams($data);
        if (!isset($requestData['signature']))
            $requestData['signature'] = ApiHelper::generateSignature($requestData, $this->secretKey, $this->version);
        $url = $this->createUrl($this->url);
        $this->validate($requestData, $this->requiredParams);
        return ApiHelper::generatePaymentForm($requestData, $url);
    }
}