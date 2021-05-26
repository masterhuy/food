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
<div class="pagebuilder-panel">
	<!-- Tool Footer -->
	<div class="tool-footer">
		<div class="dropup" id="tool-back">
				<button class="dropbtn label-tooltip" data-original-title="{l s='Back to Page List' mod='gdz_pagebuilder'}" onclick="document.location='{$link->getAdminLink('AdminGdzpagebuilderPages') nofilter}&configure=gdz_pagebuilder';"><i class="icon-close"></i></button>
		</div>
		<div class="dropup label-tooltip" data-original-title="{l s='Export' mod='gdz_pagebuilder'}" id="tool-export">
			<button class="dropbtn" onclick="document.location='{$link->getAdminLink('AdminGdzpagebuilderPages') nofilter}&configure=gdz_pagebuilder&export_id_page={$selectedpage.id_page nofilter}';"><a href="{$link->getAdminLink('AdminGdzpagebuilderPages') nofilter}&configure=gdz_pagebuilder&export_id_page={$selectedpage.id_page nofilter}"><i class="icon-download"></i></a></button>
		</div>
		<div class="dropup label-tooltip" data-original-title="{l s='Copy Language' mod='gdz_pagebuilder'}" id="tool-copylang">
			<button class="dropbtn"><a href="#"><i class="icon-language"></i></a></button>
			<div class="dropup-content">
				<div class="language-form dropup-form">
				<form name="adminForm" action="{$link->getAdminLink('AdminGdzpagebuilderPages') nofilter}&configure=gdz_pagebuilder" method="post">
					<label>{l s='Copy Data From' mod='gdz_pagebuilder'} : </label>
					<select name="src_lang_id">
					{foreach from=$languages key=i item=language}
						<option value="{$language.id_lang nofilter}">{$language.name nofilter}</option>
					{/foreach}
					</select>
					<button type="submit">{l s='Copy' mod='gdz_pagebuilder'}</button>
					<br /><span><strong>{l s='Note : Export Layout Before Do this Action' mod='gdz_pagebuilder'}.</strong></span>
					<input type="hidden" name="lang_id_page" value="{$selectedpage.id_page nofilter}" />
				</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End Tool Footer -->

	<div id="pagebuilder-setting">
	    <div class="setting-left">
					<div class="setting-left-wrapper">
					<select id="select-page">
						{foreach from=$pages key=i item=page}
							<option value="{$page.id_page nofilter}" {if $page.id_page == $selectedpage.id_page}selected="selected"{/if}>{{$page.title nofilter}}</option>
						{/foreach}
					</select>
					<select id="select-language">
	          {foreach from=$languages key=i item=language}
	            <option value="{$language.id_lang nofilter}"{if $language.id_lang == $id_lang} selected="selected"{/if}>Language : {$language.name nofilter}</option>
	          {/foreach}
	        </select>
					<a class="btn live-editor" target="_blank" href="{$live_link}">{l s='Live Editor' mod='gdz_pagebuilder'}</a>
					</div>

	    </div>
			<div class="setting-center">
					<a id="add-row" class="add-row btn btn-rounded"><span>{l s='Add Row' mod='gdz_pagebuilder'}</span> <i class="process-icon-new"></i></a>
			</div>
	    <div class="setting-right">
					{if $pro}
					<div class="dropdown btn" id="template-tool">
						<button class="dropbtn">{l s='Template Library' mod='gdz_pagebuilder'}</button><i class="arrow-down"></i>
						<div class="dropdown-content">
							<ul class="drop-list template-icons">
								<li><a id="template-library" class="dialog-open" data-dialog="template-library" data-form="library"><span class="drop-text">{l s='Template Library' mod='gdz_pagebuilder'}</span></a></li>
								<li><a class="dialog-open" data-dialog="template-library" data-form="save"><span class="drop-text">{l s='Save to Template' mod='gdz_pagebuilder'}</span></a></li>
								<li><a class="dialog-open" data-dialog="template-library" data-form="file"><span class="drop-text">{l s='Save as File' mod='gdz_pagebuilder'}</span></a></li>
							</ul>
						</div>
					</div>
					{/if}
					<a class="btn" target="_blank" href="{$link->getAdminLink('AdminGdzThemeSetting') nofilter}&configure=gdz_themesetting" title="{l s='Theme Setting' mod='gdz_pagebuilder'}">{l s='Setting' mod='gdz_pagebuilder'}</a>
					<a class="btn" target="_blank" href="{$page_link}" title="{l s='Preview' mod='gdz_pagebuilder'}">{l s='Preview' mod='gdz_pagebuilder'}</a>
					<div class="dropdown btn" id="tool-device">
						<button class="dropbtn"><i class="gdz-icon-desktop"></i></button><i class="arrow-down"></i>
						<div class="dropdown-content">
							<ul class="drop-list device-icons">
								<li class="active" data-device="xl"><a class="xl-device"><span class="icon"><i class="gdz-icon-desktop"></i></span><span class="drop-text device">{l s='Desktop' mod='gdz_pagebuilder'}</span></a></li>
								<li data-device="sm"><a class="sm-device"><span class="icon"><i class="gdz-icon-tablet"></i></span><span class="drop-text device">{l s='Tablet' mod='gdz_pagebuilder'}</span></a></li>
								<li data-device="xs"><a class="xs-device"><span class="icon"><i class="gdz-icon-mobile"></i></span><span class="drop-text device">{l s='Mobile' mod='gdz_pagebuilder'}</span></a></li>
							</ul>
						</div>
					</div>
	        <a class="btn btn-active" id="page-save" href="#">{l s='Save' mod='gdz_pagebuilder'}</a>
	    </div>
	</div>
	<div class="gdz-tools" id="tool-addons">
			<div class="tool-search">
					<input type="text" id="search-addon" placeholder="{l s='Search for addon name' mod='gdz_pagebuilder'}.." />
					<i class="gdz-icon-search"></i>
			</div>
			<ul class="pagebuilder-addons clearfix">
					<li class="addon-group">{l s='Addons' mod='gdz_pagebuilder'}</li>
					{assign var="shop_addon" value="true"}
					{foreach from=$addonslist key=i item=addonlist}
						{if $addonlist.type == 'Shop Addons' && $shop_addon == 'true'}
						<li class="addon-group">{l s='Shop Addons' mod='gdz_pagebuilder'}</li>
						{assign var="shop_addon" value="false"}
						{/if}
						<li class="addon-cat-addons{if $addonlist.pro} pro{/if}" draggable="true">
							{$addonlist.addon nofilter}
						</li>
					{/foreach}
			</ul>
	</div>
	<!-- Start Layout -->
	<div id="pagebuilder-layout">
	<div id="rowlist" class="xl-layout" data-id="{$selectedpage.id_page nofilter}">
	<div class="rowlist">
		{include file="module:gdz_pagebuilder/views/templates/admin/gdz_pagebuilder_pages/pagelayout_rows.tpl"}
	</div>
