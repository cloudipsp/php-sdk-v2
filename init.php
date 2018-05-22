<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require 'vendor/autoload.php';
\Cloudipsp\Configuration::setMerchantId(1396424);
\Cloudipsp\Configuration::setSecretKey('test');
\Cloudipsp\Configuration::setRequestType('form');//setting request type client
\Cloudipsp\Configuration::setHttpClient('HttpGuzzle');//setting another client
\Cloudipsp\Configuration::setApiUrl('api.fondy.eu'); //api base url

//start simple test
$dataT = [
    'currency' => 'USD',
    'amount' => 111,
    'response_url' => 'http://localhost/result.php'// response page
];
$data = \Cloudipsp\Checkout::url($dataT);
print_r($data->getData());
//end
