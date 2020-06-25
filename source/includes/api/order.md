# Order

Once your catalog is uploaded on ShopRunBack, you can plug your e-commerce website to the ShopRunBack dashboard.

Only an existing order can be returned. You have 2 possibilities, depending on your desired return flow :

* When a user request a return on your website, you create the corresponding order on the API and initiate the corresponding return.
* You push the order on the API directly after it is processed on your website and just redirect the customer when he/she requests a return.

In both cases, you will have to create the order, sooner or later.

## Create an order

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
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Define the environment you want to use (Production or Sandbox)
\Shoprunback\RestClient::getClient()->useProductionEnvironment();

// Create an Address for the Customer
$address = new \Shoprunback\Elements\Address();
$address->country_code = 'US';
$address->line2 = 'Building B';
$address->state = 'California';
$address->line1 = 'One Infinite Loop';
$address->zipcode = '95014';
$address->city = 'Cupertino';

// Create a Customer for the Order
$customer = new \Shoprunback\Elements\Customer();
$customer->email = 'steve@apple.com';
$customer->phone = '555-878-456';
$customer->first_name = 'Steve';
$customer->last_name = 'Jobs';
$customer->address = $address;

// Create an array of Items ordered by the Customer
$item = new \Shoprunback\Elements\Item();
$item->product_id = '1f27f9d9-3b5c-4152-98b7-760f56967dea';
$items = [$item];

// Create an Order
$order = new \Shoprunback\Elements\Order();
$order->order_number = '4548-9854';
$order->customer = $customer;
$order->items = $items;
$order->ordered_at = '2017-02-03';

// We save the Order
$order->save();
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

An order has a `order_number`, a customer and a list of items.

If you want to add extra data on the order, you can freely use the `metadata` attribute (a simple key/value store).
The ShopRunBack API will always return this data without altering it.


### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/orders`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
**ordered_at** | yes | date of the order
**order_number** | yes | the customer's order number
**customer** | yes | customer information (see [swaggerhub documentation](http://api-portal.shoprunback.com) for details)
**items** | yes | Array of items (see [swaggerhub documentation](http://api-portal.shoprunback.com) for details)
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

```php
<?php
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Define the environment you want to use (Production or Sandbox)
\Shoprunback\RestClient::getClient()->useProductionEnvironment();

// Get all your orders
$orders = \Shoprunback\Elements\Order::all();
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

















































## Delete an order

An order can only be deleted if no corresponding shipback is attached. So you must delete it first.

### HTTP Request

`DELETE https://dashboard.shoprunback.com/api/v1/orders/:order_id`

### Errors

```json
{
  "errors": [
    {
      "code": "DEPENDENT_SHIPBACK",
      "message": "dependent shipback found (fee4a476-13ff-422d-85df-4ef68fa0c8d7)"
    }
  ]
}
```

If you are trying to delete an order with a dependent shipback, you will receive an error with a `400` HTTP CODE.

You will also have an error message and an error code in the returned JSON.

In this case, the error code will be `DEPENDENT_SHIPBACK`.

If the deletion is successful, you will receive a `200` HTTP CODE.
