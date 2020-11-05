## SparePart

> Initialize

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$sparepart = new \Shoprunback\Elements\SparePart();

```
> Create a SparePart

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$sparepart = new \Shoprunback\Elements\SparePart();

// Mandatory to create a new sparepart
$sparepart->name = 'My Part';
$sparepart->reference = 'my-spare-sparepart';
$sparepart->description = 'A longer description for your spare part';
$sparepart->picture_url = 'string'; 
$sparepart->metadata = ['foo' => 'bar'];

// Now you can save the sparepart
$sparepart->save();
```

<!-- #### API Methods -->

> Get all SpareParts (Not Available)

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$sparepart = \Shoprunback\Elements\SparePart::all();
```


> Get one SparePart

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$sparepart = \Shoprunback\Elements\SparePart::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```

> Update a SparePart

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

$sparepart = \Shoprunback\Elements\SparePart::retrieve('1f27f9d9-3b5c-4152-98b7-760f56967dea');
$sparepart->name = 'New Name';
$sparepart->save();
```

> Delete a SparePart

```php
<?php
require_once 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

\Shoprunback\Elements\SparePart::delete('1f27f9d9-3b5c-4152-98b7-760f56967dea');
```


Method | Enabled
-|-
**Get all (paginated)** | No
**Get one** | Yes
**Create** | Yes
**Update** | Yes
**Delete** | Yes
