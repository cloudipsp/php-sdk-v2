<?php
/**
 * Created by PhpStorm.
 * User: dm
 * Date: 21.05.18
 * Time: 0:15
 */

namespace Fondy;

use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    private $mid = 1396424;
    private $Secret = 'test';
    private $request_types = ['json', 'xml', 'form'];
    private $TestData = [
        'currency' => 'USD',
        'amount' => 111,
        'rectoken' => 'd0110d00568b74b79eff1af5a1e4aedfd0c9df4e'
    ];

    private function setTestConfig()
    {
        \Fondy\Configuration::setMerchantId($this->mid);
        \Fondy\Configuration::setSecretKey($this->Secret);
        \Fondy\Configuration::setApiVersion('1.0');
    }

    public function testRecurring()
    {
        $this->setTestConfig();
        foreach ($this->request_types as $type) {
            \Fondy\Configuration::setRequestType($type);
            $result = \Fondy\Payment::recurring($this->TestData);
            $this->validateRecurringResult($result);
        }
    }

    private function validateRecurringResult($result)
    {
        $this->assertNotEmpty($result->isApproved(), true);
        $this->assertNotEmpty($result->isValid(), true);
        $this->assertEquals($result->getData()['response_status'], 'success');
    }
}
