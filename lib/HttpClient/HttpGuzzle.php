<?php

namespace Fondy\HttpClient;


class HttpGuzzle implements ClientInterface
{
    private $crulOptions = [
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 60,
        CURLOPT_USERAGENT => 'php-sdk-v2',
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSL_VERIFYPEER => 1,
        CURLOPT_TIMEOUT => 60
    ];

    /**
     * @param string $method
     * @param string $url
     * @param array $headers
     * @param array $params
     * @return $this
     * @throws \Fondy\Exception\HttpClientException
     */
    public function request($method = 'post', $url = '', $headers = [], $params = [])
    {
        $method = strtolower($method);
        $this->isGuzzleHere();
        $client = new \GuzzleHttp\Client();
        foreach ($headers as $header) {
            $guzzleHeaders = explode(':', $header);
            $guzzleHeaders = [$guzzleHeaders[0] => $guzzleHeaders[1]];
        }
        $data = [
            'body' => $params,
            'headers' => $guzzleHeaders,
            'config' => [
                'curl' => [
                    $this->crulOptions,
                ]
            ]
        ];
        $request = $client->$method($url, $data);
        $response = $request->getBody()->getContents();
        return $response;
    }

    /**
     * @throws \Fondy\Exception\HttpClientException
     */
    private function isGuzzleHere()
    {
        if (!class_exists('\GuzzleHttp\Client'))
            throw new \Fondy\Exception\HttpClientException('Guzzle not found.');
    }
}