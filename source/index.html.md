---
title: ShopRunBack API Reference

language_tabs:
  - ruby
  - shell

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
  name: "Apple"
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
  "name": "Apple"
}'

```

> The above command returns JSON structured like this:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "name": "Apple",
  "default": false
}
```

This endpoint create a new brand.

### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/brands`

### Query Parameters

Parameter | Description
--------- | -----------
name | Name of the brand, displayed to the customer on the return process

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

> The above command returns JSON structured like this:

```json
[
  {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967deb",
    "name": "default",
    "default": true,
  },
  {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "name": "Apple",
    "default": false,
  },
  {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dec",
    "name": "Samsung",
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
  "color": "Blue",
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
  "weight_in_grams": 200,
  "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "picture_file_url": "http://www.apple.com/images/iphone-14s.jpg"
}'

```

> The above command returns the same JSON object with the id of the created product:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "color": "Blue",
  "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "brand_name": "Apple",
  "weight_in_grams": 200,
  "picture_url": "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197"
}
```


### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/products`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
label | yes | Label of the product (ie. common name)
reference | yes | unique reference in your catalog
ean | no | barcode
weight_in_grams | yes | weight (grams) of the product (package included)
color | no | displayed as is on the web return process (no translation)
brand_id | no | if you have created a brand and this product has this brand. Otherwise, the default brand is automaticaly used
picture_file_url | no | public URL to the product image (JPG or PNG), to avoid imperfect cropping, use a square image
picture_file_base64 | no | if your product's image is not hosted on the internet, you can provide it with a base64 version of it

<aside class="success">
If you don't have more than one brand, you don't have to provide the brand_id.
</aside>

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

> The above command returns JSON structured like this:

```json
{
  "pagination": {
    "current_page": 1,
    "first_page": 1,
    "previous_page": null,
    "next_page": null,
    "last_page": 1,
    "count": 5
  },
  "products":
    [
      {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Blue",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
        "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "brand_name": "Apple",
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      },
      {...},
      {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Red",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
        "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "brand_name": "Apple",
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
ordered_at | yes | date of the order
order_number | yes | the customer's order number
customer | yes | customer information (see [swaggerhub documentation](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP) for details)
items | yes | Array of items (see [swaggerhub documentation](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP) for details)
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

stay tuned