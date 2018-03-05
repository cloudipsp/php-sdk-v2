<?php

namespace Fondy;

use Fondy\Api\Checkout as Api;

/**
 * Class Checkout
 *
 * @package Fondy
 */
class Checkout
{
    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public static function url($data, $headers = [''])
    {
        $api = new Api\Url;
        return $api->get($data, $headers);
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public static function form($data)
    {
        $api = new Api\Form;
        return $api->get($data);
    }
}