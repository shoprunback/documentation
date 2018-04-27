<div id="config" class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="{$formActionUrl}" method="POST">
            <h2>{l s="config.form.title" mod='shoprunback'}</h2>

            {if $srbtoken != ''}
                <div class="alert alert-warning">
                    <p>{l s="config.form.reset_mapping" mod='shoprunback'}</p>
                </div>
            {/if}

            <div class="form-group">
                <label for="srbtoken">{l s="config.form.token" mod='shoprunback'}</label>
                <input type="text" name="srbtoken" value="{$srbtoken}" class="form-control" required />
            </div>

            {if $PSOrderReturn == 1}
                <div class="alert alert-warning">
                    <p>{l s="config.form.disable_ps_returns" mod='shoprunback'}</p>
                </div>
            {/if}

            <div class="form-group">
                <label for="production">{l s="config.form.production" mod='shoprunback'}</label>

                <div class="radio">
                    <label>
                        {l s="config.form.yes" mod='shoprunback'}
                        <input type="radio" name="production" value="1" required {if $production == 1}checked="checked"{/if}>
                    </label>
                </div>

                <div class="radio">
                    <label>
                        {l s="config.form.no" mod='shoprunback'}
                        <input type="radio" name="production" value="0" required {if $production == 0}checked="checked"{/if}>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-default pull-right" type="submit">{l s="config.form.save" mod='shoprunback'}</button>
            </div>
        </form>

        {if ! $srbtoken}
            <div class="link-to-srb row">
                <div class="col-12 no-account">
                    <a href="{$shoprunbackURLProd}" class="srb-button pull-center" target="_blank">{l s="config.no_account" mod='shoprunback'}</a>
                </div>
            </div>
        {/if}
    </div>
</div>
