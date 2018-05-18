<?php
/**
 * Created by PhpStorm.
 * User: dm
 * Date: 18.05.18
 * Time: 14:20
 */

namespace Fondy;

use PHPUnit\Framework\TestCase;

class PCIDSSTest extends TestCase
{
    private $mid = 1396424;
    private $secret_key = 'test';
    private $request_types = ['json', 'xml', 'form'];
    private $TestCard3ds = [
        'card_number' => '4444555566661111',
        'cvv2' => '444',
        'expiry_date' => '1221',
    ];
    private $TestCardnon3ds = [
        'card_number' => '4444555511116666',
        'cvv2' => '333',
        'expiry_date' => '1222'
    ];
    private $TestPcidssData = [
        'currency' => 'USD',
        'amount' => 1000,
        'client_ip' => '127.2.2.1'
    ];

    private function setTestConfig()
    {
        \Fondy\Configuration::setMerchantId($this->mid);
        \Fondy\Configuration::setSecretKey($this->secret_key);
        \Fondy\Configuration::setApiVersion('1.0');
    }

    public function testStartNon3ds()
    {
        $this->setTestConfig();
        foreach ($this->request_types as $type) {
            \Fondy\Configuration::setRequestType($type);
            $data = array_merge($this->TestPcidssData, $this->TestCardnon3ds);
            $result = \Fondy\PCIDSS::start($data)->getData();
            $this->validateNon3dResult($result);
        }
    }

    public function testgetFrom()
    {
        $data = [
            'acs_url' => 'http://some-url.com',
            'pareq' => 'pareq',
            'md' => 'pareq',
            'TermUrl' => 'http://some-url.com'
        ];
        $form = \Fondy\PCIDSS::getFrom($data);
        $this->assertTrue(is_string($form), "Got a " . gettype($form) . " instead of a string");
    }

    public function testStart3ds()
    {
        $this->setTestConfig();
        foreach ($this->request_types as $type) {
            \Fondy\Configuration::setRequestType($type);
            $data = array_merge($this->TestPcidssData, $this->TestCard3ds);
            $result = \Fondy\PCIDSS::start($data)->getData();
            $this->validate3dResult($result);
        }
    }

    private function validate3dResult($result)
    {
        $this->assertNotEmpty($result['acs_url'], 'asc_url is empty');
        $this->assertEquals($result['response_status'], 'success');
    }

    private function validateNon3dResult($result)
    {
        $this->assertNotEmpty($result['order_id'], 'order_id is empty');
        $this->assertNotEmpty($result['order_status'], 'order_status is empty');
        $this->assertEquals($result['response_status'], 'success');
    }
}
