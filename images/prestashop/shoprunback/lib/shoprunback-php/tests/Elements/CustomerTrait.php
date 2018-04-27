<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Customer;
use \Shoprunback\Elements\Address;

trait CustomerTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Customer';
    }

    public static function createDefault()
    {
        $address = new Address();
        $address->line1 = static::randomString();
        $address->country_code = 'FR';
        $address->city = static::randomString();

        $customer = new Customer();
        $customer->first_name = static::randomString();
        $customer->last_name = static::randomString();
        $customer->email = 'test@test.com';
        $customer->phone = '0123456789';
        $customer->address = $address;

        return $customer;
    }

    protected function checkIfHasNeededValues($customer)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $customer
        );
        $this->assertNotNull($customer->first_name);
        $this->assertNotNull($customer->last_name);
        $this->assertNotNull($customer->email);
        $this->assertNotNull($customer->phone);

        $this->assertInstanceOf(
            'Shoprunback\Elements\Address',
            $customer->address
        );
        $this->assertNotNull($customer->address->line1);
        $this->assertNotNull($customer->address->country_code);
        $this->assertNotNull($customer->address->city);
    }
}