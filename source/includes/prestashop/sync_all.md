# Sync All Elements

## How to access this page

In order to use the Sync All method on Brands, Products or Orders, modify the current URL of your browser and add `&syncAll` at the end.

<aside class="warning">
  This will only work if you are on one of the pages of the ShopRunBack module
</aside>

## Limits

Modern browsers impose limits on how long a request can live. If you have a big catalogue (Brands,Products) or already registered a lot of Orders, keep in mind that the request might not synchronise **all** of the elements you wanted.

With that in mind, when the sync all method is called, it will start by syncing the elements that do not have a date of synchronisation, meaning if you synchronize multiple times, it will try to sync all the objects that have not been synced, which eventually will be none.

