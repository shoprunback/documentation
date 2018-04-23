### Address

> Initialize

```php
<?php
// With a use statement
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

use \Shoprunback\Elements\Address;

$address = new Address();

// Without a use statement
require 'path/to/lib/shoprunback-php/init.php';

$address = new \Shoprunback\Elements\Address();
```

The class **Address** represents an address. It **can belong to** a **Company**, a **Customer** or a **Warehouse**.

**Address** has **no endpoint**, but is **necessary to create a Warehouse or a Customer**. For this end, an **Address has mandatory and facultative attributes**.

#### Parameters

> Create an Address

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

$address = new \Shoprunback\Elements\Address();

// Mandatory attributes
$address->line1 = '42, Noodle Boulevard';
$address->country_code = 'FR';
$address->city = 'Paris';

// Optional attributes
$address->line2 = '103 first floor';
$address->zipcode = '75001';

// We then attribute the Address to an appropriate element
$customer = new \Shoprunback\Elements\Customer();
$customer->address = $address;
```

Parameter | Required to create | Type | Description | Tips
-|-|-|-|-
**line1** | Yes | **String** | The first part of your address
**country_code** | Yes | **String** | The ISO code of your country | The format is ISO 3166-1 alpha-2
**city** | Yes | **String** | The city where your address is
**line2** | No | **String** | The second part of your address
**zipcode** | No | **String** | Your zipcode
**state** | No | **String** | Your state if your country has states
