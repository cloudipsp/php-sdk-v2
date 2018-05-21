<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(13964224);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setApiVersion('2.0');

$result = new \Fondy\Result\Result([], '', '', true);
var_dump($result->getData());
var_dump($result->isApproved());