<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Helper\ApiHelper;

class Button extends Api
{
    private $url = '/checkout';
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
     * @return string
     *
     */
    public function get($data)
    {
        $requestData = $this->prepareParams($data);
        $url = $this->createUrl($this->url);
        return ApiHelper::generateButtonUrl($requestData, $url);
    }
}