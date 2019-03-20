# Overrides

## Relocation

```json
{
  "mode": "pickup",
  "order_id": "1234567",
  "overrides": {
    "relocation_warehouse_id": "E002"
  }
}
```

The ShopRunBack's dashboard gives you the possibility to define your rules of relocation based on the reason of the return and the country of your customer.

If the rules engine does not fit your desires, you can override the warehouse of relocation of the entire shipback while creating (or updating) the shipback on the API by providing the warehouse ID or reference.

## Price paid by the customer

```json
{
  "mode": "pickup",
  "order_id": "1234567",
  "overrides": {
    "dropoff_customer_price_cents": 300,
    "postal_customer_price_cents": 450,
    "pickup_customer_price_cents": 1200
  }
}
```

You can change the price displayed and paid by the customer on the web return process depending on rules in your own system.
If the amount paid is higher than the normal price of the service, the difference will be refunded to you.

These overrides are only for returns which are not free for the customer, if you want to create you policy for free return, please use the Smart Rules system.