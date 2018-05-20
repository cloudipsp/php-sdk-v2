<?php

namespace Fondy;

use Fondy\Api\Payment as Api;
use Fondy\Response\Response;

class Payment
{
    /**
     * Generate request to recurring by rectoken
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function recurring($data, $headers = [])
    {
        $api = new Api\Rectoken();
        $result = $api->get($data, $headers);
        return new Response($result);
    }

}