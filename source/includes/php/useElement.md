# Manage a single Element

## Original values

> Get original values

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');

echo $product->label; // Prints: 'My label'

$product->label = 'New label';

echo $product->label; // Prints: 'New label'

echo $product->_origValues->label; // Prints 'My label'

$product->refresh();

echo $product->label; // Prints 'My label'
```

You can get the original values of an Element whenever you want by getting the `_origValues` attribute.

**Never edit the** `_origValues`, there are a landmark.

If you want to reset an element with its original values, use `$element->refresh()` (makes an API call)

<aside class="warning">
When the <b>element is saved</b>, the <b>origValues</b> will be <b>filled with the new values!</b>
</aside>

## Get different attributes

> Different ways to get important attributes

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = new \Shoprunback\Elements\Product();

$product->label = 'My label';
$product->custom = 'My custom param';
$product->brand = new \Shoprunback\Elements\Brand();

var_dump($product->getAllAttributes()); // Prints 'label', 'custom' and 'brand' with their values
var_dump($product->getApiAttributes()); // Prints 'label' and 'brand' with their values
var_dump($product->getApiAttributesKeys()); // Prints ['label', 'brand']
```

To get all the attributes of an Element including the nested Elements, you can use `$element->getAllAttributes()`.

To get only the attributes an Element will use for an API call, you can use `$element->getApiAttributes()`.

## Use the elements with my objects

> Separate my own classes and the library's classes

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

use \Shoprunback\Elements\Product as libProduct;

class myProduct
{
  public function __construct()
  {
    $this->label = 'My label';
    $this->reference = 'my-label';
    $this->weight_in_grams = 1000;
  }

  public function generateLibProduct()
  {
    $product = new libProduct();

    $product->label = $this->label;
    $product->reference = $this->reference;
    $product->weight_in_grams = $this->weight_in_grams;

    return $product;
  }

  public function save()
  {
    // Code...

    $libProduct = $this->generateLibProduct();
    $libProduct->save();

    // Code...
  }
}

$myProduct = new myProduct();
$myProduct->save();
```

> Extend the library's classes

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

use \Shoprunback\Elements\Product as libProduct;

class myProduct extends libProduct
{
  public function __construct($params)
  {
    $this->label = $params['label'];
    $this->reference = $params['reference'];
    $this->weight_in_grams = $params['weight_in_grams'];

    if ($params['id']) {
      parent::__construct($params['id']);
    } else {
      parent::__construct();
    }
  }

  // Be careful not to overwrite the functions of the parent class
  public function saveProduct()
  {
    // Code...

    $this->save(); // save() is a function of the parent class

    // Code...
  }
}

$params = [
  'label' => 'My label',
  'reference' => 'my-label',
  'weight_in_grams' => 1000,
];

$myProduct = new myProduct($params);
$myProduct->saveProduct();
```

You can **either use the library independantly of your classes or extend the library's classes** ->

**If you use inheritance**, be **careful not to overwrite the parent functions**. Instead, **use functions including the parent function**.

## Check changed fields

> Check if a Product is a new one or not

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = new \Shoprunback\Elements\Product();
$product->isPersisted(); // false

$product->label = 'New label';
$product->reference = 'new-label';
$product->weight_in_grams = 1000;
$product->isPersisted(); // false

$product->save();
$product->isPersisted(); // true

$retrievedProduct = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
$retrievedProduct->isPersisted(); // true
```

> Check changed fields in a existing Product

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');

$product->isDirty(); // false
var_dump($product->getDirtyKeys()); // Prints []
$product->isKeyDirty('label'); // false

$product->label = 'New label';

$product->isDirty(); // true
var_dump($product->getDirtyKeys()); // Prints ['label']
$product->isKeyDirty('label'); // true
```

> Check changed fields in a new Product

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$product = new \Shoprunback\Elements\Product();
$product->isDirty(); // true

$product->label = 'My label';
$product->isDirtyKey('label'); // true
var_dump($product->getDirtyKeys()); // Prints ['label']
```

To know **if an element is new**, you can use `$element->isPersisted()`.

You can **check if an element is new or has at least one parameter changed** with `$element->isDirty()`.

You can know **which keys have been changed** with `$element->getDirtyKeys()`.

You can also check **if a precise key has changed** with `$element->isDirtyKey($key)`.

When you try to **update an existing Element**, it will **only send the attributes that has been changed**.

A **key present in the** `$element->getApiAttributesKeys()` that **hasn't a** `_origValues` is **considered changed** (ex: when you create a new Product and add a label).

## Which API calls can it do ?

> Check which API calls an element can or cannot do

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

// All those methods return true or false
\Shoprunback\Elements\Product::canRetrieve(); // Check if you can get one element
\Shoprunback\Elements\Product::canCreate(); // Check if you can save a new element
\Shoprunback\Elements\Product::canUpdate(); // Check if you can update an existing element
\Shoprunback\Elements\Product::canDelete(); // Check if you can delete an element
\Shoprunback\Elements\Product::canGetAll(); // Check if you can get many elements at once
```

You can **check if an element can do an API call** with those methods ->

## Get the element name

> Get the element name

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\Elements\Product::getElementName(); // Returns 'product'
\Shoprunback\Elements\Brand::getElementName(); // Returns 'brand'
\Shoprunback\Elements\Order::getElementName(); // Returns 'order'
\Shoprunback\Elements\Shipback::getElementName(); // Returns 'shipback'
\Shoprunback\Elements\Item::getElementName(); // Returns 'item'
\Shoprunback\Elements\Warehouse::getElementName(); // Returns 'warehouse'
```

To easily **get** the **lowercase name of an element**, you can use those methods ->

> Get a nested element with its name

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

$product = \Shoprunback\Elements\Product::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
$productName = $product::getElementName(); // $productName = 'product';

$brandName = \Shoprunback\Elements\Brand::getElementName(); // $brandName = 'brand'

$product->$brandName; // $product->brand
```

This way, you can easily **get the attribute name for a nested Element**. It can be **useful in recursive functions or logs** ->