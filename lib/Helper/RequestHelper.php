<?php
namespace Fondy\Helper;


class RequestHelper
{
    /**
     * @var array
     */
    private static $type = [
        'json' => 'application/json',
        'xml' => 'application/xml',
        'form' => 'application/x-www-form-urlencoded'
    ];

    /**
     * @param $headers
     * @param $type
     * @return array headers
     */
    public static function parseHeadres($headers, $type)
    {
        if (empty($type)) {
            $headers = [
                'Content-Type: application/json'
            ];
        } else {
            $headers = [
                'Content-Type: ' . self::$type[$type]
            ];
        }
        return $headers;
    }
}