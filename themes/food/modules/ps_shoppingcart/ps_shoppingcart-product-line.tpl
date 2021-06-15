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
<div class="row align-items-center">
	{if $product.cover.bySize.cart_default.url}
		<a class="cart-product-image layout-column" href="{$product.url}" title="{$product.name|escape:'html':'UTF-8'}">
			<img alt="{$product.name|escape:'html':'UTF-8'}" src="{$product.cover.bySize.cart_default.url}" class="preview img-responsive" data-full-size-image-url = "{$product.cover.large.url}">
		</a>
	{/if}
	<div class="product-info layout-column">
		<a class="product-link" href="{$product.url}" title="{$product.name|escape:'html':'UTF-8'}">
			{$product.name}
		</a>
		<div class="content_price">
			<span class="price new">{$product.price}</span> 
		</div>
		<div class="quantity">
			<span>x</span> 
			<span class="quantity">{$product.quantity}</span>
			<a class="remove-from-cart remove_link" rel="nofollow" href="{$product.remove_from_cart_url}" data-link-action="remove-from-cart" title="{l s='Remove from cart' d='Shop.Theme.Actions'}" >
				<svg width="17" height="23" viewBox="0 0 17 23" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M11.5209 0.625L12.7292 1.83333H16.9584V4.25H0.041748V1.83333H4.27092L5.47925 0.625H11.5209ZM1.25008 19.9583C1.25008 21.2875 2.33758 22.375 3.66675 22.375H13.3334C14.6626 22.375 15.7501 21.2875 15.7501 19.9583V5.45833H1.25008V19.9583ZM3.66675 7.875H13.3334V19.9583H3.66675V7.875Z" fill="#3F2803"/>
				</svg>
			</a>
		</div>
	</div>
</div>
