<?php

use Shoprunback\Elements\Address as LibAddress;

class SRBAddress extends LibAddress implements PSInterface
{
    use PSElementTrait;

    public function __construct($address)
    {
        $this->id = $address['id_address'];
        $this->line1 = $address['address1'];
        $this->line2 = $address['address2'];
        $this->zipcode = $address['postcode'];
        $this->country_code = $address['iso_code'];
        $this->city = $address['city'];
        $this->state = $address['stateName'];
    }

    // Inherited functions
    public static function getTableName()
    {
        return 'a';
    }

    static public function getIdColumnName()
    {
        return 'id_address';
    }

    static public function getIdentifier()
    {
        return 'id';
    }

    // Own functions
    static public function getByCustomerId($customerId)
    {
        return self::convertPSArrayToSRBObjects(Db::getInstance()->executeS(self::findByCustomerIdQuery($customerId)));
    }

    static public function getByOrderId($orderId)
    {
        return self::convertPSArrayToSRBObjects(Db::getInstance()->getRow(self::findByOrderIdQuery($orderId)));
    }

    static public function createFromOrder($psOrder)
    {
        return new self($psOrder);
    }

    static protected function findByCustomerIdQuery($customerId)
    {
        return self::findAllQuery()->where('id_customer = ' . pSQL($customerId));
    }

    static protected function findByOrderIdQuery($orderId)
    {
        return self::findAllQuery()->innerJoin('orders', SRBOrder::getTableName(), SRBOrder::getTableName() . '.id_address_delivery = ' . self::getTableName() . '.id_address')->where(SRBOrder::getTableName() . '.id_order = ' . pSQL($orderId));
    }
}