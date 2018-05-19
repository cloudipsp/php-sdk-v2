<?php


namespace Fondy;

use Fondy\Api;
use Fondy\Response\Response;

class P2pcredit
{

    /**
     * generate p2p request
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function start($data, $headers = [])
    {
        $api = new Api\P2pcredit\Credit('credit');
        $result = $api->get($data, $headers);
        return new Response($result);
    }
}