<?php

namespace Tests\Elements\Mocker;

use \Tests\Elements\Mocker\BaseMockerTest;

use \Shoprunback\Elements\Account;
use \Shoprunback\RestClient;

final class AccountTest extends BaseMockerTest
{
    use \Tests\Elements\AccountTrait;

    public function testCanUpdateOneMocked()
    {
        static::enableTesting();

        $account = static::getElementClass()::retrieve(1);
        $account->first_name = self::randomString();
        $account->save();

        $retrievedAccount = static::getElementClass()::retrieve(1);

        $this->assertNotSame($retrievedAccount->first_name, $account->first_name);
    }

    public function testGetChangedAccountBody()
    {
        static::enableTesting();

        $account = static::getElementClass()::retrieve(1);

        $account->first_name = static::randomString();
        $elementBody = $account->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'first_name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
    }

    public function testGetNewAccountBody()
    {
        static::enableTesting();

        $account = new Account();

        $account->first_name = static::randomString();
        $elementBody = $account->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'first_name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);

        $account->last_name = static::randomString();
        $elementBody = $account->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'last_name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 2);
    }

    public function testCanCreateMocked()
    {
        $this->assertTrue(true);
    }
}