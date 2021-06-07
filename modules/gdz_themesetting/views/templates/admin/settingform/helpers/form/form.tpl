{*
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{extends file="helpers/form/form.tpl"}

{block name="defaultForm"}
    <div class="settingForm">
        <div class="panel-tabs">
            <ul id="gdz-setting-tabs" class="gdz-setting-tabs" role="tablist">
                {foreach $fields as $f => $fieldset}
                    {if !isset($fieldset.form.child)}
                        <li class="tab{if $fieldset@first} active{/if} {if isset($fieldset.form.childForms)} haschild{/if}">
                            <a href="#{$fieldset.form.legend.id}" role="tab" {if !isset($fieldset.form.childForms)}data-toggle="tab"{/if}>
                                {if isset($fieldset.form.legend.heading_icon)}
                                <i class="material-icons ps-heading-icon">{$fieldset.form.legend.heading_icon}</i>
                                {/if}
                                <span>{$fieldset.form.legend.title}</span>
                                {if isset($fieldset.form.childForms)}<i class="material-icons ps-togglable-row">keyboard_arrow_down</i>{/if}
                            </a>
                            {if isset($fieldset.form.childForms)}
                                <ul>
                                    {foreach  key=key item=item from=$fieldset.form.childForms}
                                        <li class="tab tab-child"><a href="#{$key}" role="tab" data-toggle="tab">{$item}</a></li>
                                    {/foreach}
                                </ul>
                            {/if}

                        </li>
                    {/if}
                {/foreach}
            </ul>
        </div>
        <div class="tab-content gdz-setting-panels">
            {$smarty.block.parent}
        </div>
        <input type="hidden" value="{$base_url|escape:'html':'UTF-8'}" id="gdz-base-url"/>
        <input type="hidden" value="{$root_url|escape:'html':'UTF-8'}" id="gdz-root-url"/>
    </div>
{/block}


{block name="legend"}
    {$smarty.block.parent}
{/block}

{block name="footer"}
    <!--{$smarty.block.parent}-->
{/block}


{block name="fieldset"}
    <div role="tabpanel" class="tab-panel {if $fieldset.form.legend.id == 'gdz-general-layout'}active{/if}"
         id="{$fieldset.form.legend.id}">
        {$smarty.block.parent}
    </div>
{/block}

{block name="input_row"}
    {if isset($input.group_start)}<div class="group-fields clearfix"><div class="col-lg-3"></div><div class="col-lg-9">{/if}
    <div class="{if isset($input.condition)}condition-setting hide-setting{/if}" {if isset($input.condition)}data-condition='{$input.condition|@json_encode nofilter}'{/if}>
    {if $input.type == 'title_separator'}
        {if isset($input.border_top)}
            <hr>
        {/if}
        {if isset($input.label)}
            <div class="col-lg-12 title-reparator"><div class="col-lg-offset-3">{$input.label}</div></div>{/if}
    {elseif $input.type == 'info_text'}
    {if isset($input.desc)}<p class="alert alert-info col-lg-offset-3">{$input.desc}</p>{/if}
    {elseif $input.type == 'subtitle_separator'}
        {if isset($input.border_top)}
            <hr>
        {/if}
        <label class="control-label col-lg-3"></label>
        <div class="col-lg-9 subtitle-reparator">{$input.label} </div>
    {else}
        {$smarty.block.parent}
    {/if}
    </div>
    {if isset($input.group_end)}</div></div>{/if}
{/block}

{block name="label"}

    {$smarty.block.parent}
{/block}



{block name="input"}
    {if $input.type == 'switch-label'}
        <div class="col-lg-9">
            <span class="switch switch-label prestashop-switch fixed-width-{$input.width}">
              {foreach $input.values as $value}
              <input type="radio" name="{$input.name}"{if $value.value == 1} id="{$input.name}_on"{else} id="{$input.name}_off"{/if}{if isset($input.class) && $input.class} class="{$input.class}"{/if} value="{$value.value}"{if $fields_value[$input.name] == $value.value} checked="checked"{/if}{if (isset($input.disabled) && $input.disabled) or (isset($value.disabled) && $value.disabled)} disabled="disabled"{/if}/>
              {strip}
              <label {if $value.value == 1} for="{$input.name}_on"{else} for="{$input.name}_off"{/if}>
                {if $value.value == 1}
                  {$value.label}
                {else}
                  {$value.label}
                {/if}
              </label>
              {/strip}
              {/foreach}
              <a class="slide-button btn"></a>
            </span>
        </div>
    {elseif $input.type == 'import'}
        <div class="alert alert-info">{l s='Upload your setting to save time' mod='gdz_themesetting'}  </div>
        <div style="display:inline-block;"><input type="file" id="settingFile" name="settingFile"/></div>
        <button type="submit" class="btn btn-default btn-lg" id="importSetting" name="importSetting" value="1"><span class="icon icon-upload"></span> {l s='Import' mod='gdz_themesetting'}</button>

    {elseif $input.type == 'export'}
        <div class="alert alert-info">{l s='Download currently setting to backup setting.' mod='gdz_themesetting'}  </div>
        <a class="btn btn-default btn-lg"
               href="{$current_link|escape:'html':'UTF-8'}&ajax=1&action=exportSetting"><span
                        class="icon icon-share"></span> {l s='Export to file' mod='gdz_themesetting'} </a>
    {elseif $input.type == 'icon-select'}
        <div class="image-select image-select-horizonal icon-image-select">
            {foreach $input.options.query AS $option }
                <input id="{$input.name|escape:'html':'utf-8'}-{$option.id_option}" type="radio"
                       name="{$input.name|escape:'html':'utf-8'}"
                       value="{$option.id_option}" {if $fields_value[$input.name] == ''}{if $option@index eq 0} checked{/if}{/if} {if $option.id_option == $fields_value[$input.name]}checked{/if} />
                <div class="image-option">
                    <i class="{$option.id_option}"></i>
                    <span class="image-option-title">{$option.name}</span>
                </div>
            {/foreach}
        </div>
    {elseif $input.type == 'googlefont'}
        {assign var='fonts_selected' value=$fields_value[$input.name]}
        {assign var=fonts_selected_arr value=$fonts_selected}
        <div class="g-fonts-selected-wrap selected-wrap">
            <div class="g-fonts-selected">
                <ul>
                  {foreach $fonts_selected_arr as $i => $font}
                  <li data-name="{$font.name}">
                    <div class="font-selected">
                        <span class="font-name selected-name" style="font-family:{$font.name}">{$font.name}</span>
                        <span class="font-styles">{','|implode:$font.weight}</span>
                    </div>
                    <span class="icon icon-close font-deleted"></span>
                  </li>
                  {/foreach}
                </ul>
            </div>
        </div>
        <div class="fonts-search cleafix">
            <input class="font-filter" name="jform-filter" id="font-filter" type="text" placeholder="Type font name here...">
        </div>
        {assign var='font_styles' value=null}
        {assign var='fonts' value=$input.fonts}
        <div class="g-fonts-container">
            <ul class="g-fonts">
                {foreach $fonts as $i => $font}
                    {assign var='font_styles' value=$font.styles}
                    <li data-page="{math equation="floor($i/100)"}" class="g-font-item" data-name="{$font.name}" data-styles="{','|implode:$font_styles}">
                      <div class="font-container" style="background-position: 0 calc(-40px * {$i mod 100});">
                      <span class="font-name">{$font.name}</span>
                      <span class="font-styles">{$font_styles|count} {l s="styles"}</span>
                    </li>
                {/foreach}
            </ul>
            <div class="font-weight-popup" style="position:absolute; display: none"></div>
        </div>
        <input type="hidden" value='{$fonts_selected|json_encode}' id="{$input.name}" class="google-fonts-json" name="{$input.name}"/>
    {elseif $input.type == 'fontcssurl'}
        {assign var='css_url' value=$fields_value[$input.name]}
        {assign var='css_url_arr' value=$css_url|json_decode}
        <div class="custom-css-selected-wrap selected-wrap">
            <div class="custom-css-selected">
                <ul>
                  {foreach $css_url_arr as $i => $url}
                  <li data-url="{$url}">
                    <div class="font-css-selected">
                        <span class="css-url selected-name">{$url}</span>
                    </div>
                    <span class="icon icon-close css-deleted"></span>
                  </li>
                  {/foreach}
                </ul>
            </div>
        </div>
        <textarea id="custom-css" class="font-input" name="custom-css" rows="3" data-value=""></textarea>
        <div class="fonts-actions">
            <span class="btn-action btn-primary" data-action="csss.save">Add Font Css URL</span>
        </div>
        <input type="hidden" value='{$css_url}' id="{$input.name}" class="custom-font-css" name="{$input.name}"/>
    {elseif $input.type == 'fontfileurl'}
        {assign var='file_url' value=$fields_value[$input.name]}
        {assign var='file_url_arr' value=$file_url|json_decode}
        <div class="custom-file-selected-wrap selected-wrap">
            <div class="custom-file-selected">
                <ul>
                  {foreach $file_url_arr as $i => $url}
                  <li data-url="{$url}">
                      <div class="font-file-selected">
                            <span class="file-url selected-name">{$url}</span>
                        </div>
                        <span class="icon icon-close file-deleted"></span>
                  </li>
                  {/foreach}
                </ul>
            </div>
        </div>
        <textarea id="custom-file" class="font-input" name="custom-file" rows="3" data-value=""></textarea>
        <div class="fonts-actions">
            <span class="btn-action btn-primary add-custom-file" data-action="files.save">Add Font File URL</span>
        </div>
        <input type="hidden" value='{$file_url}' id="{$input.name}" class="custom-file-url" name="{$input.name}"/>
    {elseif $input.type == 'background-img'}
        {assign var='bgimg_val' value=$fields_value[$input.name]}
        <div class="form-group">
            <div class="col-lg-10">
                <div class="row">
                    <div class="input-group">
                        <input type="text" value="{$bgimg_val.image|escape:'html':'UTF-8'}" id="{$input.name}"
                               class="form-control" name="{$input.name}"/>
                        <span class="input-group-addon"><a href="filemanager/dialog.php?type=1&field_id={$input.name}"
                                                           class="js-dialog-upload"
                                                           data-input-name="{$input.name}"
                                                           type="button">{l s='Select image' mod='gdz_themesetting'} <i
                                        class="icon-external-link"></i></a></span>
                    </div>

                </div>
            </div>
        </div>
        <div class="input-group{if isset($input.class)} {$input.class}{/if}">
            <div class="field-group">
                <div class="field-group-content">
                <select name="{$input.name}_size">
                    <option value="inherit" {if isset($bgimg_val.size) && $bgimg_val.size =='inherit'} selected="selected"{/if}>inherit</option>
                    <option value="auto" {if isset($bgimg_val.size) && $bgimg_val.size =='auto'} selected="selected"{/if}>auto</option>
                    <option value="length" {if isset($bgimg_val.size) && $bgimg_val.size =='length'} selected="selected"{/if}>length</option>
                    <option value="cover" {if isset($bgimg_val.size) && $bgimg_val.size =='cover'} selected="selected"{/if}>cover</option>
                    <option value="contain" {if isset($bgimg_val.size) && $bgimg_val.size =='contain'} selected="selected"{/if}>contain</option>
                </select>
                </div>
                <label>Size</label>
            </div>
            <div class="field-group">
                <div class="field-group-content">
                <select name="{$input.name}_position">
                    <option value="left top" {if isset($bgimg_val.position) && $bgimg_val.position =='left top'} selected="selected"{/if}>left top</option>
                    <option value="left center" {if isset($bgimg_val.position) && $bgimg_val.position =='left center'} selected="selected"{/if}>left center</option>
                    <option value="left bottom" {if isset($bgimg_val.position) && $bgimg_val.position =='left bottom'} selected="selected"{/if}>left bottom</option>
                    <option value="right top" {if isset($bgimg_val.position) && $bgimg_val.position =='right top'} selected="selected"{/if}>right top</option>
                    <option value="right center" {if isset($bgimg_val.position) && $bgimg_val.position =='right center'} selected="selected"{/if}>right center</option>
                    <option value="right bottom" {if isset($bgimg_val.position) && $bgimg_val.position =='right bottom'} selected="selected"{/if}>right bottom</option>
                    <option value="center top" {if isset($bgimg_val.position) && $bgimg_val.position =='center top'} selected="selected"{/if}>center top</option>
                    <option value="center center" {if isset($bgimg_val.position) && $bgimg_val.position =='center center'} selected="selected"{/if}>center center</option>
                    <option value="center bottom" {if isset($bgimg_val.position) && $bgimg_val.position =='center bottom'} selected="selected"{/if}>center bottom</option>
                </select>
                </div>
                <label>Position</label>
            </div>
            <div class="field-group">
                <div class="field-group-content">
                <select name="{$input.name}_repeat">
                    <option value="inherit" {if isset($bgimg_val.repeat) && $bgimg_val.repeat =='inherit'} selected="selected"{/if}>inherit</option>
                    <option value="no-repeat" {if isset($bgimg_val.repeat) && $bgimg_val.repeat =='no-repeat'} selected="selected"{/if}>no-repeat</option>
                    <option value="repeat" {if isset($bgimg_val.repeat) && $bgimg_val.repeat =='repeat'} selected="selected"{/if}>repeat</option>
                    <option value="repeat-x" {if isset($bgimg_val.repeat) && $bgimg_val.repeat =='repeat-x'} selected="selected"{/if}>repeat-x</option>
                    <option value="repeat-y" {if isset($bgimg_val.repeat) && $bgimg_val.repeat =='repeat-y'} selected="selected"{/if}>repeat-y</option>
                </select>
                </div>
                <label>Repeat</label>
            </div>
            <div class="field-group">
                <div class="field-group-content">
                <select name="{$input.name}_attachment">
                    <option value="inherit" {if isset($bgimg_val.attachment) && $bgimg_val.attachment =='inherit'} selected="selected"{/if}>inherit</option>
                    <option value="local" {if isset($bgimg_val.attachment) && $bgimg_val.attachment =='local'} selected="selected"{/if}>local</option>
                    <option value="fixed" {if isset($bgimg_val.attachment) && $bgimg_val.attachment =='fixed'} selected="selected"{/if}>fixed</option>
                    <option value="scroll" {if isset($bgimg_val.attachment) && $bgimg_val.attachment =='scroll'} selected="selected"{/if}>scroll</option>
                </select>
                </div>
                <label>Attachment</label>
            </div>
        </div>
    {elseif $input.type == 'text-group'}
      		<div class="input-field input-group row">
      				<input type="number" name="{$input.name}[]" {if isset($input['size'])} size="{$input['size']}"{/if} value="{if isset($fields_value[$input.name].0) && $fields_value[$input.name].0}{$fields_value[$input.name].0}{/if}" />
      				<input type="number" name="{$input.name}[]" {if isset($input['size'])} size="{$input['size']}"{/if} value="{if isset($fields_value[$input.name].1) && $fields_value[$input.name].1}{$fields_value[$input.name].1}{/if}" />
      				<input type="number" name="{$input.name}[]" {if isset($input['size'])} size="{$input['size']}"{/if} value="{if isset($fields_value[$input.name].2) && $fields_value[$input.name].2}{$fields_value[$input.name].2}{/if}" />
      				<input type="number" name="{$input.name}[]" {if isset($input['size'])} size="{$input['size']}"{/if} value="{if isset($fields_value[$input.name].3) && $fields_value[$input.name].3}{$fields_value[$input.name].3}{/if}" />
      				{if isset($input.suffix)}
      				<span class="input-group-addon">
      					{$input.suffix}
      				</span>
      				{/if}
      		</div>
      		<div class="input-label row">
            {if isset($input.fieldtype) && $input.fieldtype == 'border-radius'}
              <span>Top-Left</span>
              <span>Top-Right</span>
              <span>Bottom-Right</span>
              <span>Botton-Left</span>
            {else}
      				<span>Top</span>
      				<span>Right</span>
      				<span>Bottom</span>
      				<span>Left</span>
            {/if}
      		</div>
    {elseif $input.type == 'checkbox2'}
          {foreach $input.values.query as $value}
            {assign var=id_checkbox value=$input.name|cat:'_'|cat:$value[$input.values.id]}
            <div class="checkbox{if isset($input.expand) && strtolower($input.expand.default) == 'show'} hidden{/if}">
              {strip}
                <label for="{$id_checkbox}">
                  <input type="checkbox" name="{$input.name}[]" id="{$id_checkbox}" class="{if isset($input.class)}{$input.class}{/if}"{if isset($value.val)} value="{$value.val|escape:'html':'UTF-8'}"{/if}{if isset($fields_value[$input.name]) && $fields_value[$input.name] && $value.val|in_array:$fields_value[$input.name]}
 checked="checked"{/if} />
                  {$value[$input.values.name]}
                </label>
              {/strip}
            </div>
          {/foreach}
    {elseif $input.type == 'range'}
        <div class="form-group">
            <div class="col-lg-5">
                <div class="row">
                    <div class="input-group input-group-range">
                        <input type="range"
                               name="{$input.name}_s"
                               id="{$input.name}_s"
                               data-vinput="{$input.name}"
                               value="{$fields_value[$input.name]|escape:'html':'UTF-8'}"
                                {if isset($input.min)} min="{$input.min|intval}"{/if}
                                {if isset($input.step)} step="{$input.step|intval}"{/if}
                                {if isset($input.max)} max="{$input.max|intval}"{/if}
                               oninput="{$input.name}.value = {$input.name}_s.value"
                               class="js-scss-ignore js-range-slider range-slider"/>
                        <input type="number"
                               name="{$input.name}"
                               id="{$input.name}"
                               value="{$fields_value[$input.name]|escape:'html':'UTF-8'}"
                                {if isset($input.min)} min="{$input.min|intval}"{/if}
                                {if isset($input.step)} step="{$input.step|intval}"{/if}
                                {if isset($input.max)} max="{$input.max|intval}"{/if}
                               oninput="{$input.name}_s.value = {$input.name}.value"
                               class="form-control width-70 js-range-slider-val"/>
                    </div>

                </div>
            </div>
        </div>
    {elseif $input.type == 'number'}
        {assign var='value_text' value=$fields_value[$input.name]}
        {if isset($input.prefix) || isset($input.suffix)}
            <div class="input-group{if isset($input.class)} {$input.class}{/if}">
        {/if}
        {if isset($input.prefix)}
            <span class="input-group-addon">{$input.prefix}</span>
        {/if}
        <input type="number"
               name="{$input.name}"
               id="{if isset($input.id)}{$input.id}{else}{$input.name}{/if}"
               value="{if isset($input.string_format) && $input.string_format}{$value_text|string_format:$input.string_format|escape:'html':'UTF-8'}{else}{$value_text|escape:'html':'UTF-8'}{/if}"
               class="form-control {if isset($input.class)}{$input.class}{/if}"
                {if isset($input.size)} size="{$input.size}"{/if}
                {if isset($input.min)} min="{$input.min|floatval}"{/if}
                {if isset($input.max)} max="{$input.max|floatval}"{/if}
                {if isset($input.step)} step="{$input.step|floatval}"{/if}
                {if isset($input.maxchar) && $input.maxchar} data-maxchar="{$input.maxchar|intval}"{/if}
                {if isset($input.maxlength) && $input.maxlength} maxlength="{$input.maxlength|intval}"{/if}
                {if isset($input.readonly) && $input.readonly} readonly="readonly"{/if}
                {if isset($input.disabled) && $input.disabled} disabled="disabled"{/if}
                {if isset($input.autocomplete) && !$input.autocomplete} autocomplete="off"{/if}
                {if isset($input.required) && $input.required } required="required" {/if}
                {if isset($input.placeholder) && $input.placeholder } placeholder="{$input.placeholder}"{/if}
        />
        {if isset($input.suffix)}
            <span class="input-group-addon">{$input.suffix}</span>
        {/if}
        {if isset($input.prefix) || isset($input.suffix)}
            </div>
        {/if}
    {elseif $input.type == 'border'}
        {assign var='border_val' value=$fields_value[$input.name]}
        <div class="input-group{if isset($input.class)} {$input.class}{/if}">
            <div class="field-group">
                <div class="field-group-content">
                    <input type="number"
                   id="{if isset($input.id)}{$input.id}{else}{$input.name}{/if}_width"
                   value="{if isset($border_val.width)}{$border_val.width}{/if}"
                   data-name="width"
                   name="{$input.name}_width"
                   class="form-control border-width input-width-70"
                   step="1"
                    size="10"
                    />
                  {if isset($input.suffix)}
                      <span class="input-group-addon">{$input.suffix}</span>
                  {/if}
                </div>
                <label>Width</label>
            </div>
            <div class="field-group">
                <div class="field-group-content">
                <select class="border-style" name="{$input.name}_style">
                  <option value="" {if isset($border_val.style) && $border_val.style ==''} selected="selected"{/if}></option>
                    <option value="none" {if isset($border_val.style) && $border_val.style =='none'} selected="selected"{/if}>None</option>
                    <option value="solid" {if isset($border_val.style) && $border_val.style =='solid'} selected="selected"{/if}>Solid</option>
                    <option value="dotted" {if isset($border_val.style) && $border_val.style =='dotted'} selected="selected"{/if}>Dotted</option>
                    <option value="dashed" {if isset($border_val.style) && $border_val.style =='dashed'} selected="selected"{/if}>Dashed</option>
                </select>
                </div>
                <label>Style</label>
            </div>
            <div class="field-group">
                <div class="field-group-content">
    											<div class="input-group">
    												<input type="color"
    												data-hex="true"
    												{if isset($input.class)} class="border-color"
    												{else} class="color mColorPickerInput"{/if}
    												name="{$input.name}_color"
    												value="{$border_val.color|escape:'html':'UTF-8'}" />
    											</div>

                </div>
                <label>Color</label>
            </div>
        </div>
    {elseif $input.type == 'fontstyle'}
        {assign var='fontstyle_val' value=$fields_value[$input.name]}
        <div class="input-group{if isset($input.class)} {$input.class}{/if}">
            <div class="field-group">
                <div class="field-group-content">
                    <input type="number"
                   id="{if isset($input.id)}{$input.id}{else}{$input.name}{/if}_size"
                   value="{if isset($fontstyle_val.size)}{$fontstyle_val.size}{/if}"
                   data-name="size"
                   name="{$input.name}_size"
                   class="form-control input-width-70"
                   step="1"
                    size="10"
                    />
                  {if isset($input.suffix)}
                      <span class="input-group-addon">{$input.suffix}</span>
                  {/if}
                </div>
                <label>Size</label>
            </div>
            <div class="field-group">
                <div class="field-group-content">
                <select name="{$input.name}_weight">
                    <option value="" {if isset($fontstyle_val.weight) && $fontstyle_val.weight ==''} selected="selected"{/if}></option>
                    <option value="200" {if isset($fontstyle_val.weight) && $fontstyle_val.weight =='200'} selected="selected"{/if}>200</option>
                    <option value="300" {if isset($fontstyle_val.weight) && $fontstyle_val.weight =='300'} selected="selected"{/if}>300</option>
                    <option value="400" {if isset($fontstyle_val.weight) && $fontstyle_val.weight =='400'} selected="selected"{/if}>400</option>
                    <option value="500" {if isset($fontstyle_val.weight) && $fontstyle_val.weight =='500'} selected="selected"{/if}>500</option>
                    <option value="600" {if isset($fontstyle_val.weight) && $fontstyle_val.weight =='600'} selected="selected"{/if}>600</option>
                    <option value="700" {if isset($fontstyle_val.weight) && $fontstyle_val.weight =='700'} selected="selected"{/if}>700</option>
                    <option value="800" {if isset($fontstyle_val.weight) && $fontstyle_val.weight =='800'} selected="selected"{/if}>800</option>
                    <option value="900" {if isset($fontstyle_val.weight) && $fontstyle_val.weight =='900'} selected="selected"{/if}>900</option>
                </select>
                </div>
                <label>Weight</label>
            </div>
            <div class="field-group">
                <div class="field-group-content">
                <select name="{$input.name}_style">
                    <option value="normal" {if isset($fontstyle_val.style) && $fontstyle_val.style =='normal'} selected="selected"{/if}>Normal</option>
                    <option value="italic" {if isset($fontstyle_val.style) && $fontstyle_val.style =='italic'} selected="selected"{/if}>Italic</option>
                    <option value="oblique" {if isset($fontstyle_val.style) && $fontstyle_val.style =='oblique'} selected="selected"{/if}>Oblique</option>
                </select>
                </div>
                <label>Style</label>
            </div>
            <div class="field-group">
                <div class="field-group-content">
                <select name="{$input.name}_transform">
                    <option value="capitalize" {if isset($fontstyle_val.style) && $fontstyle_val.transform =='capitalize'} selected="selected"{/if}>Capitalize</option>
                    <option value="uppercase" {if isset($fontstyle_val.style) && $fontstyle_val.transform =='uppercase'} selected="selected"{/if}>Uppercase</option>
                    <option value="lowercase" {if isset($fontstyle_val.style) && $fontstyle_val.transform =='lowercase'} selected="selected"{/if}>Lowercase</option>
                </select>
                </div>
                <label>Transform</label>
            </div>
        </div>
    {elseif $input.type == 'file-dialog'}
        <div class="form-group">
            <div class="col-lg-10">
                <div class="row">
                    <div class="input-group">
                        <input type="text" value="{$fields_value[$input.name]|escape:'html':'UTF-8'}" id="{$input.name}"
                               class="form-control" name="{$input.name}"/>
                        <span class="input-group-addon"><a href="filemanager/dialog.php?type=1&field_id={$input.name}"
                                                           class="js-dialog-upload"
                                                           data-input-name="{$input.name|escape:'html':'UTF-8'}"
                                                           type="button">{l s='Select image' mod='gdz_themesetting'} <i
                                        class="icon-external-link"></i></a></span>
                    </div>

                </div>
            </div>
        </div>
    {elseif $input.type == 'image-select'}
        <div class="image-select {if isset($input.direction)} image-select-{$input.direction}{/if}">
            {foreach $input.options.query AS $option }
                <input id="{$input.name|escape:'html':'utf-8'}-{$option.id_option}" type="radio"
                       name="{$input.name|escape:'html':'utf-8'}"
                       value="{$option.id_option}" {if $fields_value[$input.name] == ''}{if $option@index eq 0} checked{/if}{/if} {if $option.id_option == $fields_value[$input.name]}checked{/if} />
                <div class="image-option">
                    <img src="{$base_url}modules/gdz_themesetting/views/img/{$option.img}" alt="{$option.name}"
                         class="img-responsive"/>
                    <span class="image-option-title">{$option.name}</span>
                </div>
            {/foreach}
        </div>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
