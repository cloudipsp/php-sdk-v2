<?php

namespace Cloudipsp;

use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    private $mid = 1396424;
    private $secret_key = 'test';
    private $request_types = ['json', 'xml', 'form'];
    private $fullTestData = [
        'order_desc' => 'tests SDK',
        'currency' => 'USD',
        'amount' => 21321312,
        'default_payment_system' => 'card',
        'response_url' => 'http://site.com/responseurl',
        'server_callback_url' => 'http://site.com/callbackurl',
        'payment_systems' => 'qiwi,yandex,webmoney,card,p24',
        'preauth' => 'N',
        'sender_email' => 'tests@fondy.eu',
        'delayed' => 'Y',
        'lang' => 'ru',
        'product_id' => 'some_product_id',
        'required_rectoken' => 'N',
        'lifetime' => 36000,
        'verification' => 'N',
        'subscription' => 'N',
        'merchant_data' => array(
            'custom_field1' => 1111,
            'custom_field2' => '2222',
            'custom_field3' => '3!@#$%^&(()_+?"}',
            'custom_field4' => ['custom_field4_test', 'custom_field4_test2', 'custom_field4_test3' => ['custom_field4_test3_33' => 'hello world!']]
        )
    ];

    private function setTestConfig()
    {
        \Cloudipsp\Configuration::setMerchantId($this->mid);
        \Cloudipsp\Configuration::setSecretKey($this->secret_key);
        \Cloudipsp\Configuration::setApiVersion('1.0');
    }

    /**
     * @throws Exception\ApiException
     */
    public function testUrl()
    {
        $this->setTestConfig();
        foreach ($this->request_types as $type) {
            \Cloudipsp\Configuration::setRequestType($type);
            $result = \Cloudipsp\Checkout::url($this->fullTestData)->getData();
            $this->validateCheckoutUrlResult($result);
        }
    }

    /**
     * @throws Exception\ApiException
     */
    public function testToken()
    {
        $this->setTestConfig();
        //foreach ($this->request_types as $type) {
            \Cloudipsp\Configuration::setRequestType('json');
            $result = \Cloudipsp\Checkout::token($this->fullTestData)->getData();
            $this->validateTokenResult($result);
       // }
    }

    /**
     * @throws Exception\ApiException
     */
    public function testForm()
    {
        $this->setTestConfig();
        $result = \Cloudipsp\Checkout::form($this->fullTestData);
        $this->assertInternalType('string', $result, "Got a " . gettype($result) . " instead of a string");
    }

    private function validateTokenResult($result)
    {
        $this->assertNotEmpty($result['token'], 'payment_id is empty');
        $this->assertInternalType('string', $result['token'], "Got a " . gettype($result['token']) . " instead of a string");
    }

    private function validateCheckoutUrlResult($result)
    {
        $this->assertNotEmpty($result['checkout_url'], 'checkout_url is empty');
        $this->assertNotEmpty($result['payment_id'], 'payment_id is empty');
        $this->assertEquals($result['response_status'], 'success');
    }
}
