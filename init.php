<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$time_start = microtime(true);

//start
require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setApiVersion('2.0');
\Fondy\Configuration::setRequestType('json');
\Fondy\Configuration::setHttpClient('HttpCurl');
\Fondy\Configuration::setApiUrl('api.fondy.eu');

$data = [
    'order_desc' => 'test SDK',
    'currency' => 'USD',
    'amount' => 1111,
    'default_payment_system' => 'card',
    'response_url' => 'http://site.com/responseurl',
    'server_callback_url' => 'http://site.com/callbackurl',
    'payment_systems' => 'qiwi,yandex,webmoney,card,p24',
    'preauth' => 'N',
    'sender_email' => 'test@fondy.eu',
    'delayed' => 'Y',
    'lang' => 'ru',
    'product_id' => 'some_product_id',
    'required_rectoken' => 'N',
    'lifetime' => 36000,
    'verification' => 'N',
    'merchant_data' => array(
        'fields' => [
            'name'=> 'noest',
            'label'=>'dasdasdas',
            'valid'=> 'requird'
        ]
    )
];
$data['recurring_data'] =
    array(
        'start_time' => date('Y-m-d', time()),
        'amount' => 1111,
        'every' => 30,
        'period' => 'day',
        'state' => 'y',
        'readonly' => 'y'
    );
print_r(Fondy\Subscription::subscriptionUrl($data)->getData());
//end

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
//execution time of the script
echo '<b>Total Execution Time:</b>  ' . $execution_time . ' Mins';


//TODO Button error
//TODO Required fields set
//TODO Callback Handler
