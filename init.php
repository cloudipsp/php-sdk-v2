<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$time_start = microtime(true);

//start
require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setCreditKey('test');
\Fondy\Configuration::setApiVersion('1.0');
\Fondy\Configuration::setRequestType('json');
\Fondy\Configuration::setHttpClient('HttpCurl');
\Fondy\Configuration::setApiUrl('api.fondy.eu');


$dataT = [
    'currency' => 'USD',
    'amount' => 111,
    'response_url' => 'http://localhost:8091/response.php',
    'delayed' => 'N',
   //'decline_url' => 'http://localhost:8091/decline.php',
    'order_desc' => 'Мое русское описанние !"№;"№%;№:%№??*()',
    'reservation_data' => [
        "products" => [
            [
                "id" => 1,
                "name" => "Миндаль жар.",
                "price" => 700.00,
                "total_amount" => 140.00,
                "quantity" => 0.2
            ],
            [
                "id" => 2,
                "name" => "Кешью очищ.",
                "price" => 850.00,
                "total_amount" => 127.5,
                "quantity" => 0.15
            ]
        ]
    ]
];

$data = [
    'order_id' => '1396424_4300f50fd3972e2602225889e7ce0591'
];
$TestCard3ds = [
    'order_id' => time(),
    'response_url' => 'http://localhost:8091/response3ds.php',
    'currency' => 'USD',
    'amount' => 10000,
    'card_number' => '4444555511116666',
    'cvv2' => '444',
    'expiry_date' => '1221',
    'client_ip' => '127.2.2.1'
];
//$data = Fondy\Order::atolLogs($data);
//$data = Fondy\Pcidss::start($TestCard3ds);
$data = Fondy\Checkout::url($dataT);
//$data = Fondy\Payment::recurring($dataT);
var_dump($data->getData());
//end

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
//execution time of the script
echo '<b>Total Execution Time:</b>  ' . $execution_time . ' Mins';


//TODO Callback Handler
