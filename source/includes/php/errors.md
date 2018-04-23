# Errors

> Catch an Error from the library

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

try {
  $product = \Shoprunback\Elements\Product::retrieve('a wrong ID');
} catch (\Shoprunback\Error\Error $e) {
  // Here you can manage the error
}
```

To prevent errors to crash your application, you must catch the exceptions.

All the errors the library can return inherit from the class **\Shoprunback\Error\Error**.

#### Parameters

Parameter | Type | Description | Specific to
-|-|-|-
**message** | **String** | The mandatory message for an Exception | All
**response** | **RestResponse** | The response from the server explaining why the call failed | **RestClientError**

## Error types

> Use a RestClientError

```php
<?php
require 'path/to/lib/shoprunback-php/init.php';

\Shoprunback\RestClient::getClient()->setToken('yourApiToken');

try {
  $product = \Shoprunback\Elements\Product::retrieve('a wrong ID');
} catch (\Shoprunback\Error\Error $e) {
  if (is_a($e, \Shoprunback\Error\RestClientError)) {
    $restResponse = $e->response;
    // Then, see how to use a RestResponse
  }
}
```

Class name | Event | Special
-|-|-
**ElementCannotBeCreated** | When an element doesn't have a POST endpoint (ex: Account)
**ElementCannotBeUpdated** | When an element doesn't have a PUT endpoint (ex: Order)
**ElementCannotGetAll** | When an element doesn't have a GET endpoint to get all Elements (ex: Account)
**ElementIndexDoesntExists** | When you try to get the nth element and there are less than n element
**NotFoundError** | When you try to get or update an element but the given ID or reference doesn't exist
**RestClientError** | When an error occured while trying to make an API call (token not set, server unreachable...) | Has a **response** parameter containing a **RestResponse**
**UnknownApiToken** | (Not yet implemented)
**UnknownElement** | When the library checks if an object is an Element and doesn't find any appropriate class
