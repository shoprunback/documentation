---
title: ShopRunBack API Reference

language_tabs:
  - ruby

toc_footers:
  - <a href='http://dashboard.shoprunback.com'>Sign Up for a Developer Key</a>

includes:

search: true
---

# Introduction

Welcome on the ShopRunBack public API, the inventor of the Return As A Service solution.
This API provides all the endpoints for any e-commerce retailer to get all the features for an optimized return experience for its customers.

You can also get the technical documentation and test it without coding on [https://app.swaggerhub.com/apis/Shoprunback/SRB-APP/1.0.0](https://app.swaggerhub.com/apis/Shoprunback/SRB-APP/1.0.0).

# Authentication

> To authorize your queries, you must provide you company API Token in the HTTP Headers like this :

```ruby
response = HTTParty.post(
              endpoint,
              body: content,
              headers: {
                'Content-Type' => 'application/json',
                'Authorization' => "Token token=#{your_token}"
              }
            )
```

```shell
curl "<endpoint>"
  -H "Authorization: Token token=<your_token>"
```

> Replace `your_token` with your API key.

ShopRunBack uses API keys to allow access to the API.
You can get your API key on your [retailer dashboard](http://dashboard.shoprunback.com/tokens).

ShopRunBack expects for the API key to be included in all API requests to the server in a header that looks like the following:

`Authorization: Token token=<your_token>`

# Brand & Product catalog

## Add a brand

By default, once your retailer account is created and your company details entered, a default brand is created.
But you can add your own brands if you have multiple brands in your catalog.

```ruby
body = {
  name: "Apple"
}
```

```shell
curl -X "POST" "<api_endpoint>/brands" \
     -H "Authorization: Token token=<your_token>" \
     -H "Content-Type: application/json; charset=utf-8" \
     -d $'{
  "name": "Apple"
}'

```

> The above command returns JSON structured like this:

```json
{
  "id": "1f27f9d9-3b5c-4152-98b7-760f56967dea",
  "name": "Apple",
  "default": false
}
```

This endpoint create a new brand.

### HTTP Request

`GET https://dashboard.shoprunback.com/api/v1/brands`

### Query Parameters

Parameter | Description
--------- | -----------
name | Name of the brand, displayed to the customer on the return process

<aside class="success">
If you don't more than one brand, you don't have to create another one, the default brand is enough.
</aside>

## Get a Specific Kitten

```ruby
require 'kittn'

api = Kittn::APIClient.authorize!('meowmeowmeow')
api.kittens.get(2)
```

```python
import kittn

api = kittn.authorize('meowmeowmeow')
api.kittens.get(2)
```

```shell
curl "http://example.com/api/kittens/2"
  -H "Authorization: meowmeowmeow"
```

```javascript
const kittn = require('kittn');

let api = kittn.authorize('meowmeowmeow');
let max = api.kittens.get(2);
```

> The above command returns JSON structured like this:

```json
{
  "id": 2,
  "name": "Max",
  "breed": "unknown",
  "fluffiness": 5,
  "cuteness": 10
}
```

This endpoint retrieves a specific kitten.

<aside class="warning">Inside HTML code blocks like this one, you can't use Markdown, so use <code>&lt;code&gt;</code> blocks to denote code.</aside>

### HTTP Request

`GET http://example.com/kittens/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the kitten to retrieve
