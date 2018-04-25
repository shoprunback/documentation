## Warehouse

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$warehouse = new \Shoprunback\Elements\Warehouse();
```

The class Warehouse represents the destination of the items that will be returned to you.

<aside class="warning">
You <b>need to have</b> at least <b>one Warehouse to create a Shipback</b>.
</aside>

> Create a Warehouse

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$warehouse = new \Shoprunback\Elements\Warehouse();

// Mandatory to create a new warehouse
$warehouse->name = 'My warehouse';
$warehouse->reference = 'my-warehouse';

// Now we can save the warehouse!
$warehouse->save();
```

#### API operations

> Get all Warehouses (paginated)

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$warehouses = \Shoprunback\Elements\Warehouse::all();
```

> Get one Warehouse

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

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