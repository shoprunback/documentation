### Item

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

// With a use statement
use \Shoprunback\Elements\Item;

$item = new Item();

// Without a use statement
$item = new \Shoprunback\Elements\Item();
```

The class Item represents a **product a customer ordered with additionnal parameters** specific to the order.

An **Order owns an array of Items**.

An **Item** is **linked to a Product**.

#### Parameters

> Create an Item

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$order = new \Shoprunback\Elements\Order();

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');

$item = new \Shoprunback\Elements\Item();

// Mandatory attributes
$item->product_id = $product->id;
$item->label = 'My item label'; // You can also set the product's label: $product->label
$item->reference = 'my-item-reference'; // You can also set the product's reference: $product->reference
$item->price_cents = 1000;

// Optional attributes
$item->barcode = '9782700507089';
$item->currency = 'eur';

$order->items = [$item];
```

Parameter | Type | Description | Tips
-|-|-|-
**label** | **String** | The label of the item | You can set the label of the product in the customer language
**reference** | **String** | Reference of the item | You can use the product's reference. If you don't, use only lowercase letters and replace spaces by -
**barcode** | **String** | If set, the barcode will be printed next to the corresponding item in the return voucher | The printed barcode is a CODE 128
**price_cents** | **INT** | The price of the item
**currency** | **String** | Currency used | Default: **eur**
**created_at** | **DateTime** | The item's creation date
**product_id** | **String** | The id of the linked Product | **When you create an Item, ONLY SET THE PRODUCT_ID**
**product** | **Product** | The linked Product | **When you create an Item, ONLY SET THE PRODUCT_ID**
