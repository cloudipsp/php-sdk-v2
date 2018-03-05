<?php
namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Helper\ApiHelper;

class Form extends Api
{
    private $url = '/checkout/redirect/';

    public function get($data)
    {
        $data = $this->prepareParams($data);
        $url = $this->createUrl($this->url);
        return ApiHelper::generatePaymentForm($data, $url);
    }
}