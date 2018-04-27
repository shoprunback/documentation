<?php

namespace Tests\Elements\Mocker;

use Tests\Elements\BaseElementTest;

use \Shoprunback\RestClient;

abstract class BaseMockerTest extends BaseElementTest
{
    public static function enableTesting()
    {
        RestClient::getClient()->enableTesting();
    }

    public function testCanFetchOneMocked()
    {
        static::enableTesting();
        $this->checkIfHasNeededValues(static::getElementClass()::retrieve(1));
    }

    public function testObjectFromMockerIsPersisted()
    {
        static::enableTesting();
        $this->assertTrue(static::getElementClass()::retrieve(1)->isPersisted());
    }

    public function testCanFetchAllMocked()
    {
        static::enableTesting();

        if (static::getElementClass()::canGetAll()) {
            $objects = static::getElementClass()::all();
            $this->assertEquals($objects->count, 2);

            $object = $objects[0];
            $this->checkIfHasNeededValues($object);
        } else {
            $this->assertTrue(true);
        }
    }

    public function testCanCreateMocked()
    {
        static::enableTesting();

        if (static::getElementClass()::canUpdate()) {
            $object = static::createDefault();
            $object->save();

            $this->assertNotNull($object->id);
        } else {
            $this->assertTrue(true);
        }
    }

    public function testCanDeleteMocked()
    {
        static::enableTesting();

        if (static::getElementClass()::canDelete()) {
            $this->assertNull(static::getElementClass()::delete(1));
        } else {
            $this->assertTrue(true);
        }
    }

    public function testGetUnchangedElementBody()
    {
        static::enableTesting();

        $element = static::getElementClass()::retrieve(1);
        $this->assertEquals(count(get_object_vars($element->getElementBody(false))), 0);
    }
}