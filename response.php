<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setApiVersion('1.0');
\Fondy\Configuration::setRequestType('form');
\Fondy\Configuration::setHttpClient('HttpCurl');
\Fondy\Configuration::setApiUrl('api.fondy.eu');

$data = [
    'order_id' => '1396424_65cac3f2392aeb02517da68b96ea26d7',
    'pares' => $_POST['PaRes'],
    'md' => $_POST['MD']
];
print_r($data);
print_r($data = Fondy\PCIDSS::submit($data)->getData());
die;