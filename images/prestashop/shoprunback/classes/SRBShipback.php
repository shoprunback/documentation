<?php

use Shoprunback\Elements\Shipback as LibShipback;

class SRBShipback extends LibShipback implements PSElementInterface
{
    use PSElementTrait;

    const SHIPBACK_TABLE_NAME_NO_PREFIX = 'shoprunback_shipbacks';

    public function __construct($psReturn)
    {
        $this->ps = $psReturn;
        $this->id_srb_shipback = isset($psReturn['id_srb_shipback']) ? $psReturn['id_srb_shipback'] : '';
        $this->order = isset($psReturn['order']) ? $psReturn['order'] : SRBOrder::getById($this->ps['id_order']);
        $this->order_id = $this->order->order_number;
        $this->mode = $psReturn['mode'];
        $this->state = $psReturn['state'];
        $this->created_at = Util::convertDateFormatForDB($psReturn['created_at']);
        $this->public_url = $psReturn['public_url'];

        if ($srbId = $this->getMapId()) {
            parent::__construct($srbId);
        } else {
            parent::__construct();
        }
    }

    // Inherited functions
    public static function getTableName()
    {
        return 'srbr';
    }

    static public function getIdColumnName()
    {
        return 'id_srb_shipback';
    }

    static public function getIdentifier()
    {
        return self::getIdColumnName();
    }

    static public function getDisplayNameAttribute()
    {
        return self::getIdColumnName();
    }

    static public function getObjectTypeForMapping()
    {
        return 'shipback';
    }

    static public function getPathForAPICall()
    {
        return 'shipbacks';
    }

    static public function findAllQuery($limit = 0, $offset = 0)
    {
        $sql = new DbQuery();
        $sql->select(self::getTableName() . '.*, ' . SRBOrder::getTableName() . '.*');
        $sql->from(self::SHIPBACK_TABLE_NAME_NO_PREFIX, self::getTableName());
        $sql->innerJoin('orders', SRBOrder::getTableName(), self::getTableName() . '.id_order = ' . SRBOrder::getTableName() . '.' . SRBOrder::getIdColumnName());
        $sql->groupBy(static::getTableIdentifier());
        $sql = self::addLimitToQuery($sql, $limit, $offset);

        return $sql;
    }

    // Own functions
    static public function getShipbackTableName()
    {
        return _DB_PREFIX_ . self::SHIPBACK_TABLE_NAME_NO_PREFIX;
    }

    public function getShipbackDetails()
    {
        $sql = self::findAllQuery();
        $sql->innerJoin('order_detail', 'od', 'ord.id_order_detail = od.id_order_detail');
        $sql->where(self::getTableIdentifier() . ' = ' . pSQL($this->id));
        $sql->groupBy('ord.id_order_detail');

        return Db::getInstance()->executeS($sql);
    }

    static public function createShipbackFromOrderId($orderId)
    {
        if (self::getByOrderIdIfExists($orderId)) {
            return false;
        }

        $order = SRBOrder::getById($orderId);
        if (!$order->isShipped()) {
            return false;
        }

        $psReturn = [
            'id_srb_shipback' => 0,
            'id_order' => $orderId,
            'order' => $order,
            'state' => '0',
            'mode' => 'postal',
            'created_at' => date('Y-m-d H:i:s'),
            'public_url' => ''
        ];
        $srbShipback = new self($psReturn);
        $result = $srbShipback->sync();

        if (!is_null($result)) {
            SRBLogger::addLog('Could not create Shipback on ShopRunBack for order ' . $orderId . '. Response: ' . json_encode($result), SRBLogger::FATAL, self::getObjectTypeForMapping());
        } else {
            $srbShipback->id_srb_shipback = $srbShipback->id;
            $srbShipback->insertOnPS();
        }

        return $result;
    }

    public function insertOnPS()
    {
        $shipbackToInsert = [
            'id_srb_shipback' => $this->id,
            'id_order' => $this->ps['id_order'],
            'state' => $this->state,
            'mode' => $this->mode,
            'created_at' => Util::convertDateFormatForDB($this->created_at),
            'public_url' => $this->public_url
        ];

        $sql = Db::getInstance();
        $sql->insert(self::SHIPBACK_TABLE_NAME_NO_PREFIX, $shipbackToInsert);

        $this->mapApiCall();

        SRBLogger::addLog(self::getObjectTypeForMapping() . ' "' . $this->id . '" inserted', SRBLogger::INFO, self::getObjectTypeForMapping(), $this->id);
    }

    public function updateOnPS()
    {
        $shipbackToUpdate = [
            'state' => $this->state,
            'mode' => $this->mode,
            'created_at' => $this->created_at,
            'public_url' => $this->public_url,
        ];

        $sql = Db::getInstance();
        $result = $sql->update(self::SHIPBACK_TABLE_NAME_NO_PREFIX, $shipbackToUpdate, self::getIdColumnName() . ' = "' . pSQL($this->id) . '"');

        SRBLogger::addLog(self::getObjectTypeForMapping() . ' "' . $this->getReference() . '" updated', SRBLogger::INFO, self::getObjectTypeForMapping(), $this->getDBId());

        $this->mapApiCall();

        return $result;
    }

