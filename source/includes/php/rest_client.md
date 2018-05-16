# RestClient

> Use the RestClient globally

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$restClient = \Shoprunback\RestClient::getClient();
$restClient->setApiBaseUrl('https://dashboard.shoprunback.com');
$restClient->setToken('yourApiToken');

define('REST_CLIENT', $restClient);
```

**Accepts: GET ; POST ; PUT ; DELETE**

The RestClient is used to execute the API calls.

It is a **Singleton**, so you need to use `getClient` to use it.

<aside class="warning">
  Since it is a Singleton, it is highly recommended to <b>declare it in a variable or a constant</b> so you can use it everywhere
</aside>

You can **set a specific URL target** for the API calls with `setApiBaseUrl()`. This URL should be **https://dashboard.shoprunback.com** by default and **https://sandbox.dashboard.shoprunback.com** for the sandbox.

You can **set the token of a user** with `setToken()`. Most of the API calls need you to be authentified to be done.

You can also **set environment variables** called `SHOPRUNBACK_URL` and `SHOPRUNBACK_TOKEN` to automatically load them.
