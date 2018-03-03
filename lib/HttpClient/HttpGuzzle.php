<?php
namespace Fondy\HttpClient;

class HttpGuzzle
{
    /**
     * @param string $method
     * @param string $url
     * @param array $headers
     * @param array $params
     * @return $this
     */
    public function request($method = 'post', $url = '', $headers = [], $params = []){
        return $this;
    }
}