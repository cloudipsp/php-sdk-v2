<?php

namespace Fondy;

use Fondy\Api;
use Fondy\Response\PcidssResponse;
use Fondy\Helper;
use Fondy\Exception\ApiException;

class Pcidss
{
    /**
     * generate payment
     * @param $data
     * @param array $headers
     * @return PcidssResponse
     * @throws Exception\ApiException
     */
    public static function start($data, $headers = [])
    {
        $api = new Api\Payment\Pcidss\StepOne();
        $result = $api->get($data, $headers);
        return new PcidssResponse($result);
    }

    /**
     * generate payment 3ds step 2
     * @param $data
     * @param array $headers
     * @return PcidssResponse
     * @throws Exception\ApiException
     */
    public static function submit($data, $headers = [])
    {
        $api = new Api\Payment\Pcidss\StepTwo();
        $result = $api->get($data, $headers);
        return new PcidssResponse($result);
    }

    /**
     * generate form 3ds step 2
     * @param $data
     * @param array $headers
     * @return string
     * @throws Exception\ApiException
     */
    public static function get3dsFrom($data, $response_url = '')
    {
        if (!$data['acs_url']) {
            throw new ApiException('Required param acs_url is missing or empty.');
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
        $form3ds = Helper\ApiHelper::generatePaymentForm($formData, $data['acs_url']);
        return $form3ds;
    }

}