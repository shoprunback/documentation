## Item

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$item = new \Shoprunback\Elements\Item();
```

The class Item represents a **product a customer ordered with additionnal parameters** specific to the order.

An **Order owns an array of Items**.

An **Item** is **linked to a Product**.

> Create an Item

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

// The Item must be linked to a Product
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

// We then attribute the Item to an appropriate element
$order = new \Shoprunback\Elements\Order();
$order->items = [$item];
```
