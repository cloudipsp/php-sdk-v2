<?php
namespace Fondy\Helper;


class RequestHelper
{
    /**
     * @var array
     */
    private $type = [
        'json' => 'application/json',
        'xml' => 'application/xml',
        'form' => 'application/x-www-form-urlencoded'
    ];

    /**
     * @param $headers
     * @param $type
     * @return array headers
     */
    public function parseHeadres($headers, $type)
    {
        if (empty($type)) {
            $headers[] = [
                'Content-Type' => 'application/json'
            ];
        } else {
            $headers[] = [
                'Content-Type' => $this->type[$type]
            ];
        }
        return $headers;
    }
}