<div id="srb-header">
    <div class="header row">
        <div class="col-md-4">
            <a href="{$shoprunbackURL}" target="_blank"><img src="../modules/shoprunback/assets/img/logo.png" /></a>
        </div>

        <div class="col-md-5 col-md-offset-2 link-to-srb text-right">
            {l s="header.go_to" mod='shoprunback'} <a href="{$shoprunbackURL}" class="srb-button" target="_blank">{l s="header.my_dashboard" mod='shoprunback'}</a>
        </div>
    </div>

    <div class="navigation">
        <ul class="nav nav-pills nav-justified">
            <li class="{if $itemType eq 'return'}active{/if}">
                <a href="{$srbManager}&itemType=return">{l s='return.my_returns' mod='shoprunback'}</a>
            </li>
            <li class="{if $itemType eq 'brand'}active{/if}">
                <a href="{$srbManager}&itemType=brand">{l s='brand.my_brands' mod='shoprunback'}</a>
            </li>
            <li class="{if $itemType eq 'product'}active{/if}">
                <a href="{$srbManager}&itemType=product">{l s="product.my_products" mod='shoprunback'}</a>
            </li>
            <li class="{if $itemType eq 'order'}active{/if}">
                <a href="{$srbManager}&itemType=order">{l s="order.my_orders" mod='shoprunback'}</a>
            </li>
            <li class="{if $itemType eq 'config'}active{/if}">
                <a href="{$srbManager}&itemType=config">{l s="config" mod='shoprunback'}</a>
            </li>
        </ul>
    </div>
</div>
