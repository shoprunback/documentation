<?php

namespace Tests\Util;

require_once dirname(__FILE__) . '/../../init.php';

use \Tests\BaseTest;

use \Shoprunback\RestClient;
use \Shoprunback\Elements\Brand;
use \Shoprunback\Util\Inflector;
use \Shoprunback\Util\Container;

final class InflectorTest extends BaseTest
{
    public function testIsKnownElement()
    {
        $this->assertTrue(Inflector::isKnownElement('Brand'));
        $this->assertTrue(Inflector::isKnownElement('brand'));
        $this->assertFalse(Inflector::isKnownElement('Brands'));

        $this->assertTrue(Inflector::isKnownElement('Address'));
        $this->assertTrue(Inflector::isKnownElement('Customer'));
        $this->assertTrue(Inflector::isKnownElement('Item'));
        $this->assertTrue(Inflector::isKnownElement('Order'));
        $this->assertTrue(Inflector::isKnownElement('Product'));
    }

    public function testClassify()
    {
        $this->assertSame(Inflector::classify('Brand'), 'Brand');
        $this->assertSame(Inflector::classify('Brands'), 'Brand');
        $this->assertSame(Inflector::classify('Country'), 'Country');
        $this->assertSame(Inflector::classify('Countries'), 'Country');
        $this->assertSame(Inflector::classify('Address'), 'Address');
        $this->assertSame(Inflector::classify('Addresses'), 'Address');
    }

    public function testPluralize()
    {
        $this->assertSame(Inflector::pluralize('Brand'), 'brands');
        $this->assertSame(Inflector::pluralize('Brands'), 'brands');
        $this->assertSame(Inflector::pluralize('Country'), 'countries');
        $this->assertSame(Inflector::pluralize('Countries'), 'countries');
        $this->assertSame(Inflector::pluralize('Address'), 'addresses');
        $this->assertSame(Inflector::pluralize('Addresses'), 'addresses');
    }

    public function testIsPluralClassName()
    {
        $this->assertTrue(Inflector::isPluralClassName('Brand', 'brands'));
        $this->assertTrue(Inflector::isPluralClassName('Brands', 'brands'));
        $this->assertTrue(Inflector::isPluralClassName('Country', 'countries'));
        $this->assertTrue(Inflector::isPluralClassName('Countries', 'countries'));
        $this->assertSame(Inflector::isPluralClassName('Address'), 'addresses');
        $this->assertSame(Inflector::isPluralClassName('Addresses'), 'addresses');
    }

    public function testConstantizeOne()
    {
        RestClient::getClient()->enableTesting();
        $retrievedBrand = Brand::retrieve(1);

        $name = self::randomString();
        $reference = self::randomString();
        $arrayBrand = ['name' => $name, 'reference' => $reference];
        $objectBrand = new \stdClass();
        $objectBrand->name = $name;
        $objectBrand->reference = $reference;

        $inflectedArrayBrand = Inflector::constantize($arrayBrand, 'Brand');
        $inflectedObjectBrand = Inflector::constantize($objectBrand, 'Brand');

        $this->assertSame($inflectedArrayBrand->name, $name);
        $this->assertSame($inflectedObjectBrand->name, $name);

        $this->assertSame($inflectedArrayBrand->reference, $reference);
        $this->assertSame($inflectedObjectBrand->reference, $reference);

        $this->assertEquals($inflectedArrayBrand->_origValues, $inflectedObjectBrand->_origValues);
    }

    public function testGetClassElement()
    {
        $brand = new Brand();
        $this->assertSame(Inflector::getClass($brand), 'Shoprunback\Elements\Brand');
        $this->assertSame(Inflector::getClass(get_class($brand)), 'Shoprunback\Elements\Brand');
    }

    public function testGetClassChild()
    {
        $brandChild = new BrandChild('');
        $this->assertSame(Inflector::getClass($brandChild), 'Shoprunback\Elements\Brand');
        $this->assertSame(Inflector::getClass('Tests\Util\BrandChild'), 'Shoprunback\Elements\Brand');
    }

    public function testGetClassGrandChild()
    {
        $brandChildChild = new BrandChildChild();
        $this->assertSame(Inflector::getClass($brandChildChild), 'Shoprunback\Elements\Brand');
        $this->assertSame(Inflector::getClass('Tests\Util\BrandChildChild'), 'Shoprunback\Elements\Brand');
    }

    /**
     * @expectedException \Shoprunback\Error\UnknownElement
     */
    public function testGetClassUnknown()
    {
        $stdClass = new \stdClass();
        Inflector::getClass($stdClass);
    }
}

// To test getClass
class BrandChild extends \Shoprunback\Elements\Brand
{
    public function __construct($params){}
}
class BrandChildChild extends BrandChild
{
    public function __construct(){}
}