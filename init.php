<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$time_start = microtime(true);

//start
require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1000);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setApiVersion('1.0');
\Fondy\Configuration::setRequestType('xml');
//\Fondy\Configuration::setHttpClient('HttpCurl');
//\Fondy\Configuration::setApiUrl('api.fondy.eu');

$data = [
    'currency' => 'USD',
    'amount' => 1000,
    'default_payment_system' => 'qiwi',
    'merchant_data' => array(
        'custom_field1' => 1,
        'custom_field2' => 2,
        'custom_field3' => 3,
    )
];
print_r(Fondy\Checkout::url($data)->getData());
//end

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
//execution time of the script
echo '<b>Total Execution Time:</b>  ' . $execution_time . ' Mins';


//TODO Button error
//TODO Required fields set
//TODO Callback Handler
