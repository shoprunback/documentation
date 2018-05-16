# Return

## Create the order and the return sequentially

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

```php
<?php
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Define the environment you want to use (Production or Sandbox)
\Shoprunback\RestClient::getClient()->useProductionEnvironment();

//--------------------------------------------------------------------------
// To create a Shipback, we must first have an Order to link the Shipback to
//--------------------------------------------------------------------------

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

//--------------------------------------------------------
// Now that we have an Order, we can link a Shipback to it
//--------------------------------------------------------

// Create a Shipback and link the Order
$shipback = new \Shoprunback\Elements\Shipback();
$shipback->order_id = $order->id;

  // Optionnal: you can directly link the Items the Customer wants to return
  // If you don't, the Customer will have to fill the return request's form to select them
  $returnedItem = new \Shoprunback\Elements\ReturnedItem();
  $returnedItem->item_id = $order->items[0]->id; // It must be the ID of an Item from the Order
  $returnedItem->reason_code = 'doesnt_fit';

  $shipback->items = [$returnedItem];

// We save the Shipback
$shipback->save();
```

You can create the order and its corresponding shipback in 2 sequential API calls without parsing the first response by using your own references.

First, create the order with an _order_number_ and the items.
You don't have to push all the items in the initial order if you already know which items are going to be returned, just push them and not the others. You must provide item references if you want to avoid the parsing of the response. An item reference should be unique per order.

Second, create the corresponding shipback attached to your _order_number_ by giving the item's _reference_ and the reason of the return.

If the customer details of the shipback are not provided, the order's customer is copied and used for the shipback.

