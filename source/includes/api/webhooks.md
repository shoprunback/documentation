# Webhooks

Every event on ShopRunBack can trigger a webhook.

Basically, a webhook is a JSON Object send by HTTP (POST) to an URL you have set on your account.

The server expect a 200 response (`HTTP OK`) when posting the webhook, otherwise it is marked as not received successfully on the dashboard.

[Go to the webhooks dashboard](https://staging.dashboard.shoprunback.com/en/webhooks).


## List


| Webhook name | Trigger |
|--------------|---------|
| collaborator.created     | Sent when a collaborator creates its account |
| collaborator.invited     | Sent when a manager invite a collaborator |
| product.created          | Sent when a product is created in the catalogue |
| relocation.created       | Sent when a new relocation rule has been created |
| returneditem.missing     | Sent when a returned item is marked as missing by an operator |
| returneditem.relocated   | Sent when a returned item is relocated to the retailer's warehouse |
| returneditem.transiting  | Sent when a returned item is transitting |
| shipback.paid            | Sent when a shipback is registered (the customer has paid or validated is free return) and the customer can download its voucher and label |
| shipback.relocated       | Sent when all the returned item's of a shipback are relocated to the retailer's warehouse |
| shipback.transiting      | Sent when all returned item's of a shipback are transiting |
| sponsoring.created       | Sent when a new sponsoring rule has been created |
| warehouse.created        | Sent when a new warehouse is added to the company |

 <aside class="notice">
  If you want to track a specific event and you don't find the appropriate webhooks above, please contact julien _at_ shoprunback _dot_ com.

  If accurate, the webhook can be added to the platform in the next release.
</aside>

## Data sent


```ruby
  # Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "shipback.relocated",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id"=>"fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "mode"=>"postal",
      (...)
    }
  }
```

```php
<?php
  // Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "shipback.relocated",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id"=>"fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "mode"=>"postal",
      (...)
    }
  }
?>
```

```shell
  # Example of JSON sent:
  {
    "id": "00082f23-9b8c-4515-b1cd-527d56a1bef3",
    "event": "shipback.relocated",
    "created_at": "2018-02-20 16:54:22 +0100",
    "data": {
      "id"=>"fc8520bf-3ae0-46b1-8991-cacb6b03c698",
      "mode"=>"postal",
      (...)
    }
  }
```

All webhooks has the same caracteristics; this is a JSON Object with the attributes:

* the `id`: a unique identifier. You can use it to detect duplicate.
* the name of the `event` with the format: `<object trigerring the webhook>.<action>`
* the date of the event which is also the date of creation of the webhook: `created_at`
* the object triggering the webhook as a JSON in the `data` attribute.


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

* setup a basic authentication and provide the login and passoword in the URL (`http://<login>:<password>@host.com`)
* verify the value of a specific URL parameter and provide it in the webhook URL (`http://host.com?shoprunback=topsecret`)

You can set your Wehbook URL on the dashboard, in the [section Developers > Webhooks](https://dashboard.shoprunback.com/webhooks/edit).

## Volume

The volume of webhooks increase with the amount of shipbacks ShopRunBack will handle for you.

Please make sure your server and the application which provides the endpoint can handle all the requests.

If you don't use the webhooks, don't provide any webhooks URL and the platform will not send it.

