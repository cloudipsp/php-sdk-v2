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

/*
$data = [
    'currency' => 'USD',
    'amount' => 111,
    'required_rectoken' => 'Y',
    'response_url' => 'http://localhost:8091/response.php'
];
*/
$data = [
    'currency' => 'USD',
    'amount' => 10000,
    'rectoken' => 'd0110d00568b74b79eff1af5a1e4aedfd0c9df4e'
];
/*
$data = [
    'currency' => 'USD',
    'amount' => 111,
    'order_id' => '1396424_71bcb2a56f8c6fe9144a673ff0970506'
];*/

$data = Fondy\Checkout::url($data)->getUrl();
//$data = Fondy\P2pcredit::start($data)->getData();
//$data = Fondy\Order::capture($data)->getData();
print_r($data);
//end

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
//execution time of the script
echo '<b>Total Execution Time:</b>  ' . $execution_time . ' Mins';


//TODO Callback Handler
