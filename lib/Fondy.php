<?php

namespace Fondy;

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
    public function order($data = [])
    {
        $HttpClient = Configuration::getHttpClient();
        $url = Configuration::getApiUrl();
        //$this->request();
    }
}