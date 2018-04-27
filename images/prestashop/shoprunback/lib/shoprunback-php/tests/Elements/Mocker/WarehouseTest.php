<?php

namespace Tests\Elements\Mocker;

use \Tests\Elements\Mocker\BaseMockerTest;

use \Shoprunback\Elements\Warehouse;
use \Shoprunback\RestClient;

final class WarehouseTest extends BaseMockerTest
{
    use \Tests\Elements\WarehouseTrait;

    public function testGetChangedWarehouseBody()
    {
        static::enableTesting();

        $warehouse = Warehouse::retrieve(1);

        $warehouse->name = static::randomString();
        $elementBody = $warehouse->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
    }

    public function testGetNewWarehouseBody()
    {
        static::enableTesting();

        $warehouse = new Warehouse();

        $warehouse->name = static::randomString();
        $elementBody = $warehouse->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);

        $warehouse->reference = static::randomString();
        $elementBody = $warehouse->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'reference'));
        $this->assertEquals(count(get_object_vars($elementBody)), 2);
    }
}