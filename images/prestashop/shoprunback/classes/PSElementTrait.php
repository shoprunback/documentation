<?php

use \Shoprunback\ElementManager;

trait PSElementTrait
{
    static protected function convertPSArrayToElements($PSArray)
    {
        $class = get_called_class();
        $elements = [];
        foreach ($PSArray as $PSItem) {
            try {
                $elements[] =  new $class($PSItem);
            } catch (SRBException $e) {

            }
        }

        return $elements;
    }

    static public function getTableIdentifier()
    {
        return static::getTableName() . '.' . static::getIdColumnName();
    }

    public function getDBId()
    {
        return $this->ps[static::getIdColumnName()];
    }

    static public function getComponentsToFindAllWithMappingQuery($onlySyncItems = false)
    {
        $identifier = static::getIdColumnName();
        $type = static::getObjectTypeForMapping();
        $joinType = $onlySyncItems ? 'innerJoin' : 'leftJoin';
        $mapQuery = ElementMapper::findOnlyLastSentByTypeQuery($type);

        $sql = static::findAllQuery();
        $sql->select(ElementMapper::getTableName() . '.id_item_srb');
        $sql->{$joinType}(
            ElementMapper::MAPPER_TABLE_NAME_NO_PREFIX,
            ElementMapper::getTableName(),
            ElementMapper::getTableName() . '.id_item = ' . static::getTableName() . '.' . $identifier . '
                AND ' . ElementMapper::getTableName() . '.type = "' . $type . '"
                AND ' . ElementMapper::getTableName() . '.last_sent_at IN (' . $mapQuery . ')'
        );

        return $sql;
    }

    protected function findNotSyncQuery()
    {
        $type = static::getObjectTypeForMapping();
        $mapQuery = ElementMapper::findOnlyIdItemByTypeQuery($type);

        return static::findAllQuery()->where(static::getTableIdentifier() . ' NOT IN (' . $mapQuery . ')');
    }

    static protected function findAllWithMappingQuery($onlySyncItems = false, $limit = 0, $offset = 0)
    {
        $identifier = static::getIdColumnName();

        $sql = self::getComponentsToFindAllWithMappingQuery($onlySyncItems);
        $sql->select(ElementMapper::getTableName() . '.*');
        $sql->groupBy(static::getTableName() . '.' . $identifier);
        $sql->orderBy(ElementMapper::getTableName() . '.last_sent_at DESC');
        $sql = self::addLimitToQuery($sql, $limit, $offset);

        return $sql;
    }

    static public function getAllWithMapping($onlySyncItems = false, $limit = 0, $offset = 0)
    {
        $class = get_called_class();
        $items = self::convertPSArrayToElements(Db::getInstance()->executeS($class::findAllWithMappingQuery($onlySyncItems, $limit, $offset)));

        foreach ($items as $key => $item) {
            $items[$key]->id_item_srb = $item->ps['id_item_srb'];
            $items[$key]->last_sent_at = $item->ps['last_sent_at'];
        }

        return $items;
    }

    static public function getCountAllWithMapping($onlySyncItems = false)
    {
        $class = get_called_class();
        return self::getCountOfQuery($class::findCountAllWithMappingQuery($onlySyncItems));
    }

    static protected function findCountAllWithMappingQuery($onlySyncItems = false)
    {
        return self::addCountToQuery(self::getComponentsToFindAllWithMappingQuery($onlySyncItems));
    }

    static protected function addCountToQuery($sql)
    {
        return $sql->select('COUNT(DISTINCT ' . static::getTableIdentifier() . ') as count');
    }

    static protected function findOneQuery($id)
    {
        return static::addWhereId(static::getComponentsToFindAllWithMappingQuery(true), $id);
    }

    static protected function findOneNotSyncQuery($id)
    {
        return static::addWhereId(static::findAllQuery(), $id);
    }

    static protected function addWhereId($sql, $id)
    {
        $sql->where(self::getTableIdentifier() . ' = "' . pSQL($id) . '"');
        return $sql;
    }

    static public function checkResultOfGetById($result, $id)
    {
        if (!$result) {
            $class = get_called_class();
            $exceptionName = ucfirst($class::getObjectTypeForMapping()) . 'Exception';
            throw new $exceptionName('No ' . $class::getObjectTypeForMapping() . ' found with id ' . $id, 1);
        }
    }

    static public function extractNewItemFromGetByIdResult($result, $id)
    {
        static::checkResultOfGetById($result, $id);
        return static::createNewFromGetByIdQuery($result);
    }

    static public function getById($id)
    {
        return static::extractNewItemFromGetByIdResult(Db::getInstance()->getRow(static::findOneQuery($id)), $id);
    }

    static public function getNotSyncById($id)
    {
        return static::extractNewItemFromGetByIdResult(Db::getInstance()->getRow(static::findOneNotSyncQuery($id)), $id);
    }

    static public function createNewFromGetByIdQuery($result)
    {
        $class = get_called_class();
        return new $class($result);
    }

    static public function getCountOfQuery($sql)
    {
        return Db::getInstance()->getRow(self::addCountToQuery($sql))['count'];
    }

    static protected function addLimitToQuery($sql, $limit = 0, $offset = 0)
    {
        if ($limit > 0) {
            $sql->limit($limit, $offset);
        }

        return $sql;
    }

    public function isMapped()
    {
        if (!$this->getMapId()) return false;

        return true;
    }

    public function getMapId()
    {
        return isset($this->id) ? $this->id : ElementMapper::getMappingIdIfExists($this->getDBId(), static::getObjectTypeForMapping());
    }

    public function getName()
    {
        $name = static::getDisplayNameAttribute();
        return $this->{$name};
    }

    static public function getAll($limit = 0, $offset = 0)
    {
        $class = get_called_class();
        return self::convertPSArrayToElements(Db::getInstance()->executeS($class::findAllQuery($limit, $offset)));
    }

    static public function getCountAll()
    {
        $class = get_called_class();
        return self::getCountOfQuery($class::findAllQuery());
    }

    static public function getAllNotSync()
    {
        $class = get_called_class();
        return self::convertPSArrayToElements(Db::getInstance()->executeS($class::findNotSyncQuery()));
    }

    public function mapApiCall()
    {
        $identifier = static::getIdColumnName();
        $itemId = isset($this->$identifier) ? $this->$identifier : $this->getDBId();

        SRBLogger::addLog('Saving map for ' . static::getObjectTypeForMapping() . ' with ID ' . $itemId, SRBLogger::INFO, static::getObjectTypeForMapping());
        $data = [
            'id_item' => $itemId,
            'id_item_srb' => $this->getMapId(),
            'type' => static::getObjectTypeForMapping(),
            'last_sent_at' => date('Y-m-d H:i:s'),
        ];
        $map = new ElementMapper($data);
        $map->save();

        // TODO recursive mapApiCall()
    }

    public function sync()
    {
        SRBLogger::addLog('SYNCHRONIZING ' . self::getObjectTypeForMapping() . ' "' . $this->getReference() . '"', SRBLogger::INFO, self::getObjectTypeForMapping(), $this->getDBId());

        try {
            $result = $this->save();
            $this->mapApiCall();
            return $result;
        } catch (\Shoprunback\Error $e) {
            SRBLogger::addLog(json_encode($e), SRBLogger::INFO, self::getObjectTypeForMapping(), $this->getDBId());
        }
    }

    static public function syncAll($newOnly = false)
    {
        $items = $newOnly ? self::getAllNotSync() : self::getAll();

        $responses = [];
        foreach ($items as $item) {
            $responses[] = $item->sync();
        }

        return $responses;
    }
}