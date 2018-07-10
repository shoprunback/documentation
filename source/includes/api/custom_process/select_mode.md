## 3. Select the mode



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

To select the mode, you have to update the shipbacks and provide one of the available modes.

A mode is available if the corresponding quote is marked as `available`.

### Mode Dropoff

```json
{
  "dropoff_code": "O4001",
  "mode": "dropoff"
}
```

To select the dropoff mode, you also have to provide a valid dropoff point code. This code is provided in the `quotes` endpoint.

Update the shipback with the mode `dropoff` and the `dropoff_code` on the `api/v1/shipbacks/:id` endpoint.

### Mode Pickup

```json
{
  "pickup_datetime": "2018-01-18 14:00:00",
  "pickup_duration": "120",
  "mode": "pickup"
}

```

To select the pickup mode, you also have to provide a valid `pickup_datetime` and `pickup_duration`. These values are available in the `quotes` endpoint.

Update the shipback withe the mode `pickup` and these 2 values on the `api/v1/shipbacks/:id` endpoint.



