<?php

namespace Tests\Elements\Api;

use \Tests\Elements\Api\BaseApiTest;

use \Shoprunback\Elements\Brand;
use \Shoprunback\Elements\Product;
use \Shoprunback\RestClient;

final class ProductTest extends BaseApiTest
{
    use \Tests\Elements\ProductTrait;

    public function testCanSaveNewProduct()
    {
        static::disableTesting();

        $product = self::createDefault();

        $label = $product->label;
        $reference = $product->reference;

        $product->save();

        $this->assertNotNull($product->id);
        $this->assertSame($product->label, $label);
        $this->assertSame($product->reference, $reference);
    }

    public function testCanUpdate()
    {
        static::disableTesting();

        $product = Product::all()[0];
        $productId = $product->id;
        $label = self::randomString();
        $product->label = $label;
        $product->save();

        $retrievedProduct = Product::retrieve($productId);

        $this->assertSame($retrievedProduct->label, $label);
    }

    public function testGetExistingProductExistingBrandDirtyKeys()
    {
        static::disableTesting();

        $product = Product::all()[0];
        $product->brand = Brand::all()[1];

        $this->assertEquals($product->getDirtyKeys(), ['brand_id']);
        $this->assertEquals($product->brand->getDirtyKeys(), []);
    }

    public function testGetExistingProductNewBrandDirtyKeys()
    {
        static::disableTesting();

        $product = Product::all()[0];
        $brand = new Brand();
        $brand->name = BrandTest::randomString();
        $brand->reference = BrandTest::randomString();

        $product->brand = $brand;

        $this->assertEquals($product->getDirtyKeys(), ['brand_id']);
        $this->assertEquals($product->brand->getDirtyKeys(), ['name', 'reference'], "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
    }

    public function testGetExistingProductExistingUpdatedBrandDirtyKeys()
    {
        static::disableTesting();

        $product = Product::all()[0];
        $product->brand = Brand::all()[1];
        $product->brand->name = BrandTest::randomString();

        $this->assertEquals($product->getDirtyKeys(), ['brand_id']);
        $this->assertEquals($product->brand->getDirtyKeys(), ['name']);
    }

    public function testGetRetrievedProductRetrievedBrandBody()
    {
        static::disableTesting();

        $product = Product::all()[0];
        $product->brand = Brand::all()[1];

        $elementBody = $product->getElementBody(false);
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
        $this->assertTrue(property_exists($elementBody, 'brand_id'));
    }

    public function testGetRetrievedProductChangeRetrievedBrandBody()
    {
        static::disableTesting();

        $product = Product::all()[0];
        $product->brand = Brand::all()[1];
        $product->brand->name = BrandTest::randomString();

        $elementBody = $product->getElementBody(false);
        $this->assertEquals(count(get_object_vars($elementBody)), 2);
        $this->assertTrue(property_exists($elementBody, 'brand'));
        $this->assertTrue(property_exists($elementBody, 'brand_id'));

        $elementBody = $product->brand->getElementBody(false);
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
        $this->assertTrue(property_exists($elementBody, 'name'));
    }
}