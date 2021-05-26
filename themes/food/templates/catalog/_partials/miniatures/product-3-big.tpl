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

<div class="product-miniature js-product-miniature productbox-3" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
	<div class="product-preview">
		{block name='product_thumbnail'}
		  	<a href="{$product.url}" class="product-image{if $gdzSetting.productbox_hover == 'swap-image' && isset($product.images.1) && $product.images.1} swap-image{else} blur-image{/if}">
				<img class="img-responsive product-img1{if $gdzSetting.carousel_lazyload} owl-lazy{/if}"
            {if $gdzSetting.carousel_lazyload}data-src="{$product.cover.bySize.large_default.url}"{else}
				    src = "{$product.cover.bySize.large_default.url}"
            {/if}
				    alt = "{$product.cover.legend}"
					title="{$product.name|escape:'html':'UTF-8'}"
				    data-full-size-image-url = "{$product.cover.large.url}"
				/>
				{if $gdzSetting.productbox_hover == 'swap-image' && isset($product.images.1) && $product.images.1}
					<img class="img-responsive product-img2{if $gdzSetting.carousel_lazyload} owl-lazy{/if}"
              {if $gdzSetting.carousel_lazyload}data-src="{$product.images.1.bySize.large_default.url}"{else}
					    src = "{$product.images.1.bySize.large_default.url}"
              {/if}
					    alt = "{$product.images.1.legend}"
						title="{$product.name|escape:'html':'UTF-8'}"
					    data-full-size-image-url = "{$product.images.1.large.url}"
					/>
				{/if}
		  	</a>
		{/block}
    <div class="product-button">
      {if !$configuration.is_catalog && $gdzSetting.productbox_addtocart}
          {if $product.quantity >= 1}
          <a href="#" class="btn ajax-add-to-cart product-btn{if $product.quantity < 1} disabled{/if} cart-button" {if $product.quantity < 1}disabled{/if} title="{if $product.quantity < 1}{l s='Sold Out' d='Shop.Theme.Actions'}{else}{l s='Add to cart' d='Shop.Theme.Actions'}{/if}" {if $product.quantity < 1}disabled{/if} data-id-product="{$product.id}" data-minimal-quantity="{$product.minimal_quantity}" data-token="{if isset($static_token) && $static_token}{$static_token}{/if}">
              <span class="text-addcart">{l s='Add to cart' d='Shop.Theme.Actions'}</span>
          </a>
          {else}
          <a href="#" class="btn product-btn disabled" disabled title="{l s='Sold Out' d='Shop.Theme.Actions'}" data-id-product="{$product.id}" data-minimal-quantity="{$product.minimal_quantity}">
              <span class="text-outofstock">{l s='Out of stock' d='Shop.Theme.Actions'}</span>
          </a>
          {/if}
      {/if}
      {if $gdzSetting.productbox_quickview}
          <a href="#" data-link-action="quickview" title="{l s='Quick View' d='Shop.Theme.Actions'}" class="btn quick-view">{l s='Quick View' d='Shop.Theme.Actions'}</a>
      {/if}
    </div>
    {if $product.main_variants && $gdzSetting.productbox_variant}
        {block name='product_variants'}
              {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
        {/block}
    {/if}
	</div>

	<div class="product-info">
        <div class="title-price align-items-center">
    		    {block name='product_name'}
              {if $page.page_name == 'index'}
                <h3 class="product-title text-left" itemprop="name"><a class="product-link" href="{$product.canonical_url}">{$product.name|truncate:20:'...'}</a></h3>
              {else}
                <h3 class="product-title text-left" itemprop="name"><a class="product-link" href="{$product.canonical_url}">{$product.name|truncate:20:'...'}</a></h2>
              {/if}
            {/block}
            <div class="text-right">
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
    		{block name='product_variants'}
    			{if $product.main_variants}
    				{if isset($jpb_pcolor) && $jpb_pcolor == 1}
    					<div class="color_to_pick_list">
    						{include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
    					</div>
    				{/if}
    			{/if}
    		{/block}

    		<div class="product-short-desc">
    			{$product.description_short|truncate:300:'...' nofilter}
    		</div>

	</div>
</div>
