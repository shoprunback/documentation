# Your own return process

If <b>you don't want to use the return process provided by ShopRunBack</b>, you can built your own return's funnel.

For that you have to:

1/ Create the shipback with the list of the returned items (with the associated reason code)

2/ Request the quotes (for each mode - pickup, postal and dropoff - a quote is created to compute the corresponding price of the return)

3/ Confirm the quote (select and confirm one of the available quotes)

4/ Get the label

<aside class="notice">
ShopRunBack is directly connected to the system of multiple carriers with variable response time.
For that reason, several calls made to the API will provide the response <b>asynchronously</b>.
</aside>

<aside class="warning">
  You can only generate the label by yourself for mode you sponsor entirely (sponsoring = 100%). Otherwise your customer has to pay for the remaining part and it can only be done on our website.
</aside>



## 1. Create the shipback

To create the return [follow this instruction](/api.html#return).
