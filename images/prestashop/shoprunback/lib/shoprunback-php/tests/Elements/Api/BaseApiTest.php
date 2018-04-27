<?php

namespace Tests\Elements\Api;

use Tests\Elements\BaseElementTest;

use \Shoprunback\RestClient;

abstract class BaseApiTest extends BaseElementTest
{
    public static function disableTesting()
    {
        RestClient::getClient()->disableTesting();
    }

    public function testNewObjectIsNotPersisted()
    {
        $elementClass = static::getElementClass();
        $object = new $elementClass();
        $this->assertFalse($object->isPersisted());
    }

    public function testNewObjectWithIdIsNotPersisted()
    {
        $elementClass = static::getElementClass();
        $object = new $elementClass();
        $object->id = 1;
        $this->assertFalse($object->isPersisted());
    }

    public function testObjectFromApiIsPersisted()
    {
        static::disableTesting();

        $object = static::createDefault();
        $this->assertFalse($object->isPersisted());

        if (static::getElementClass()::canCreate()) {
            $object->save();
            $this->assertTrue($object->isPersisted());
        }
    }

    public function testCanFetchAll()
    {
        static::disableTesting();

        if (static::getElementClass()::canGetAll()) {
            $this->assertGreaterThan(0, static::getElementClass()::all()->count);
        } else {
            $this->assertTrue(true);
        }
    }

    public function testCanIterate()
    {
        static::disableTesting();

        if (static::getElementClass()::canGetAll()) {
            $elements = static::getElementClass()::all();
            $this->assertNotNull($elements[0]->id);
            $this->assertNotNull($elements[$elements->count - 1]);

            if ($elements->count > $elements->per_page && !is_null($elements->next_page)) {
                $this->assertNotNull($elements[$elements->per_page + 1]->id);
                $this->assertNotEquals(count($elements), $elements->count);
                $this->assertEquals($elements->per_page, count($elements));
            }

            $this->assertTrue(is_array($elements) || $elements instanceof \Traversable);
        } else {
            $this->assertTrue(true);
        }

    }

    /**
     * @expectedException \Shoprunback\Error\ElementIndexDoesntExists
     */
    public function testExceptionOnWrongIteration()
    {
        static::disableTesting();

        if (static::getElementClass()::canGetAll()) {
            $elements = static::getElementClass()::all();
            $elements[$elements->count + 1];
        } else {
            throw new \Shoprunback\Error\ElementIndexDoesntExists('Test worked');
        }
    }

    /**
     * @expectedException \Shoprunback\Error\NotFoundError
     */
    public function testCannotRetrieveUnknown()
    {
        static::disableTesting();

        if (static::getElementClass()::canRetrieve()) {
            static::getElementClass()::retrieve(self::randomString());
        } else {
            throw new \Shoprunback\Error\NotFoundError('Test worked');
        }
    }

    public function testCanRetrieve()
    {
        static::disableTesting();

        if (static::getElementClass()::canGetAll()) {
            $object = static::getElementClass()::all()[0];

            $retrievedObject = static::getElementClass()::retrieve($object->id);

            $this->assertSame($object->id, $retrievedObject->id);

        } else {
            $this->assertTrue(method_exists($this, 'testCanRetrieve'));
        }
    }

    public function testCanRetrieveByReference()
    {
        static::disableTesting();

        if (static::getElementClass()::canGetAll()) {
            $elementClass = static::getElementClass();
            $reference = $elementClass::getReferenceAttribute();

            $element = $elementClass::all()[0];

            $createdElement = new $elementClass();
            $createdElement->$reference = $element->getReference();

            $retrievedElement = static::getElementClass()::retrieve($createdElement->getReference());

            $this->assertSame($element->id, $retrievedElement->id);
        } else {
            $this->assertTrue(method_exists($this, 'testCanRetrieve'));
        }
    }

    /**
     * @expectedException \Shoprunback\Error\NotFoundError
     */
    public function testCanDelete()
    {
        static::disableTesting();

        if (static::getElementClass()::canDelete()) {
            $object = static::createDefault();
            $object->save();

            $object->remove();

            static::getElementClass()::retrieve($object->id);
        } else {
            throw new \Shoprunback\Error\NotFoundError('Test worked');
        }
    }
}