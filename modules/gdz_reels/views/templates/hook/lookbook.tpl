<div class="lookbook" id-lookbook="{$lookbook->id}">
    <h1>
        {l s='Look book' mod='gdz_reels'} <span class="count">{counter}</span>
        <div class="btn-group-action pull-right">
            <button class="btn btn-default delete-lookbook">
                <i class="icon-trash"></i>
                {l s='Delete lookbook' mod='gdz_reels'}
            </button>
        </div>
    </h1>
    <div class="products" id-lookbook="{$lookbook->id}">
        {if isset($lookbook->products) && $lookbook->products|count > 0}
            {foreach $lookbook->products as $product}
                {include file='./product.tpl'}
            {/foreach}
        {/if}
        <form class="add-product-form panel" action="{$link->getBaseLink()}modules/{$module_name}/ajax_gdz_reel.php">
            <input type="hidden" name="action" value="addProduct">
            <input type="hidden" name="id_lookbook" value="{$lookbook->id}">
            <input type="hidden" name="secure_key" value="{$secure_key}">
            <div class="row">
                <div class="col-lg-1">
                    <p class="name">
                        <i class="icon-plus"></i>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="name">
                        <select name="product" class="product-select">
                            {foreach $products as $product}
                            <option value="{$product.id_product}">{$product.name}</option>
                            {/foreach}
                        </select>
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-horizontal">
                        <label class="control-label col-lg-6">{l s='Duration' mod='gdz_reels'}</label>
                        <div class="col-lg-6">
                            <input class="duration" type="text" name="duration" value="1">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="btn-group-action pull-right">
                        <button class="btn btn-default add-product">
                            <i class="icon-plus"></i>
                            {l s='Add' mod='gdz_reels'}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>