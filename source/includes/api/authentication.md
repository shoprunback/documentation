# Authentication

> To authorize your queries, you must provide your company API Token in the HTTP Headers like this:

```ruby
response = HTTParty.post(
              endpoint,
              body: content,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl "<endpoint>"
  -H "Authorization: Token token=<your_token>"
```

```php

<?php
// Load the library
require 'path/to/lib/shoprunback-php/init.php';

// Set your token
\Shoprunback\RestClient::getClient()->setToken('your_token');

// Define the environment you want to use (Production or Sandbox)
\Shoprunback\RestClient::getClient()->useProductionEnvironment();

// Here your token is already set
// You can check if your token is correct by loading your ShopRunBack account
$account = \Shoprunback\Elements\Account::getOwn();
```

> Replace `your_token` with your API key.

We use API keys to allow access to the API.

You can get your API key on the [dashboard](http://dashboard.shoprunback.com/tokens).

ShopRunBack expects for the API key to be included in all API requests to the server in a header that looks like the following:

`Authorization: Token token=<your_token>`


<aside class="notice">
Your API Key is private and linked to your own account. Do not share it with anybody.
</aside>