</div>
</div>
<!-- End Layout -->
</div>
<input id="root_url" type="hidden" name="root_url" value="{$root_url nofilter}" />
<input id="current_url" type="hidden" name="current_url" value="{$link->getAdminLink('AdminGdzpagebuilderPages') nofilter}&configure=gdz_pagebuilder&editAddon=1" />
<input id="backend_url" type="hidden" name="backend_url" value="{$link->getAdminLink('AdminGdzpagebuilderPages') nofilter}" />
<div class="hidden">
    <div id="gdz_pagebuilder-row">
		<div class="row" data-name="Row" data-fluid="0" data-layout="12">
			<div class="row-title">
				<div class="pull-left">
					<span><i class="icon-arrows"></i></span>
					<strong class="row-name">{l s='Row' mod='gdz_pagebuilder'}</strong>
				</div>
				<div class="pull-right">
					<ul aria-labelledby="dLabel" role="menu" class="button-group">
						<li class="layout-action">
							<a class="btn btn-default label-tooltip" data-original-title="Row Layout"><i class="icon-th"></i></a>
							<ul class="column-list">
								<li><a href="#" class="column-layout label-tooltip column-layout-12 " data-layout="12" data-original-title="12"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-66 " data-layout="6,6" data-original-title="6,6"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-444 " data-layout="4,4,4" data-original-title="4,4,4"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-3333 " data-layout="3,3,3,3" data-original-title="3,3,3,3"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-48 " data-layout="4,8" data-original-title="4,8"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-39 active" data-layout="3,9" data-original-title="3,9"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-363 " data-layout="3,6,3" data-original-title="3,6,3"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-264 " data-layout="2,6,4" data-original-title="2,6,4"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-210 " data-layout="2,10" data-original-title="2,10"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-57 " data-layout="5,7" data-original-title="5,7"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-237 " data-layout="2,3,7" data-original-title="2,3,7"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-255 " data-layout="2,5,5" data-original-title="2,5,5"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-282 " data-layout="2,8,2" data-original-title="2,8,2"></a></li>
								<li><a href="#" class="column-layout label-tooltip column-layout-2442 " data-layout="2,4,4,2" data-original-title="2,4,4,2"></a></li>
								<li><a data-original-title="Custom Layout" data-layout="custom" class="column-layout column-layout-custom label-tooltip" href="#"></a></li>
							</ul>
						</li>
						<li>
							<a class="btn btn-default row-setting label-tooltip" data-original-title="{l s='Row Setting' mod='gdz_pagebuilder'}"><i class="icon-cogs"></i></a>
						</li>
						<li>
							<a class="btn btn-default duplicate-row label-tooltip" data-original-title="{l s='Duplicate Row' mod='gdz_pagebuilder'}"><i class="icon-copy"></i></a>
						</li>
						<li>
							<a class="btn btn-default remove-row label-tooltip" data-original-title="{l s='Delete This Row' mod='gdz_pagebuilder'}"><i class="icon-trash"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row-columns">
			</div>
		</div>
	</div>
