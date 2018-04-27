<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Account;
use \Shoprunback\RestClient;

trait AccountTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Account';
    }

    public static function createDefault()
    {
        $account = new Account();
        $account->first_name = self::randomString();
        $account->last_name = self::randomString();
        $account->email = 'test@example.com';
        $account->created_at = '2018-03-29T15:38:13.638Z';
        $account->owner = false;
        $account->pending = false;
        $account->manager = false;
        $account->auth_token = self::randomString();

        return $account;
    }

    protected function checkIfHasNeededValues($account)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $account
        );

        $this->assertNotNull($account->first_name);
        $this->assertNotNull($account->last_name);
        $this->assertNotNull($account->email);
        $this->assertNotNull($account->created_at);
        $this->assertNotNull($account->owner);
        $this->assertNotNull($account->pending);
        $this->assertNotNull($account->manager);
        $this->assertNotNull($account->auth_token);
    }

    public function testCannotCreate()
    {
        $this->assertFalse(static::getElementClass()::canCreate());
    }

    public function testCanUpdate()
    {
        $this->assertTrue(static::getElementClass()::canUpdate());
    }

    public function testCannotDelete()
    {
        $this->assertFalse(static::getElementClass()::canDelete());
    }

    public function testPrintAccountBody()
    {
        $first_name = self::randomString();
        $last_name = self::randomString();
        $email = self::randomString();
        $owner = self::randomString();

        $account = new Account();
        $account->first_name = $first_name;
        $account->last_name = $last_name;
        $account->email = $email;
        $account->owner = $owner;

        $first_name = json_encode($first_name);
        $last_name = json_encode($last_name);
        $email = json_encode($email);
        $owner = json_encode($owner);

        $this->expectOutputString($account . ': {"first_name":' . $first_name . ',"last_name":' . $last_name . ',"email":' . $email . ',"owner":' . $owner . '}' . "\n");
        $account->printElementBody();
    }

    public function testGetBaseEndpoint ()
    {
        $this->assertSame(static::getElementClass()::getBaseEndpoint(), 'me');
    }
}