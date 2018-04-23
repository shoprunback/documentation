### Shipback

> Initialize

```php
<?php
// With a use statement
require 'path/to/lib/shoprunback-php/init.php';

use \Shoprunback\Elements\Shipback;

$shipback = new Shipback();

// Without a use statement
require 'path/to/lib/shoprunback-php/init.php';

$shipback = new \Shoprunback\Elements\Shipback();
```

The class Shipback represents a return request made by a customer.

To **create a Shipback**, you **must have at least one Warehouse** created on your account.

All **shipbacks have an array of returned items** and are **linked to an order**. They also have an **array of quotes given by the logistics service** (see Quotes for more info) and a **size set by the customer after the shipback was created**.

The **returned_items** are an **array of ReturnedItems composed of Items from the linked order**.

The **quotes** is an **array of Quotes**, meaning the **available modes to do a return**, with their price, state and their related data.

The **customer** is the customer that **has initially made the linked order**.

The **company** is the company **owning the items the customer bought** in the linked order.

<aside class="warning">
You <b>need to have</b> at least <b>one Warehouse to create a Shipback</b>.
</aside>

#### Parameters

> Create a Shipback

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$shipback = new \Shoprunback\Elements\Shipback();

// Mandatory attributes
$shipback->order_id = '1f27f9d9-3b5c-4152-98b7-760f56967deav';

// ---------------------------------------------------------------------------------------------------------
// To create a shipback, you must only set an order_id. All the other attributes are created by ShopRunBack.
// ---------------------------------------------------------------------------------------------------------

// ---------------------------------------------------------------------------------------------------------
// To create a shipback, you must have at least one Warehouse created on your account!
// ---------------------------------------------------------------------------------------------------------

// Now we can save the shipback!
$shipback->save();
```

Parameter | Required to create | Type | Description | Tips
-|-|-|-|-
**order_id** | Yes | **String** | Id of the order linked to this shipback | **When you create a shipback, ONLY SET THIS ATTRIBUTE**
**rma** | X | **String** | Return merchandise authorization. If set, a barcode of the RMA is printed at the top of the return voucher |
**mode** | X | **Enum: postal; drop-off; line-haul; direct** | The mode the client want to return its items by |
**weight_in_grams** | X | **INT** | Weight defined by the retailer | **In grams**
**computed_weight_in_grams** | X | **INT** | Sum of the returned items plus a wrapping factor | **In grams**
**created_at** | X | **DateTime** | Date of the creation of the shipback |
**public_url** | X | **String** | The URL where the user can check and fill its return request |
**returned_items** | X | **Array of ReturnedItems** | The items the user wants to return | **Contains only ReturnedItems**
**order** | X | **Order** | Order linked to this shipback |
**company_id** | X | **String** | Id of the company concerned by the shipback |
**company** | X | **Company** | Company concerned by the shipback |
**size** | X | **Jigsize** | The size selected for the shipback |
**quotes** | X | **Array of Quotes** | The quotes the shipback can use to be returned | **Contains only Quotes**

#### API operations

> Get all Shipbacks (paginated)

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$shipbacks = \Shoprunback\Elements\Shipback::all();
```

> Get one Shipback

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$shipback = \Shoprunback\Elements\Shipback::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967deav');
```

> Delete a Shipback

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

// Get the shipback and remove it later in the code
$shipback = \Shoprunback\Elements\Shipback::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967deav');

// Delete a shipback by an instance
$shipback->remove();

// --
// OR
// --

// Delete a shipback directly
\Shoprunback\Elements\Shipback::delete('1f27f9d9-3b5c-4152-98b7-760f56967deav');
```

Operation | Enabled
-|-
**Get all (paginated)** | Yes
**Get one** | Yes
**Create** | Yes
**Update** | Yes
**Delete** | Yes
