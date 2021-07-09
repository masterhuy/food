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
<div class="row product-detail product-layout-3columns">
	<div class="col-left col-12 col-md-6 col-lg-4">
		<div class="pd-left-content">
			{block name='page_content_container'}
				<section class="page-content" id="content">
				{block name='page_content'}
					{block name='product_cover_thumbnails'}
						{include file='catalog/_partials/product-cover-thumbnails-3-columns.tpl'}
					{/block}
				{/block}
				</section>
			{/block}
		</div>
	</div>
	<div class="col-right col-12 col-md-6 col-lg-8">
		<div class="row">
			<div class="col-12 col-lg-7">
				{block name='page_header_container'}
					{block name='page_header'}
						<h1 class="product-name" itemprop="name">{block name='page_title'}{$product.name}{/block}</h1>
					{/block}
				{/block}

				{hook h='displayProductPriceBlock' product=$product type="old_price"}
				
				<div class="product-information">
					{block name='product_description_short'}
						<div id="product-description-short-{$product.id}" class="product-desc"itemprop="description">{$product.description_short|truncate:800:"..." nofilter}</div>
					{/block}

					{if $product.is_customizable && count($product.customizations.fields)}
						{block name='product_customization'}
							{include file="catalog/_partials/product-customization.tpl" customizations=$product.customizations}
						{/block}
					{/if}

					<ul class="other-info">
						{if isset($product.reference_to_display) && $product.reference_to_display neq ''}
							<li class="product-reference">
								<label>{l s='SKU' d='Shop.Theme.Catalog'}: </label>
								<span itemprop="sku">{$product.reference_to_display}</span>
							</li>
						{/if}
						<li class="product-category">
							<label>{l s='Category:' d='Shop.Theme.Catalog'}</label>
							<a class="editable" href="{url entity='category' id=$product.id_category_default}">
								{$product.category|escape:'html':'UTF-8'}
							</a
						</li>
						<li>
							{if $product.additional_shipping_cost > 0}
								<label>{l s='Shipping tax : '}</label>
								<span class="shipping_cost">{$product.additional_shipping_cost}</span>
							{else}
								<label>{l s='Shipping tax : '}</label>
								<span class="shipping_cost">{l s=' Free'}</span>
							{/if}
						</li>
					</ul>
					{hook h='displayReassurance'}
					{block name='product_additional_info'}
						{include file='catalog/_partials/product-additional-info.tpl'}
					{/block}
				</div>
			</div>
			<div class="col-12 col-lg-5">
				<div class="content-wrapper">
					<div class="product-information">
						<div class="available-quantity">
							<span></span>
							{l s='available in stock' d='Shop.Theme.Catalog'}
						</div>
					</div>
					{block name='product_prices'}
						{include file='catalog/_partials/product-prices.tpl'}
					{/block}
					<div class="product-actions">
						{block name='product_buy'}
							<form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
								<input type="hidden" name="token" value="{$static_token}">
								<input type="hidden" name="id_product" value="{$product.id}" id="product_page_product_id">
								<input type="hidden" name="id_customization" value="{$product.id_customization}" id="product_customization_id">
								{block name='product_pack'}
								{if $packItems}
									<section class="product-pack">
										<h3 class="h4">{l s='This pack contains' d='Shop.Theme.Catalog'}</h3>
										{foreach from=$packItems item="product_pack"}
											{block name='product_miniature'}
												{include file='catalog/_partials/miniatures/pack-product.tpl' product=$product_pack}
											{/block}
										{/foreach}
									</section>
								{/if}
								{/block}
								{block name='product_discounts'}
									{include file='catalog/_partials/product-discounts.tpl'}
								{/block}
								{block name='product_variants'}
									{include file='catalog/_partials/product-variants.tpl'}
								{/block}

								{block name='product_add_to_cart'}
									{include file='catalog/_partials/product-add-to-cart.tpl'}
								{/block}

								{block name='product_refresh'}
									<input class="product-refresh ps-hidden-by-js" name="refresh" type="submit" value="{l s='Refresh' d='Shop.Theme.Actions'}">
								{/block}
							</form>
						{/block}
					</div>
				</div>
			</div>
			<div class="col-12">
				{if $gdzSetting.product_page_moreinfos_type == 'accordion'}
					{include file='catalog/more-infos-accordion.tpl'}
				{else}
					{include file='catalog/more-infos-tab.tpl'}
				{/if}
			</div>
		</div>
	</div>
</div>

