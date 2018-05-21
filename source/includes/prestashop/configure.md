# Configure the module

## Connect my ShopRunBack account to the module

To share your data with ShopRunBack, you must use the [authentication token of your ShopRunBack account](https://dashboard.shoprunback.com/tokens).

Copy it and go back to your website.

Click on the `ShopRunBack` tab in the left menu.

| 1.6 | 1.7 |
|-|-|
| ![ShopRunBack tab in the left menu for PrestaShop 1.6.0.9](../../images/prestashop/ps1.6.0.9_left-menu-srb.png) | ![ShopRunBack tab in the left menu for PrestaShop 1.7.2.5](../../images/prestashop/ps1.7.2.5_left-menu-srb.png) |

Go to `Configuration`.

![Go to the configuration tab in the ShopRunBack module](../../images/prestashop/ps_srb-returns-goto-configuration.png)

Paste your token in the `API Token` field and save your configuration.

![Save the ShopRunBack token](../../images/prestashop/ps_srb-configuration-save-token.png)

Now, you can share your data with your ShopRunBack account!

## Synchronize your data!

After configuring your account, we recommend you to directly synchronize all your brands, products and orders.

![Synchronize all brands](../../images/prestashop/ps_srb-brands-sync-all.png)

![Synchronize all products](../../images/prestashop/ps_srb-products-sync-all.png)

![Synchronize all orders](../../images/prestashop/ps_srb-orders-sync-all.png)

## Environment

<aside class="warning">
  Be careful about which environment is set in your configuration!
</aside>

There are 2 modes:

- **Sandbox**: It is a **test** environment. The data on this environment is **reset every monday**.
- **Production**: It is where your customers' return requests are made. **This is real data!**

![Where to find ShopRunBack in the left menu](../../images/prestashop/ps_srb-configuration-environments.png)
