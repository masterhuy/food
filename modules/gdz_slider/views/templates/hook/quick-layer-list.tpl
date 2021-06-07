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
<div id="quick-layer-selector">
    <div class="row">
        <span class="layer-list">
            <span id="quick-list" class="quick-list item"><i class="material-icons">list</i></span>
            <input id="quick-title" type="text" value="{l s='No Layer Selected' d='gdz_slider'}" class="item" disabled>
        </span>
        <div class="action">
            <span title="Edit" id="quick-edit" class="quick-edit"><i class="material-icons">mode_edit</i></span>
            <span title="Delete" id="quick-delete" class="quick-delete "><i class="material-icons">delete</i></span>
            <span title="Duplicate" id="quick-duplicate" class="quick-duplicate"><i class="icon-copy"></i></span>
            <span title="Show/Hide" id="quick-show" class="quick-show"><i class="material-icons">remove_red_eye</i></span>
        </div>
        <div class="confirm">
            <span id="quick-check"><i class="material-icons">check</i></span>
            <span id="quick-cancel"><i class="material-icons">close</i></span>
        </div>
    </div>
    <div class="layer-container">
        {foreach $currentSlide->layers as $layer}
        <div id="layer_{$layer->id}" class="layer row">
            <span class="layer-list">
                <span class="quick-list item"><i class="material-icons">{if $layer->data_type=='text'}assignment{elseif $layer->data_type=='image'}collections{else}video_librarys{/if}</i></span>
                <input class="quick-tittle item" type="text" value="{$layer->data_title}" disabled>
            </span>
            <span class="quick-edit"><i class="material-icons">mode_edit</i></span>
            <span class="quick-delete"><i class="material-icons">delete</i></span>
            <span class="quick-duplicate"><i class="icon-copy"></i></span>
            <span class="quick-show"><i class="material-icons {if !$layer->desktop->data_show}layer-hide{/if}">remove_red_eye</i></span>
        </div>
        {/foreach}
    </div>
    <div class="editor">
        <textarea id="text-editor"></textarea>
    </div>
</div>
