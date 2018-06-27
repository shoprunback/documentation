# RestClient

> Use the RestClient globally

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$restClient = \Shoprunback\RestClient::getClient();
$restClient->useSandboxEnvironment();
$restClient->setToken('yourApiToken');

define('SRB_REST_CLIENT', $restClient);
```

**Accepts: GET ; POST ; PUT ; DELETE**

The RestClient is used to execute the API calls.

It is a **Singleton**, so you need to use `getClient` to use it.

<aside class="warning">
  Since it is a Singleton, it is highly recommended to <b>declare it in a variable or a constant</b> so you can use it everywhere
</aside>

## Set token

> Set token

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$restClient = \Shoprunback\RestClient::getClient();
$restClient->setToken('yourApiToken');
```

You can **set the token of a user** with `setToken()`. Most of the API calls need you to be authentified to be done.

## Use production or sandbox environment

> Set environment

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

$restClient = \Shoprunback\RestClient::getClient();

$restClient->useProductionEnvironment();
// OR
$restClient->useSandboxEnvironment();
```

To choose **which environment to work with**, you can use `useProductionEnvironment` or `useSandboxEnvironment`.

It will define **https://dashboard.shoprunback.com** or **https://sandbox.dashboard.shoprunback.com** as the base URL for all the API calls.

> Get the environments' URL

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getProductionUrl(); // Returns 'https://dashboard.shoprunback.com'
\Shoprunback\RestClient::getSandboxUrl(); // Returns 'https://sandbox.dashboard.shoprunback.com'
```

If you want to **get the URL of the** production or sandbox **environment without changing the environment you are working with**, you can use `getProductionUrl` or `getSandboxUrl`.

## Custom headers

### Set custom headers

> Set custom headers

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setCustomHeaders([
  'Custom-Field: Custom value',
  'Another-Field: Another value'
]);
```

If you need to add headers to your HTTP requests, you can add custom headers to your RestClient with `setCustomHeaders`.

**Your custom headers must be an array**.

<aside class="warning">
  You cannot modify the "Content-Type" and "Authorization" headers.
</aside>

### Get your custom headers

> Get your custom headers

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->getCustomHeaders();
```

You can get the custom headers you set with `getCustomHeaders`.