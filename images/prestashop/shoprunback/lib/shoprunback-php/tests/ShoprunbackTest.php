<?php

namespace Tests;

use \Tests\BaseTest;

use \Shoprunback\Shoprunback;

final class ShoprunbackTest extends BaseTest
{
    public function __construct()
    {
        parent::__construct();
    }

    public function testIsTesting()
    {
        $this->assertTrue(Shoprunback::isTesting());
    }
}