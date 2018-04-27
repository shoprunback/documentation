<?php

include_once _PS_MODULE_DIR_ . '/shoprunback/lib/shoprunback-php/init.php';
include_once 'PSInterface.php';

interface PSElementInterface extends PSInterface
{
    static function getDisplayNameAttribute();
    static function getObjectTypeForMapping();
    static function getPathForAPICall();
    static function findAllQuery($limit = 0, $offset = 0);
}