<?php

namespace Shoprunback\Util;

abstract class Container
{
    public static function addValueToContainer(&$container, $key, $value)
    {
        if (is_array($container)) {
            $container[$key] = $value;
        } else {
            $container->$key = $value;
        }
    }

    public static function isContainer($mixed)
    {
        return is_array($mixed) || is_object($mixed);
    }
}