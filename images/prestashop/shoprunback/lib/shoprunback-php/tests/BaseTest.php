<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    public function setUp()
    {
        require_once dirname(dirname(__FILE__)) . '/init.php';
    }

    protected static function randomString()
    {
        return get_called_class() . '-' . uniqid();
    }
}