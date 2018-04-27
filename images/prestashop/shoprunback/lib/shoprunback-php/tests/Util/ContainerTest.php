<?php

namespace Tests\Util;

use \Tests\BaseTest;

use \Shoprunback\RestClient;
use \Shoprunback\Elements\Brand;
use \Shoprunback\Util\Container;

final class ContainerTest extends BaseTest
{
    public function testAddToMixed()
    {
        $array = [];
        $key = 'key';
        $value = 'value';
        Container::addValueToContainer($array, $key, $value);
        $this->assertSame($array[$key], $value);

        $object = new \stdClass();
        Container::addValueToContainer($object, $key, $value);
        $this->assertSame($object->$key, $value);

        $this->assertSame($array[$key], $object->$key);
    }

    public function testArrayIsContainer()
    {
        $this->assertTrue(Container::isContainer([]));
    }

    public function testObjectIsContainer()
    {
        $this->assertTrue(Container::isContainer(new \stdClass()));
    }

    public function testStringIsNotContainer()
    {
        $this->assertFalse(Container::isContainer('a'));
    }

    public function testIntIsNotContainer()
    {
        $this->assertFalse(Container::isContainer(1));
    }
}