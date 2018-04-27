<div id="srb-content">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    {include file='./header.tpl'}

    {if $message}
        <div class="alert alert-{$messageType}">
            {if $message == AdminShoprunbackController::SUCCESS_CONFIG}
                {l s="sucess.config" mod='shoprunback'}
            {elseif $message == AdminShoprunbackController::ERROR_NO_TOKEN}
                {l s="error.no_token" mod='shoprunback'}
            {/if}
        </div>
    {/if}

    {include file="./$template.tpl"}
</div>
