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

    public static function get($data, $headers = [])
    {
        if (\Fondy\Configuration::getApiVersion() !== '2.0')
            \Fondy\Configuration::setApiVersion('2.0');
        $data = array_merge($data, self::$defaultParams);
        $result = parent::token($data, $headers, self::$requiredParams);
        return $result;
    }


}