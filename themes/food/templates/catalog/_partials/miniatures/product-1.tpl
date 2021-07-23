{**
 * 2007-2019 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div
	class="product-miniature js-product-miniature productbox-1"
	data-id-product="{$product.id_product}"
	data-id-product-attribute="{$product.id_product_attribute}"
	itemscope itemtype="http://schema.org/Product">
	<div class="product-preview thumbnail-container">
		{block name='product_thumbnail'}
			<div class="product-thumbnail">
				{if $product.cover}
					<a
						href="{$product.url}"
						class="product-image{if $gdzSetting.productbox_hover == 'swap-image' && isset($product.images.1) && $product.images.1} swap-image{else} blur-image{/if}"
					>
						<img class="img-responsive product-img1{if $gdzSetting.carousel_lazyload} owl-lazy{/if}"
							{if $gdzSetting.carousel_lazyload}data-src="{$product.cover.bySize.home_default.url}"{else}
								src = "{$product.cover.bySize.home_default.url}"
							{/if}
							alt = "{$product.cover.legend}"
							title="{$product.name|escape:'html':'UTF-8'}"
							data-full-size-image-url = "{$product.cover.large.url}"
						/>
						{if $gdzSetting.productbox_hover == 'swap-image' && isset($product.images.1) && $product.images.1}
							<img class="img-responsive product-img2"
								src = "{$product.images.1.bySize.home_default.url}"
								alt = "{$product.images.1.legend}"
								title="{$product.name|escape:'html':'UTF-8'}"
								data-full-size-image-url = "{$product.images.1.large.url}"
							/>
						{/if}
					</a>
				{else}
					<a href="{$product.url}" class="product-image">
						<img src="{$urls.no_picture_image.bySize.home_default.url}" />
					</a>
				{/if}
				{include file='catalog/_partials/product-flags.tpl'}
			</div>
		{/block}

		<div class="product-info">
			{if $gdzSetting.productbox_category}
				<div class="category-name">
					<a href="{url entity='category' id=$product.id_category_default}">
						{$product.category_name|escape:'html':'UTF-8'}
					</a>
				</div>
			{/if}
			{block name='product_name'}
				<h3 class="product-title" itemprop="name"><a class="product-link" href="{$product.canonical_url}">{$product.name|truncate:30:'...'}</a></h3>
			{/block}
			{if $gdzSetting.productbox_price}
				{block name='product_price_and_shipping'}
					{if $product.show_price}
					<div class="content_price">
						{hook h='displayProductPriceBlock' product=$product type="before_price"}
						{if $product.has_discount}
							{hook h='displayProductPriceBlock' product=$product type="old_price"}
							<span class="old price">{$product.regular_price}</span>
						{/if}
						<span class="price new">{$product.price}</span>
						{hook h='displayProductPriceBlock' product=$product type='unit_price'}
						{hook h='displayProductPriceBlock' product=$product type='weight'}
					</div>
					{/if}
				{/block}
			{/if}
			{if $product.main_variants && $gdzSetting.productbox_variant}
				{block name='product_variants'}
					{include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
				{/block}
			{/if}
			<div class="product-short-desc">
				{$product.description_short|truncate:300:'...' nofilter}
			</div>
    		<div class="product-buttons">
				{if $gdzSetting.productbox_wishlist}
					<a href="#" title="{l s='Add to wishlist' d='Shop.Theme.Actions'}" class="addToWishlist btn-icon" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|escape:'html'}', false, 1); return false;" data-id-product="{$product.id_product|escape:'html'}">
						<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 4.30061C11.4537 3.18061 12.915 2.47186 14.4375 2.47186C17.1325 2.47186 19.25 4.58936 19.25 7.28436C19.25 10.5891 16.2799 13.2824 11.7798 17.3631L11.7688 17.3731L10.5 18.5281L9.23125 17.3819L9.19671 17.3505C4.7098 13.2731 1.75 10.5834 1.75 7.28436C1.75 4.58936 3.8675 2.47186 6.5625 2.47186C8.085 2.47186 9.54625 3.18061 10.5 4.30061ZM10.5 16.1656L10.5875 16.0781C14.7525 12.3069 17.5 9.81311 17.5 7.28436C17.5 5.53436 16.1875 4.22186 14.4375 4.22186C13.09 4.22186 11.7775 5.08811 11.3225 6.28686H9.68625C9.2225 5.08811 7.91 4.22186 6.5625 4.22186C4.8125 4.22186 3.5 5.53436 3.5 7.28436C3.5 9.81311 6.2475 12.3069 10.4125 16.0781L10.5 16.1656Z" fill="black" fill-opacity="0.54"/>
						</svg>
						<span>{l s='Add to wishlist' d='Shop.Theme.Actions'}</span>
					</a>
				{/if}
				{if !$configuration.is_catalog && $gdzSetting.productbox_addtocart}
					{if $product.quantity >= 1}
						<a
							href="#"
							class="ajax-add-to-cart btn product-btn cart-button"
							title="{l s='Add to cart' d='Shop.Theme.Actions'}"
							{if $product.quantity < 1} disabled {/if}
							data-id-product="{$product.id}"
							data-minimal-quantity="{$product.minimal_quantity}"
							data-token="{if isset($static_token) && $static_token}{$static_token}{/if}">
							{l s='Add to cart' d='Shop.Theme.Actions'}
						</a>
						{else}
						<a
							href="#"
							class="product-btn btn disabled"
							disabled
							title="{l s='Sold out' d='Shop.Theme.Actions'}"
							data-id-product="{$product.id}"
							data-minimal-quantity="{$product.minimal_quantity}">
							{l s='Sold out' d='Shop.Theme.Actions'}
						</a>	
					{/if}
				{/if}
				{if $gdzSetting.productbox_quickview}
					<a href="#" title="{l s='Quick view' d='Shop.Theme.Actions'}" data-link-action="quickview" class="btn-icon quick-view">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0.833374 10C2.27504 6.34167 5.83337 3.75 10 3.75C14.1667 3.75 17.725 6.34167 19.1667 10C17.725 13.6583 14.1667 16.25 10 16.25C5.83337 16.25 2.27504 13.6583 0.833374 10ZM17.35 10C15.975 7.19167 13.1584 5.41667 10 5.41667C6.8417 5.41667 4.02503 7.19167 2.65003 10C4.02503 12.8083 6.8417 14.5833 10 14.5833C13.1584 14.5833 15.975 12.8083 17.35 10ZM10 7.91667C11.15 7.91667 12.0834 8.85 12.0834 10C12.0834 11.15 11.15 12.0833 10 12.0833C8.85004 12.0833 7.91671 11.15 7.91671 10C7.91671 8.85 8.85004 7.91667 10 7.91667ZM6.25004 10C6.25004 7.93333 7.93337 6.25 10 6.25C12.0667 6.25 13.75 7.93333 13.75 10C13.75 12.0667 12.0667 13.75 10 13.75C7.93337 13.75 6.25004 12.0667 6.25004 10Z" fill="black" fill-opacity="0.54"/>
						</svg>
						<span>{l s='Quick view' d='Shop.Theme.Actions'}</span>
					</a>
				{/if}
    		</div>
		</div>
	</div>
</div>
