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
	class="product-miniature js-product-miniature productbox-3"
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
							{if $gdzSetting.carousel_lazyload}data-src="{$product.cover.bySize.large_default.url}"{else}
								src = "{$product.cover.bySize.large_default.url}"
							{/if}
							alt = "{$product.cover.legend}"
							title="{$product.name|escape:'html':'UTF-8'}"
							data-full-size-image-url = "{$product.cover.large.url}"
						/>
						{if $gdzSetting.productbox_hover == 'swap-image' && isset($product.images.1) && $product.images.1}
							<img class="img-responsive product-img2"
								src = "{$product.images.1.bySize.large_default.url}"
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
                <div class="product-buttons">
                    {if !$configuration.is_catalog && $gdzSetting.productbox_addtocart}
                        {if $product.quantity >= 1}
                            <button
                                class="ajax-add-to-cart btn product-btn cart-button btn-icon"
                                title="{l s='Add to cart' d='Shop.Theme.Actions'}"
                                {if $product.quantity < 1} disabled {/if}
                                data-id-product="{$product.id}"
                                data-minimal-quantity="{$product.minimal_quantity}"
                                data-token="{if isset($static_token) && $static_token}{$static_token}{/if}"
                            >   
                                <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2963 9.97C16.9563 10.59 16.2963 11 15.5463 11H8.09628L6.99628 13H18.9963V15H6.99628C5.47628 15 4.51628 13.37 5.24628 12.03L6.59628 9.59L2.99628 2H0.996277V0H4.26628L5.20628 2H20.0063C20.7663 2 21.2463 2.82 20.8763 3.48L17.2963 9.97ZM18.3063 4H6.15628L8.52628 9H15.5463L18.3063 4ZM6.99628 16C5.89628 16 5.00628 16.9 5.00628 18C5.00628 19.1 5.89628 20 6.99628 20C8.09628 20 8.99628 19.1 8.99628 18C8.99628 16.9 8.09628 16 6.99628 16ZM15.0063 18C15.0063 16.9 15.8963 16 16.9963 16C18.0963 16 18.9963 16.9 18.9963 18C18.9963 19.1 18.0963 20 16.9963 20C15.8963 20 15.0063 19.1 15.0063 18Z" fill="#3F2803"/>
                                </svg>
                            </button>
                        {else}
                            <button
                                class="product-btn btn btn-icon disabled"
                                disabled
                                title="{l s='Sold out' d='Shop.Theme.Actions'}"
                                data-id-product="{$product.id}"
                                data-minimal-quantity="{$product.minimal_quantity}"
                            >
                                <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2963 9.97C16.9563 10.59 16.2963 11 15.5463 11H8.09628L6.99628 13H18.9963V15H6.99628C5.47628 15 4.51628 13.37 5.24628 12.03L6.59628 9.59L2.99628 2H0.996277V0H4.26628L5.20628 2H20.0063C20.7663 2 21.2463 2.82 20.8763 3.48L17.2963 9.97ZM18.3063 4H6.15628L8.52628 9H15.5463L18.3063 4ZM6.99628 16C5.89628 16 5.00628 16.9 5.00628 18C5.00628 19.1 5.89628 20 6.99628 20C8.09628 20 8.99628 19.1 8.99628 18C8.99628 16.9 8.09628 16 6.99628 16ZM15.0063 18C15.0063 16.9 15.8963 16 16.9963 16C18.0963 16 18.9963 16.9 18.9963 18C18.9963 19.1 18.0963 20 16.9963 20C15.8963 20 15.0063 19.1 15.0063 18Z" fill="#3F2803"/>
                                </svg>
                            </button>	
                        {/if}
                    {/if}
                    {if $gdzSetting.productbox_wishlist}
                        <a href="#" title="{l s='Add to wishlist' d='Shop.Theme.Actions'}" class="addToWishlist btn-icon" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|escape:'html'}', false, 1); return false;" data-id-product="{$product.id_product|escape:'html'}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.915C11.09 1.635 12.76 0.825001 14.5 0.825001C17.58 0.825001 20 3.245 20 6.325C20 10.1019 16.6056 13.1799 11.4627 17.8435L11.45 17.855L10 19.175L8.55 17.865L8.51052 17.8291C3.38263 13.1692 0 10.0953 0 6.325C0 3.245 2.42 0.825001 5.5 0.825001C7.24 0.825001 8.91 1.635 10 2.915ZM10 16.475L10.1 16.375C14.86 12.065 18 9.215 18 6.325C18 4.325 16.5 2.825 14.5 2.825C12.96 2.825 11.46 3.815 10.94 5.185H9.07C8.54 3.815 7.04 2.825 5.5 2.825C3.5 2.825 2 4.325 2 6.325C2 9.215 5.14 12.065 9.9 16.375L10 16.475Z" fill="#3F2803"/>
                            </svg>
                        </a>
                    {/if}
                    {if $gdzSetting.productbox_quickview}
                        <a href="#" title="{l s='Quickview' d='Shop.Theme.Actions'}" data-link-action="quickview" class="btn-icon quick-view">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 2V16H16V9H18V16C18 17.1 17.1 18 16 18H2C0.89 18 0 17.1 0 16V2C0 0.9 0.89 0 2 0H9V2H2ZM11 2V0H18V7H16V3.41L6.17 13.24L4.76 11.83L14.59 2H11Z" fill="#3F2803"/>
                            </svg>
                        </a>
                    {/if}
                </div>
			</div>
		{/block}
        
		<div class="product-info">
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
    		
		</div>
	</div>
</div>
