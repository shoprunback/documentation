<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Brand;

trait BrandTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Brand';
    }

    public static function createDefault()
    {
        $name = self::randomString();
        $reference = self::randomString();

        $brand = new Brand();
        $brand->name = $name;
        $brand->reference = $reference;

        return $brand;
    }

    protected function checkIfHasNeededValues($brand)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $brand
        );

        $this->assertNotNull($brand->id);
        $this->assertNotNull($brand->name);
        $this->assertNotNull($brand->reference);
    }

    public function testCanUpdate()
    {
        $this->assertTrue(static::getElementClass()::canUpdate());
    }

    public function testCanDelete()
    {
        $this->assertTrue(static::getElementClass()::canDelete());
    }

    public function testPrintBrandBody()
    {
        $name = static::randomString();
        $reference = static::randomString();

        $brand = new Brand();
        $brand->name = $name;
        $brand->reference = $reference;

        $name = json_encode($name);
        $reference = json_encode($reference);

        $this->expectOutputString($brand . ': {"name":' . $name . ',"reference":' . $reference . '}' . "\n");
        $brand->printElementBody();
    }

    public function testGetBaseEndpoint ()
    {
        $this->assertSame(static::getElementClass()::getBaseEndpoint(), 'brands');
    }
}