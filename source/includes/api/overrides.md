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