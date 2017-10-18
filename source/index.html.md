---
title: ShopRunBack API Reference

language_tabs:
  - shell
  - ruby
  - php

toc_footers:
  - <a href='http://dashboard.shoprunback.com'>Sign Up for a Developer Key</a>

includes:

search: true
---

# Introduction

Welcome on the ShopRunBack public API, the inventor of the Return As A Service solution.
This API provides all the endpoints for any e-commerce retailer to get all the features for an optimized return experience for its customers.

You can also get the technical documentation and test it without coding on [https://app.swaggerhub.com/apis/Shoprunback/SRB-APP](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP).

If you got any questions, send an email to: julien_at_shoprunback.com.

For feature request, use the built in form: https://dashboard.shoprunback.com/en/features.

# Authentication

> To authorize your queries, you must provide you company API Token in the HTTP Headers like this :

```ruby
response = HTTParty.post(
              endpoint,
              body: content,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl "<endpoint>"
  -H "Authorization: Token token=<your_token>"
```

```php

<%php
// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, endpoint);

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json; charset=utf-8",
  "Authorization: Token token=<your_token>",
 ]
);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);
?>
```

> Replace `your_token` with your API key.

ShopRunBack uses API keys to allow access to the API.

You can get your API key on your [retailer dashboard](http://dashboard.shoprunback.com/tokens).

ShopRunBack expects for the API key to be included in all API requests to the server in a header that looks like the following:

`Authorization: Token token=<your_token>`

















































# Products catalog

Once your account created and configured (follow the onboarding process for that), you must push your products catalog.
Only product in the ShopRunBack catalog can be returned.

First, create your brands if you have any and then create your products.
















































## Create a brand

By default, once your retailer account is created and your company details entered, a default brand is created.
But you can add your own brands if you have multiple brands in your catalog.

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
// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/brands');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your token>",
  "Content-Type: application/json; charset=utf-8",
 ]
);
// Create body
$json_array = [
            "name" => "Apple",
            "reference" => "apple"
        ];
$body = json_encode($json_array);

// Set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);
?>

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

This endpoint create a new brand.

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

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/brands');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your_token>",
 ]
);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);

?>

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

















































## Add your products

Push all your products catalog with this endpoint.

The image in not mandatory but the return experience of your customer will be better with it.

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

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/products');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your token>",
  "Content-Type: application/json; charset=utf-8",
 ]
);
// Create body
$json_array = [
            "reference" => "IPHONE 14S B",
            "id" => "1f27f9d9-3b5c-4152-98b7-760f56967dea",
            "picture_url" => "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197",
            "label" => "Iphone 14S Blue",
            "weight_grams" => 200,
            "brand" => [
                "id" => "1f27f9d9-3b5c-4152-98b7-760f56967dea",
                "name" => "Apple",
                "reference" => "apple"
            ],
            "ean" => "1258987561456"
        ];
$body = json_encode($json_array);

// Set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);

?>
```
> The above command returns the same JSON object with the id of the created product:

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
If you don't have more than one brand, you don't have to provide the brand_id.
</aside>
















































## Create a product with its brand

You can create your product directly with the brand object embedded.

If 2 products have the same brand's `reference`, only one brand object is created.

The image in not mandatory but the return experience of your customer will be better with it.

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

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'http://localhost:3000/api/v1/products');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your token>",
  "Content-Type: application/json; charset=utf-8",
 ]
);
// Create body
$json_array = [
            "reference" => "IPHONE 14S B",
            "id" => "1f27f9d9-3b5c-4152-98b7-760f56967dea",
            "picture_url" => "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197",
            "label" => "Iphone 14S Blue",
            "brand" => [
                "id" => "20d0be72-a191-4eb8-af22-9dd4c3e65fe8",
                "name" => "Apple",
                "reference" => "apple"
            ],
            "weight_grams" => 200,
            "ean" => "1258987561456"
        ];
$body = json_encode($json_array);

// Set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);
?>
```

> The above command returns the same JSON object with the id of the created product:

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

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/products?page=1');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your token>",
 ]
);


// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);
?>
```

> The above command returns JSON structured like this:

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

The result is paginated, provide the `page` parameter to get a page (default is page 1).

### HTTP Request

`GET https://dashboard.shoprunback.com/api/v1/products?page=1`
















































# Order

Once your catalog is uploaded on ShopRunBack, you can plug your e-commerce website to the ShopRunBack dashboard.

Only an existing order can be returned. You have 2 possibilities, depending on your desired return flow :

* When a user request a return on your website, you create the corresponding order on the API and initiate the corresponding return
* You push the order on the API directly after is processing on your website and just the redirect the customer when he/she requests a return

In both cases, you will have to create the order, sooner or later.

## Create an order

An order has a `order_number`, a customer and a list of items.

