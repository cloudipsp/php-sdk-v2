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
        'rectoken' => ''
    ];
    private $TestCardnon3ds = [
        'card_number' => '4444555511116666',
        'cvv2' => '333',
        'expiry_date' => '1222',
        'required_rectoken' => 'Y'
    ];
    private $TestPcidssData = [
        'currency' => 'USD',
        'amount' => 1,
        'client_ip' => '127.2.2.1'
    ];

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        $this->setTestConfig();
        $this->TestData['rectoken'] = $this->getToken(array_merge($this->TestPcidssData, $this->TestCardnon3ds));
        parent::__construct($name, $data, $dataName);
    }

    private function setTestConfig()
    {
        \Fondy\Configuration::setMerchantId($this->mid);
        \Fondy\Configuration::setSecretKey($this->Secret);

    }

    public function testRecurring()
    {
        $this->setTestConfig();
        \Fondy\Configuration::setApiVersion('1.0');
        foreach ($this->request_types as $type) {
            \Fondy\Configuration::setRequestType($type);
            $result = \Fondy\Payment::recurring($this->TestData);
            $this->assertEquals($result->isApproved(), true);
            $this->assertEquals($result->isValid(), true);
            $this->assertEquals($result->getData()['response_status'], 'success');
        }
    }

    public function testRecurringv2()
    {
        $this->setTestConfig();
        \Fondy\Configuration::setApiVersion('2.0');
        \Fondy\Configuration::setRequestType('json');
        $result = \Fondy\Payment::recurring($this->TestData);
        $this->assertEquals($result->isApproved(), true);
        $this->assertEquals($result->isValid(), true);
        $this->assertEquals($result->getData()['response_status'], 'success');

    }

    private function getToken($data)
    {
        $data = \Fondy\Pcidss::start($data);
        return $data->getData()['rectoken'];
    }
}
