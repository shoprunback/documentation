<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Product;
use \Shoprunback\Elements\Brand;
use \Shoprunback\RestClient;

trait ProductTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Product';
    }

    public static function createDefault()
    {
        $label = self::randomString();
        $reference = self::randomString();

        $product = new Product();
        $product->label = $label;
        $product->reference = $reference;
        $product->weight_grams = 1000;

        if (RestClient::getClient()->isTesting()) {
            $product->brand = Brand::retrieve(1);
        } else {
            $product->brand = Brand::all()[0];
        }

        return $product;
    }

    protected function checkIfHasNeededValues($product)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $product
        );

        $this->assertNotNull($product->id);
        $this->assertNotNull($product->label);
        $this->assertNotNull($product->reference);
        $this->assertNotNull($product->ean);
        $this->assertNotNull($product->weight_grams);
        $this->assertNotNull($product->width_mm);
        $this->assertNotNull($product->length_mm);
        $this->assertNotNull($product->height_mm);
        $this->assertNotNull($product->width_mm);
        $this->assertNotNull($product->picture_file_base64);
        $this->assertNotNull($product->picture_file_url);
        $this->assertNotNull($product->created_at);
        $this->assertNotNull($product->updated_at);
        $this->assertNotNull($product->picture_url);

        $this->assertSame($product->brand_id, $product->brand->id);
        $this->assertInstanceOf(
            'Shoprunback\Elements\Brand',
            $product->brand
        );
    }

    public function testCanUpdate()
    {
        $this->assertTrue(static::getElementClass()::canUpdate());
    }

    public function testCanDelete()
    {
        $this->assertTrue(static::getElementClass()::canDelete());
    }

    public function testPrintProductBody()
    {
        $label = static::randomString();
        $reference = static::randomString();

        $product = new Product();
        $product->label = $label;
        $product->reference = $reference;

        $label = json_encode($label);
        $reference = json_encode($reference);

        $this->expectOutputString($product . ': {"label":' . $label . ',"reference":' . $reference . '}' . "\n");
        $product->printElementBody();
    }

    public function testGetBaseEndpoint ()
    {
        $this->assertSame(static::getElementClass()::getBaseEndpoint(), 'products');
    }
}