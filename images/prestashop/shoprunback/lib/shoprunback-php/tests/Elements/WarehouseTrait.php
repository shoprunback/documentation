<?php

namespace Tests\Elements;

use \Tests\Elements\Nested\AddressTest;

use \Shoprunback\Elements\Warehouse;
use \Shoprunback\RestClient;

trait WarehouseTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Warehouse';
    }

    public static function createDefault()
    {
        $warehouse = new Warehouse();
        $warehouse->name = self::randomString();
        $warehouse->reference = self::randomString();
        $warehouse->address = AddressTest::createDefault();

        return $warehouse;
    }

    protected function checkIfHasNeededValues($warehouse)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $warehouse
        );

        $this->assertNotNull($warehouse->name);
        $this->assertNotNull($warehouse->reference);

        $this->assertInstanceOf(
            AddressTrait::getElementClass(),
            $warehouse->address
        );
    }

    public function testCannotUpdate()
    {
        $this->assertFalse(static::getElementClass()::canUpdate());
    }

    public function testCannotDelete()
    {
        $this->assertFalse(static::getElementClass()::canDelete());
    }

    public function testPrintWarehouseBody()
    {
        $name = self::randomString();
        $reference = self::randomString();

        $warehouse = new Warehouse();
        $warehouse->name = $name;
        $warehouse->reference = $reference;

        $name = json_encode($name);
        $reference = json_encode($reference);

        $this->expectOutputString($warehouse . ': {"name":' . $name . ',"reference":' . $reference . '}' . "\n");
        $warehouse->printElementBody();
    }

    public function testGetBaseEndpoint ()
    {
        $this->assertSame(static::getElementClass()::getBaseEndpoint(), 'warehouses');
    }
}