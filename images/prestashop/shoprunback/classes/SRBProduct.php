<?php

use Shoprunback\Elements\Product as LibProduct;
use Shoprunback\Elements\Brand as LibBrand;

class SRBProduct extends LibProduct implements PSElementInterface
{
    use PSElementTrait;

    public function __construct($psProduct)
    {
        $this->ps = $psProduct;
        $this->label = $this->extractNameFromPSArray($psProduct['name']);
        $reference = $psProduct['reference'] != '' ? $psProduct['reference'] : $this->label;
        $this->reference = str_replace(' ', '-', $reference);
        $this->weight_grams = intval($psProduct['weight'] * 1000);
        $this->width_mm = intval($psProduct['width'] * 10);
        $this->height_mm = intval($psProduct['height'] * 10);
        $this->length_mm = intval($psProduct['depth'] * 10);
        $this->addCoverPicture();

        if ($psProduct['id_manufacturer'] != 0) {
            $this->brand = SRBBrand::getNotSyncById($psProduct['id_manufacturer']);
            $this->brand_id = $this->brand->reference;
        }

        if ($srbId = $this->getMapId()) {
            parent::__construct($srbId);
        } else {
            parent::__construct();
        }
    }

    // Inherited functions
    public static function getTableName()
    {
        return 'p';
    }

    static public function getIdColumnName()
    {
        return 'id_product';
    }

    static public function getIdentifier()
    {
        return 'reference';
    }

    static public function getDisplayNameAttribute()
    {
        return 'label';
    }

    static public function getObjectTypeForMapping()
    {
        return 'product';
    }

    static public function getPathForAPICall()
    {
        return 'products';
    }

    static public function findAllQuery($limit = 0, $offset = 0)
    {
        $sql = new DbQuery();
        $sql->select(self::getTableName() . '.*, pl.*');
        $sql->from('product', self::getTableName());
        $sql->innerJoin('product_lang', 'pl', self::getTableName() . '.id_product = pl.id_product');
        $sql->where('pl.id_lang = ' . Configuration::get('PS_LANG_DEFAULT'));
        $sql = self::addLimitToQuery($sql, $limit, $offset);

        return $sql;
    }

    // Own functions
    static private function extractNameFromPSArray($psProductArrayName)
    {
        return is_array($psProductArrayName) ? $psProductArrayName[1] : $psProductArrayName;
    }

    static public function getOrderProducts($orderId)
    {
        return self::convertPSArrayToSRBObjects(Db::getInstance()->executeS(self::findOrderProductsQuery($orderId)));
    }

    public function getCoverPicture()
    {
        $productCover = Product::getCover($this->getDBId());
        $image = new Image($productCover['id_image']);
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . _THEME_PROD_DIR_ . $image->getExistingImgPath() . '.jpg';

        if (file_exists($imagePath)) {
            return file_get_contents($imagePath);
        }

        return false;
    }

    private function addCoverPicture()
    {
        $coverPicture = $this->getCoverPicture();

        if ($coverPicture) {
            $this->picture_file_url = 'ps-' . $this->label;
            $this->picture_file_base64 = 'data:image/png;base64,' . base64_encode($coverPicture);
        }
    }

    // Check if product has NEVER been ordered
    public static function canBeDeleted($dbId)
    {
        $sql = new DbQuery();
        $sql->select('COUNT(' . SRBOrder::getTableName() . '.id_order)');
        $sql->from('product', self::getTableName());
        $sql->innerJoin('cart_product', 'cp', self::getTableIdentifier() . ' = cp.id_product');
        $sql->innerJoin('cart', 'ca', 'cp.id_cart = ca.id_cart');
        $sql->innerJoin('orders', SRBOrder::getTableName(), 'ca.id_cart = ' . SRBOrder::getTableName() . '.id_cart');
        $sql->where(self::getTableIdentifier() . ' = ' . $dbId);

        return (Db::getInstance()->getValue($sql) == 0);
    }

    public function deleteWithCheck()
    {
        if (!static::canBeDeleted($this->getDBId())) {
            SRBLogger::addLog('Product "' . $this->getReference() . '" couldn\'t be deleted because it has already been ordered', SRBLogger::WARNING, self::getObjectTypeForMapping(), $this->getDBId());
            return false;
        }

        if ($this->syncDelete() != '') {
            SRBLogger::addLog('An error occured, product "' . $this->getReference() . '" couldn\'t be deleted', SRBLogger::FATAL, self::getObjectTypeForMapping(), $this->getDBId());
            return false;
        }

        SRBLogger::addLog('Product "' . $this->getReference() . '" deleted', SRBLogger::INFO, self::getObjectTypeForMapping(), $this->getDBId());
        return true;
    }

    public function syncDelete()
    {
        SRBLogger::addLog('DELETING ' . self::getObjectTypeForMapping() . ' "' . $this->getReference() . '"', SRBLogger::INFO, self::getObjectTypeForMapping(), $this->getDBId());
        $product = Product::retrieve($this->id);
        return $product->remove();
    }

    static protected function findOrderProductsQuery($orderId)
    {
        $sql = new DbQuery();
        $sql->select(self::getTableName() . '.*, pl.name, cu.iso_code');
        $sql->from('product', self::getTableName());
        $sql->innerJoin('product_lang', 'pl', self::getTableName() . '.id_product = pl.id_product');
        $sql->innerJoin('cart_product', 'cp', self::getTableName() . '.id_product = cp.id_product');
        $sql->innerJoin('cart', 'ca', 'cp.id_cart = ca.id_cart');
        $sql->innerJoin('orders', SRBOrder::getTableName(), 'ca.id_cart = ' . SRBOrder::getTableName() . '.id_cart');
        $sql->innerJoin('currency', 'cu', 'cu.id_currency = ' . SRBOrder::getTableName() . '.id_currency');
        $sql->where('pl.id_lang = ' . Configuration::get('PS_LANG_DEFAULT'));
        $sql->where(SRBOrder::getTableName() . '.id_order = ' . pSQL($orderId));

        return $sql;
    }
}