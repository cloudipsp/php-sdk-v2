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
     * generate payment url
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function url($data, $headers = [])
    {
        $api = new Api\Url();
        $result = $api->get($data, $headers);
        return new Response($result);
    }

    /**
     * render payment form
     * @param $data
     * @return string
     * @throws Exeption\ApiExeption
     */
    public static function form($data)
    {
        $api = new Api\Form();
        return $api->get($data);
    }

    /**
     * generate payment button string
     * @param $data
     * @return string
     * @throws Exeption\ApiExeption
     */
    public static function button($data)
    {
        $api = new Api\Button();
        return $api->get($data);
    }

    /**
     * generate payment token
     * @param $data
     * @return string
     * @throws Exeption\ApiExeption
     */
    public static function token($data, $headers = [])
    {
        $api = new Api\Token;
        $result = $api->get($data, $headers);
        return new Response($result);
    }

}