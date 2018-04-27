<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Address;

trait AddressTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Address';
    }

    public static function createDefault()
    {
        $address = new Address();
        $address->line1 = static::randomString();
        $address->country_code = 'FR';
        $address->city = static::randomString();

        return $address;
    }

    protected function checkIfHasNeededValues($address)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $address
        );
        $this->assertNotNull($address->line1);
        $this->assertNotNull($address->country_code);
        $this->assertNotNull($address->city);
    }
}