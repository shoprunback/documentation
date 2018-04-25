### Customer

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

// With a use statement
use \Shoprunback\Elements\Customer;

$customer = new Customer();

// Without a use statement
$customer = new \Shoprunback\Elements\Customer();
```

The class Customer represents one of your customers.

**Customer** has **no endpoint**, but is **necessary to create an Order or a Shipback**. For this end, a **Customer has mandatory and facultative attributes**.

#### Parameters

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
// The Address must then be filled with the required parameters.
// Please read the doc showing how to correctly create an Address.
$customer->address = new \Shoprunback\Elements\Address();

// Optional attributes
$customer->locale = 'fr';

// We then attribute the Customer to an appropriate element
$order = new \Shoprunback\Elements\Order();
$order->customer = $customer;
```

Parameter | Required to create | Type | Description | Tips
-|-|-|-|-
**first_name** | Yes | **String** | The first name of a customer
**last_name** | Yes | **String** | The last name of a customer
**email** | Yes | **String** | The email of a customer
**phone** | Yes | **String** | The phone number of a customer
**address** | Yes | **Address** | The Address of a customer | See Address for more information
**locale** | No | **String** | The language used for the customer | Default: the locale language set in your company parameters