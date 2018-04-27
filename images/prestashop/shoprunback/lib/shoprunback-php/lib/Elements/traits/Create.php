<?php

namespace Shoprunback\Elements;

trait Create
{
    public static function create($element)
    {
        $element->save();
        return $element;
    }
}
