<section class="box" id="order-detail">
    <h1>
        {if ! $shipback}
            {l s='front.order.detail.title' mod='shoprunback'}<br>

            {l s='front.order.detail.content' mod='shoprunback'} <a href="{$createReturnLink}">{l s='front.order.detail.link' mod='shoprunback'}</a>
        {else}
            <a href="{$shipback->public_url}" target="_blank">{l s='front.order.detail.returned' mod='shoprunback'}</a>
        {/if}
    </h1>
</section>
