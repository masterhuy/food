<div id-product="{$product->id}" class="product panel">
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-md-4">
            <p class="name">
                #{$product->id} - {$product->name[$id_lang]}
            </p>
        </div>
        <div class="col-md-4">
            <div class="form-group form-horizontal">
                <label class="control-label col-lg-6">{l s='Duration' mod='gdz_reels'}</label>
                <div class="col-lg-6 flex">
                    <input class="duration" type="text" name="duration" value="{$product->duration}">
                    <button class="update-product btn btn-default">{l s='Update' mod='gdz_reels'}</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="btn-group-action pull-right">
                <button class="btn btn-default delete-product" id-product="{$product->id}">
                    <i class="icon-trash"></i>
                    {l s='Delete' mod='gdz_reels'}
                </button>
            </div>
        </div>
    </div>
</div>