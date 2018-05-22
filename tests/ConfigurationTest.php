<?php

namespace Cloudipsp;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{

    public function testGetApiUrl()
    {
        $this->assertEquals('https://api.fondy.eu/api', \Cloudipsp\Configuration::getApiUrl());
        \Cloudipsp\Configuration::setApiUrl('api.saas.com');
        $this->assertEquals(
            'https://api.saas.com/api',
            \Cloudipsp\Configuration::getApiUrl()
        );
        \Cloudipsp\Configuration::setApiUrl('api.fondy.eu');
        $this->assertEquals(
            'https://api.fondy.eu/api',
            \Cloudipsp\Configuration::getApiUrl()
        );
    }

    public function testSetApiVersion()
    {
        $this->assertEquals(
            '1.0',
            \Cloudipsp\Configuration::getApiVersion()
        );
        \Cloudipsp\Configuration::setApiVersion('2.0');
        $this->assertEquals(
            '2.0',
            \Cloudipsp\Configuration::getApiVersion()
        );
    }

    public function testSetHttpClient()
    {
        \Cloudipsp\Configuration::setHttpClient('HttpCurl');
        $this->assertInstanceOf('\\Cloudipsp\\HttpClient\\HttpCurl', \Cloudipsp\Configuration::getHttpClient());
        \Cloudipsp\Configuration::setHttpClient('HttpGuzzle');
        $this->assertInstanceOf('\\Cloudipsp\\HttpClient\\HttpGuzzle', \Cloudipsp\Configuration::getHttpClient());
        \Cloudipsp\Configuration::setHttpClient('HttpCurl');
    }


    public function testSetSecretKey()
    {
        \Cloudipsp\Configuration::setSecretKey('something-secret');
        $this->assertEquals('something-secret', \Cloudipsp\Configuration::getSecretKey());
    }


    public function testSetMerchantId()
    {
        \Cloudipsp\Configuration::setMerchantId(123);
        $this->assertEquals(123, \Cloudipsp\Configuration::getMerchantId());
    }

    public function testSetCreditKey()
    {
        \Cloudipsp\Configuration::setCreditKey('something-secret');
        $this->assertEquals('something-secret', \Cloudipsp\Configuration::getCreditKey());
    }
}
