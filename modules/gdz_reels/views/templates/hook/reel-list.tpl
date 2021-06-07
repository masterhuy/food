{**
* 2007-2020 PrestaShop
*
* Godzilla Reel
*
*  @author    Prestawork <joommasters@gmail.com>
*  @copyright 2007-2020 Prestawork
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.prestawork.com
*}
<input id="secure_key" type="hidden" name="secure_key" value="{$secure_key}">
<input id="ajax_url" type="hidden" name="secure_key" value="{$link->getBaseLink()}modules/{$module_name}/ajax_gdz_reel.php">
<div class="panel">
    <h3>
        <span>
            <i class="icon-list-ul"></i> {l s='Reel list' mod='gdz_reels'}
        </span>
        <span class="panel-heading-action">
            <a  href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_reels&page=reelForm" class="btn btn-default btn-success" id="addReel" title="{l s='Add Reel' mod='gdz_reels'}">
                <i class="icon-plus"></i>
            </a>
        </span>
    </h3>
    <div>
        <div>
            {if $list|@count gt 0}
            {foreach from=$list item=reel}
            <div id="reel_{$reel->id}" class="panel reel">
                <div class="row">
                    <div class="col-lg-1">
                        <span><i class="icon-arrows "></i></span>
                    </div>
                    <div class="col-md-2">
                        #{$reel->id} - {$reel->name}
                    </div>
                    <div class="col-md-9">
                        <div class="btn-group-action pull-right">
                            <a class="btn btn-default"
                                href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_reels&page=reelForm&id_reel={$reel->id nofilter}">
                                <i class="icon-edit"></i>
                                {l s='Edit' mod='gdz_reels'}
                            </a>
                            <a class="btn btn-default delete-reel" id-reel="{$reel->id}">
                                <i class="icon-trash"></i>
                                {l s='Delete' mod='gdz_reels'}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {/foreach}
            {else}
            {l s='There is no reel' mod='gdz_reels'}
            {/if}
        </div>
    </div>
</div>