## ReturnedItem

> Get ReturnedItems

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$shipback = \Shoprunback\Elements\Shipback::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');

$returnedItem = $shipback->returned_items;
```

The class ReturnedItem represents an item a customer ordered and wants to return.

A **Shipback owns an array of ReturnedItems**.

A **ReturnedItems** is **linked to an Item**.
