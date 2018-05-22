<?php
namespace Cloudipsp\HttpClient;

interface ClientInterface
{
    /**
     * Send http request
     */
    public function request($method, $url, $headers, $data);
}