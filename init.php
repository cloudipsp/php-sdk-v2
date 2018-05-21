<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$time_start = microtime(true);

//start
require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setCreditKey('test');
\Fondy\Configuration::setApiVersion('2.0');
\Fondy\Configuration::setRequestType('json');
\Fondy\Configuration::setHttpClient('HttpCurl');
\Fondy\Configuration::setApiUrl('api.fondy.eu');


$dataT = [
    'currency' => 'USD',
    'amount' => 111,
    'response_url' => 'http://localhost:8091/response.php',
    'server_callback_url' => 'http://test.com:8091/result.php'
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
