# Return button

To enable returns for your customers, you need to modify you shop's theme.


## Add the HTML code to your store

* Go to your Store

* Click on Online Store in the sidebar
￼
* Click on Themes

![theme](images/shopify/theme.png)


* Click on Actions > Edit code

![edit_code](images/shopify/edit_code.png)
￼

* Select the `customers/order.liquid` file in the Templates section

￼
![customer_order](images/shopify/customer_order.png)

* Then
￼

![insert_code](images/shopify/insert_code.png)


```html
<div class="shoprunback_return">
  <h2 class="title">{{ 'customer.order.return.title' | t }}</h2>
  <span class="action">
    {{ 'customer.order.return.action' | t }}
    {% assign customer_url = order.customer_url| split: "/"  %}
    <a style="font-weight: bold;" href="https://modulespf.shoprunback.com/{{shop.domain}}/orders/{{order.id}}/return/">{{ 'customer.order.return.button' | t }}</a>
  </span>
</div>
```


* Find the `</table>` tag and insert the code on the right under it


## Add the localization keys

* Our module is localized. Open the locales section

￼
![locales](images/shopify/locales.png)


Open the `en.default.json` (or your own en.json file) file and find the **order** dictionary :

You need to add a `return` dictionary inside with 3 keys :

- title : "A problem with your order"
- action: "You can return it"
- button: "here"


Your file should look like this : 


![locale_en](images/shopify/locale_en.png)

￼
 Do the same for every other language you are supporting.

## What it looks like

![return_order](images/shopify/return_order.png)
