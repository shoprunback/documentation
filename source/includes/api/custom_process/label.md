## 4. Get the label


```json
{
  "bank_token": "free"
}
```

To validate the selected mode and get the label, you have to update the shipbacks on the `api/v1/shipbacks/:id` endpoint with the `bank_token` set to `free`.

<aside class="notice">
  You can only generate the label for modes free of charge for your customer, otherwise your customer has to be redirected to our website.
</aside>

Once the `bank_token` provided, the voucher and the label are being generated, you can get the corresponding label by polling the `api/v1/shipbacks/:id` endpoint.

The label generation is dependent of the carriers response time, you can expect up to 1 minute of waiting to get the label.