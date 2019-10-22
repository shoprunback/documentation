# Overrides

## Relocation

```json
# POST on the endpoint api/v1/shipbacks/:id
{
  "mode": "pickup",
  "overrides": {
    "relocation_warehouse_id": "E002"
  }
}
```

The ShopRunBack's dashboard gives you the possibility to define your rules of
relocation based on the reason of the return and the country of your customer.

If the rules engine does not fit your desires, you can override the warehouse of
relocation of the entire shipback while creating (or updating) the shipback on
the API by providing the warehouse ID or reference.

## Price paid by the customer

```json
# POST on the endpoint api/v1/shipbacks/:id
{
  "mode": "pickup",
  "overrides": {
    "dropoff_customer_price_cents": 300,
    "postal_customer_price_cents": 450,
    "pickup_customer_price_cents": 1200
  }
}
```

You can change the price displayed and paid by the customer on the web return
process depending on rules in your own system. If the amount paid is higher than
the normal price of the service, the difference will be refunded to you.

These overrides are only for returns which are not free for the customer, if you
want to create you policy for free return, please use the Smart Rules system.

## Try at Home

```json
# POST on the endpoint api/v1/shipbacks/:id
{
  "overrides": {
    "try_at_home": true
  }
}
```

ShopRunBack provides a _Try at Home_ feature which makes certain returns free
when they are within a specified period of time after the initial order. At the
time of writing, this feature needs to be enabled in your company configuration
by ShopRunBack's support.

Shipbacks leveraging this feature needs to be flagged as _Try at Home_ returns.
This is accomplished by setting the `try_at_home` override to `true`, POSTing
the following json data on the shipback's endpoint:

```shell
# cURL example:
curl -H "Authorization: Token token=<your_token>"
     -X POST -d '{"overrides": {"try_at_home": true}}'
     'https://dashboard.shoprunback.com/api/v1/shipbacks/:id'
```

```ruby
# Ruby example
response = HTTParty.post(
    'https://dashboard.shoprunback.com/api/v1/shipbacks/#{shipback_id}'
    body: { overrides: { try_at_home: true } },
    headers: {
        'Content-Type' => 'application/json',
        'Authorization' => "Token token=#{your_token}"
    }
)
```
