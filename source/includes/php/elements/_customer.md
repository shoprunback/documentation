## Customer

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$customer = new \Shoprunback\Elements\Customer();
```

The class Customer represents one of your customers.

**Customer is necessary to create an Order or a Shipback**.

> Create a Customer

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$customer = new \Shoprunback\Elements\Customer();

// Mandatory attributes
$customer->first_name = 'Jean';
$customer->last_name = 'Dupont';
$customer->email = 'jeandupont@gmail.com';
$customer->phone = '0612345789';

// Mandatory nested elements
// The mandatory nested elements must be filled with the required parameters.

// Please read the doc showing how to correctly create an Address.
$customer->address = new \Shoprunback\Elements\Address();

// Optional attributes
$customer->locale = 'fr';

// We then attribute the Customer to an appropriate element
$order = new \Shoprunback\Elements\Order();
$order->customer = $customer;
```
