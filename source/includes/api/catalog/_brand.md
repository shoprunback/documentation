## Create a brand

```ruby
body = {
  name: "Apple",
  reference: "apple"
}

HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/brands",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "POST" "https://dashboard.shoprunback.com/api/v1/brands" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "name": "Apple",
  "reference": "apple"
}'

```

```php
<?php
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Define the environment you want to use (Production or Sandbox)
\Shoprunback\RestClient::getClient()->useProductionEnvironment();

// Create a new blank Brand and add mandatory attributes
$brand = new \Shoprunback\Elements\Brand();
$brand->name = 'Apple';
$brand->reference = 'apple';

// Save the Brand
$brand->save();
```

> The above command returns JSON structured like this:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "name": "Apple",
  "reference": "apple",
  "default": false
}
```

By default, once your **retailer account is created and your company details entered**, a **default Brand is created**.
But you **can add your own Brands** if you have multiple Brands in your catalog.

This endpoint creates a new Brand.

### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/brands`

### Query Parameters

Parameter | Required | Description
--------- | ----------|------------
**name** | yes | Name of the brand, displayed to the customer on the return process
**reference** | yes | Unique reference of the brand (if you don't have any, use the name)

<aside class="success">
If you don't have more than one brand, you don't have to create another one, the default brand is enough.
</aside>

## List your brands

```ruby
HTTParty.get(
              "https://dashboard.shoprunback.com/api/v1/brands",
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "GET" "https://dashboard.shoprunback.com/api/v1/brands" \
     -H "Authorization: Token token=<your_token>" \
```

```php
<?php
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Define the environment you want to use (Production or Sandbox)
\Shoprunback\RestClient::getClient()->useProductionEnvironment();

// Get all your brands
$brands = \Shoprunback\Elements\Brand::all();
```

> The above command returns JSON structured like this:

```json
[
  {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967deb",
    "name": "default",
    "reference": "default",
    "default": true,
  },
  {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "name": "Apple",
    "reference": "apple",
    "default": false,
  },
  {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dec",
    "name": "Samsung",
    "reference": "samsung",
    "default": false,
  }
]
```

This endpoint lists all your brands.

### HTTP Request

`GET https://dashboard.shoprunback.com/api/v1/brands`

