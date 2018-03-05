<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$time_start = microtime(true);

//start
require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setRequestType('form');
\Fondy\Configuration::setHttpClient('HttpCurl');
\Fondy\Configuration::setApiUrl('api.fondy.eu');

$data = [
    'currency' => 'USD',
    'amount' => 1000,
    'order_desc' => null
];
var_dump(Fondy\Checkout::url($data)->getData());
//end

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
//execution time of the script
echo '<b>Total Execution Time:</b>  ' . $execution_time . ' Mins';