# Use the module

## Synchronize your data

The ShopRunBack tab summarizes your returns, products, brands and orders, and allows you to synchronize them with ShopRunBack.

On each tab, you can see your data and can synchronize each of them at any time, or all at once.

You must always have your data synchronized with ShopRunBack to avoid any discrepancies.

## What is automatically synchronized?

For instance, some of your data is automatically synchronized after some actions:

- Product
  - When you create a product
  - When you edit a product
  - When you delete a product
- Order
  - When you or a customer create a product
  - When the status of an order changes
- Return
  - When a return is modified on ShopRunBack

<aside class="warning">
  You still need to manually synchronize the brands.
</aside>

<aside class="warning">
  If you delete a product that has already been ordered, even just once, it cannot be deleted on ShopRunBack's database.
</aside>

<aside class="warning">
  When you create a product on your website, you must fill the following fields:

  <ul>
    <li>Label</li>
    <li>Reference</li>
    <li>Weight</li>
  </ul>
</aside>

## How does my customers create a return demand?

Any customer can create a return demand once an order is at least "Shipped".

They then have a button to create a return demand on the details of the order.

This button redirects them to the ShopRunBack's form to fill their demand.

## How can I know if anything went wrong?

We log most of the module's actions on your log system.

To access it, just go to your back-office, and, in the left menu, go to "Advanced parameters" > "Logs".

All our logs have their message beginning with "[ShopRunBack]" so you can filter them easily.
