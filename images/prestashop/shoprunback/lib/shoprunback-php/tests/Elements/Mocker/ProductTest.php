<?php

namespace Tests\Elements\Mocker;

use \Tests\Elements\Mocker\BaseMockerTest;
use \Tests\Elements\Mocker\BrandTest;

use \Shoprunback\Elements\Brand;
use \Shoprunback\Elements\Product;
use \Shoprunback\RestClient;

final class ProductTest extends BaseMockerTest
{
    use \Tests\Elements\ProductTrait;

    public function testCanUpdateOneMocked()
    {
        static::enableTesting();

        $product = self::getElementClass()::retrieve(1);
        $product->label = self::randomString();
        $product->save();

        $retrievedProduct = self::getElementClass()::retrieve(1);

        $this->assertNotSame($retrievedProduct->label, $product->label);
    }

    public function testGetBrand()
    {
        static::enableTesting();

        $product = new Product();
        $this->assertNull($product->brand);
        $product->brand_id = Brand::retrieve(1)->id;
        $this->assertInstanceOf(
            BrandTest::getElementClass(),
            $product->brand
        );
    }

    public function testGetNewProductNewBrandDirtyKeys()
    {
        static::enableTesting();

        $product = new Product();
        $product->label = self::randomString();
        $product->reference = self::randomString();
        $product->weight_grams = 1000;

        $brand = new Brand();
        $brand->name = self::randomString();
        $brand->reference = self::randomString();

        $product->brand = $brand;

        $this->assertEquals($product->getDirtyKeys(), ['label', 'reference', 'weight_grams', 'brand_id'], "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
        $this->assertEquals($product->brand->getDirtyKeys(), ['name', 'reference'], "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
    }

    public function testGetNewProductExistingBrandDirtyKeys()
    {
        static::enableTesting();

        $product = new Product();
        $product->label = self::randomString();
        $product->reference = self::randomString();
        $product->weight_grams = 1000;
        $product->brand = Brand::retrieve(1);

        $this->assertEquals($product->getDirtyKeys(), ['label', 'reference', 'weight_grams', 'brand_id'], "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
        $this->assertEquals($product->brand->getDirtyKeys(), []);
    }

    public function testGetExistingProductUpdatedBrandDirtyKeys()
    {
        static::enableTesting();

        $product = self::getElementClass()::retrieve(1);
        $product->brand->name = BrandTest::randomString();

        $this->assertEquals($product->getDirtyKeys(), []);
        $this->assertEquals($product->brand->getDirtyKeys(), ['name']);
    }

    public function testGetChangedProductBody()
    {
        static::enableTesting();

        $product = self::getElementClass()::retrieve(1);

        $product->label = self::randomString();
        $elementBody = $product->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'label'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
    }

    public function testGetNewProductBody()
    {
        static::enableTesting();

        $product = new Product();

        $product->label = self::randomString();
        $elementBody = $product->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'label'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);

        $product->reference = self::randomString();
        $elementBody = $product->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'reference'));
        $this->assertEquals(count(get_object_vars($elementBody)), 2);
    }

    public function testGetNewProductNewBrandBody()
    {
        static::enableTesting();

        $brand = new Brand();
        $brand->name = BrandTest::randomString();
        $brand->reference = BrandTest::randomString();

        $product = new Product();
        $product->brand = $brand;

        $elementBody = $product->getElementBody(false);
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
        $this->assertTrue(property_exists($elementBody, 'brand'));
    }

    public function testGetNewProductRetrievedBrandBody()
    {
        static::enableTesting();

        $brand = Brand::retrieve(1);

        $product = new Product();
        $product->brand = $brand;

        $elementBody = $product->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'brand_id'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
    }

    public function testGetRetrievedProductNewBrandBody()
    {
        static::enableTesting();

        $brand = new Brand();
        $brand->name = BrandTest::randomString();
        $brand->reference = BrandTest::randomString();

        $product = Product::retrieve(1);
        $product->brand = $brand;

        $elementBody = $product->getElementBody(false);
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
        $this->assertTrue(property_exists($elementBody, 'brand'));
    }
}