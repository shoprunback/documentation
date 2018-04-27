<?php

namespace Tests\Elements\Mocker;

use \Tests\Elements\Mocker\BaseMockerTest;

use \Shoprunback\Elements\Order;
use \Shoprunback\RestClient;

final class OrderTest extends BaseMockerTest
{
    use \Tests\Elements\OrderTrait;

    public function testGetNewOrderBody()
    {
        static::enableTesting();

        $order = new Order();

        $order->order_number = static::randomString();
        $order->ordered_at = date('Y-m-d');
        $elementBody = $order->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'order_number'));
        $this->assertTrue(property_exists($elementBody, 'ordered_at'));
        $this->assertEquals(count(get_object_vars($elementBody)), 2);

        $order->created_at = date('Y-m-d H:i:s');
        $elementBody = $order->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'created_at'));
        $this->assertEquals(count(get_object_vars($elementBody)), 3);
    }

    public function testHasItems()
    {
        static::enableTesting();

        $order = self::createDefault();
        $this->assertEquals(count($order->items), 2);
    }
}