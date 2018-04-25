## Address

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$address = new \Shoprunback\Elements\Address();
```

The class **Address** represents a postal address. It **can belong to** a **Company**, a **Customer** or a **Warehouse**.

**Address is necessary to create a Warehouse or a Customer**. For this end, an **Address has mandatory and facultative attributes**.

> Create an Address

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

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