If you want to add extra data on the order, you can freely use the `metadata` attribute (a simple key/value store).
The ShopRunBack API will always returns this data without altering it.

```ruby
body = {
  "ordered_at": "2017-02-03",
  "order_number": "4548-9854",
  "customer": {
    "first_name": "Steve",
    "last_name": "Jobs",
    "email": "steve@apple.com",
    "phone": "555-878-456",
    "address": {
      "line1": "One Infinite Loop",
      "line2": "Building B",
      "zipcode": "95014",
      "country_code": "US",
      "city": "Cupertino",
      "state": "California"
    }
  },
  "items": [
    {
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    },
  ],
  "metadata": {
    "foo": "bar",
    "bar": "foo"
  }
}

HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/orders",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "POST" "https://dashboard.shoprunback.com/api/v1/orders" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "ordered_at": "2017-02-03",
  "order_number": "4548-9854",
  "customer": {
    "first_name": "Steve",
    "last_name": "Jobs",
    "email": "steve@apple.com",
    "phone": "555-878-456",
    "address": {
      "line1": "One Infinite Loop",
      "line2": "Building B",
      "zipcode": "95014",
      "country_code": "US",
      "city": "Cupertino",
      "state": "California"
    }
  },
  "items":
  [
    {
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    },
    {
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    }
  ],
  "metadata": {
    "foo": "bar",
    "bar": "foo"
  }
}'
```

```php
<?php

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/orders');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your token>",
  "Content-Type: application/json; charset=utf-8",
 ]
);
// Create body
$json_array = [
            "order_number" => "4548-9854",
            "metadata" => [
                "foo" => "bar",
                "bar" => "foo"
            ],
            "customer" => [
                "email" => "steve@apple.com",
                "phone" => "555-878-456",
                "last_name" => "Jobs",
                "first_name" => "Steve",
                "address" => [
                    "country_code" => "US",
                    "line2" => "Building B",
                    "state" => "California",
                    "line1" => "One Infinite Loop",
                    "zipcode" => "95014",
                    "city" => "Cupertino"
                ]
            ],
            "items" => [
                [
                    "product_id" => "1f27f9d9-3b5c-4152-98b7-760f56967dea"
                ]
            ],
            "ordered_at" => "2017-02-03"
        ];
$body = json_encode($json_array);

// Set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);

?>
```

> The above command returns the same JSON object with the id of the created order, customer and items:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "ordered_at": "2017-02-03",
  "order_number": "4548-9854",
  "customer": {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "first_name": "Steve",
    "last_name": "Jobs",
    "email": "steve@apple.com",
    "phone": "555-878-456",
    "address": {
      "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
      "line1": "One Infinite Loop",
      "line2": "Building B",
      "zipcode": "95014",
      "country_code": "US",
      "city": "Cupertino",
      "state": "California"
    }
  },
  "items": [
    {
      "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
      "product": {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Red",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
        "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "brand_name": "Apple",
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      }
    },
    {
      "id": "1f27f9d9-3b5c-4152-98b7-760f56967dec",
      "product": {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Red",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
        "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "brand_name": "Apple",
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      }
    }
  ],
  "metadata": {
    "foo": "bar"
  }
}
```


### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/orders`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
**ordered_at** | yes | date of the order
**order_number** | yes | the customer's order number
**customer** | yes | customer information (see [swaggerhub documentation](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP) for details)
**items** | yes | Array of items (see [swaggerhub documentation](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP) for details)
metadata | no | Anything you want to add to the order, this data will always be returned and never modified.
















































## List all orders

This endpoint lists all your paginated orders.

### HTTP Request

`GET https://dashboard.shoprunback.com/api/v1/orders?page=1`

```ruby
HTTParty.get(
              "https://dashboard.shoprunback.com/api/v1/orders?page=1",
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "GET" "https://dashboard.shoprunback.com/api/v1/orders?page=1" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \

```

> The above command returns JSON structured like this:

```json
{
  "pagination": {
    "current_page": 1,
    "first_page": 1,
    "previous_page": 10,
    "next_page": null,
    "last_page": 1,
    "count": 5
  },
  "orders":
    [
      {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "ordered_at": "2017-02-03",
        "order_number": "4548-9854",
        "customer": {
          "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
          "first_name": "Steve",
          "last_name": "Jobs",
          "email": "steve@apple.com",
          "phone": "555-878-456",
          "address": {
            "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
            "line1": "One Infinite Loop",
            "line2": "Building B",
            "zipcode": "95014",
            "country_code": "US",
            "city": "Cupertino",
            "state": "California"
          }
        },
        "items": [
          {
            "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
            "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
            "product": {
              "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
              "label": "Iphone 14S Red",
              "reference": "IPHONE 14S B",
              "ean": "1258987561456",
              "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
              "brand_name": "Apple",
              "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
            }
          },
        ],
        "metadata": {
          "foo": "bar"
        }
      },
      {...}
    ]
}
```
















































