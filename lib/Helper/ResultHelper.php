<?php

namespace Fondy\Helper;

use Fondy\Configuration;
use Fondy\Helper\ApiHelper as Signature;

class ResultHelper
{
    /**
     * Check is Payment Valid
     * @param array $response
     * @return bool
     */
    public static function isPaymentValid($result, $secretKey = '')
    {
        if ($secretKey == '') {
            $secretKey = Configuration::getSecretKey();
        }
        if (!array_key_exists('signature', $result)) return FALSE;
        $signature = $result['signature'];
        $response = self::clearResult($result);
        return $signature === Signature::generateSignature($response, $secretKey);
    }

    /**
     * @param array $response
     * @return array
     */
    public static function clearResult(Array $result)
    {
        if (array_key_exists('response_signature_string', $result))
            unset($result['response_signature_string']);
        unset($result['signature']);
        return $result;
    }
}