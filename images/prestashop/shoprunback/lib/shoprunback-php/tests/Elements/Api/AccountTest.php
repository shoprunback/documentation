<?php

namespace Tests\Elements\Api;

use \Tests\Elements\Api\BaseApiTest;

use \Shoprunback\Elements\Account;
use \Shoprunback\RestClient;
use \Shoprunback\Error\NotFoundError;

final class AccountTest extends BaseApiTest
{
    use \Tests\Elements\AccountTrait;

    public function testGetOwn()
    {
        $this->checkIfHasNeededValues(static::getElementClass()::getOwn());
    }

    public function testCanUpdate()
    {
        static::disableTesting();

        $account = static::getElementClass()::getOwn();
        $accountId = $account->id;
        $first_name = self::randomString();
        $account->first_name = $first_name;
        $account->save();

        $retrievedAccount = static::getElementClass()::retrieve($accountId);

        $this->assertSame($retrievedAccount->first_name, $first_name);
    }

    public function testCanRetrieve()
    {
        static::disableTesting();

        $account = static::getElementClass()::getOwn();

        $retrievedAccount = static::getElementClass()::retrieve($account->id);

        $this->assertSame($account->id, $retrievedAccount->id);
    }

    public function testObjectFromApiIsPersisted()
    {
        static::disableTesting();

        $account = static::createDefault();
        $this->assertFalse($account->isPersisted());

        $account = static::getElementClass()::getOwn();
        $this->assertTrue($account->isPersisted());
    }
}