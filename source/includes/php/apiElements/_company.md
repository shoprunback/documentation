### Company

The class Company represents your company.

#### Parameters

> Get its company

```php
<?php
// With a use statement
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

use \Shoprunback\Elements\Company;

$company = Company::getOwn();

// Without a use statement
require 'path/to/lib/shoprunback-php/init.php';

$company = \Shoprunback\Elements\Company::getOwn();
```

Parameter | Type | Description
-|-|-
**name** | **String** | Your company's name
**slug** | **String** | Your company's slug
**address1** | **String** | First part of your company's address
**address2** | **String** | Second part your company's address
**zipcode** | **String** | Your company's zipcode
**state** | **String** | Your company's state
**country_code** | **String** | Your company's country code
**contact_email** | **String** | Your company's contact email
**website_url** | **String** | Your company's website URL
**phone_number** | **String** | Your company's public phone number
**logo_url** | **String** | Your company's logo's URL
**reasons** | **Array of Reasons** | The reasons of returns your company accepts


#### API operations

> Update its company

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$company = \Shoprunback\Elements\Company::getOwn();
$company->name = 'ShopRunBack';
$company->save();
```

Operation | Enabled
-|-
**Get all (paginated)** | No
**Get one** | Yes, **own only**
**Create** | No
**Update** | Yes
**Delete** | No