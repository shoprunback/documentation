# Return button

To enable returns for your customers, you need to modify you shop's theme.


* Go to your Store

* Click on Online Store on the sidebar
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
  <span class="title">{{ 'customer.order.return.title' | t }}</span>
  <span class="action">
    {{ 'customer.order.return.action' | t }}
    {% assign customer_url = order.customer_url| split: "/"  %}
    <a style="font-weight: bold;" href="https://shopify.shoprunback.com/{{shop.domain}}/orders/{{order.id}}/return/{{customer_url | last }}">{{ 'customer.order.return.button' | t }}</a>
  </span>
</div>
```


* Find the `</table>` tag and insert the code on the right


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


You’re all done, now your customers will be able to request a return directly in their order detail

![return_order](images/shopify/return_order.png)
