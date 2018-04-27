<?php

use Shoprunback\Elements\Brand as LibBrand;

class SRBBrand extends LibBrand implements PSElementInterface
{
    use PSElementTrait;

    public function __construct($manufacturer)
    {
        $this->ps = $manufacturer;
        $this->name = $manufacturer['name'];
        $this->reference = str_replace(' ', '-', $manufacturer['name']);

        if ($srbId = $this->getMapId()) {
            parent::__construct($srbId);
        } else {
            parent::__construct();
        }
    }

    // Inherited functions
    public static function getTableName()
    {
        return 'm';
    }

    static public function getIdColumnName()
    {
        return 'id_manufacturer';
    }

    static public function getIdentifier()
    {
        return 'reference';
    }

    static public function getDisplayNameAttribute()
    {
        return 'name';
    }

    static public function getObjectTypeForMapping()
    {
        return 'brand';
    }

    static public function getPathForAPICall()
    {
        return 'brands';
    }

    static public function findAllQuery($limit = 0, $offset = 0)
    {
        $sql = new DbQuery();
        $sql->select(self::getTableName() . '.*');
        $sql->from('manufacturer', self::getTableName());
        $sql = self::addLimitToQuery($sql, $limit, $offset);

        return $sql;
    }
}