## Order

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$order = new \Shoprunback\Elements\Order();
```

The class Order represents an online **order made by one of your customers**.

All **orders have an array of items**.

If **the customer has asked to return** some of the items, then **the order is linked to a shipback**.

> Create an Order

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$order = new \Shoprunback\Elements\Order();

// Mandatory to create a new order
$order->order_number = '4548-9854';


// Mandatory nested elements
// The mandatory nested elements must be filled with the required parameters.

// Please read the doc showing how to correctly create a Customer.
$order->customer = new \Shoprunback\Elements\Customer();

// Please read the doc showing how to correctly create a Item.
$order->items = [];
$order->items[] = new \Shoprunback\Elements\Item();


// Optional
$order->metadata = ['foo' => 'bar'];

// Now we can save the order!
$order->save();
```

#### API Methods

> Get all Orders (paginated)

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$orders = \Shoprunback\Elements\Order::all();
```

> Get an Order

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$order = \Shoprunback\Elements\Order::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967deav');
```

> Delete an Order

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

\Shoprunback\Elements\Order::delete('1f27f9d9-3b5c-4152-98b7-760f56967deav');
```

Method | Enabled
-|-
**Get all (paginated)** | Yes
**Get one** | Yes
**Create** | Yes
**Update** | No
**Delete** | Yes
