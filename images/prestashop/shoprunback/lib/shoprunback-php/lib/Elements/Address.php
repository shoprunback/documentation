<?php

namespace Shoprunback\Elements;

class Address extends Element
{
    public function __toString()
    {
        return $this->display($this->line1 . ' ' . $this->line2 . ', ' . $this->city . ' ' . $this->zipcode . ', ' . $this->country_code);
    }

    public static function getBelongsTo()
    {
        return ['customer'];
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
            'line1',
            'line2',
            'zipcode',
            'country_code',
            'city',
            'state'
        ];
    }
}