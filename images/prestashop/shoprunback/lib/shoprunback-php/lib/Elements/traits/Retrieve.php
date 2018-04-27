<?php

namespace Shoprunback\Elements;

trait Retrieve
{
    public static function retrieve($id)
    {
        $instance = new static($id);
        $instance->refresh();
        return $instance;
    }
}
