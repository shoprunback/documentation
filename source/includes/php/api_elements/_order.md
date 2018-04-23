### Order

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

// With a use statement
use \Shoprunback\Elements\Order;

$order = new Order();

// Without a use statement
$order = new \Shoprunback\Elements\Order();
```

The class Order represents an **order made by a customer**. For instance, the customer **may not have claimed a shipback yet**.

All **orders have an array of items**.

If **the customer has asked to return** some of the items, then **the order is linked to a shipback**. The **returned items in this shipback** is an **array containing many items from the original order** (those the customer wants to return).

#### Parameters

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

// Now we can save the order!
$order->save();
```

Parameter | Required | Type | Description | Tips
-|-|-|-|-
**order_number** | Yes | **String** | The unique identifier linked to the order, displayed to the customer on the return process |
**customer** | Yes | **Customer** | The Customer that has made this order |
**ordered_at** | Yes | **Date (Y-m-d)** | The date when the order has been created |
**items** | Yes | **Array of Items** | The items the customer ordered |
**created_at** | X | **Datetime** | The date when the order has been created in the ShopRunBack's database | Can't be set on creation
**shipback_id** | X | **String** | The id of the shipback linked to this order | Can't be set on creation
**shipback** | X | **Shipback** | The shipback linked to this order | Can't be set on creation

#### API operations

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

// Get the order and remove it later in the code
$order = \Shoprunback\Elements\Order::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967deav');

// Delete an order by an instance
$order->remove();

// --
// OR
// --

// Delete an order directly
\Shoprunback\Elements\Order::delete('1f27f9d9-3b5c-4152-98b7-760f56967deav');
```

Operation | Enabled
-|-
**Get all (paginated)** | Yes
**Get one** | Yes
**Create** | Yes
**Update** | No
**Delete** | Yes
