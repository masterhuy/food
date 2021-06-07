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
{block name="field"}
	{if $input.type == 'skin'}
	<div class="col-lg-9">
		<a class="skin-box {if $input.jpb_skin=='default' || $input.jpb_skin==''}active{/if}" title="Default">
			<img src="{$input.img_url|escape:'htmlall':'UTF-8'}default.png" alt="Default" />
		</a>
		{foreach from=$input.skins item=sk}
			<a class="skin-box {if $input.jpb_skin=={$sk|escape:'htmlall':'UTF-8'}}active{/if}" title="{$sk|escape:'htmlall':'UTF-8'}" data-color="{$sk|escape:'htmlall':'UTF-8'}">
			<img src="{$input.img_url|escape:'htmlall':'UTF-8'}{$sk|escape:'htmlall':'UTF-8'}.png" alt="{$sk|escape:'htmlall':'UTF-8'}" />
			</a>
		{/foreach}
		<input type="hidden" name="JPB_SKIN" id="gdzskin" value="" />
		<script type="text/javascript">
		jQuery(function ($) {
			"use strict";
			$(".skin-box").click(function() {
				var skin =  $(this).attr('data-color');
				$('#gdzskin').val(skin);
				$(".skin-box").removeClass('active');
				$(this).addClass('active');
			});
		});
		</script>
	</div>
	{/if}
	{if $input.type == 'select-image'}
	<div class="col-lg-9">
			<select class="form-control fixed-width-xxl select-image {if isset($input['class'])}{$input['class']}{/if}" name="{$input.name}"{if isset($input['js'])} onchange="{$input['js']}"{/if} id="{$input.name}" {if isset($input['size'])} size="{$input['size']}"{/if}>
				{foreach $input.options.query AS $k => $option}
						<option value="{$option.id}" {if $input.value == $option.id}selected="selected"{/if}>{$option.name}</option>
				{/foreach}
			</select>
			<div id="jpb-preview-img">
			{if isset($input.value) && $input.value}
			<img id="preview-img" src="{$input.img_url}/{$input.value}.jpg" />
			{/if}
		</div>
			<script type="text/javascript">
			jQuery(function ($) {
				"use strict";
				$(".select-image").change(function() {
					var selected_value = $(this). children("option:selected").val();
					var new_url = '{$input.img_url}' + '/' + selected_value + '.jpg';
					var img = $('<img id="preview-img">');
					img.attr('src', new_url);
					$('#jpb-preview-img').html('');
					img.appendTo('#jpb-preview-img');
				});
			});
			</script>
	</div>
	{/if}
	{if $input.type == 'text-group'}
	<div class="col-lg-9">
		<div class="input-field input-group row">
				<input class="" name="{$input.name}[]"{if isset($input['js'])} onchange="{$input['js']}"{/if} id="{$input.name}" {if isset($input['size'])} size="{$input['size']}"{/if} value="{$input.value.0}" />
				<input class="" name="{$input.name}[]"{if isset($input['js'])} onchange="{$input['js']}"{/if} id="{$input.name}" {if isset($input['size'])} size="{$input['size']}"{/if} value="{$input.value.1}" />
				<input class="" name="{$input.name}[]"{if isset($input['js'])} onchange="{$input['js']}"{/if} id="{$input.name}" {if isset($input['size'])} size="{$input['size']}"{/if} value="{$input.value.2}" />
				<input class="" name="{$input.name}[]"{if isset($input['js'])} onchange="{$input['js']}"{/if} id="{$input.name}" {if isset($input['size'])} size="{$input['size']}"{/if} value="{$input.value.3}" />
				{if isset($input.suffix)}
				<span class="input-group-addon">
					{$input.suffix}
				</span>
				{/if}
		</div>
		<div class="input-label row">
				<span>Top</span>
				<span>Right</span>
				<span>Left</span>
				<span>Bottom</span>
		</div>
	</div>
	{/if}
	{if $input.type == 'switch-label'}
	<div class="col-lg-9">
	<span class="switch prestashop-switch fixed-width-{$input.width}">
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
	{/if}
	{if $input.type == 'fontpicker'}
	<div class="col-lg-9">
			<input class="font-picker" name="{$input.name}" type="text" value="{$fields_value[$input.name]}" />
			<script>
					$(function(){
						//$('#font').fontselect();
						$('.font-picker').fontselect().change(function(){
		          var font = $(this).val().replace(/\+/g, ' ');
		          font = font.split(':');
		          $(this).attr('value', font[0]);
		        });
					});

			</script>
	</div>
	{/if}	
{$smarty.block.parent}
{/block}
