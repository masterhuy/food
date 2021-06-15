{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
<div
	class="btn-group blockcart cart-preview dropdown col-auto{if $gdzSetting.addtocart_type !=''} {$gdzSetting.addtocart_type}{/if}"
	id="cart_block" data-refresh-url="{$refresh_url}">
	<a href="#" class="cart-icon" data-toggle="dropdown" data-display="static" aria-expanded="false">
		<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M19.4375 16.25C20.375 16.25 21.2 15.7375 21.625 14.9625L26.1 6.85C26.5625 6.025 25.9625 5 25.0125 5H6.5125L5.3375 2.5H1.25V5H3.75L8.25 14.4875L6.5625 17.5375C5.65 19.2125 6.85 21.25 8.75 21.25H23.75V18.75H8.75L10.125 16.25H19.4375ZM7.7 7.5H22.8875L19.4375 13.75H10.6625L7.7 7.5ZM8.75 22.5C7.375 22.5 6.2625 23.625 6.2625 25C6.2625 26.375 7.375 27.5 8.75 27.5C10.125 27.5 11.25 26.375 11.25 25C11.25 23.625 10.125 22.5 8.75 22.5ZM21.25 22.5C19.875 22.5 18.7625 23.625 18.7625 25C18.7625 26.375 19.875 27.5 21.25 27.5C22.625 27.5 23.75 26.375 23.75 25C23.75 23.625 22.625 22.5 21.25 22.5Z" fill="#3F2803"/>
		</svg>
		{if $gdzSetting.addtocart_type == 'circle-filled'}
			{if $cart.products_count > 0}<span class="circle-notify"></span>{/if}
		{else}
			<span class="ajax_cart_quantity">{$cart.products_count}</span>
		{/if}
	</a>
	<span class="cart_block_total ajax_block_cart_total">{$cart.totals.total.value}</span>
	<div class="dropdown-menu shoppingcart-box{if $gdzSetting.cart_type =='sidebar'} shoppingcart-sidebar{/if}">
		<div class="cart-title">{l s='Shopping Cart' d='Shop.Theme.Actions'} ({$cart.products_count})</div>
		{if $cart.products_count == 0}
			<span class="ajax_cart_no_product">{l s='There is no product' d='Shop.Theme.Actions'}</span>
		{else}
			<ul class="list products cart_block_list">
				{foreach from=$cart.products item=product}
					<li>{include 'module:ps_shoppingcart/ps_shoppingcart-product-line.tpl' product=$product}</li>
				{/foreach}
			</ul>
		{/if}
		{if $cart.products_count != 0}
			<div class="billing-info">
				{if $gdzSetting.cart_subtotal == 1}
					{foreach from=$cart.subtotals item="subtotal"}
						{if $subtotal.label}
							<div class="{$subtotal.type} cart-prices-line">
								<span class="label">{$subtotal.label}</span>
								<span class="value">{$subtotal.value}</span>
							</div>
						{/if}
					{/foreach}
				{/if}
				{if $gdzSetting.cart_total == 1}
					<div class="cart-total cart-prices-line">
						<span class="label">{$cart.totals.total.label}</span>
						<span class="value">{$cart.totals.total.value}</span>
					</div>
				{/if}
			</div>
			<div class="cart-button">
				{if $gdzSetting.cart_links && 'checkout'|in_array:$gdzSetting.cart_links}
					<a href="{url entity=order}" class="btn btn-active checkout-btn">
						{l s='Check out' d='Shop.Theme.Actions'}
					</a>
				{/if}
				{if $gdzSetting.cart_links && 'cart'|in_array:$gdzSetting.cart_links}
					<a class="btn btn-active cart-btn" href="{$cart_url}" rel="nofollow">
						{l s='View cart' d='Shop.Theme.Actions'}
					</a>
				{/if}
			</div>
		{/if}
	</div>
</div>
