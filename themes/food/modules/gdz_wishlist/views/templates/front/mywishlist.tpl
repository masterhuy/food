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
{extends file='page.tpl'}
{block name='page_content_container'}
<div id="mywishlist">
    {capture name=path}
        <a href="{$link->getPageLink('my-account', true)|escape:'html'}">{l s='My account' d='Shop.Theme.Catalog'}</a>
        <span class="navigation-pipe">{$navigationPipe}</span>
        <a href="{$link->getModuleLink('gdz_wishlist', 'mywishlist')|escape:'html'}">{l s='My wishlists' d='Shop.Theme.Catalog'}</a>
		{if isset($current_wishlist)}
	        <span class="navigation-pipe">{$navigationPipe}</span>
	        {$current_wishlist.name}
		{/if}
    {/capture}
	<div class="wishlist-header">
		<h3>{l s='My wishlists' d='Shop.Theme.Catalog'}</h3>
		<a class="wishlist-add float-right" href="javascript:;" onclick="javascript:toggleAddForm();"><i class="fa fa-plus"></i>{l s='Add New WishList' d='Shop.Theme.Catalog'}</a>
	</div>

	{include file='_partials/form-errors.tpl' errors=$errors}
	{if $id_customer|intval neq 0}
		<form method="post" class="std" id="form-wishlist-add">
			<h4>{l s='Add New Wishlist' d='Shop.Theme.Catalog'}</h4>
			<div class="form-group">
				<label for="exampleInputEmail1">{l s='Name' d='Shop.Theme.Catalog'}</label>
				<input type="text" id="name" name="name" class="inputTxt form-control" value="{if isset($smarty.post.name) and $errors|@count > 0}{$smarty.post.name|escape:'html':'UTF-8'}{/if}" />
				<input type="hidden" name="token" value="{$token|escape:'html':'UTF-8'}" />
			</div>
			<button type="submit" name="submitWishlist" id="submitWishlist" class="btn btn-default btn-primary" value="{l s='Save' d='Shop.Theme.Catalog'}" class="exclusive">
				{l s='Save' d='Shop.Theme.Catalog'}
			</button>
		</form>
		{if $wishlists}
		<div id="block-history" class="block-center">
			<table class="std table">
				<thead>
					<tr>
						<th class="first_item">{l s='Name' d='Shop.Theme.Catalog'}</th>
						<th class="wishlist-align-center">{l s='Qty' d='Shop.Theme.Catalog'}</th>
						<th class="wishlist-align-center">{l s='Viewed' d='Shop.Theme.Catalog'}</th>
						<th class="wishlist-align-center">{l s='Created' d='Shop.Theme.Catalog'}</th>
						<th class="wishlist-align-center">{l s='Direct Link' d='Shop.Theme.Catalog'}</th>
						<th class="wishlist-align-center">{l s='Default' d='Shop.Theme.Catalog'}</th>
						<th class="wishlist-align-center">{l s='Delete' d='Shop.Theme.Catalog'}</th>
					</tr>
				</thead>
				<tbody>
				{section name=i loop=$wishlists}
					<tr id="wishlist_{$wishlists[i].id_wishlist|intval}">
						<td>
							<a href="javascript:;" onclick="javascript:WishlistManage('block-order-detail', '{$wishlists[i].id_wishlist|intval}');">{$wishlists[i].name|truncate:30:'...'|escape:'html':'UTF-8'}</a>
						</td>
						<td class="wishlist-align-center">
							{assign var=n value=0}
							{foreach from=$nbProducts item=nb name=i}
								{if $nb.id_wishlist eq $wishlists[i].id_wishlist}
									{assign var=n value=$nb.nbProducts|intval}
								{/if}
							{/foreach}
							{if $n}
								{$n|intval}
							{else}
								0
							{/if}
						</td>
						<td class="wishlist-align-center">{$wishlists[i].counter|intval}</td>
						<td class="wishlist-align-center">{$wishlists[i].date_add|date_format:"%Y-%m-%d"}</td>
						<td class="wishlist-align-center"><a href="javascript:;" onclick="javascript:WishlistManage('block-order-detail', '{$wishlists[i].id_wishlist|intval}');">{l s='View' d='Shop.Theme.Catalog'}</a></td>
						<td class="wishlist-align-center wishlist-default">
							{if isset($wishlists[i].default) && $wishlists[i].default == 1}
								<p class="is_wish_list_default">
									<i class="fa fa-check-square-o"></i>
								</p>
							{else}
								<a href="#" onclick="javascript:event.preventDefault();(WishlistDefault('wishlist_{$wishlists[i].id_wishlist|intval}', '{$wishlists[i].id_wishlist|intval}'));">
									<i class="fa fa-square-o"></i>
								</a>
							{/if}
						</td>
						<td class="wishlist-align-center">
							<a href="javascript:;"onclick="return (WishlistDelete('wishlist_{$wishlists[i].id_wishlist|intval}', '{$wishlists[i].id_wishlist|intval}', '{l s='Do you really want to delete this wishlist ?' d='Shop.Theme.Catalog' js=1}'));"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				{/section}
				</tbody>
			</table>
		</div>
		<div id="block-order-detail">&nbsp;</div>
		{/if}
	{/if}

	<ul class="wishlist-footer-links">
		<li><a href="{$link->getPageLink('my-account', true)}"></a><a class="btn btn-default button button-small" href="{$link->getPageLink('my-account', true)|escape:'html'}"><i class="fa fa-user"></i>{l s='Back to Your Account' d='Shop.Theme.Catalog'}</a></li>
		<li class="f_right"><a href="#"></a><a href="{$urls.pages.index}" class="btn btn-default button button-small"><i class="fa fa-home"></i>{l s='Home' d='Shop.Theme.Catalog'}</a></li>
	</ul>
</div>
{/block}
