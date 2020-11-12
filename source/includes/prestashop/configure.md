# Configure the module

## Connect my ShopRunBack account to the module

To share your data with ShopRunBack, you must use the [authentication token of your ShopRunBack account](https://dashboard.shoprunback.com/tokens).

Copy it and go back to your website.

Click on the `ShopRunBack` tab in the left menu.

| 1.6 | 1.7 |
|-|-|
| ![ShopRunBack tab in the left menu for PrestaShop 1.6.0.9](../../images/prestashop/ps1.6.0.9_left-menu-srb.png) | ![ShopRunBack tab in the left menu for PrestaShop 1.7.2.5](../../images/prestashop/ps1.7.2.5_left-menu-srb.png) |

Go to `Configuration`.

![Go to the configuration tab in the ShopRunBack module](../../images/prestashop/no-return.png)

Paste your token in the `API Token` field and save your configuration.

![Save the ShopRunBack token](../../images/prestashop/config-token.png)

Now, you can share your data with your ShopRunBack account!

## Synchronize your data!

To synchronize an element, click on its corresponding `Synchronize` button.

<aside class="warning">
  If you switch environment, change your API token or uninstall the module, all the return requests and synchronizations will be reset!
</aside>

![Synchronize data](images/prestashop/return.png)

## Environment

<aside class="warning">
  Be careful about which environment is set in your configuration!
</aside>

There are 2 modes:

- **Sandbox**: It is a **test** environment. The data on this environment is **reset every monday**.
- **Production**: It is where your customers' return requests are made. **This is real data!**

<aside class="warning">
  If you switch environment, change your API token or uninstall the module, all the return requests and synchronizations will be reset!
</aside>

![Where to find ShopRunBack in the left menu](../../images/prestashop/config-token-and-env.png)
