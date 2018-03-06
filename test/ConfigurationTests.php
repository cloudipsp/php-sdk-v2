<?php

class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    public function testMerchantID()
    {
        \Fondy\Configuration::setMerchantId(123);

        $this->assertEquals(123, \Fondy\Configuration::getMerchantId());
    }

    public function testSecretKey()
    {
        \Fondy\Configuration::setSecretKey('something-secret');

        $this->assertEquals('something-secret', \Fondy\Configuration::getSecretKey());
    }
}