</div>
<div class="hidden">
	<div class="addon-box module" data-addon="module" data-modulename="" data-hook="">
		<i class="addon-icon module-icon"></i><span class="addon-title">{l s='Module' mod='gdz_pagebuilder'}</span>
		<div class="addon-tools">
			<a class="edit-addon"><i class="icon-edit"></i></a>
			<a class="duplicate-addon"><i class="icon-copy"></i></a>
			<a class="remove-addon"><i class="icon-trash"></i></a>
		</div>
	</div>
</div>
<div class="hidden">
	<div class="row-settings">
		<ul role="tablist" class="nav nav-tabs">
		{foreach from=$row_settings key=i item=row_setting}
			<li class="{if $i==0}active{/if}"><a data-toggle="tab" href="#row-{$row_setting.id}">{$row_setting.title}</a></li>
		{/foreach}
		</ul>
		<div class="tab-content">
		{foreach from=$row_settings key=i item=setting}
			{include file="module:gdz_pagebuilder/views/templates/admin/settings.tpl" stype="row"}
		{/foreach}
		</div>
	</div>
</div>
<div class="hidden">
	<div class="column-settings">
			<ul role="tablist" class="nav nav-tabs">
			{foreach from=$column_settings key=i item=column_setting}
				<li class="{if $i==0}active{/if}"><a data-toggle="tab" href="#column-{$column_setting.id}">{$column_setting.title}</a></li>
			{/foreach}
			</ul>
			<div class="tab-content">
			{foreach from=$column_settings key=i item=setting}
				{include file="module:gdz_pagebuilder/views/templates/admin/settings.tpl" stype="column"}
			{/foreach}
			</div>
	</div>
</div>
<div class="hidden">
	<ul class="pagebuilder-addons clearfix">
		{foreach from=$addonslist key=i item=addonlist}
			<li class="addon-cat-addons">
				{$addonlist.addon nofilter}
			</li>
		{/foreach}
	</ul>
</div>
<div class="gdz-modal" id="layout-modal" role="dialog" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
    <div class="gdz-modal-dialog">
        <div class="gdz-modal-content">
            <div class="gdz-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="gdz-modal-title" id="modal-label"></h3>
            </div>
            <div class="gdz-modal-body"></div>
            <div class="gdz-modal-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-success pull-left" id="save-settings" data-dismiss="modal">{l s='Apply' mod='gdz_pagebuilder'}</a>
                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">{l s='Cancel' mod='gdz_pagebuilder'}</button>
            </div>
        </div>
    </div>
</div>
<div class="gdz-modal" id="addon-modal" role="dialog" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
    <div class="gdz-modal-dialog">
        <div class="gdz-modal-content">
            <div class="gdz-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="gdz-modal-title" id="modal-label"></h3>
            </div>
            <div class="gdz-modal-body"></div>
            <div class="gdz-modal-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-success pull-left" id="save-addons" data-dismiss="modal">{l s='Apply' mod='gdz_pagebuilder'}</a>
                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">{l s='Cancel' mod='gdz_pagebuilder'}</button>
            </div>
        </div>
    </div>
</div>
{include file="module:gdz_pagebuilder/views/templates/admin/library.tpl"}
<input type="hidden" name="mediatoken" id="mediatoken" value="{$mediatoken nofilter}" />
<form name="layoutForm" action="{$link->getAdminLink('AdminGdzpagebuilderPages') nofilter}&configure=gdz_pagebuilder" method="post">
<div class="hidden">
<input type="hidden" name="gdzformjson" id="gdzformjson" value="{$jsontext}" />
</div>
<input type="hidden" name="json_page_id" value="{$selectedpage.id_page nofilter}" />
<input type="hidden" name="saveLayout" value="1" />
</form>
<script type="text/javascript">
	var iso = 'en';
	var pathCSS = '{$smarty.const._THEME_CSS_DIR_|addslashes nofilter}';
	var ad = '{$ad nofilter}';

	$(document).ready(function(){
		{block name="autoload_tinyMCE"}
			tinySetup({
				mode : "textareas",
				editor_selector :"gdz_editor",
				relative_urls : false,
				remove_script_host : false,
				convert_urls : {if $converturl}true{else}false{/if},
				document_base_url : "{$root_url nofilter}"
			});
		{/block}
	});
	$(document).ready(function(){
		$('body').addClass('page-sidebar-closed');
	});
</script>
