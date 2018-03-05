<?php

namespace Fondy;

use Fondy\Api\Checkout as Api;
use Fondy\Response\Response;

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
    public static function url($data, $headers = [])
    {
        $api = new Api\Url;
        $result = $api->get($data, $headers);
        return new Response($result);
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

    /**
     *
     */
    public function toCheckout()
    {
        print_r(1);
    }
}