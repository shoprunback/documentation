## Product

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = new \Shoprunback\Elements\Product();
```

The class Product represents a product your company is selling. **Do not confuse it with** an **Item**.

All your **products are linked to a brand**. If you **forget to link** a product to a brand, it is **then automatically linked to the default** brand.

An **Order has Items**, and **each Item is linked to one Product**.

> Create a Product

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = new \Shoprunback\Elements\Product();

// Mandatory to create a new product
$product->label = 'My super product';
$product->reference = 'my-super-product';
$product->weight_grams = 100;


// Mandatory nested elements
// The mandatory nested elements must be filled with the required parameters.

// If you want to link your product to an existing Brand, set the ID of your already registered brand
$product->brand_id = '1f27f9d9-3b5c-4152-98b7-760f56967dea';

// If you want to link your product to a new Brand
// Please read the documentation above showing how to correctly create a Brand.
$product->brand = new \Shoprunback\Elements\Brand();

// --------------------------------------------------------------------------------------
// To link a Brand, you must always either set brand_id or brand, but never both!
// --------------------------------------------------------------------------------------


// Optional
$product->ean = '1258987561456';
$product->width_mm = 100;
$product->length_mm = 100;
$product->height_mm = 100;
$product->metadata = ['foo' => 'bar'];

// For the picture, please use ONLY ONE of those two parameters, not both at the same time
$product->picture_file_base64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAHaTzTgAAAAKSURBVHgBY2AAAAACAAFzdQEYAAAAAElFTkSuQmCC';
$product->picture_file_url = 'http://shoprunback.com/wp-content/themes/shoprunback/images/logo-menu.png';

// For Sparepart
$product->spare_parts =[];

$sparepart = new \Shoprunback\Elements\SparePart();
$sparepart->name = 'spare part test';
$sparepart->reference = 'SparePart-reference';

$product->spare_parts[] =  $sparepart;

// Now you can save the product
$product->save();
```

#### API Methods

> Get all Products (paginated)

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$products = \Shoprunback\Elements\Product::all();
```

> Get one Product

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

> Update a Product

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
$product->label = 'New label';

$product->save();
```

> Delete a Product

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

\Shoprunback\Elements\Product::delete('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

> Delete a Product's image

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

\Shoprunback\Elements\Product::deleteImage('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

> Add SparePart to Exists Product

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');

// For Sparepart
$product->spare_parts =[];

$sparepart = new \Shoprunback\Elements\SparePart();
$sparepart->name = 'spare part test';
$sparepart->reference = 'SparePart-reference';

$product->spare_parts[] =  $sparepart;

$product->save();
```

>Create a bulk of spare parts associated to a product

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');

$product->bulk = [];

$sparpart = new \Shoprunback\Elements\SparePart();
$sparpart->reference = "part-ref-test-ok";
$sparpart->name = "A user friendly spare part name";
$sparpart->description = "A longer description for your spare part";

$product->bulk[] = $sparpart;

$product->save();
```


Method | Enabled
-|-
**Get all (paginated)** | Yes
**Get one** | Yes
**Create** | Yes
**Update** | Yes
**Delete** | Yes
**Delete (image)** | Yes
