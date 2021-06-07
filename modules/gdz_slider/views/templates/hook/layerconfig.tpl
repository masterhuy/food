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
<div id="form_layer_{$layer->id}" class="form-layer panel-bodyclearfix" style="display:none">
    <input type="hidden" name="layer_ids[]" value="{$layer->id nofilter}" />
    <input type="hidden" name="data_type_{$layer->id}" value="{$layer->data_type}">
    <input type="hidden" name="data_show_{$layer->id}" value="{$layer->desktop->data_show}">
    <input type="hidden" name="data_mshow_{$layer->id}" value="{$layer->mobile->data_show}">
    <input type="hidden" name="data_m2show_{$layer->id}" value="{$layer->mobile2->data_show}">
    <input type="hidden" name="data_tshow_{$layer->id}" value="{$layer->tablet->data_show}">
    <div class="area-displgontay form-horizontal">
        <div class="layerconfig layer-col">
            <div class="inner">
                <div class="tab">
                    <button type="button" class="tablinks defaultOpen" onclick="openCity(this, 'tab_setting_{$layer->id}')">{l s='Layer Setting' d='gdz_slider'}</button>
                    <button type="button" class="tablinks tab-desktop" onclick="openCity(this, 'tab_style_{$layer->id}')">{l s='Style' d='gdz_slider'}</button>
                    <button type="button" class="tablinks tab-desktop" onclick="openCity(this, 'tab_position_{$layer->id}')">{l s='Position' d='gdz_slider'}</button>
                    <button type="button" class="tablinks" onclick="openCity(this, 'tab_animation_{$layer->id}')">{l s='Animation' d='gdz_slider'}</button>
                    {if $layer->data_type == 'video'}
                    <button type="button" class="tablinks video-settings" onclick="openCity(this, 'tab_video_set_{$layer->id}')">{l s='Video Setting' d='gdz_slider'}</button>
                    {/if}
                    <button type="button" class="tablinks tab-mobile" onclick="openCity(this, 'tab_style_mobile_{$layer->id}')">{l s='Style Mobile (< 480)' d='gdz_slider'}</button>
                    <button type="button" class="tablinks tab-mobile2" onclick="openCity(this, 'tab_style_mobile2_{$layer->id}')">{l s='Style Mobile (< 768)' d='gdz_slider'}</button>
                    <button type="button" class="tablinks tab-tablet" onclick="openCity(this, 'tab_style_tablet_{$layer->id}')">{l s='Style Tablet (< 1200)' d='gdz_slider'}</button>
                </div>
                <div id="tab_setting_{$layer->id}" class="tabcontent">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-3">
                                <span title="" data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="Title of slide not show front end">{l s='Title' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text"  name="data_title_{$layer->id nofilter}" value="{$layer->data_title nofilter}">
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-3">{l s='Class suffix' mod='gdz_slider'}</label>
                            <div class="col-lg-9">
                                <input type="text" name="data_class_suffix_{$layer->id nofilter}" value="{$layer->data_class_suffix nofilter}">
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-3">{l s='Layer fixed' mod='gdz_slider'}</label>
                            <div class="col-lg-4">
                                <span class="switch prestashop-switch fixed-width-lg">
                                    <input type="radio" {if $layer->data_fixed == '1'}checked="checked"{/if} value="1" id="data_fixed_{$layer->id nofilter}_on" name="data_fixed_{$layer->id nofilter}">
                                    <label for="data_fixed_{$layer->id nofilter}_on">Yes</label>
                                    <input type="radio" {if $layer->data_fixed == '0'}checked="checked"{/if} value="0" id="data_fixed_{$layer->id nofilter}_off" name="data_fixed_{$layer->id nofilter}">
                                    <label for="data_fixed_{$layer->id nofilter}_off">No</label>
                                    <a class="slide-button btn"></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display:none">
                        <div class="form-group col-lg-9">
                            <label class="control-label col-lg-1">{l s='Text' mod='gdz_slider'}</label>
                            <div class="col-lg-9">
                                <textarea name="data_html_{$layer->id nofilter}" id="data_html_{$layer->id nofilter}" class="data-html" cols="70" rows="2">{$layer->data_html nofilter}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab_style_{$layer->id}" class="tabcontent">
                    <div class="row" style="display:flex">
                        <div class="form-group col-lg-2">
                            <span data-original-title="Color" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">colorize</i></span>
                            <div class="col-lg-8">
                                <input type="color"  class="data-color btn color mColorPickerInput" name="data_color_{$layer->id nofilter}" id="data_color_{$layer->id nofilter}" value="{$layer->data_color nofilter}" style="background-color: {$layer->data_color nofilter};">
                            </div>
                        </div>
                        <div class="form-group col-lg-2" style="flex:1">
                            <span data-original-title="Font size" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_size</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_font_size_{$layer->id nofilter}" name="data_font_size_{$layer->id nofilter}" value="{$layer->desktop->data_font_size nofilter}" class="data-font-size">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-2" style="flex:1">
                            <span data-original-title="Line height" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_line_spacing</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_line_height_{$layer->id nofilter}" name="data_line_height_{$layer->id nofilter}" value="{$layer->desktop->data_line_height nofilter}" class="data-line-height">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-2" style="flex:1">
                            <span data-original-title="Font Style" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">line_weight</i></span>
                            <div class="col-lg-8">
                                <select   class="data-style" name="data_style_{$layer->id nofilter}" id="data_style_{$layer->id nofilter}">
                                    <option {if $layer->desktop->data_style=='normal'}selected{/if} value="normal">Normal</option>
                                    <option {if $layer->desktop->data_style=='italic'}selected{/if} value="italic">Italic</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-2" style="flex:1">
                            <span data-original-title="Font weight" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_size</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_font_weight_{$layer->id nofilter}" name="data_font_weight_{$layer->id nofilter}" value="{$layer->desktop->data_font_weight nofilter}" class="data-font-weight">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab_position_{$layer->id}" class="tabcontent">
                    <div class="row">
                        <div class="form-group col-lg-3" style="display:none">
                            <span data-original-title="Typing 'full' to full width, 'half' to a half width and 'quarter' to a quarter width" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">settings_ethernet</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_width_{$layer->id nofilter}" class="data-width" name="data_width_{$layer->id nofilter}" value="{$layer->desktop->data_width nofilter}"
                                    title="Typing 'full' to full width, 'half' to a half width and 'quarter' to a quarter width ">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3" style="display:none">
                            <span data-original-title="Typing 'full' to full height, 'half' to a half height and 'quarter' to a quarter height" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons rotate90">settings_ethernet</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_height_{$layer->id nofilter}" class="data-height" name="data_height_{$layer->id nofilter}" value="{$layer->desktop->data_height nofilter}" title="Typing 'full' to full height, 'half' to a half height and 'quarter' to a quarter height">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Typing 'center' to center" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Data X' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_x_{$layer->id nofilter}" class="data-x" name="data_x_{$layer->id nofilter}" value="{$layer->desktop->data_x nofilter}" title="Typing 'center' to center">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Typing 'center' to center" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Data Y' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_y_{$layer->id nofilter}" class="data-y" name="data_y_{$layer->id nofilter}" value="{$layer->desktop->data_y nofilter}" title="Typing 'center' to center">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab_animation_{$layer->id}" class="tabcontent">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <span data-original-title="Start moving in" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">schedule</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                <input type="text" id="data_delay" value="{$layer->data_delay nofilter}" name="data_delay_{$layer->id nofilter}">
                                    <span class="input-group-addon">ms</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Stop moving in" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">hourglass_empty</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                <input type="text" id="data_time" value="{$layer->data_time nofilter}" name="data_time_{$layer->id nofilter}">
                                    <span class="input-group-addon">ms</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Transition in" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">directions_walk</i></span>
                            <div class="col-lg-8">
                                <select name="data_in_{$layer->id nofilter}" id="data_in">
                                    {foreach from=$transitions item=trans}
                                        <option {if $layer->data_in==$trans.id}selected{/if} value="{$trans.id nofilter}">{$trans.name nofilter}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                           <span data-original-title="Transition out" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons flip">directions_walk</i></span>
                            <div class="col-lg-8">
                                <select name="data_out_{$layer->id nofilter}" id="data_out">
                                    {foreach from=$transitions item=trans}
                                        <option {if $layer->data_out==$trans.id}selected{/if} value="{$trans.id nofilter}">
                                            {$trans.name nofilter}
                                        </option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <span data-original-title="Ease in" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons flip">navigate_before</i></span>
                            <div class="col-lg-8">
                                <select name="data_ease_in_{$layer->id nofilter}" id="data_ease_in">
                                    {foreach from=$eases item=ease}
                                        <option {if $layer->data_ease_in==$ease.id}selected{/if} value="{$ease.id nofilter}">{$ease.name nofilter}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Ease out" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons flip">navigate_next</i></span>
                            <div class="col-lg-8">
                                <select name="data_ease_out_{$layer->id nofilter}" id="data_ease_out">
                                    {foreach from=$eases item=ease}
                                        <option {if $layer->data_ease_out==$ease.id}selected{/if} value="{$ease.id nofilter}">{$ease.name nofilter}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Transform in" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">transform</i></span>
                            <div class="col-lg-8">
                                <select name="data_transform_in_{$layer->id nofilter}" data-id="data_transform_in">
                                    {foreach from=$transforms item=transform}
                                        <option {if $layer->data_transform_in==$transform.id}selected{/if} value="{$transform.id nofilter}">{$transform.id nofilter}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Transform out" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons flip">transform</i></span>
                            <div class="col-lg-8">
                                <select name="data_transform_out_{$layer->id nofilter}" data-id="data_transform_out">
                                    {foreach from=$transforms item=transform}
                                        <option {if $layer->data_transform_out==$transform.id}selected{/if} value="{$transform.id nofilter}">{$transform.id nofilter}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {if $layer->data_type == 'video'}
                <div id="tab_video_set_{$layer->id}" class="tabcontent">
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Video Url" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Video Url' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-10">
                                <textarea name="data_video_{$layer->id nofilter}" id="data_video_{$layer->id nofilter}" class="data-video" cols="30" rows="3">{$layer->data_video nofilter}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                        <label class="control-label col-lg-2">{l s='Autoplay' mod='gdz_slider'}</label>
                            <span class="switch prestashop-switch col-lg-3">
                                <input type="radio" {if $layer->data_video_autoplay==1}checked="checked"{/if} value="1" id="data_video_autoplay_{$layer->id nofilter}_on" name="data_video_autoplay_{$layer->id nofilter}">
                                <label for="data_video_autoplay_{$layer->id nofilter}_on">Yes</label>
                                <input type="radio" {if $layer->data_video_autoplay==0}checked="checked"{/if} value="0" id="data_video_autoplay_{$layer->id nofilter}_off" name="data_video_autoplay_{$layer->id nofilter}">
                                <label for="data_video_autoplay_{$layer->id nofilter}_off">No</label>
                                <a class="slide-button btn"></a>
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <label class="control-label col-lg-2">{l s='Controls' mod='gdz_slider'}</label>
                            <span class="switch prestashop-switch col-lg-3">
                                <input type="radio" {if $layer->data_video_controls==1}checked="checked"{/if} value="1" id="data_video_controls_{$layer->id nofilter}_on" name="data_video_controls_{$layer->id nofilter}">
                                <label for="data_video_controls_{$layer->id nofilter}_on">Yes</label>
                                <input type="radio" {if $layer->data_video_controls==0}checked="checked"{/if} value="0" id="data_video_controls_{$layer->id nofilter}_off" name="data_video_controls_{$layer->id nofilter}">
                                <label for="data_video_controls_{$layer->id nofilter}_off">No</label>
                                <a class="slide-button btn"></a>
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <label class="control-label col-lg-2">{l s='Loop' mod='gdz_slider'}</label>
                            <span class="switch prestashop-switch col-lg-3">
                                <input type="radio" {if $layer->data_video_loop==1}checked="checked"{/if} value="1" id="data_video_loop_{$layer->id nofilter}_on" name="data_video_loop_{$layer->id nofilter}">
                                <label for="data_video_loop_{$layer->id nofilter}_on">Yes</label>
                                <input type="radio" {if $layer->data_video_loop==0}checked="checked"{/if} value="0" id="data_video_loop_{$layer->id nofilter}_off" name="data_video_loop_{$layer->id nofilter}">
                                <label for="data_video_loop_{$layer->id nofilter}_off">No</label>
                                <a class="slide-button btn"></a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="checkbox" {if $layer->data_video_bg==1}checked{/if} value="1" id="data_video_bg_{$layer->id nofilter}" class="data_video_bg" name="data_video_bg_{$layer->id nofilter}">
                            <label for="data_video_bg_{$layer->id nofilter}">{l s='Set this video for slide background' mod='gdz_slider'}</label>
                        </div>
                    </div>
                </div>
                {/if}
                <div id="tab_style_mobile_{$layer->id}" class="tabcontent">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font size" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_size</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" name="data_mfont_size_{$layer->id}" value="{$layer->mobile->data_font_size}" class="data-font-size">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Line height" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_line_spacing</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" name="data_mline_height_{$layer->id}" value="{$layer->mobile->data_line_height}" class="data-line-height">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font Style" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">line_weight</i></span>
                            <div class="col-lg-8">
                                <select id="data_mstyle_{$layer->id}" class="data-style" name="data_mstyle_{$layer->id}">
                                    <option {if $layer->mobile->data_style=='normal'}selected{/if} value="normal">Normal</option>
                                    <option {if $layer->mobile->data_style=='italic'}selected{/if} value="italic">Italic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Typing 'center' to center" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Data X' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="data-x" name="data_mx_{$layer->id}" value="{$layer->mobile->data_x}" title="Typing 'center' to center">
                                    <span class="input-group-addon">pixel</span>
                                    <input type="hidden" id="data_width_{$layer->id nofilter}" class="data-width" name="data_mwidth_{$layer->id nofilter}" value="{$layer->mobile->data_width nofilter}">
                                    <input type="hidden" id="data_height_{$layer->id nofilter}" class="data-height" name="data_mheight_{$layer->id nofilter}" value="{$layer->mobile->data_height nofilter}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Typing 'center' to center" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Data Y' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="data-y" name="data_my_{$layer->id}" value="{$layer->mobile->data_y}" title="Typing 'center' to center">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font weight" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_size</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_mfont_weight_{$layer->id nofilter}" name="data_mfont_weight_{$layer->id nofilter}" value="{$layer->mobile->data_font_weight nofilter}" class="data-font-weight">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab_style_mobile2_{$layer->id}" class="tabcontent">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font size" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_size</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" name="data_m2font_size_{$layer->id}" value="{$layer->mobile2->data_font_size}" class="data-font-size">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Line height" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_line_spacing</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" name="data_m2line_height_{$layer->id}" value="{$layer->mobile2->data_line_height}" class="data-line-height">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font Style" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">line_weight</i></span>
                            <div class="col-lg-8">
                                <select id="data_m2style_{$layer->id}" class="data-style" name="data_m2style_{$layer->id}">
                                    <option {if $layer->mobile2->data_style=='normal'}selected{/if} value="normal">Normal</option>
                                    <option {if $layer->mobile2->data_style=='italic'}selected{/if} value="italic">Italic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Typing 'center' to center" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Data X' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="data-x" name="data_m2x_{$layer->id}" value="{$layer->mobile2->data_x}" title="Typing 'center' to center">
                                    <span class="input-group-addon">pixel</span>
                                    <input type="hidden" id="data_width_{$layer->id nofilter}" class="data-width" name="data_m2width_{$layer->id nofilter}" value="{$layer->mobile2->data_width nofilter}">
                                    <input type="hidden" id="data_height_{$layer->id nofilter}" class="data-height" name="data_m2height_{$layer->id nofilter}" value="{$layer->mobile2->data_height nofilter}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Typing 'center' to center" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Data Y' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="data-y" name="data_m2y_{$layer->id}" value="{$layer->mobile2->data_y}" title="Typing 'center' to center">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font weight" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_size</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_m2font_weight_{$layer->id nofilter}" name="data_m2font_weight_{$layer->id nofilter}" value="{$layer->mobile2->data_font_weight nofilter}" class="data-font-weight">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab_style_tablet_{$layer->id}" class="tabcontent">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font size" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_size</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" name="data_tfont_size_{$layer->id}" value="{$layer->tablet->data_font_size}" class="data-font-size">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Line height" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_line_spacing</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" name="data_tline_height_{$layer->id}" value="{$layer->tablet->data_line_height}" class="data-line-height">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font Style" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">line_weight</i></span>
                            <div class="col-lg-8">
                                <select id="data_tstyle_{$layer->id}" class="data-style" name="data_tstyle_{$layer->id}">
                                    <option {if $layer->tablet->data_style=='normal'}selected{/if} value="normal">Normal</option>
                                    <option {if $layer->tablet->data_style=='italic'}selected{/if} value="italic">Italic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Typing 'center' to center" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Data X' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="data-x" name="data_tx_{$layer->id}" value="{$layer->tablet->data_x}" title="Typing 'center' to center">
                                    <span class="input-group-addon">pixel</span>
                                    <input type="hidden" id="data_width_{$layer->id nofilter}" class="data-width" name="data_twidth_{$layer->id nofilter}" value="{$layer->tablet->data_width nofilter}">
                                    <input type="hidden" id="data_height_{$layer->id nofilter}" class="data-height" name="data_theight_{$layer->id nofilter}" value="{$layer->tablet->data_height nofilter}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label class="control-label col-lg-2">
                            <span data-original-title="Typing 'center' to center" class="label-tooltip" data-toggle="tooltip" data-html="true" title="">{l s='Data Y' mod='gdz_slider'}</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="data-y" name="data_ty_{$layer->id}" value="{$layer->tablet->data_y}" title="Typing 'center' to center">
                                    <span class="input-group-addon">pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <span data-original-title="Font weight" class="label-tooltip" data-toggle="tooltip" data-html="true" ><i class="material-icons">format_size</i></span>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" id="data_tfont_weight_{$layer->id nofilter}" name="data_tfont_weight_{$layer->id nofilter}" value="{$layer->tablet->data_font_weight nofilter}" class="data-font-weight">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>