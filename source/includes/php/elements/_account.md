## Account

The class Account represents your ShopRunBack account.

> Get your account

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$account = \Shoprunback\Elements\Account::getOwn();
```

#### API Methods

> Update your account

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$account = \Shoprunback\Elements\Account::getOwn();
$account->first_name = 'Martin';
$account->save();
```

Method | Enabled
-|-
**Get all (paginated)** | No
**Get one** | Yes, **for your account only**
**Create** | No
**Update** | Yes
**Delete** | No