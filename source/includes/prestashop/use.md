# Use the module

## How to synchronize your data

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

## Which language can I use?

It is currently available in English (GB and US) and French.

## How do my customers create a return request?

Any customer can create a return request once an order is at least `Shipped`.

They then have a button to create a return request on the details of the order.

(The screenshots show the default PrestaShop template)

### 1.6 version

![Order detail in front-office in PrestaShop 1.6.0.9](../../images/prestashop/ps1.6.0.9_order-detail-return-request.png)

### 1.7 version

![Order detail in front-office in PrestaShop 1.7.2.5](../../images/prestashop/ps1.7.2.5_order-detail-return-request.png)

This button redirects them to the ShopRunBack's form to fill their request.
