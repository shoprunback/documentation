<?php
class ElementMapper
{
    const MAPPER_TABLE_NAME_NO_PREFIX = 'shoprunback_mapper';
    const MAPPER_INDEX_NAME = 'index_type_id_item';
    const MAPPER_INDEX_COLUMNS = 'type, id_item';

    public $id_srb_map;
    public $id_item;
    public $id_item_srb;
    public $type;
    public $last_sent_at;

    public function __construct($psMap)
    {
        $this->id_srb_map = isset($psMap[self::getIdColumnName()]) ? $psMap[self::getIdColumnName()] : 0;
        $this->id_item = $psMap['id_item'];
        $this->id_item_srb = $psMap['id_item_srb'];
        $this->type = $psMap['type'];
        $this->last_sent_at = Util::convertDateFormatForDB($psMap['last_sent_at']);
    }

    static public function getMapperTableName()
    {
        return _DB_PREFIX_ . self::MAPPER_TABLE_NAME_NO_PREFIX;
    }

    static public function getTableName()
    {
        return 'srbm';
    }

    static public function getIdColumnName()
    {
        return 'id_srb_map';
    }

    public function save()
    {
        $mapArray = [];

        foreach ($this as $key => $value) {
            $mapArray[$key] = $value;
        }

        unset($mapArray['id_srb_map']);

        if (!isset($this->id_srb_map) || $this->id_srb_map == 0) {
            $mapFromDB = ElementMapper::getByIdItemAndIdType($this->id_item, $this->type);

            if ($mapFromDB) {
                $this->id_srb_map = $mapFromDB->id_srb_map;
            }
        }

        $result = '';
        $sql = Db::getInstance();
        if (isset($this->id_srb_map) && $this->id_srb_map != 0) {
            $result = $sql->update(ElementMapper::MAPPER_TABLE_NAME_NO_PREFIX, $mapArray, 'id_item_srb = "' . pSQL($this->id_item_srb) . '"');
            SRBLogger::addLog('Map of ' . ucfirst($this->type) . ' ' . $this->id_item . ' updated', SRBLogger::INFO, $this->type, $this->id_item);
        } else {
            $result = $sql->insert(ElementMapper::MAPPER_TABLE_NAME_NO_PREFIX, $mapArray);
            SRBLogger::addLog(ucfirst($this->type) . ' ' . $this->id_item . ' mapped', SRBLogger::INFO, $this->type, $this->id_item);
        }

        return $result;
    }

    static private function returnResult($result)
    {
        return $result ? new self($result) : false;
    }

    static public function getMappingIdIfExists($itemId, $itemType)
    {
        $map = self::getByIdItemAndIdType($itemId, $itemType);

        if ($map) {
            return $map->id_item_srb;
        }

        return null;
    }

    static public function getById($id)
    {
        $sql = self::findAllQuery();
        $sql->where(self::getTableIdentifier() . ' = ' . pSQL($id));
        $result = Db::getInstance()->getRow($sql);

        return self::returnResult($result);
    }

    static public function getByType($type)
    {
        $shipbacksFromDB = Db::getInstance()->executeS(self::findByTypeQuery($type));

        $shipbacks = [];
        foreach ($shipbacksFromDB as $shipback) {
            $shipbacks[] = new self($shipback);
        }

        return $shipbacks;
    }

    static public function getByIdItemAndIdType($idItem, $type)
    {
        if (is_string($idItem) && !is_numeric($idItem)) return static::getByIdItemSRBAndIdType($idItem, $type);

        $sql = self::findAllQuery();
        $sql->where(self::getTableName() . '.id_item = ' . pSQL($idItem) . ' AND ' . pSQL(self::getTableName()) . '.type = "' . pSQL($type) . '"');
        $result = Db::getInstance()->getRow($sql);

        return self::returnResult($result);
    }

    static public function getByIdItemSRBAndIdType($idItemSrb, $type)
    {
        $sql = self::findAllQuery();
        $sql->where(self::getTableName() . '.id_item_srb = "' . pSQL($idItemSrb) . '" AND ' . pSQL(self::getTableName()) . '.type = "' . pSQL($type) . '"');
        $result = Db::getInstance()->getRow($sql);

        return self::returnResult($result);
    }

    static public function getAll()
    {
        $shipbacksFromDB = Db::getInstance()->executeS(self::findAllQuery());

        $shipbacks = [];
        foreach ($shipbacksFromDB as $shipback) {
            $shipbacks[] = new self($shipback);
        }

        return $shipbacks;
    }

    static public function findAllQuery()
    {
        $sql = new DbQuery();
        $sql->select(self::getTableName() . '.*');
        $sql->from(self::MAPPER_TABLE_NAME_NO_PREFIX, self::getTableName());

        return $sql;
    }

    static public function findByTypeQuery($type)
    {
        $sql = self::findAllQuery();
        $sql->where(self::getTableName() . '.type = "' . $type . '"');

        return $sql;
    }

    static public function findOnlyIdItemByTypeQuery($type)
    {
        $sql = new DbQuery();
        $sql->select(self::getTableName() . '.id_item');
        $sql->from(self::MAPPER_TABLE_NAME_NO_PREFIX, self::getTableName());
        $sql->where(self::getTableName() . '.type = "' . $type . '"');

        return $sql;
    }

    static public function findOnlyLastSentByTypeQuery($type)
    {
        $sql = new DbQuery();
        $sql->select(self::getTableName() . '.last_sent_at');
        $sql->from(self::MAPPER_TABLE_NAME_NO_PREFIX, self::getTableName());
        $sql->where(self::getTableName() . '.type = "' . $type . '"');

        return $sql;
    }

    static public function truncateTable()
    {
        $sql = 'TRUNCATE TABLE ' . self::getMapperTableName();
        Db::getInstance()->execute($sql);
    }
}
