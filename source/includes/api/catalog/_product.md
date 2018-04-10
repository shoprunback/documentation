
## Add your products

Push all your products catalog with this endpoint.

The image in not mandatory but the return experience of your customer will be better with it.

```ruby
body = {
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "weight_grams": 200,
  "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "image_url": "http://www.apple.com/images/iphone-14s.jpg"
}

HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/products",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "POST" "https://dashboard.shoprunback.com/api/v1/products" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "weight_grams": 200,
  "brand_id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "picture_file_url": "http://www.apple.com/images/iphone-14s.jpg"
}'

```

```php
<?php

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/products');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your token>",
  "Content-Type: application/json; charset=utf-8",
 ]
);
// Create body
$json_array = [
            "reference" => "IPHONE 14S B",
            "id" => "1f27f9d9-3b5c-4152-98b7-760f56967dea",
            "picture_url" => "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197",
            "label" => "Iphone 14S Blue",
            "weight_grams" => 200,
            "brand" => [
                "id" => "1f27f9d9-3b5c-4152-98b7-760f56967dea",
                "name" => "Apple",
                "reference" => "apple"
            ],
            "ean" => "1258987561456"
        ];
$body = json_encode($json_array);

// Set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);

?>
```
> The above command returns the same JSON object with the id of the created product:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "weight_grams": 200,
  "picture_url": "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197",
  "brand": {
    "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
    "name": "Apple",
    "reference": "apple"
  }
}
```


### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/products`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
**label** | yes | Label of the product (ie. common name)
**reference** | yes | unique reference in your catalog
**weight_grams** | yes | weight (grams) of the product (package included)
ean | no | barcode
brand_id | no | if you have created a brand and this product has this brand. Otherwise, the default brand is automaticaly used
picture_file_url | no | public URL to the product image (JPG or PNG), to avoid imperfect cropping, use a square image
picture_file_base64 | no | if your product's image is not hosted on the internet, you can provide it with a base64 version of it

<aside class="success">
If you don't have more than one brand, you don't have to provide the brand_id.
</aside>
















































## Create a product with its brand

You can create your product directly with the brand object embedded.

If 2 products have the same brand's `reference`, only one brand object is created.

The image in not mandatory but the return experience of your customer will be better with it.

```ruby
body = {
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "brand": {
    "name": "Apple",
    "reference": "apple"
  },
  "image_url": "http://www.apple.com/images/iphone-14s.jpg"
}

HTTParty.post(
              "https://dashboard.shoprunback.com/api/v1/products",
              body: body,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "POST" "https://dashboard.shoprunback.com/api/v1/products" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "weight_in_grams": 200,
  "brand": {
    "name": "Apple",
    "reference": "apple"
  },
  "picture_file_url": "http://www.apple.com/images/iphone-14s.jpg"
}'

```

```php
<?php

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'http://localhost:3000/api/v1/products');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your token>",
  "Content-Type: application/json; charset=utf-8",
 ]
);
// Create body
$json_array = [
            "reference" => "IPHONE 14S B",
            "id" => "1f27f9d9-3b5c-4152-98b7-760f56967dea",
            "picture_url" => "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197",
            "label" => "Iphone 14S Blue",
            "brand" => [
                "id" => "20d0be72-a191-4eb8-af22-9dd4c3e65fe8",
                "name" => "Apple",
                "reference" => "apple"
            ],
            "weight_grams" => 200,
            "ean" => "1258987561456"
        ];
$body = json_encode($json_array);

// Set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);
?>
```

> The above command returns the same JSON object with the id of the created product:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "label": "Iphone 14S Blue",
  "reference": "IPHONE 14S B",
  "ean": "1258987561456",
  "brand": {
    "id": "20d0be72-a191-4eb8-af22-9dd4c3e65fe8",
    "name": "Apple",
    "reference": "apple"
  },
  "weight_grams": 200,
  "picture_url": "https://s3.eu-central-1.amazonaws.com/shoprunback-dev/products/484/7b4/f4-/pictures/medium.?1505912197"
}
```


### HTTP Request

`POST https://dashboard.shoprunback.com/api/v1/products`

### Query Parameters

Parameter | Required | Description
--------- | ----------- | --------------
**label** | yes | Label of the product (ie. common name)
**reference** | yes | unique reference in your catalog
**weight_grams** | yes | weight (grams) of the product (package included)
ean | no | barcode
color | no | displayed as is on the web return process (no translation)
brand | no | the brand object with all its required attributes
picture_file_url | no | public URL to the product image (JPG or PNG), to avoid imperfect cropping, use a square image
picture_file_base64 | no | if your product's image is not hosted on the internet, you can provide it with a base64 version of it

















































## List your products

```ruby
HTTParty.get(
              "https://dashboard.shoprunback.com/api/v1/products",
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl -X "GET" "https://dashboard.shoprunback.com/api/v1/products?page=1" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \

```

```php
<?php

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://dashboard.shoprunback.com/api/v1/products?page=1');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Token token=<your token>",
 ]
);


// Send the request & save response to $resp
$resp = curl_exec($ch);

if(!$resp) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
  echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "\nResponse HTTP Body : " . $resp;
}

// Close request to clear up some resources
curl_close($ch);
?>
```

> The above command returns JSON structured like this:

```json
{
  "pagination": {
    "current_page": 1,
    "first_page": 1,
    "previous_page": null,
    "next_page": null,
    "last_page": 1,
    "count": 5,
    "per_page": 10
  },
  "products":
    [
      {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Blue",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
         "brand": {
            "id": "20d0be72-a191-4eb8-af22-9dd4c3e65fe8",
            "name": "Apple",
            "reference": "apple"
          },
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      },
      {...},
      {
        "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
        "label": "Iphone 14S Red",
        "reference": "IPHONE 14S B",
        "ean": "1258987561456",
         "brand": {
            "id": "20d0be72-a191-4eb8-af22-9dd4c3e65fe8",
            "name": "Apple",
            "reference": "apple"
          },
        "picture_url": "http://s3.amazonaws/assets/iphone_14s.jpg"
      }
    ]
}
```

You can list all your products on ShopRunBack with this endpoint.

The result is paginated, provide the `page` parameter to get a page (default is page 1).

### HTTP Request

`GET https://dashboard.shoprunback.com/api/v1/products?page=1`

