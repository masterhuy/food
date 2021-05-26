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
<div class="panel">
	<div id="rows">
		<div id="page_list" class="page">
			<div class="list-heading">
					<div class="row">
						<div class="col-lg-1"></div>
						<div class="col-lg-6">ID-Title</div>
						<div class="col-lg-3">State</div>
						<div class="col-lg-2"><span class="pull-right">Action</span></div>
					</div>
			</div>
			{foreach from=$pages key=i item=page}
				<div id="page_{$page.id_page|escape:'html':'UTF-8'}" class="list-row">
					<div class="row">
						<div class="col-lg-1 list-arrow"><span class="pull-left"><i class="icon-arrows"></i></span></div>
						<div class="col-lg-6">
							<a href="{$link->getAdminLink('AdminGdzpagebuilderPages')|escape:'html':'UTF-8'}&configure=gdz_pagebuilder&edit_id_page={$page.id_page|escape:'html':'UTF-8'}">#{$page.id_page|escape:'html':'UTF-8'} - {$page.title|escape:'html':'UTF-8'}</h4>
						</div>
						<div class="col-md-3 list-status">
								<a class="grid-toggler-icon-valid"	href="{$link->getAdminLink('AdminGdzpagebuilderPages')|escape:'html':'UTF-8'}&configure=gdz_pagebuilder&status_id_page={$page.id_page|escape:'html':'UTF-8'}" title="{if $page.active}Enabled{else}Disabled{/if}">
								<i class="material-icons ps-togglable-row grid-toggler-icon-{if $page.active}valid{else}not-valid{/if}">{if $page.active}check{else}clear{/if}</i>
								</a>
						</div>
						<div class="col-md-2">
							<div class="btn-group-action pull-right">
								<div class="btn-group pull-right">
									<a href="{$link->getAdminLink('AdminGdzpagebuilderPages')|escape:'html':'UTF-8'}&configure=gdz_pagebuilder&edit_id_page={$page.id_page|escape:'html':'UTF-8'}" title="Edit" class="edit btn btn-default">
											<i class="icon-pencil"></i> {l s='Edit' mod='gdz_pagebuilder'}
									</a>
									<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<i class="icon-caret-down"></i>&nbsp;
									</button>
									<ul class="dropdown-menu">
											<li>
												<a href="{$link->getAdminLink('AdminGdzpagebuilderPages')|escape:'html':'UTF-8'}&configure=gdz_pagebuilder&duplicate_id_page={$page.id_page|escape:'html':'UTF-8'}" title="{l s='Duplicate' mod='gdz_pagebuilder'}">
														<i class="icon-copy"></i> {l s='Duplicate' mod='gdz_pagebuilder'}
												</a>
											</li>
											<li>
												<a href="{$link->getAdminLink('AdminGdzpagebuilderPages')|escape:'html':'UTF-8'}&configure=gdz_pagebuilder&delete_id_page={$page.id_page|escape:'html':'UTF-8'}" title="{l s='Delete' mod='gdz_pagebuilder'}" onclick="return confirm('{l s='Are you sure you want to delete this item' mod='gdz_pagebuilder'}?');">
														<i class="icon-trash"></i> {l s='Delete' mod='gdz_pagebuilder'}
												</a>
											</li>
											<li>
												<a href="{$link->getAdminLink('AdminGdzpagebuilderPages')|escape:'html':'UTF-8'}&configure=gdz_pagebuilder&config_id_page={$page.id_page|escape:'html':'UTF-8'}" title="{l s='Layout Config' mod='gdz_pagebuilder'}">
														<i class="icon-sitemap"></i> {l s='Layout Config' mod='gdz_pagebuilder'}
												</a>
											</li>
											<li>
												<a href="{$link->getAdminLink('gdzPagebuilderEditor')|escape:'html':'UTF-8'}&id_page={$page.id_page|escape:'html':'UTF-8'}" title="{l s='Live Editor' mod='gdz_pagebuilder'}">
														<i class="icon-sitemap"></i> {l s='Live Editor' mod='gdz_pagebuilder'}
												</a>
											</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			{/foreach}
		</div>
	</div>
</div>
