<?php

namespace Fondy\HttpClient;

use Fondy\Exeption;

class HttpCurl implements ClientInterface
{
    /**
     * @param string $method
     * @param string $url
     * @param array $headers
     * @param array $params
     * @return array
     * @throws Exeption\HttpClientExeption
     */
    public function request($method = 'post', $url = '', $headers = [], $params = [])
    {
        if (!$this->curlEnabled())
            throw new Exeption\HttpClientExeption('Curl not enabled');
        if (empty($url))
            throw new Exeption\HttpClientExeption('The url iss empty');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        if (!($headers))
            $headers = $this->setDefaultHeader();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($params) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpStatus != 200)
            throw new Exeption\HttpClientExeption(sprintf('Curl Send Error Header Status is: %s',$httpStatus));

        curl_close($ch);
        return ['code' => $httpStatus, 'response' => trim($response)];
    }

    /**
     * @return array default headers
     */
    private function setDefaultHeader(){
        return  ['Content-Type: application/json'];
    }

    /**
     * @return bool
     */
    private function curlEnabled()
    {
        return function_exists('curl_init');
    }
}