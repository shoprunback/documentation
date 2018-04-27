<?php

namespace Tests\Elements\Api;

use \Tests\Elements\Api\BaseApiTest;

use \Shoprunback\Elements\Brand;
use \Shoprunback\RestClient;
use \Shoprunback\Error\NotFoundError;

final class BrandTest extends BaseApiTest
{
    use \Tests\Elements\BrandTrait;

    public function testCanSaveNewBrand()
    {
        static::disableTesting();

        $brand = self::createDefault();

        $name = $brand->name;
        $reference = $brand->reference;

        $brand->save();

        $this->assertNotNull($brand->id);
        $this->assertSame($brand->name, $name);
        $this->assertSame($brand->reference, $reference);
    }

    public function testCanUpdate()
    {
        static::disableTesting();

        $brand = Brand::all()[0];
        $brandId = $brand->id;
        $name = self::randomString();
        $brand->name = $name;
        $brand->save();

        $retrievedBrand = Brand::retrieve($brandId);

        $this->assertSame($retrievedBrand->name, $name);
    }
}