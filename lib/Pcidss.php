<?php

namespace Fondy;

use Fondy\Api;
use Fondy\Response\Response;
use Fondy\Helper;
use Fondy\Exeption\ApiExeption;

class Pcidss
{
    /**
     * generate payment
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function start($data, $headers = [])
    {
        $api = new Api\Pcidss\StepOne();
        $result = $api->get($data, $headers);
        return new Response($result);
    }

    /**
     * generate payment 3ds step 2
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function submit($data, $headers = [])
    {
        $api = new Api\Pcidss\StepTwo();
        $result = $api->get($data);
        return new Response($result);
    }

    /**
     * get form page for 3ds step 2
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function get3dsContent($data, $response_url = '')
    {
        if (!$data['acs_url']) {
            throw new ApiExeption('Required param acs_url is missing or empty.');
        }
        Helper\ValidationHelper::validateURL($data['acs_url']);
        $formData = [
            'PaReq' => $data['pareq'],
            'MD' => $data['md'],
            'TermUrl' => $response_url ? $response_url : $data['TermUrl']
        ];
        $client = Configuration::getHttpClient();
        $response = $client->request('POST', $data['acs_url'], ['Content-Type: multipart/form-data'], $formData);
        return $response;
    }

    /**
     * generate form 3ds step 2
     * @param $data
     * @param array $headers
     * @return Response
     * @throws Exeption\ApiExeption
     */
    public static function getFrom($data, $response_url = '')
    {
        if (!$data['acs_url']) {
            throw new ApiExeption('Required param acs_url is missing or empty.');
        }
        Helper\ValidationHelper::validateURL($data['acs_url']);
        foreach ($data as $key => $value) {
            $data[strtolower($key)] = $value;
        }
        $formData = [
            'PaReq' => $data['pareq'],
            'MD' => $data['md'],
            'TermUrl' => $response_url ? $response_url : $data['termurl']
        ];
        $form = Helper\ApiHelper::generatePaymentForm($formData, $data['acs_url']);
        return $form;
    }

}