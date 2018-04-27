<?php

namespace Shoprunback\Elements;

class Customer extends Element
{
    private $address;

    public function __toString()
    {
        return $this->display($this->first_name . ' ' . $this->last_name);
    }

    public static function getBelongsTo()
    {
        return ['order', 'shipback'];
    }

    public static function getAcceptedNestedElements()
    {
        return ['address'];
    }

    public static function canOnlyBeNested()
    {
        return true;
    }

    public static function getReferenceAttribute()
    {
        return 'id';
    }

    public function getAllAttributes()
    {
        return get_object_vars($this);
    }

    public function getApiAttributesKeys()
    {
        return [
            'id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'locale',
            'address'
        ];
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }
}