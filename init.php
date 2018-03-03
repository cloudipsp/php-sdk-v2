<?php
error_reporting(-1);
ini_set('display_errors', 'On');


require 'vendor/autoload.php';
\Fondy\Configuration::setMerchantId(1234567);
\Fondy\Configuration::setSecretKey('12423423');
\Fondy\Configuration::setHttpClient('HttpCurl');