<?php

namespace Fondy;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{

    public function testGetApiUrl()
    {
        $this->assertEquals('https://api.fondy.eu/api', \Fondy\Configuration::getApiUrl());
        \Fondy\Configuration::setApiUrl('api.saas.com');
        $this->assertEquals(
            'https://api.saas.com/api',
            \Fondy\Configuration::getApiUrl()
        );
        \Fondy\Configuration::setApiUrl('api.fondy.eu');
        $this->assertEquals(
            'https://api.fondy.eu/api',
            \Fondy\Configuration::getApiUrl()
        );
    }

    public function testSetApiVersion()
    {
        $this->assertEquals(
            '1.0',
            \Fondy\Configuration::getApiVersion()
        );
        \Fondy\Configuration::setApiVersion('2.0');
        $this->assertEquals(
            '2.0',
            \Fondy\Configuration::getApiVersion()
        );
    }

    public function testSetHttpClient()
    {
        $this->assertInstanceOf('\\Fondy\\HttpClient\\HttpCurl', \Fondy\Configuration::getHttpClient());
        \Fondy\Configuration::setHttpClient('HttpGuzzle');
        $this->assertInstanceOf('\\Fondy\\HttpClient\\HttpGuzzle', \Fondy\Configuration::getHttpClient());
        \Fondy\Configuration::setHttpClient('HttpCurl');
    }


    public function testSetSecretKey()
    {
        \Fondy\Configuration::setSecretKey('something-secret');
        $this->assertEquals('something-secret', \Fondy\Configuration::getSecretKey());
    }


    public function testSetMerchantId()
    {
        \Fondy\Configuration::setMerchantId(123);
        $this->assertEquals(123, \Fondy\Configuration::getMerchantId());
    }

    public function testSetCreditKey()
    {
        \Fondy\Configuration::setCreditKey('something-secret');
        $this->assertEquals('something-secret', \Fondy\Configuration::getCreditKey());
    }
}
