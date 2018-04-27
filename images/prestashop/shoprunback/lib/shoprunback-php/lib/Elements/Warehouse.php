<?php

namespace Shoprunback\Elements;

class Warehouse extends Element
{
    use Retrieve;
    use All;
    use Create;

    private $address;

    public function __toString()
    {
        return $this->display($this->name);
    }

    public static function getAcceptedNestedElements()
    {
        return ['address'];
    }

    public function getAllAttributes()
    {
        return get_object_vars($this);
    }

    public function getApiAttributesKeys()
    {
        return [
            'id',
            'name',
            'reference',
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