<?php

namespace Fondy\Api\Checkout;

use Fondy\Api\Api;

class Url extends Api
{
    private $url = '/checkout/url/';

    public function get($data, $headers = [])
    {
        $data = $this->prepareParams($data);
        return parent::Request($method = 'POST', $this->url, $headers, $data);
    }

}