## Company

> Get its company

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$company = \Shoprunback\Elements\Company::getOwn();
```

The class Company contains the informations about your company.

#### API operations

> Update your company

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$company = \Shoprunback\Elements\Company::getOwn();
$company->name = 'ShopRunBack';
$company->save();
```

Operation | Enabled
-|-
**Get all (paginated)** | No
**Get one** | Yes, **your company only**
**Create** | No
**Update** | Yes
**Delete** | No