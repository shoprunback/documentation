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
