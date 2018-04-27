<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Shipback;
use \Shoprunback\Elements\Order;
use \Shoprunback\Elements\Item;
use \Shoprunback\Elements\Product;
use \Shoprunback\Elements\Customer;
use \Shoprunback\Elements\Address;
use \Shoprunback\RestClient;

trait ShipbackTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Shipback';
    }

    public static function createDefault()
    {
        $order;
        if (RestClient::getClient()->isTesting()) {
            $order = Order::Retrieve(1);
        } else {
            $order = Order::all()->getLast();
        }

        $shipback = new Shipback();
        $shipback->rma = self::randomRma();
        $shipback->mode = self::randomMode();
        $shipback->weight_in_grams = 1000;
        $shipback->computed_weight_in_grams = 1020;
        $shipback->created_at = '2017-06-15T16:17:46.435+02:0';
        $shipback->public_url = 'http://localhost:3002/company/123';
        $shipback->returned_items = [$order->items[0]];
        $shipback->order_id = $order->id;
        $shipback->order = $order;
        $shipback->customer = $order->customer;

        return $shipback;
    }

    protected function checkIfHasNeededValues($shipback)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $shipback
        );

        $this->assertNotNull($shipback->order_id);

        $this->assertInstanceOf(
            'Shoprunback\Elements\Order',
            $shipback->order
        );

        $this->assertInstanceOf(
            'Shoprunback\Elements\Company',
            $shipback->company
        );

        $this->assertInstanceOf(
            'Shoprunback\Elements\Customer',
            $shipback->customer
        );
    }

    public function testCantUpdate()
    {
        $this->assertTrue(static::getElementClass()::canUpdate());
    }

    public function testCanDelete()
    {
        $this->assertTrue(static::getElementClass()::canDelete());
    }

    public function testPrintShipbackBody()
    {
        $rma = self::randomRma();
        $mode = self::randomMode();
        $weight_in_grams = 1000;
        $computed_weight_in_grams = 1020;
        $public_url = 'http://localhost:3002/company/123';

        $shipback = new Shipback();
        $shipback->rma = $rma;
        $shipback->mode = $mode;
        $shipback->weight_in_grams = $weight_in_grams;
        $shipback->computed_weight_in_grams = $computed_weight_in_grams;
        $shipback->public_url = $public_url;

        $rma = json_encode($rma);
        $mode = json_encode($mode);
        $weight_in_grams = json_encode($weight_in_grams);
        $computed_weight_in_grams = json_encode($computed_weight_in_grams);
        $public_url = json_encode($public_url);

        $this->expectOutputString($shipback . ': {"rma":' . $rma . ',"mode":' . $mode . ',"weight_in_grams":' . $weight_in_grams . ',"computed_weight_in_grams":' . $computed_weight_in_grams . ',"public_url":' . $public_url . '}' . "\n");
        $shipback->printElementBody();
    }

    public static function randomRma()
    {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
        $randomCharacters = array_rand($seed, 12);
        $rma = '';
        foreach ($randomCharacters as $key => $character) {
            if ($key % 2 == 0 && $key > 0) {
                $rma .= ':';
            }

            $rma .= $seed[$character];
        }
        return $rma;
    }

    public static function randomMode()
    {
        $modes = ['postal', 'pickup', 'dropoff', 'direct'];
        return $modes[array_rand($modes, 1)];
    }

    public function testGetBaseEndpoint ()
    {
        $this->assertSame(static::getElementClass()::getBaseEndpoint(), 'shipbacks');
    }
}