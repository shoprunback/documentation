# Managing the -All- API call

> Use the result of a Product::All()

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

// ----------------------------------------------------------------
// For this example, we will imagine we have 15 products registered
// ----------------------------------------------------------------

$products = \Shoprunback\Elements\Product::all(); // Here $products contains the 10 first products of your company

$products[0]; // Returns the product with the index 0, the first product of the list
$products[9]; // Returns the product with the index 9, the 10th product of the list

$products[10]; // Refreshes the var with the second page of products, and returns the product with the index 10, the 11th product of the list
$products[11]; // Returns the product with the index 11, the 12th product of the list

$products[0]; // Refreshes the var with the first page of product, and returns the product with the index 0, the first product of the list

try {
  $products[15]; // Since there is only 15 products, there is no product with the index 15 or more, so it will return an error
} catch (\Shoprunback\Error\ElementIndexDoesntExists $e) {

}
```

When trying to **retrieve all datas of an element** with an API call, you will actually **get a page of the first elements** of your company (10 by default).

You **can** then **get any of those elements**.

If you **try to get** for example **the 12th element**, the **variable will load the corresponding page and be refreshed**, meaning you will have **a page of 10 elements, from the 11th to the 20th**, so it can return you the 12th element.

This way, you **have access to all your elements without loading them all** from the ShopRunBack's database and **without having to calculate or specify the page you need** to load to get the correct index.

But **if you have** for example **30 elements** and **try to get the 32th**, you will have a **ElementIndexDoesntExists error**.
