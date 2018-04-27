<?php

namespace Tests\Elements\Mocker;

use \Tests\Elements\Mocker\BaseMockerTest;

use \Shoprunback\Elements\Brand;
use \Shoprunback\RestClient;

final class BrandTest extends BaseMockerTest
{
    use \Tests\Elements\BrandTrait;

    public function testCanUpdateOneMocked()
    {
        static::enableTesting();

        $brand = Brand::retrieve(1);
        $brand->name = self::randomString();
        $brand->save();

        $retrievedBrand = Brand::retrieve(1);

        $this->assertNotSame($retrievedBrand->name, $brand->name);
    }

    public function testGetChangedBrandBody()
    {
        static::enableTesting();

        $brand = Brand::retrieve(1);

        $brand->name = static::randomString();
        $elementBody = $brand->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
    }

    public function testGetNewBrandBody()
    {
        static::enableTesting();

        $brand = new Brand();

        $brand->name = static::randomString();
        $elementBody = $brand->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);

        $brand->reference = static::randomString();
        $elementBody = $brand->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'reference'));
        $this->assertEquals(count(get_object_vars($elementBody)), 2);
    }
}