    public function getMapId()
    {
        return $this->id_srb_shipback;
    }

    static private function findAllByCreateDateQuery ($limit = 0, $offset = 0, $byAsc = false)
    {
        $sql = self::findAllQuery();
        $sql = SRBOrder::addComponentsToQuery($sql);
        if ($byAsc) {
            $sql->orderBy('created_at ASC');
        } else {
            $sql->orderBy('created_at DESC');
        }
        $sql = self::addLimitToQuery($sql, $limit, $offset);

        return $sql;
    }

    static public function getComponentsToFindAllWithMappingQuery($onlySyncItems = false)
    {
        $sql = static::findAllQuery();
        $sql->select(ElementMapper::getTableName() . '.id_item_srb');
        $sql->innerJoin(
            ElementMapper::MAPPER_TABLE_NAME_NO_PREFIX,
            ElementMapper::getTableName(),
            ElementMapper::getTableName() . '.id_item_srb = ' . static::getTableIdentifier() . '
                AND ' . ElementMapper::getTableName() . '.type = "' . static::getObjectTypeForMapping() . '"
                AND ' . ElementMapper::getTableName() . '.last_sent_at IN (' . ElementMapper::findOnlyLastSentByTypeQuery(static::getObjectTypeForMapping()) . ')'
        );

        return $sql;
    }

    static public function getAllByCreateDate($byAsc = false, $limit = 0, $offset = 0)
    {
        return self::generateReturnsFromDBResult(Db::getInstance()->executeS(self::findAllByCreateDateQuery($limit, $offset, $byAsc)));
    }

    static public function getLikeOrderReferenceByCreateDate($orderReference, $limit = 0, $offset = 0)
    {
        return self::generateReturnsFromDBResult(Db::getInstance()->executeS(self::findLikeOrderIdByCreateDateQuery($orderReference, $limit, $offset)));
    }

    static public function getCountLikeOrderReferenceByCreateDate($orderReference)
    {
        return self::getCountOfQuery(self::findLikeOrderIdByCreateDateQuery($orderReference));
    }

    static public function getLikeCustomerByCreateDate($customer, $limit = 0, $offset = 0)
    {
        return self::generateReturnsFromDBResult(Db::getInstance()->executeS(self::findLikeCustomerByCreateDateQuery($customer, $limit, $offset)));
    }

    static public function getCountLikeCustomerByCreateDate($customer)
    {
        return self::getCountOfQuery(self::findLikeCustomerByCreateDateQuery($customer));
    }

    static public function findLikeOrderIdByCreateDateQuery($orderReference, $limit = 0, $offset = 0)
    {
        $sql = self::findAllByCreateDateQuery($limit, $offset);
        $sql->where(SRBOrder::getTableName() . '.reference LIKE "%' . pSQL($orderReference) . '%"');
        $sql = self::addLimitToQuery($sql, $limit, $offset);

        return $sql;
    }

    static public function findLikeCustomerByCreateDateQuery($customer, $limit = 0, $offset = 0)
    {
        $sql = self::findAllByCreateDateQuery($limit, $offset);
        $sql->where('
            c.firstname LIKE "%' . pSQL($customer) . '%" OR
            c.lastname LIKE "%' . pSQL($customer) . '%" OR
            CONCAT(c.firstname, " ", c.lastname) LIKE "%' . pSQL($customer) . '%"'
        );
        $sql = self::addLimitToQuery($sql, $limit, $offset);

        return $sql;
    }

    static public function getByOrderId($orderId)
    {
        $sql = self::findAllQuery();
        $sql = SRBOrder::addComponentsToQuery($sql);
        $sql->where(self::getTableName() . '.id_order = ' . pSQL($orderId));
        $sql->orderBy('created_at', 'DESC');
        $shipbackFromDB = Db::getInstance()->getRow($sql);

        if (! $shipbackFromDB) {
            throw new ShipbackException('No shipback found for order ' . $orderId, SRBLogger::ERROR);
        }

        $shipbackFromDB['order'] = SRBOrder::createFromShipback($shipbackFromDB);

        return new self($shipbackFromDB);
    }

    static public function getByOrderIdIfExists($orderId)
    {
        try {
            return self::getByOrderId($orderId);
        } catch (ShipbackException $e) {
            return false;
        }
    }

    static private function generateReturnsFromDBResult($shipbacksFromDB)
    {
        $shipbacks = [];
        foreach ($shipbacksFromDB as $key => $shipback) {
            $shipback['order'] = SRBOrder::createFromShipback($shipback);
            $shipbacks[] = new self($shipback);
        }

        return $shipbacks;
    }

    static public function truncateTable()
    {
        $sql = 'TRUNCATE TABLE ' . self::getShipbackTableName();
        Db::getInstance()->execute($sql);
    }
}