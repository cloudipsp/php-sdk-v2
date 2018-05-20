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
    'required_rectoken' => 'Y'
];

$data = [
    'order_id' => '1396424_db3e3e9db2986260927b20293ea828f5'
];
$TestCard3ds = [
    'order_id' => time(),
    'response_url' => 'http://localhost:8091/response3ds.php',
    'currency' => 'USD',
    'amount' => 10000,
    'card_number' => '4444555566661111',
    'cvv2' => '444',
    'expiry_date' => '1221',
    'client_ip' => '127.2.2.1'
];
session_start();
$_SESSION['order_id'] = $TestCard3ds['order_id'];
/*
$data = [
    'currency' => 'USD',
    'amount' => 111,
    'order_id' => '1396424_71bcb2a56f8c6fe9144a673ff0970506'
];*/

$data = Fondy\Order::transList($data);
//$data = Fondy\Pcidss::start($TestCard3ds);
//$data = Fondy\Payment::recurring($data);
//$data = Fondy\Payment::recurring($dataT);
print_r($data->getData());
//end

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
//execution time of the script
echo '<b>Total Execution Time:</b>  ' . $execution_time . ' Mins';


//TODO Callback Handler
