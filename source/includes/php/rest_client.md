# RestClient

> Use the RestClient globally

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$restClient = \Shoprunback\RestClient::getClient();
$restClient->setApiBaseUrl('http://localhost:3000');
$restClient->setToken('yourApiToken');

define('SRB_REST_CLIENT', $restClient);
```

**Accepts: GET ; POST ; PUT ; DELETE**

The RestClient is used to execute the API calls.

It is a **Singleton**, so you need to use `getClient` to use it.

<aside class="warning">
  Since it is a Singleton, it is highly recommended to <b>declare it in a variable or a constant</b> so you can use it everywhere
</aside>

## Set parameters

> Set RestClient parameters

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$restClient = \Shoprunback\RestClient::getClient();
$restClient->setApiBaseUrl('http://localhost:3000');
$restClient->setToken('yourApiToken');
```

You can **set a specific URL target** for the API calls with `setApiBaseUrl()`.

You can **set the token of a user** with `setToken()`. Most of the API calls need you to be authentified to be done.

You can also **set environment variables** called `SHOPRUNBACK_URL` and `SHOPRUNBACK_TOKEN` to automatically load them.

## Use production or sandbox environment

> Use the production environment

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$restClient = \Shoprunback\RestClient::getClient();
$restClient->useProductionEnvironment();
```

> Use the sandbox environment

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$restClient = \Shoprunback\RestClient::getClient();
$restClient->useSandboxEnvironment();
```

If you want to **use the production or sandbox environment**, you can use `useProductionEnvironment` and `useSandboxEnvironment`.

It will set **https://dashboard.shoprunback.com** for the production environment and **https://sandbox.dashboard.shoprunback.com** for the sandbox.