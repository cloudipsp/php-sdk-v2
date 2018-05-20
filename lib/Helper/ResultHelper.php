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
        if (!array_key_exists('signature', $result)) return 'Nothing to validate';
        $signature = $result['signature'];
        $response = self::clearResult($result);
        return $signature === Signature::generateSignature($response, $secretKey);
    }

    /**
     * Clearing before generate sign
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

    /**
     * @param array $result
     * @return bool
     */
    public static function isActiveMerchant(Array $result)
    {
        if (Configuration::getMerchantId() == $result['merchant_id'])
            return true;

        return false;
    }

    /**
     * @return bool
     */
    public static function isPaymentApproved($data)
    {
        if (!isset($data['order_status']))
            return 'Nothing to check';
        $valid = self::isPaymentValid($data);
        if ($valid && $data['order_status'] === 'approved')
            return true;

        return false;

    }

    /**
     * @return mixed
     */
    public function getVerifyStatus($data)
    {
        $status = $data['verification_status'];
        if ($status)
            return $status;

        return false;
    }
}