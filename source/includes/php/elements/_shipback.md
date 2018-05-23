## Shipback

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$shipback = new \Shoprunback\Elements\Shipback();
```

The class Shipback represents a return request made by a customer.

All **shipbacks are linked to an order**. They also **have an array of quotes given by the logistics service** (see Quotes for more info), **an array of returned items** and **a size set by the customer after the shipback was created**.

The **returned items** is an **array containing the selected items from the original order**.

The **quotes** is an **array of Quotes**, meaning the **available modes of transportation for the return**, with their price, state and their related data.

The **customer** is the customer that **has initially made the linked order**.

The **company** is the company **that owns the products inside the items the customer bought** in the linked order.

<aside class="warning">
You <b>need to have</b> at least <b>one Warehouse to create a Shipback</b>.
</aside>

> Create a Shipback

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$shipback = new \Shoprunback\Elements\Shipback();

// Mandatory attributes
$shipback->order_id = '1f27f9d9-3b5c-4152-98b7-760f56967deav';

// ---------------------------------------------------------------------------------------------------------
// To create a shipback, you must only set an order_id. All the other attributes are created by ShopRunBack.
// ---------------------------------------------------------------------------------------------------------

// -----------------------------------------------------------------------------------
// To create a shipback, you must have at least one Warehouse created on your account!
// -----------------------------------------------------------------------------------


// Optional
$shipback->metadata = ['foo' => 'bar'];

// Now we can save the shipback!
$shipback->save();
```

#### API Methods

> Get all Shipbacks (paginated)

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$shipbacks = \Shoprunback\Elements\Shipback::all();
```

> Get one Shipback

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$shipback = \Shoprunback\Elements\Shipback::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967deav');
```

> Delete a Shipback

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

\Shoprunback\Elements\Shipback::delete('1f27f9d9-3b5c-4152-98b7-760f56967deav');
```

Method | Enabled
-|-
**Get all (paginated)** | Yes
**Get one** | Yes
**Create** | Yes
**Update** | Yes
**Delete** | Yes
