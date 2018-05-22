<?php
/**
 * Author: DM
 */
error_reporting(-1);
ini_set('display_errors', 'On');

require 'vendor/autoload.php';
\Cloudipsp\Configuration::setMerchantId(1396424);
\Cloudipsp\Configuration::setSecretKey('test');
\Cloudipsp\Configuration::setRequestType('form');//setting request type client
\Cloudipsp\Configuration::setHttpClient('HttpCurl');//setting another client
\Cloudipsp\Configuration::setApiUrl('api.fondy.eu'); //api base url

//start simple test
$dataC = [
    'currency' => 'USD',
    'amount' => 111,
    'response_url' => 'http://localhost/result.php'// response page
];

$data = \Cloudipsp\Checkout::url($dataC);
var_dump($data->getOrderID());
//end
