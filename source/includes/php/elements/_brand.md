## Brand

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$brand = new \Shoprunback\Elements\Brand();
```

The class Brand represents the brand you're selling. Products belongs to a brand. You can create and delete Brands and add or remove Products from your Brands.

All your **Products are linked to a Brand**.

> Create a Brand

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$brand = new \Shoprunback\Elements\Brand();

// Mandatory to create a new brand
$brand->name = 'My super brand';
$brand->reference = 'my-super-brand';

// Now we can save the brand!
$brand->save();
```

#### API operations

> Get all Brands (paginated)

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$brands = \Shoprunback\Elements\Brand::all();
```

> Get a Brand

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$brand = \Shoprunback\Elements\Brand::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

> Update a Brand

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$brand = \Shoprunback\Elements\Brand::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
$brand->name = 'New name';
$brand->save();
```

> Delete a Brand

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

// Get the brand and remove it later in the code
$brand = \Shoprunback\Elements\Brand::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');

// Delete a brand by an instance
$brand->remove();

// --
// OR
// --

// Delete a brand directly
\Shoprunback\Elements\Brand::delete('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

Operation | Enabled
-|-
**Get all (paginated)** | Yes
**Get one** | Yes
**Create** | Yes
**Update** | Yes
**Delete** | Yes