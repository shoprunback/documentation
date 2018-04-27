<?php

use Shoprunback\Elements\Item as LibItem;

class SRBItem extends LibItem
{
    use PSElementTrait;

    public function __construct($psProduct)
    {
        $this->price_cents = intval($psProduct['price'] * 100);
        $this->currency = $psProduct['iso_code'];
        $this->product = new SRBProduct($psProduct);
        $this->label = $this->product->label;
        $this->reference = $this->product->getReference();
    }

    static public function createItemsFromOrderId($orderId)
    {
        $sql = self::findProductsForItems();
        $sql->where('o.' . SRBOrder::getIdColumnName() . ' = "' . pSQL($orderId) . '"');
        $productsFromDB = Db::getInstance()->executeS($sql);

        return self::generateItemsWithProducts($productsFromDB);
    }

    static public function createItemsFromOrderDetail($orderDetailId)
    {
        $sql = self::findProductsForItems();
        $sql->innerJoin('order_detail', 'od', 'od.id_order = ' . SRBOrder::getTableName() . '.id_order');
        $sql->where('od.id_order_detail = ' . pSQL($orderDetailId));
        $productsFromDB = Db::getInstance()->executeS($sql);

        return self::generateItemsWithProducts($productsFromDB);
    }

    static private function findProductsForItems()
    {
        $sql = new DbQuery();
        $sql->select(SRBProduct::getTableName() . '.*, pl.name, cu.iso_code, cp.quantity');
        $sql->from('product', SRBProduct::getTableName());
        $sql->innerJoin('product_lang', 'pl', SRBProduct::getTableName() . '.id_product = pl.id_product');
        $sql->innerJoin('cart_product', 'cp', SRBProduct::getTableName() . '.id_product = cp.id_product');
        $sql->innerJoin('cart', 'ca', 'cp.id_cart = ca.id_cart');
        $sql->innerJoin('orders', SRBOrder::getTableName(), 'ca.id_cart = ' . SRBOrder::getTableName() . '.id_cart');
        $sql->innerJoin('currency', 'cu', 'cu.id_currency = ' . SRBOrder::getTableName() . '.id_currency');
        $sql->where('pl.id_lang = ' . Configuration::get('PS_LANG_DEFAULT'));

        return $sql;
    }

    static private function generateItemsWithProducts($products)
    {
        $items = [];
        foreach ($products as $product) {
            $item = new self($product);
            $quantity = $product['quantity'];

            for ($i = 1; $i <= $quantity; $i++) {
                $items[] = $item;
            }
        }

        return $items;
    }
}