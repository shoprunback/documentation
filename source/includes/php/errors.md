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

To prevent errors to crash your code, you must catch the exceptions.

All the errors the library can return inherit from the class **\Shoprunback\Error\Error**. ->

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

\Shoprunback\RestClient::getClient()->setToken('a wrong token');

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
**ElementCannotBeCreated** | Happens when the code tries to create an element that hasn't a POST endpoint (ex: Account)
**ElementCannotBeUpdated** | Happens when the code tries to update an element that hasn't a PUT endpoint (ex: Order)
**ElementCannotGetAll** | Happens when the code tries to get an array of elements and it is not allowed (ex: Account)
**ElementIndexDoesntExists** | Happens when the code tries to get the nth element and there are less than n element
**NotFoundError** | Happens when the code tries to get or update an element but the given ID or reference doesn't exists
**RestClientError** | Happens when an error occured while trying to make an API call (token not set, server unreachable...) | Has a **response** parameter containing a **RestResponse**
**UnknownApiToken** | (Not yet implemented)
**UnknownElement** | Happens when the library checks if an object is an Element and doesn't find any appropriate resource
