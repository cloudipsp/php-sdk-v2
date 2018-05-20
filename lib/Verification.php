<?php


namespace Fondy;

class Verification extends Checkout
{
    /**
     * Minimal required params to get checkout
     * @var array
     */
    private static $defaultParams = [
        'verification' => 'Y',
        'verification_type' => 'amount'
    ];

    /**
     * return checkout url with card verify
     * @param $data
     * @param array $headers
     * @return Response\Response
     */
    public static function url($data, $headers = [])
    {
        $data = array_merge($data, self::$defaultParams);
        $result = parent::url($data, $headers);
        return $result;
    }

    public static function button($data = [])
    {
        return false;
    }
}