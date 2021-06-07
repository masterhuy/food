<input id="secure_key" type="hidden" name="secure_key" value="{$secure_key}">
<input id="ajax_url" type="hidden" name="secure_key" value="{$link->getBaseLink()}modules/{$module_name}/ajax_gdz_reel.php">
<input id="id_reel" type="hidden" name="id_reel" value="{$reel->id}">
<input id="count" type="hidden" name="count" value="{$reel->lookbooks|count}">
<div class="panel">
    <div class="panel-heading">
        {l s='Look book' mod='gdz_reels'}
    </div>
    <div class="form-wrapper" id="lookbooks">
        {foreach $reel->lookbooks as $lookbook}
            {include file='./lookbook.tpl'}
        {/foreach}
    </div>
    <div class="panel-footer">
        <button class="btn btn-default pull-right" id="add-lookbook">
            <i class="process-icon-plus"></i> {l s='Add' mod='gdz_reels'}
        </button>
    </div>
</div>