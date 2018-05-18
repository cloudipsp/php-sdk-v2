<?php
/**
 * Created by PhpStorm.
 * User: dm
 * Date: 18.05.18
 * Time: 12:27
 */

namespace Fondy;

use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    private $mid = 1396424;
    private $secret_key = 'test';
    private $TestSubscriptionData = [
        'currency' => 'USD',
        'amount' => 10000,
        'recurring_data' => [
            'start_time' => '2021-12-24',
            'amount' => 1000,
            'every' => 30,
            'period' => 'day',
            'state' => 'y',
            'readonly' => 'y'
        ]
    ];

    private function setTestConfig()
    {
        \Fondy\Configuration::setMerchantId($this->mid);
        \Fondy\Configuration::setSecretKey($this->secret_key);
        \Fondy\Configuration::setRequestType('json');
        \Fondy\Configuration::setApiVersion('2.0');
    }

    public function testSubscriptionToken()
    {
        $this->setTestConfig();
        $result = \Fondy\Subscription::subscriptionToken($this->TestSubscriptionData)->getData();
        $this->assertNotEmpty($result['token'], 'payment_id is empty');
    }

    public function testSubscriptionUrl()
    {
        $this->setTestConfig();
        $result = \Fondy\Subscription::subscriptionUrl($this->TestSubscriptionData)->getData();
        $this->validate($result);

    }

    private function validate($result)
    {
        $this->assertNotEmpty($result['checkout_url'], 'checkout_url is empty');
        $this->assertNotEmpty($result['payment_id'], 'payment_id is empty');
    }
}
