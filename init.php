<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$time_start = microtime(true);

//start
require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setApiVersion('1.0');
\Fondy\Configuration::setRequestType('xml');
\Fondy\Configuration::setHttpClient('HttpCurl');
\Fondy\Configuration::setApiUrl('api.fondy.eu');

$data = [
    'order_desc' => 'test SDK',
    'currency' => 'USD',
    'amount' => 1111,
    'card_number' => '4444111155556666',
    'cvv2' => '444',
    'expiry_date' => '1221',
    'client_ip' => '127.2.2.1'
];
$data = Fondy\PCIDSS::start($data)->getData();
if (isset($data['acs_url'])) {
    print_r(Fondy\PCIDSS::getFrom($data, 'http://localhost:63342/sdk-v2/response.php?_ijt=k8ou6fplt8mh79h9qtjbflkq2j'));
}else{
    print_r($data);
}
//end

$time_end = microtime(true);
$execution_time = ($time_end - $time_start) / 60;
//execution time of the script
echo '<b>Total Execution Time:</b>  ' . $execution_time . ' Mins';


//TODO Button error
//TODO Required fields set
//TODO Callback Handler
