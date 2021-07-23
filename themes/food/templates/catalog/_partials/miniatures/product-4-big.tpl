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
	class="product-miniature js-product-miniature productbox-4"
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
							{if $gdzSetting.carousel_lazyload}data-src="{$product.cover.bySize.large_default_300x300.url}"{else}
								src = "{$product.cover.bySize.large_default_300x300.url}"
							{/if}
							alt = "{$product.cover.legend}"
							title="{$product.name|escape:'html':'UTF-8'}"
							data-full-size-image-url = "{$product.cover.large.url}"
						/>
						{if $gdzSetting.productbox_hover == 'swap-image' && isset($product.images.1) && $product.images.1}
							<img class="img-responsive product-img2"
								src = "{$product.images.1.bySize.large_default_300x300.url}"
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
			{block name='product_name'}
				<h3 class="product-title" itemprop="name"><a class="product-link" href="{$product.canonical_url}">{$product.name|truncate:30:'...'}</a></h3>
			{/block}
			<div class="product-reviews">
                {block name='product_reviews'}
                    {hook h='displayProductListReviews' product=$product}
                {/block}
            </div>
			{if $product.main_variants && $gdzSetting.productbox_variant}
				{block name='product_variants'}
					{include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
				{/block}
			{/if}
			<div class="product-short-desc">
				{$product.description_short|truncate:300:'...' nofilter}
			</div>
			<div class="block-addtocart">
				<div class="product-buttons">
					{if !$configuration.is_catalog && $gdzSetting.productbox_addtocart}
						{if $product.quantity >= 1}
							<a
								href="#"
								class="ajax-add-to-cart btn product-btn cart-button btn-icon"
								title="{l s='Add to cart' d='Shop.Theme.Actions'}"
								{if $product.quantity < 1} disabled {/if}
								data-id-product="{$product.id}"
								data-minimal-quantity="{$product.minimal_quantity}"
								data-token="{if isset($static_token) && $static_token}{$static_token}{/if}"
							>   
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g id="icon/content/add_24px">
										<path id="icon/content/add_24px_2" d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z" fill="#06163A"/>
									</g>
								</svg>
								<span>{l s='Add to cart' d='Shop.Theme.Actions'}</span>
							</a>
						{else}
							<a
								href="#"
								class="product-btn btn btn-icon disabled"
								disabled
								title="{l s='Sold out' d='Shop.Theme.Actions'}"
								data-id-product="{$product.id}"
								data-minimal-quantity="{$product.minimal_quantity}"
							>
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g id="icon/content/add_24px">
										<path id="icon/content/add_24px_2" d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z" fill="#06163A"/>
									</g>
								</svg>
							</a>	
						{/if}
					{/if}
					{if $gdzSetting.productbox_quickview}
						<a href="#" title="{l s='Quickview' d='Shop.Theme.Actions'}" data-link-action="quickview" class="btn-icon quick-view">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g id="icon/action/visibility_24px">
									<path id="icon/action/visibility_24px_2" fill-rule="evenodd" clip-rule="evenodd" d="M0.833252 10C2.27492 6.34167 5.83325 3.75 9.99992 3.75C14.1666 3.75 17.7249 6.34167 19.1666 10C17.7249 13.6583 14.1666 16.25 9.99992 16.25C5.83325 16.25 2.27492 13.6583 0.833252 10ZM17.3499 10C15.9749 7.19167 13.1583 5.41667 9.99993 5.41667C6.8416 5.41667 4.02493 7.19167 2.64993 10C4.02493 12.8083 6.8416 14.5833 9.99993 14.5833C13.1583 14.5833 15.9749 12.8083 17.3499 10ZM9.99992 7.91667C11.1499 7.91667 12.0833 8.85 12.0833 10C12.0833 11.15 11.1499 12.0833 9.99992 12.0833C8.84992 12.0833 7.91659 11.15 7.91659 10C7.91659 8.85 8.84992 7.91667 9.99992 7.91667ZM6.24992 10C6.24992 7.93333 7.93325 6.25 9.99992 6.25C12.0666 6.25 13.7499 7.93333 13.7499 10C13.7499 12.0667 12.0666 13.75 9.99992 13.75C7.93325 13.75 6.24992 12.0667 6.24992 10Z" fill="#06163A"/>
								</g>
							</svg>
						</a>
					{/if}
				</div>
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
			</div>
		</div>
	</div>
</div>
