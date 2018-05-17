<?php


namespace Fondy;

class Subscription extends Checkout
{
    private static $requiredApiVersion = '2.0';
    /**
     * Minimal required params to get checkout
     * @var array
     */
    private static $requiredParams = [
        'recurring_data' => [
            'start_time' => 'date',
            'amount' => 'integer',
            'every' => 'integer',
            'period' => 'string'
        ]
    ];
    private static $defaultParams = [
        'subscription' => 'Y'
    ];

    /**
     * return checkout url with calendar
     * @param $data
     * @param array $headers
     * @return Response\Response
     */
    public static function subscriptionUrl($data, $headers = [])
    {
        if (\Fondy\Configuration::getApiVersion() !== '2.0') {
            trigger_error('Reccuring_data allowed only for api version \'2.0\'', E_USER_NOTICE);
            \Fondy\Configuration::setApiVersion('2.0');
        }
        $data = array_merge($data, self::$defaultParams);
        $result = parent::url($data, $headers, self::$requiredParams);
        return $result;
    }

    /**
     * return checkout token with calendar
     * @param $data
     * @param array $headers
     * @return Response\Response
     */
    public static function subscriptionToken($data, $headers = [])
    {
        if (\Fondy\Configuration::getApiVersion() !== '2.0') {
            trigger_error('Reccuring_data allowed only for api version \'2.0\'', E_USER_NOTICE);
            \Fondy\Configuration::setApiVersion('2.0');
        }
        $data = array_merge($data, self::$defaultParams);
        $result = parent::token($data, $headers, self::$requiredParams);
        return $result;
    }


}