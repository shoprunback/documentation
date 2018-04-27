
## Add your products

```ruby
body = {
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "weight_grams": 200,
  "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "image_url": "http://www.apple.com/images/iphone-14s.jpg"
}

HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/products",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "POST" "https://dashboard.shoprunback.com/api/v1/products" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "weight_grams": 200,
  "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "picture_file_url": "http://www.apple.com/images/iphone-14s.jpg"
}'

```

```php
<?php
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Create a new Product
$product = new \Shoprunback\Elements\Product();
$product->label = 'Iphone 14S Blue';
$product->reference = 'IPHONE 14S B';
$product->weight_grams = 200;
$product->brand_id = '1f27f9d9-3b5c-4152-98b7-760f56967dea';
$product->ean = '1258987561456';
$product->picture_url = 'https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197';

// Save the Product
$product->save();
```

> The above command (except for PHP) returns the same JSON object with the id of the created product:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "weight_grams": 200,
  "picture_url": "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197",
  "brand": {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "name": "Apple",
    "reference": "apple"
  }
}
```

Push all your products' catalog with this endpoint.

The image in not mandatory but the return experience of your customer will be better with it.


### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/products`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
**label** | yes | Label of the product (ie. common name)
**reference** | yes | unique reference in your catalog
**weight_grams** | yes | weight (grams) of the product (package included)
ean | no | barcode
brand_id | no | if you have created a brand and this product has this brand. Otherwise, the default brand is automaticaly used
picture_file_url | no | public URL to the product image (JPG or PNG), to avoid imperfect cropping, use a square image
picture_file_base64 | no | if your product's image is not hosted on the internet, you can provide it with a base64 version of it

<aside class="success">
If you only have one brand, you don't have to provide the brand_id.
</aside>
















































## Create a product with its brand

```ruby
body = {
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "brand": {
    "name": "Apple",
    "reference": "apple"
  },
  "image_url": "http://www.apple.com/images/iphone-14s.jpg"
}

HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/products",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "POST" "https://dashboard.shoprunback.com/api/v1/products" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "weight_in_grams": 200,
  "brand": {
    "name": "Apple",
    "reference": "apple"
  },
  "picture_file_url": "http://www.apple.com/images/iphone-14s.jpg"
}'

```

```php
<?php
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Create a Brand for your Product
$brand = new \Shoprunback\Elements\Brand();
$brand->name = 'Apple';
$brand->reference = 'apple';

// Create a new Product
$product = new \Shoprunback\Elements\Product();
$product->label = 'Iphone 14S Blue';
$product->reference = 'IPHONE 14S B';
$product->weight_grams = 200;
$product->brand = $brand;
$product->ean = '1258987561456';
$product->picture_url = 'https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197';

// Save the Product
$product->save();
```

> The above command (except for PHP) returns the same JSON object with the id of the created product:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "brand": {
    "id": "20d0be72-a191-4eb8-af22-9dd4c3e65fe8",
    "name": "Apple",
    "reference": "apple"
  },
  "weight_grams": 200,
  "picture_url": "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197"
}
```

You can create your product directly with the brand object embedded.

If 2 products have the same brand's `reference`, only one brand object is created.

The image in not mandatory but the return experience of your customer will be better with it.


### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/products`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
**label** | yes | Label of the product (ie. common name)
**reference** | yes | unique reference in your catalog
**weight_grams** | yes | weight (grams) of the product (package included)
ean | no | barcode
color | no | displayed as is on the web return process (no translation)
brand | no | the brand object with all its required attributes
picture_file_url | no | public URL to the product image (JPG or PNG), to avoid imperfect cropping, use a square image
picture_file_base64 | no | if your product's image is not hosted on the internet, you can provide it with a base64 version of it

















































## List your products

```ruby
HTTParty.get(
              "https://dashboard.shoprunback.com/api/v1/products",
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "GET" "https://dashboard.shoprunback.com/api/v1/products?page=1" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \

```

```php
<?php
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Get all your products
$products = \Shoprunback\Elements\Product::all();
```

> The above command (except for PHP) returns JSON structured like this:

```json
{
  "pagination": {
    "current_page": 1,
    "first_page": 1,
    "previous_page": null,
    "next_page": null,
    "last_page": 1,
    "count": 5,
    "per_page": 10
  },
  "products":
    [
      {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Blue",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
         "brand": {
            "id": "20d0be72-a191-4eb8-af22-9dd4c3e65fe8",
            "name": "Apple",
            "reference": "apple"
          },
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      },
      {...},
      {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Red",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
         "brand": {
            "id": "20d0be72-a191-4eb8-af22-9dd4c3e65fe8",
            "name": "Apple",
            "reference": "apple"
          },
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      }
    ]
}
```

You can list all your products on ShopRunBack with this endpoint.

The result is paginated, provide the `page` parameter to get a specific page (default is page 1).

### HTTP Request

`GET https://dashboard.shoprunback.com/api/v1/products?page=1`

