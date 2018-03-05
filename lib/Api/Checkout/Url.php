<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;
use Fondy\Helper\ApiHelper;

class Url extends Api
{
    private $url = '/checkout/url/';

    public function get($data, $headers = [])
    {
        $data = $this->prepareParams($data);
        return parent::Request($method = 'POST', $this->url, $headers, $data);
    }
    
}