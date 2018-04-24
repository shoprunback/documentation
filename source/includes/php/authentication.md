# Authentication

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

// We highly recommend you to write this line at the very beginning of your code, so the token is set for all future API call
\Shoprunback\RestClient::getClient()->setToken('yourApiToken');
```

To use the API, you must be authenticated with your API token, which can be done with the class RestClient.

You need to set your API token in the RestClient with `\Shoprunback\RestClient::getClient()->setToken('yourApiToken');`, and then you will have access to all your data.

<aside class="warning">
The authentication token is <b>unique</b> for each Account and <b>gives access to all your data</b>, <b>be careful not to share it</b>!
</aside>
