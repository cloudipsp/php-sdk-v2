<?php

namespace Fondy;

use Fondy\Api\Order as Api;
use Fondy\Response\OrderResponse;

class Order
{
    /**
     * Generate request to capture order
     * @param $data
     * @param array $headers
     * @return OrderResponse
     * @throws Exeption\ApiExeption
     */
    public static function capture($data, $headers = [])
    {
        $api = new Api\Capture();
        $result = $api->get($data, $headers);
        return new OrderResponse($result);
    }

    /**
     * Generate request to reverse order
     * @param $data
     * @param array $headers
     * @return OrderResponse
     * @throws Exeption\ApiExeption
     */
    public static function reverse($data, $headers = [])
    {
        $api = new Api\Reverse();
        $result = $api->get($data, $headers);
        return new OrderResponse($result);
    }

    /**
     * Generate request to get order info
     * @param $data
     * @param array $headers
     * @return OrderResponse
     * @throws Exeption\ApiExeption
     */
    public static function status($data, $headers = [])
    {
        $api = new Api\Status();
        $result = $api->get($data, $headers);
        return new OrderResponse($result);
    }

    /**
     * Generate request to get transaction list of order
     * @param $data
     * @param array $headers
     * @return OrderResponse
     * @throws Exeption\ApiExeption
     */
    public static function transactionList($data, $headers = [])
    {
        $api = new Api\TransactionList();
        $result = $api->get($data, $headers);
        return new OrderResponse($result);
    }

    /**
     * Generate request to get transaction list of order
     * @param $data
     * @param array $headers
     * @return OrderResponse
     * @throws Exeption\ApiExeption
     */
    public static function atolLogs($data, $headers = [])
    {
        $api = new Api\Atol();
        $result = $api->get($data, $headers);
        return new OrderResponse($result);
    }

}