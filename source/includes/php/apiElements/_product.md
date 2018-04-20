### Product

> Initialize

```php
<?php
// With a use statement
require 'path/to/lib/shoprunback-php/init.php';

use \Shoprunback\Elements\Product;

$product = new Product();

// Without a use statement
require 'path/to/lib/shoprunback-php/init.php';

$product = new \Shoprunback\Elements\Product();
```

The class Product represents a product.

All your **products are linked to a brand**. If you **forgot to link** a product to a brand, it is **then automatically linked to the default** brand.

#### Parameters

> Create a Product

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = new \Shoprunback\Elements\Product();

// Mandatory to create a new product
$product->label = 'My super product';
$product->reference = 'my-super-product';
$product->weight_grams = 100;

// Optional
$product->ean = '1258987561456';
$product->width_mm = 100;
$product->length_mm = 100;
$product->height_mm = 100;
// For the picture, please use ONLY ONE of those two parameters, not both at the same time
$product->picture_file_base64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAHaTzTgAAAAKSURBVHgBY2AAAAACAAFzdQEYAAAAAElFTkSuQmCC';
$product->picture_file_url = 'http://shoprunback.com/wp-content/themes/shoprunback/images/logo-menu.png';


// Mandatory nested elements

// If you want to link your product to an existing Brand
// The ID of one of your already registered brands
$product->brand_id = '1f27f9d9-3b5c-4152-98b7-760f56967dea';

// If you want to link your product to a new Brand
// The brand must then be filled with the required parameters.
// Please read the doc showing how to correctly create a Brand.
$product->brand = new \Shoprunback\Elements\Brand();

// --------------------------------------------------------------------------------------
// For the nested elements, you must always either set brand_id or brand, but never both!
// --------------------------------------------------------------------------------------

// Now we can save the product!
$product->save();
```

Parameter | Required | Type | Description | Tips
-|-|-|-|-
**label** | Yes | **String** | Label of the product, displayed to the customer on the return process |
**reference** | Yes | **String** | Unique reference of the product | Use only lowercase letters and replace spaces by -
**weight_grams** | Yes | **INT** | Weight of the product | In grams
**ean** | No | **String** | EAN of the product |
**width_mm** | No | **INT** | Width of the product | In millimeters
**length_mm** | No | **INT** | Length of the product | In millimeters
**height_mm** | No | **String** | Height of the product | In millimeters
**picture_file_base64** | No | **String** | The cover image encoded in base64 | Don't use it at the same time as **picture_file_url**
**picture_file_url** | No | **String** | URL of the product's picture | Don't use it at the same time as **picture_file_base64**
**brand_id** | No | **String** | ID of one of your already registered brands | Don't use it at the same time as **brand**
**brand** | No | **Brand** | An unregistered **Brand** | Don't use it at the same time as **brand_id**

#### API operations

> Get all Products (paginated)

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$products = \Shoprunback\Elements\Product::all();
```

> Get one Product

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

> Update a Product

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
$product->label = 'New label';
$product->save();
```

> Delete a Product

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

// Get the product and remove it later in the code
$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');

// Delete a product by an instance
$product->remove();

// --
// OR
// --

// Delete a product directly
\Shoprunback\Elements\Product::delete('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

Operation | Enabled
-|-
**Get all (paginated)** | Yes
**Get one** | Yes
**Create** | Yes
**Update** | Yes
**Delete** | Yes
