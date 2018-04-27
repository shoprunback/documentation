<?php

namespace Tests\Elements\Api;

use \Tests\Elements\Api\BaseApiTest;

use \Shoprunback\Elements\Order;
use \Shoprunback\Elements\Customer;
use \Shoprunback\Elements\Address;
use \Shoprunback\Elements\Item;
use \Shoprunback\Elements\Brand;
use \Shoprunback\Elements\Product;
use \Shoprunback\RestClient;

final class OrderTest extends BaseApiTest
{
    use \Tests\Elements\OrderTrait;

    public function testCanSaveNewOrder()
    {
        static::disableTesting();

        $order = self::createDefault();

        $ordered_at = $order->ordered_at;

        $order->save();

        $this->assertNotNull($order->id);
        $this->assertSame($order->ordered_at, $ordered_at);
    }
}