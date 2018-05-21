<?php
error_reporting(-1);
ini_set('display_errors', 'On');
print_r($_POST);
print_r('decline');
require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1396424);
\Fondy\Configuration::setSecretKey('test');
\Fondy\Configuration::setApiVersion('1.0');
\Fondy\Configuration::setRequestType('form');
\Fondy\Configuration::setHttpClient('HttpCurl');
\Fondy\Configuration::setApiUrl('api.fondy.eu');

die;