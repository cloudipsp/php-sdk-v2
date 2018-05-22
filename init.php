<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setRequestType('form');
\Fondy\Configuration::setHttpClient('HttpGuzzle');
\Fondy\Configuration::setApiUrl('api.fondy.eu');


$dataT = [
    'currency' => 'USD',
    'amount' => 111,
    'response_url' => 'http://localhost:8091/response.php',
    'server_callback_url' => 'http://test.com:8091/result.php'
];
$data = Fondy\Checkout::url($dataT);
//$data = Fondy\Payment::recurring($dataT);
print_r($data->getData());
//end
