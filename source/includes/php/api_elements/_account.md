### Account

The class Account represents your ShopRunBack account.

#### Parameters

> Get your account

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

// With a use statement
use \Shoprunback\Elements\Account;

$account = Account::getOwn();

// Without a use statement
$account = \Shoprunback\Elements\Account::getOwn();
```

Parameter | Type | Description
-|-|-
**first_name** | **String** | Your first name
**last_name** | **String** | Your last name
**email** | **String** | Your email
**auth_token** | **String** | Your authentication token, required to do almost all API calls

#### API operations

> Update your account

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$account = \Shoprunback\Elements\Account::getOwn();
$account->first_name = 'Martin';
$account->save();
```

Operation | Enabled
-|-
**Get all (paginated)** | No
**Get one** | Yes, **for your Account only**
**Create** | No
**Update** | Yes
**Delete** | No