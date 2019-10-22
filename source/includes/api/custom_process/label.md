## 4. Get the label

```shell
# cURL example:
curl -H "Authorization: Token token=<your_token>"
     -X POST
     'https://dashboard.shoprunback.com/api/v1/shipbacks/:id/free'
```

```ruby
# Ruby example
response = HTTParty.post(
    'https://dashboard.shoprunback.com/api/v1/shipbacks/#{shipback_id}/free',
    headers: {
        'Content-Type' => 'application/json',
        'Authorization' => "Token token=#{your_token}"
    }
)
```

<aside class="notice">
  You can only generate the label for modes free of charge for your customer,
  otherwise your customer has to be redirected to our website.
</aside>

To validate the selected mode and get the label, payment information needs to be
added to the shipback. In the case of a custom return process, where customer
payment isn't supported, we need to skip the payment phase by POSTing on the
`api/v1/shipbacks/:id/free` endpoint.


Once the call has been successfully performed, the voucher and the label are
being generated, you can get the corresponding label by polling the
`api/v1/shipbacks/:id` endpoint.

The label generation is dependent of the carriers response time, you can expect
up to 1 minute of waiting to get the label.
