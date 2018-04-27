<div class="display row">
    <div class="col-md-10 col-md-offset-1">
        <div class="banner">
            <div class="top row">
                <div class="title col-sm-8">
                    <h1>{l s="return.my_returns" mod='shoprunback'}</h1>
                </div>

                <div class="external-link col-sm-4">
                    <a href="{$shoprunbackURL}/shipbacks" target="_blank" class="srb-button external-link">{l s="title.link_to_returns" mod='shoprunback'}</a>
                </div>
            </div>

            <div class="row">
                <p class="col-sm-12">{l s="return.description" mod='shoprunback'}</p>
            </div>
        </div>

        <div id="item-list">
            <table class="table">
                <thead>
                    <tr>
                        <th>{l s="return.returns" mod='shoprunback'}</th>
                        <th>
                            {l s="return.customer" mod='shoprunback'}
                            <form action="{$actionUrl}" method="POST">
                                <input type="text" name="customer" placeholder="{l s='form.placeholder' mod='shoprunback'}" value="{$searchCustomer}" autocomplete="off" />
                                <a href="{$srbManager}&itemType={$itemType}" class="btn btn-default">{l s='form.clear' mod='shoprunback'}</a>
                            </form>
                        </th>
                        <th>
                            {l s='order.id' mod='shoprunback'}
                            <form action="{$actionUrl}" method="POST">
                                <input type="text" min="0" name="orderReference" placeholder="{l s='form.placeholder' mod='shoprunback'}" value="{$searchOrderReference}" autocomplete="off" />
                                <a href="{$srbManager}&itemType={$itemType}" class="btn btn-default">{l s='form.clear' mod='shoprunback'}</a>
                            </form>
                        </th>
                        <th>{l s='return.state' mod='shoprunback'}</th>
                        <th>{l s='return.created_at' mod='shoprunback'}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {if count($items) > 0}
                        {foreach from=$items key=id item=item}
                            <tr data-id="{$item->getReference()}">
                                <td><a href="{$externalLink}{$item->getReference()}" target="_blank"><b>{$item->getName()}</b></a></td>
                                <td>{$item->order->customer->first_name} {$item->order->customer->last_name}</td>
                                <td>{$item->order_id}</td>
                                <td>
                                    <a href="{$externalLink}{$item->getReference()}" target="blank">
                                        <span class="badge badge-default {$item->state}">{$item->state|capitalize}</span>
                                    </a>
                                </td>
                                <td>{$item->created_at}</td>
                                <td><a href="{$externalLink}{$item->getReference()}" target="_blank"><i class="fa fa-external-link-square fa-lg" aria-hidden="true"></i></a></td>
                            </tr>
                        {/foreach}
                    {else}
                        <tr>
                            <td colspan="6">{l s="search.no_result" mod='shoprunback'}</td>
                        </tr>
                    {/if}
                </tbody>
            </table>
        </div>
    </div>
</div>
