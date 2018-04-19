# Authentication

To use the API, you must be authenticated, which can be done with the class RestClient.

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';
```

<aside class="notice">
To use the library, you must first have loaded it with ->
</aside>

## Authenticate

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

// We highly recommend you to write this line at the very beginning of your code, so the token is set for all future API call
\Shoprunback\RestClient::getClient()->setToken('yourApiToken');
```

You need to set your API token in the RestClient, and then you will have access to all your data ->