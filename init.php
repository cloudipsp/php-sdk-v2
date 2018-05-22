<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setRequestType('form');//setting request type client
\Fondy\Configuration::setHttpClient('HttpGuzzle');//setting another client
\Fondy\Configuration::setApiUrl('api.fondy.eu'); //api base url

//start simple test
$dataT = [
    'currency' => 'USD',
    'amount' => 111,
    'response_url' => 'http://localhost/result.php'// response page
];
$data = \Fondy\Checkout::url($dataT);
print_r($data->getData());
//end
