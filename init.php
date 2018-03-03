<?php
error_reporting(-1);
ini_set('display_errors', 'On');


require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setHttpClient('HttpCurl');
\Fondy\Configuration::setApiUrl('api.fondy.eu');
$fondy = new \Fondy\Fondy();
$order_id = time();
$data = [
    'order_id' => $order_id,
    'order_desc' => 'Short Order Description',
    'currency' => 'USD',
    'amount' => 2000,
    'response_url' => 'http://site_url/callback.php'
];
print_r($fondy->checkout($data));