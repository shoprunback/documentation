<?php

namespace Shoprunback\Elements;

class Order extends Element
{
    use Retrieve;
    use All;
    use Create;
    use Delete;

    private $shipback;
    private $customer;

    public function __toString()
    {
        return $this->display($this->order_number);
    }

    public static function getAcceptedNestedElements()
    {
        return ['items', 'customer'];
    }

    public function getAllAttributes()
    {
        return get_object_vars($this);
    }

    public static function getReferenceAttribute()
    {
        return 'order_number';
    }

    public function getApiAttributesKeys()
    {
        return [
            'id',
            'order_number',
            'ordered_at',
            'customer',
            'metadata',
            'items',
            'created_at',
            'shipback_id'
        ];
    }

    public function setShipback($shipback)
    {
        $this->shipback = $shipback;
    }

    public function getShipback()
    {
        return $this->shipback;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}