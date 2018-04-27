<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Item;
use \Shoprunback\Elements\Product;
use \Shoprunback\RestClient;

trait ItemTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Item';
    }

    public static function createDefault()
    {
        $product;
        if (RestClient::getClient()->isTesting()) {
            $product = Product::Retrieve(1);
        } else {
            $product = Product::all()[0];
        }

        $item = new Item();
        $item->product = $product;
        $item->product_id = $product->id;
        $item->label = $product->label;
        $item->reference = $product->reference;
        $item->barcode = '9782700507089';
        $item->price_cents = 1000;
        $item->currency = 'eur';
        $item->created_at = '2017-06-15T16:17:46.482+02:00';

        return $item;
    }

    protected function checkIfHasNeededValues($item)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $item
        );
        $this->assertNotNull($item->label);
        $this->assertNotNull($item->reference);
        $this->assertNotNull($item->barcode);
        $this->assertNotNull($item->price_cents);
        $this->assertNotNull($item->currency);

        $this->assertInstanceOf(
            'Shoprunback\Elements\Product',
            $item->product
        );
        $this->assertNotNull($item->product_id);
        $this->assertEquals($item->product_id, $item->product->id);
    }
}