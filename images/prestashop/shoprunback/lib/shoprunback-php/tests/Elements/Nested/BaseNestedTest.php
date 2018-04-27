<?php

namespace Tests\Elements\Nested;

use Tests\Elements\BaseElementTest;

use \Shoprunback\RestClient;

abstract class BaseNestedTest extends BaseElementTest
{
    public function testCanOnlyBeNested()
    {
        $this->assertTrue(static::getElementClass()::canOnlyBeNested());
    }
}