<?php

namespace Fondy;

use Fondy\Api\Order as Api;
use Fondy\Response\Response;

class Order
{
    /**
     * Generate request to capture order
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function capture($data, $headers = [])
    {
        $api = new Api\Capture();
        $result = $api->get($data, $headers);
        return new Response($result);
    }

    /**
     * Generate request to reverse order
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function reverse($data, $headers = [])
    {
        $api = new Api\Reverse();
        $result = $api->get($data, $headers);
        return new Response($result);
    }

}