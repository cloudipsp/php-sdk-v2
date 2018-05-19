<?php
/**
 * Created by PhpStorm.
 * User: dm
 * Date: 19.05.18
 * Time: 16:44
 */

namespace Fondy;

use PHPUnit\Framework\TestCase;

class P2pcreditTest extends TestCase
{
    private $mid = 1396424;
    private $CreditKey = 'test';
    private $request_types = ['json', 'xml', 'form'];
    private $TestData = [
        'currency' => 'USD',
        'amount' => 111,
        'receiver_card_number' => '4444555511116666'
    ];

    private function setTestConfig()
    {
        \Fondy\Configuration::setMerchantId($this->mid);
        \Fondy\Configuration::setSecretKey('');
        \Fondy\Configuration::setCreditKey($this->CreditKey);
        \Fondy\Configuration::setApiVersion('1.0');
    }

    public function testCredit()
    {
        $this->setTestConfig();
        foreach ($this->request_types as $type) {
            \Fondy\Configuration::setRequestType($type);
            $result = \Fondy\P2pcredit::start($this->TestData)->getData();
            $this->validateResult($result);
        }
    }

    private function validateResult($result)
    {
        $this->assertNotEmpty($result['order_id'], 'order_id is empty');
        $this->assertNotEmpty($result['payment_id'], 'payment_id is empty');
        $this->assertEquals($result['response_status'], 'success');
    }
}
