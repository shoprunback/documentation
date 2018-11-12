# Webhooks

Every event on ShopRunBack can trigger a webhook.

Basically, a webhook is a JSON Object send by HTTP (POST) to an URL you have set on your account.

The server expect a 200 response (`HTTP OK`) when posting the webhook, otherwise it is marked as not received successfully on the dashboard.

[Go to the webhooks dashboard](https://dashboard.shoprunback.com/en/webhooks).


## Data sent


```json
  // Example of JSON sent
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "shipback.relocated",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id": "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "mode": "postal"
    }
  }
```


All webhooks has the same caracteristics; this is a JSON Object with the attributes:

* the `id`: a unique identifier. You can use it to detect duplicate.
* the name of the `event` with the format: `<object trigerring the webhook>.<action>`
* the date of the event which is also the date of creation of the webhook: `created_at`
* the object triggering the webhook as a JSON in the `data` attribute.

 <aside class="notice">
  If you want to track a specific event and you don't find the appropriate webhooks above, please contact julien _at_ shoprunback _dot_ com.

  If accurate, the webhook can be added to the platform in the next release.
</aside>

### Collaborator

```json
// Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "collaborator.invited",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "email" : "tim@apple.com"
    }
  }

```

| Webhook name | Trigger |
|--------------|---------|
| collaborator.created     | Sent when a collaborator creates its account |
| collaborator.invited     | Sent when a manager invite a collaborator |

### Product

```json
 // Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "product.created",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "label" : "Iphone 12S - Blue",
      "reference": "IPHONE-12S",
      "ean": "1237492402485"
    }
  }

```

| Webhook name | Trigger |
|--------------|---------|
| product.created          | Sent when a product is created in the catalogue |

### Relocation

```json
  // Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "relocation.created",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "country_code" : "FR",
      "reason_code" : "damaged",
      "warehoused_id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c699"
    }
  }

```


| Webhook name | Trigger |
|--------------|---------|
| relocation.created       | Sent when a new relocation rule has been created |

### Returned Item


```json
  // Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "returneditem.relocated",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "reason_code" : "damaged",
      "item" : {
        "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c600",
        "barcode": "12149837489",
        "label": "Iphone 12S - Blue",
        "reference": "IPHONE-12S"
      }
    }
  }

```


| Webhook name | Trigger |
|--------------|---------|
| returneditem.missing     | Sent when a returned item is marked as missing by an operator |
| returneditem.relocated   | Sent when a returned item is relocated to the retailer's warehouse |
| returneditem.transiting  | Sent when a returned item is transitting |

### Shipback

```json

  # Example of JSON sent for shipback.registered
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "shipback.registered",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "rma" : "123",
      "registered_at": "2018-02-20 16:58:22 +0100",
      "mode": "postal",
      "weight_in_grams": "1000",
      "size": "S",
      "computed_weight_in_grams": "1000",
      "public_url": "https://web.shoprunback.com/apple/1234",
      "metadata": {},
      "price_cents": "10000",
      "customer_price_cents": "10000"
    }
  }

  # Example of JSON sent for shipback.labelled
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "shipback.labelled",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "rma" : "123",
      "registered_at": "2018-02-20 16:58:22 +0100",
      "mode": "postal",
      "weight_in_grams": "1000",
      "size": "S",
      "computed_weight_in_grams": "1000",
      "public_url": "https://web.shoprunback.com/apple/1234",
      "metadata": {},
      "price_cents": "10000",
      "customer_price_cents": "10000",
      "label_url" : "http://cdn.com/label/1234.pdf",
      "tracking_number": "123456-tracking"
    }
  }

  // Example of JSON sent for other events
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "shipback.registered",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "rma" : "123",
    }
  }

```

| Webhook name | Trigger |
|--------------|---------|
| shipback.created         | Sent when a shipback is created (via the API or via the web interface) |
| shipback.registering            | Sent when a customer has visited the return link |
| shipback.registered            | Sent when a shipback is registered (the customer has paid or validated is free return) and the customer can download its voucher and label |
| shipback.labelled            | Sent when the label is available |
| shipback.delivering            | Sent when the shipback is transiting between the customer's location and our warehouse |
| shipback.delivered            | Sent when the shipback is delivered to our warehouse |
| shipback.identified      | Sent when the incoming parcel has been open and all returned items have been identified with a unique barcode or marked has missing (not returned) |
| shipback.relocating       | Sent when the shipback is transitting from our warehouse to the retailer's warehouse |
| shipback.relocated       | Sent when all the returned item's of a shipback are relocated to the retailer's warehouse |
| shipback.failed       | Sent when something went wront with this shipback |

### Sponsoring

```json
// Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "sponsoring.created",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "percentage": "100",
      "country_code": "FR",
      "reason_code": "damaged",
      "merchant_fee_min": 5,
      "merchant_fee_max": 10,
      "customer_fee_min": null,
      "customer_fee_max": null
    }
  }

```


| Webhook name | Trigger |
|--------------|---------|
| sponsoring.created       | Sent when a new sponsoring rule has been created |


### Warehouse

```json
// Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "warehouse.created",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id" : "fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "reference": "APPLE01",
      "name": "Apple store Paris",
    }
  }

```


| Webhook name | Trigger |
|--------------|---------|
| warehouse.created        | Sent when a new warehouse is added to the company |


## Set the URL

```ruby

  # in a Rake base application controller
  def webhook
    # handle the webhook content with params
    head 200 # HTTP OK
  end
```

```php
<?php

  // in a PHP Framework controller
  private function webhook()
  {
    $webhook = file_get_contents("php://input");
    $webhook = json_decode($webhook); // the webhook data in an associative array

    return self::returnHeaderHTTP(200); //example in Prestashop
  }

?>
```

The ShopRunBack's API send the webhooks on a public accessible HTTP or HTTPS endpoint (the certificate must be valid).

If you want to protect this endpoint, you can :

* setup a basic authentication and provide the login and password in the URL (`http://<login>:<password>@host.com`)
* verify the value of a specific URL parameter and provide it in the webhook URL (`http://host.com?shoprunback=topsecret`)
* Use the build-in HMAC signature without altering the URL (see below)

You can set your Wehbook URL on the dashboard, in the [section Developers > Webhooks](https://dashboard.shoprunback.com/webhooks/edit).

## Signature

We include a signature in each webhooks sent by ShopRunBack in the `Shoprunback-Signature` header.

### Define your secret

You can change the secret (the default one is empty) on your dashboard: [section Developers > Webhooks](https://dashboard.shoprunback.com/webhooks/edit).

Use a random string with high entropy with, by example, the following command: `ruby -rsecurerandom -e 'puts SecureRandom.hex(20)'` in your terminal.

### Verify the signature

```ruby
  digest = OpenSSL::Digest.new('sha256')
  secret = "your secret" # empty string if not set
  payload = request.body.read

  # signature
  hmac = OpenSSL::HMAC.hexdigest(digest, secret, payload)

  # verification
  hmac == request.env['HTTP_SHOPRUNBACK_SIGNATURE']
```

```php
<?php

  $secret = "your secret"; // empty string if not set
  $payload = @file_get_contents('php://input');

  // signature
  $hmac = hash_hmac ('sha-256', $body , $secret)

  // verification
  $hmac == $_SERVER['HTTP_STRIPE_SIGNATURE'];

?>
```

ShopRunBack generates signatures using a hash-based message authentication code (HMAC) with SHA-256.

To verify this signature:

1. Get the signature in the `Shoprunback-Signature` header
2. Compare the header value with HMAC (SHA-256) of the request body

The two signature must be the same otherwise you can reject this webhook.

## Volume

The volume of webhooks increase with the amount of shipbacks ShopRunBack will handle for you.

Please make sure your server and the application which provides the endpoint can handle all the requests.

If you don't use the webhooks, don't provide any webhooks URL and the platform will not send it.

