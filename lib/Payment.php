<?php

namespace Fondy;

use Fondy\Api\Payment as Api;
use Fondy\Response\PaymentResponse;

class Payment
{
    /**
     * Generate request to recurring by rectoken
     * @param $data
     * @param array $headers
     * @return PaymentResponse
     * @throws Exeption\ApiExeption
     */
    public static function recurring($data, $headers = [])
    {
        $api = new Api\Rectoken();
        $result = $api->get($data, $headers);
        return new PaymentResponse($result);
    }

}