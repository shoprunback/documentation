<?php

use Shoprunback\Elements\Customer as LibCustomer;

class SRBCustomer extends LibCustomer implements PSInterface
{
    use PSElementTrait;

    public function __construct($customer)
    {
        $this->ps = $customer;
        $this->id = $this->extractIdFromPSArray($customer);
        $this->first_name = $customer['firstname'];
        $this->last_name = $customer['lastname'];
        $this->email = $customer['email'];
        $this->locale = Configuration::get('PS_LANG_DEFAULT');
    }

    // Inherited functions
    public static function getTableName()
    {
        return 'c';
    }

    static public function getIdColumnName()
    {
        return 'id_customer';
    }

    static public function getIdentifier()
    {
        return 'id';
    }

    // Own functions
    static private function extractIdFromPSArray($psCustomerArrayName)
    {
        return isset($psCustomerArrayName['id_customer']) ? $psCustomerArrayName['id_customer'] : $psCustomerArrayName['id'];
    }

    static public function createFromOrder($psOrderArray)
    {
        $customer = new self($psOrderArray);
        $customer->address = SRBAddress::createFromOrder($psOrderArray);
        $customer->phone = $psOrderArray['phone'];

        return $customer;
    }
}