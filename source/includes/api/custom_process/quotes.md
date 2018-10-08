## 2. Request the quotes

```ruby
HTTParty.get(
              "https://dashboard.shoprunback.com/api/v1/shipbacks/00082f23-9b8c-4515-b1cd-527d56a1bef3/quotes",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )

```


```shell
curl -X "GET" "https://dashboard.shoprunback.com/api/v1/shipbacks/00082f23-9b8c-4515-b1cd-527d56a1bef3/quotes" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8"
```

```php
<?php
  //The ShopRunBack library doesn't provide, at the moment, a dedicated method for that

// get cURL resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/shipbacks/00082f23-9b8c-4515-b1cd-527d56a1bef3/quotes');

// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Authorization: Token token=your_token',
]);

// send the request and save response to $response
$response = curl_exec($ch);

// stop if fails
if (!$response) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}

echo 'HTTP Status Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
echo 'Response Body: ' . $response . PHP_EOL;

// close curl resource to free up system resources
curl_close($ch);



```

> The above command returns JSON structured like this:

```json
[
  {
    "id": "570f3429-25ec-4685-9229-581853d0fecc",
    "state": "computing",
    "mode": "postal",
    "price_cents": null,
    "customer_price_cents": null
  },
  {
    "id": "dc1383df-020b-44a6-8100-69bed63c35ee",
    "state": "computing",
    "mode": "pickup",
    "price_cents": null,
    "customer_price_cents": null
  },
  {
    "id": "d014d7c6-8f46-4c87-9d81-df91d502b1ef",
    "state": "computing",
    "mode": "dropoff",
    "price_cents": null,
    "customer_price_cents": null
  }
]

```


The quotes are only computed on demand. So once the shipback created with the returned items inside, you have to trigger the computation of the quotes.

The computation takes some time (from 30 to 90s) to compute the 3 quotes. You can request the endpoint `/api/v1/shipbacks/:id/quotes` every 20 seconds to get the state of the computation.

You can also query the quote of the mode you want to follow directly the computation of this mode only : `/api/v1/shipbacks/:id/quotes/postal` for the postal mode.


### Clear the quotes

```ruby
HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/shipbacks/00082f23-9b8c-4515-b1cd-527d56a1bef3/quotes/clear",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )

```


```shell
curl -X "POST" "https://dashboard.shoprunback.com/api/v1/shipbacks/00082f23-9b8c-4515-b1cd-527d56a1bef3/quotes/clear" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8"
```

```php
<?php
  //The ShopRunBack library doesn't provide, at the moment, a dedicated method for that

// get cURL resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/shipbacks/00082f23-9b8c-4515-b1cd-527d56a1bef3/quotes/clear');

// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Authorization: Token token=your_token',
]);

// send the request and save response to $response
$response = curl_exec($ch);

// stop if fails
if (!$response) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}

echo 'HTTP Status Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
echo 'Response Body: ' . $response . PHP_EOL;

// close curl resource to free up system resources
curl_close($ch);



```


If you have updated the shipback or simply want to retrigger the quotes computation, you have to clear them by calling the dedicated endpoint.


