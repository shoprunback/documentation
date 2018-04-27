<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Item;
use \Shoprunback\Elements\ReturnedItem;
use \Shoprunback\RestClient;

trait ReturnedItemTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\ReturnedItem';
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

        $returnedItem = new ReturnedItem();
        $returnedItem->item = $item;
        $returnedItem->reason_code = $item;

        return $returnedItem;
    }

    public function randomReason()
    {
        return array_rand(['doesnt_fit', 'quality', 'damaged', 'wrong', 'incorrect', 'delay', 'reconsider'], 1);
    }

    protected function checkIfHasNeededValues($returnedItem)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $returnedItem
        );
        $this->assertNotNull($returnedItem->reason_code);

        $this->assertInstanceOf(
            '\Shoprunback\Elements\Item',
            $returnedItem->item
        );
        $this->assertEquals($returnedItem->item_id, $returnedItem->item->id);
    }
}