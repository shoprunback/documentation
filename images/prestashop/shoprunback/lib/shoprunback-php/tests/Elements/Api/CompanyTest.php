<?php

namespace Tests\Elements\Api;

use \Tests\Elements\Api\BaseApiTest;

use \Shoprunback\Elements\Company;
use \Shoprunback\RestClient;
use \Shoprunback\Error\NotFoundError;

final class CompanyTest extends BaseApiTest
{
    use \Tests\Elements\CompanyTrait;

    public function testGetOwn()
    {
        $this->checkIfHasNeededValues(static::getElementClass()::getOwn());
    }

    public function testCanUpdate()
    {
        static::disableTesting();

        $company = Company::getOwn();
        $companyId = $company->id;
        $name = self::randomString();
        $company->name = $name;
        $company->save();

        $retrievedCompany = Company::retrieve($companyId);

        $this->assertSame($retrievedCompany->name, $name);
    }

    public function testCanRetrieve()
    {
        static::disableTesting();

        $company = Company::getOwn();

        $retrievedCompany = static::getElementClass()::retrieve($company->id);

        $this->assertSame($company->id, $retrievedCompany->id);
    }

    public function testObjectFromApiIsPersisted()
    {
        static::disableTesting();

        $company = static::createDefault();
        $this->assertFalse($company->isPersisted());

        $company = static::getElementClass()::getOwn();
        $this->assertTrue($company->isPersisted());
    }

    public function testCannotRetrieveUnknown()
    {
        static::disableTesting();

        $retrievedCompany = static::getElementClass()::retrieve(self::randomString());
        $ownCompany = static::getElementClass()::getOwn();

        $this->assertEquals($retrievedCompany->id, $ownCompany->id);
    }
}