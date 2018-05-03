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

<aside class="warning">
  If a return has already been finished (ie. the corresponding shipback has been registered), you can't update the order anymore.
</aside>

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
