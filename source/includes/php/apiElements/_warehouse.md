### Warehouse

> Initialize

```php
<?php
// With a use statement
require 'path/to/lib/shoprunback-php/init.php';

use \Shoprunback\Elements\Warehouse;

$warehouse = new Warehouse();

// Without a use statement
require 'path/to/lib/shoprunback-php/init.php';

$warehouse = new \Shoprunback\Elements\Warehouse();
```

The class Warehouse represents a warehouse the products will pass by to be returned to the trader.

You **need to have** at least **one Warehouse to create a shipback**.

#### Parameters

> Create a Warehouse

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$warehouse = new \Shoprunback\Elements\Warehouse();

// Mandatory to create a new warehouse
$warehouse->name = 'My warehouse';
$warehouse->reference = 'my-warehouse';

// Now we can save the warehouse!
$warehouse->save();
```

Parameter | Required to create | Type | Description
-|-|-|-
**name** | Yes | **String** | Name of the warehouse, displayed to the customer on the return process
**reference** | Yes | **String** | Unique reference of the warehouse (if you don't have any, use the name)
**address** | Yes | **Address** | Address of the warehouse

#### API operations

> Get all Warehouses (paginated)

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$warehouses = \Shoprunback\Elements\Warehouse::all();
```

> Get one Warehouse

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$warehouse = \Shoprunback\Elements\Warehouse::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

Operation | Enabled
-|-
**Get all (paginated)** | Yes
**Get one** | Yes
**Create** | Yes
**Update** | No
**Delete** | No