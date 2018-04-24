### Company

The class Company contains the informations about your company.

#### Parameters

> Get its company

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

// With a use statement
use \Shoprunback\Elements\Company;

$company = Company::getOwn();

// Without a use statement
$company = \Shoprunback\Elements\Company::getOwn();
```

Parameter | Type | Description
-|-|-
**name** | **String** | Your company's name (mandatory to create a company)
**slug** | **String** | Your company's slug
**address1** | **String** | Your company's address
**address2** | **String** | Optional informations (floor, code...)
**zipcode** | **String** | Your company's zipcode
**state** | **String** | Your company's state
**country_code** | **String** | Your company's country code
**contact_email** | **String** | Your company's contact email
**website_url** | **String** | Your company's website URL
**phone_number** | **String** | Your company's public phone number
**logo_url** | **String** | Your company's logo's URL
**reasons** | **Array of Reasons** | The retur reasons your company accepts (**'doesnt_fit'** ; **'quality'** ; **'damaged'** ; **'wrong'** ; **'incorrect'** ; **'delay'** ; **'reconsider'**)


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