## Update an order

This endpoint updates an existing order.

Warning: if a return has already been finished (ie. the return label has been downloaded), you can't update the order.

### HTTP Request

`PUT https://dashboard.shoprunback.com/api/v1/orders/:order_id`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
ordered_at | yes | date of the order
order_number | yes | the customer's order number
customer | yes | customer object (see [swaggerhub documentation](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP) for details)
items | yes | items' array (see [swaggerhub documentation](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP) for details)
metadata | no | Anything you want to add to the order, this data will always be returned and never modified.

```ruby
body = {
  "ordered_at": "2017-02-03",
  "order_number": "4548-9854",
  "customer": {
    "first_name": "Steve",
    "last_name": "Jobs",
    "email": "steve@apple.com",
    "phone": "555-878-456",
    "address": {
      "line1": "One Infinite Loop",
      "line2": "Building B",
      "zipcode": "95014",
      "country_code": "US",
      "city": "Cupertino",
      "state": "California"
    }
  },
  "items": [
    {
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    },
  ],
  "metadata": {
    "foo": "bar"
  }
}

HTTParty.put(
              "https://dashboard.shoprunback.com/api/v1/orders/#{order_id}",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "PUT" "https://dashboard.shoprunback.com/api/v1/orders/<order_id>" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "ordered_at": "2017-02-03",
  "order_number": "4548-9854",
  "customer": {
    "first_name": "Steve",
    "last_name": "Jobs",
    "email": "steve@apple.com",
    "phone": "555-878-456",
    "address": {
      "line1": "One Infinite Loop",
      "line2": "Building B",
      "zipcode": "95014",
      "country_code": "US",
      "city": "Cupertino",
      "state": "California"
    }
  },
  "items":
  [
    {
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
      "product": {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Red",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
        "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "brand_name": "Apple",
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      }
    },
  ],
  "metadata": {
    "foo": "bar"
  }
}'
```

> The above command returns the same JSON object with the updated order, customer or items:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "ordered_at": "2017-02-03",
  "order_number": "4548-9854",
  "customer": {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "first_name": "Steve",
    "last_name": "Jobs",
    "email": "steve@apple.com",
    "phone": "555-878-456",
    "address": {
      "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
      "line1": "One Infinite Loop",
      "line2": "Building B",
      "zipcode": "95014",
      "country_code": "US",
      "city": "Cupertino",
      "state": "California"
    }
  },
  "items": [
    {
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
      "product": {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Red",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
        "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "brand_name": "Apple",
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      }
    },
  ],
  "metadata": {
    "foo": "bar"
  }
}
```
















































# Return

## Create the order and the return sequentially

You can create the order and the corresponding shipback in 2 sequential API calls without parsing the first response by using your own references.

First, create the order with an _order_number_ and the items.
You don't have to push all the items in the initial order if you already know which items are going to be returned, just push them and not the others. You must provide item references if you want to avoid the parsing of the response. An item reference should be unique per order.

Second, create the corresponding shipback attached to your _order_number_ by giving the _item_reference_ and the reason of the return.

If the customer details of the shipback are not provided, the same details of the order's customer are copied.


```ruby
body = {
  "ordered_at": "2017-06-12",
  "order_number": "1234567",
  "customer": {
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@doe.com",
    "phone": "1230145365",
    "address": {
      "line1": "651 rue de dunkerque",
      "zipcode": "78010",
      "country_code": "FR",
      "city": "Paris"
    }
  },
  "items": [
    {
      "label": "Chemise bleu",
      "reference": "item 001",
      "product_id": "reference1"
    },
    {
      "label": "Casquette rouge",
      "reference": "item 2",
      "product_id": "reference2"
    }
  ]
}

HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/orders",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )

body = {
  "mode": "pickup",
  "order_id": "1234567",
  "items": [
    {
      "item_id": "item 2",
      "reason_code": "doesnt_fit"
    }
  ]
}

HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/shipbacks",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "POST" "https://dashboard.shoprunback.com/api/v1/orders" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "ordered_at": "2017-06-12",
  "order_number": "1234567",
  "customer": {
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@doe.com",
    "phone": "1230145365",
    "address": {
      "line1": "651 rue de dunkerque",
      "zipcode": "78010",
      "country_code": "FR",
      "city": "Paris"
    }
  },
  "items": [
    {
      "label": "Chemise bleu",
      "reference": "item 001",
      "product_id": "reference1"
    },
    {
      "label": "Casquette rouge",
      "reference": "item 2",
      "product_id": "reference2"
    }
  ]
}'

curl -X "POST" "https://dashboard.shoprunback.com/api/v1/shipbacks" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "mode": "pickup",
  "order_id": "1234567",
  "items": [
    {
      "item_id": "item 2",
      "reason_code": "doesnt_fit"
    }
  ]
}'
```
