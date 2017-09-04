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

You can also get the technical documentation and test it without coding on [https://app.swaggerhub.com/apis/Shoprunback/SRB-APP/1.0.0](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP/1.0.0).

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


# Catalog

Once your account created and configured (follow the onboarding process for that), you must push your products catalog.
Only product in the ShopRunBack catalog can be returned.

First, create your brands if you have any and then create your products.

## Create brand

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

## List brands

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

## Create product

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
  "color": "Blue",
  "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "image_url": "http://www.apple.com/images/iphone-14s.jpg"
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
  "image_base": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAHaTzTgAAAAKSURBVHgBY2AAAAACAAFzdQEYAAAAAElFTkSuQmCC",
  "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
}
```

This endpoint create a new product.

### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/products`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
label | yes | Label of the product (ie. common name)
reference | yes | unique reference in your catalog
ean | no | barcode
color | no | displayed as is on the web return process (no translation)
brand_id | no | if you have created a brand and this product has this brand. Otherwise, the default brand is automaticaly used
image_url | yes | public URL to the product image (JPG or PNG), to avoid imperfect cropping, use a square image

<aside class="success">
If you don't have more than one brand, you don't have to provide the brand_id.
</aside>

## List products

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
curl -X "GET" "https://dashboard.shoprunback.com/api/v1/products" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \

```

> The above command returns JSON structured like this:

```json
[
  {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "label": "Iphone 14S Blue",
    "reference": "IPHONE 14S B",
    "ean": "1258987561456",
    "color": "Blue",
    "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "brand_name": "Apple",
    "image_base": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAHaTzTgAAAAKSURBVHgBY2AAAAACAAFzdQEYAAAAAElFTkSuQmCC",
    "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
  },
  {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "label": "Iphone 14S Red",
    "reference": "IPHONE 14S B",
    "ean": "1258987561456",
    "color": "Red",
    "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "brand_name": "Apple",
    "image_base": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAHaTzTgAAAAKSURBVHgBY2AAAAACAAFzdQEYAAAAAElFTkSuQmCC",
    "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
  }
]
```

This endpoint lists all your products.

### HTTP Request

`GET https://dashboard.shoprunback.com/api/v1/products`


# Order

## Create order

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
      "name": "Iphone 14S",
      "reference": "1234567890",
      "price_in_cents": "1000",
      "currency": "EUR",
      "weight_in_grams": 1200,
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    },
  ]
  "metadata": {
    "foo": "bar"
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
      "items": [
    {
      "name": "Iphone 14S",
      "reference": "1234567890",
      "price_in_cents": "1000",
      "currency": "EUR",
      "weight_in_grams": 1200,
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    },
  ]
  "metadata": {
    "foo": "bar"
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
      "name": "Iphone 14S",
      "reference": "1234567890",
      "price_in_cents": "1000",
      "currency": "EUR",
      "weight_in_grams": 1200,
      "product_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    },
  ]
  "metadata": {
    "foo": "bar"
  }
}
```

This endpoint create a new order.

### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/orders`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
ordered_at | yes | date of the order
order_number | yes | the customer's order number
customer | yes | customer informations
items | yes | displayed as is on the web return process (no translation)
metadata | no | additional informations about the order

## List orders

## Update orders

# Return

## Pre-create a return

## Create a ready-to-ship return

## Get a return

## Update a return
