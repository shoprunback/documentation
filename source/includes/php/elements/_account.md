## Account

The class Account represents your account.

### Parameters

> Get its account

```php
<?php
// With a use statement
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

use \Shoprunback\Elements\Account;

$account = Account::getOwn();

// Without a use statement
require 'path/to/lib/shoprunback-php/init.php';

$account = \Shoprunback\Elements\Account::getOwn();
```

Parameter | Description
-|-
**first_name** | Your first name
**last_name** | Your last name
**email** | Your email
**auth_token** | Your authentication token, required to do almost all API calls

### API operations

> Update its account

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$account = \Shoprunback\Elements\Account::getOwn();
$account->first_name = 'Martin';
$account->save();
```

Operation | Enabled
-|-
**Get all (paginated)** | No
**Get one** | Yes, own only
**Create** | No
**Update** | Yes
**Delete** | No