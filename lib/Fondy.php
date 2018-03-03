<?php

namespace Fondy;

use Fondy\Api\Api;

/**
 * Class Fondy
 *
 * @package Fondy
 */
class Fondy extends Configuration
{
    /**
     * @param array $data
     */
    public function checkout($data)
    {
        $url = Configuration::getApiUrl();
        $url .= '/checkout/url/';
        $headers = [];
        $n = new Api($method = 'post', $url, $headers, $data);
        return $n->doRequest();
    }
}