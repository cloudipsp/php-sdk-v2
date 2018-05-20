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
session_start();
$data = [
    'order_id' => $_SESSION['order_id'],
    'pares' => $_POST['PaRes'],
    'md' => $_POST['MD']
];

$data = Fondy\Pcidss::submit($data)->getData();
var_dump($data);
die;