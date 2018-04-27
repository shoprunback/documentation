<?php

namespace Tests\Elements;

use \Tests\BaseTest;

abstract class BaseElementTest extends BaseTest
{
    abstract public static function getElementClass();

    abstract public static function createDefault();

    abstract protected function checkIfHasNeededValues($object);
}