<?php

namespace Tests\Elements;

use \Shoprunback\Elements\Company;
use \Shoprunback\RestClient;

trait CompanyTrait
{
    public static function getElementClass()
    {
        return 'Shoprunback\Elements\Company';
    }

    public static function createDefault()
    {
        $company = new Company();
        $company->name = self::randomString();
        $company->slug = self::randomString();
        $company->address1 = self::randomString();
        $company->zipcode = '75000';
        $company->country_code = 'FR';
        $company->contact_email = 'example@example.com';
        $company->website_url = 'www.example.com';
        $company->phone_number = '0612345789';

        return $company;
    }

    protected function checkIfHasNeededValues($company)
    {
        $this->assertInstanceOf(
            self::getElementClass(),
            $company
        );

        $this->assertNotNull($company->name);
        $this->assertNotNull($company->slug);
        $this->assertNotNull($company->address1);
        $this->assertNotNull($company->zipcode);
        $this->assertNotNull($company->country_code);
        $this->assertNotNull($company->contact_email);
        $this->assertNotNull($company->website_url);
        $this->assertNotNull($company->phone_number);
    }

    public function testCannotCreate()
    {
        $this->assertFalse(static::getElementClass()::canCreate());
    }

    public function testCanUpdate()
    {
        $this->assertTrue(static::getElementClass()::canUpdate());
    }

    public function testCannotDelete()
    {
        $this->assertFalse(static::getElementClass()::canDelete());
    }

    public function testPrintCompanyBody()
    {
        $name = self::randomString();
        $slug = self::randomString();
        $address1 = self::randomString();
        $zipcode = self::randomString();

        $company = new Company();
        $company->name = $name;
        $company->slug = $slug;
        $company->address1 = $address1;
        $company->zipcode = $zipcode;

        $name = json_encode($name);
        $slug = json_encode($slug);
        $address1 = json_encode($address1);
        $zipcode = json_encode($zipcode);

        $this->expectOutputString($company . ': {"name":' . $name . ',"slug":' . $slug . ',"address1":' . $address1 . ',"zipcode":' . $zipcode . '}' . "\n");
        $company->printElementBody();
    }

    public function testGetBaseEndpoint ()
    {
        $this->assertSame(static::getElementClass()::getBaseEndpoint(), 'company');
    }
}