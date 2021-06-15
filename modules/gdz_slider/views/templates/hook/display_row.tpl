{**
* 2007-2020 PrestaShop
*
* Godzilla Slider
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*}
{assign var=positions value=json_decode($display.position, true)}
<div class="panel display" id="display_{$display.id_slider}">
    <div class="row">
        <div class="col-lg-1">
            #{$display.id_slider}
        </div>
        <div class="col-md-5" id="slider_title_{$display.id_slider}">
             {$display.title}
        </div>
        <div class="col-md-5">
            <ul id="list_hook_{$display.id_slider}" data-slider="{$display.id_slider}">
             {foreach from=$positions item=hook}
                    <li data-hook="{$hook.id_hook}"><span>{$hook.name}</span><i class="icon-remove deleteHook"></i></li>
            {/foreach}
            </ul>

            <select data-placeholder="{l s='Select Hooks' d='gdz_slider'}" multiple class="chosen-select" name="select-slider" id="select_{$display.id_slider}">
                {foreach $hooks as $hook}
                    {if !in_array($hook, $positions)}
                    <option value="{$hook.id_hook}" >{$hook.name}</option>
                    {/if}
                {/foreach}
            </select>
            <a class="btn btn-default add-hook" data-slider="{$display.id_slider}">
                <i class="icon-plus"></i>
                Add
            </a>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-default deleteDisplay" data-slider="{$display.id_slider}">
                Delete
            </a>
        </div>

    </div>
</div>