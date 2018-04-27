<?php

namespace Tests\Elements\Mocker;

use \Tests\Elements\Mocker\BaseMockerTest;

use \Shoprunback\Elements\Shipback;
use \Shoprunback\Elements\Order;
use \Shoprunback\RestClient;

final class ShipbackTest extends BaseMockerTest
{
    use \Tests\Elements\ShipbackTrait;

    public function testGetNewShipbackBody()
    {
        static::enableTesting();

        $shipback = new Shipback();
        $shipback->rma = self::randomRma();
        $shipback->mode = 'postal';
        $shipback->weight_in_grams = 1000;

        $elementBody = $shipback->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'rma'));
        $this->assertTrue(property_exists($elementBody, 'mode'));
        $this->assertTrue(property_exists($elementBody, 'weight_in_grams'));
        $this->assertEquals(count(get_object_vars($elementBody)), 3);

        $order = new Order();
        $order->order_number = static::randomString();
        $order->ordered_at = date('Y-m-d');
        $shipback->order = $order;
        $elementBody = $shipback->getElementBody(false);
        $this->assertInstanceOf(
            '\Shoprunback\Elements\Order',
            $shipback->order
        );
        $this->assertEquals(count(get_object_vars($elementBody)), 4);
    }
}