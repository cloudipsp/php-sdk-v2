<?php
namespace Fondy\HttpClient;

interface ClientInterface
{
    /**
     * Send http request
     */
    public function request($method, $url, $headers, $data);
}