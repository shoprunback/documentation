<?php

namespace Tests\Elements\Api;

use \Tests\Elements\Api\BaseApiTest;

use \Shoprunback\Elements\Warehouse;
use \Shoprunback\RestClient;
use \Shoprunback\Error\NotFoundError;

final class WarehouseTest extends BaseApiTest
{
    use \Tests\Elements\WarehouseTrait;

    public function testCanSaveNewWarehouse()
    {
        static::disableTesting();

        $warehouse = self::createDefault();

        $name = $warehouse->name;
        $reference = $warehouse->reference;

        $warehouse->save();

        $this->assertNotNull($warehouse->id);
        $this->assertSame($warehouse->name, $name);
        $this->assertSame($warehouse->reference, $reference);
    }
}