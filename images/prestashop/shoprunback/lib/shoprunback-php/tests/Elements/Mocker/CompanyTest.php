<?php

namespace Tests\Elements\Mocker;

use \Tests\Elements\Mocker\BaseMockerTest;

use \Shoprunback\Elements\Company;
use \Shoprunback\RestClient;

final class CompanyTest extends BaseMockerTest
{
    use \Tests\Elements\CompanyTrait;

    public function testCanUpdateOneMocked()
    {
        static::enableTesting();

        $company = static::getElementClass()::retrieve(1);
        $company->name = self::randomString();
        $company->save();

        $retrievedCompany = static::getElementClass()::retrieve(1);

        $this->assertNotSame($retrievedCompany->name, $company->name);
    }

    public function testGetChangedCompanyBody()
    {
        static::enableTesting();

        $company = static::getElementClass()::retrieve(1);

        $company->name = static::randomString();
        $elementBody = $company->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);
    }

    public function testGetNewCompanyBody()
    {
        static::enableTesting();

        $company = new Company();

        $company->name = static::randomString();
        $elementBody = $company->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'name'));
        $this->assertEquals(count(get_object_vars($elementBody)), 1);

        $company->slug = static::randomString();
        $elementBody = $company->getElementBody(false);
        $this->assertTrue(property_exists($elementBody, 'slug'));
        $this->assertEquals(count(get_object_vars($elementBody)), 2);
    }

    public function testCanCreateMocked()
    {
        $this->assertTrue(true);
    }
}