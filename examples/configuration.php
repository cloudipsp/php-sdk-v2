<?php
error_reporting(-1);
ini_set('display_errors', 'On');

/**
 * Setting up testing configuration
 * All testing details you can find here https://docs.fondy.eu/docs/page/2/
 */
define('SDK_ROOTPATH', __DIR__);
require_once SDK_ROOTPATH . '/../vendor/autoload.php';
\Cloudipsp\Configuration::setMerchantId(1396424);
\Cloudipsp\Configuration::setSecretKey('test');
