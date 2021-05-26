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

 <div class="pricing-box" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
   <div class="pricing-header">
   {block name='product_name'}
    <h3 class="product-title" itemprop="name">{$product.name|truncate:30:'...'}</h3>
   {/block}
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
  </div>
  <div class="product-short-desc">
  		{$product.description_short|truncate:300:'...' nofilter}
  </div>
  <div class="col-action">
      {if $product.add_to_cart_url}
      <a href="#" class="btn ajax-add-to-cart product-btn cart-button btn-fullwidth" title="{l s='Buy Now' d='Shop.Theme.Actions'}" data-id-product="{$product.id}" data-minimal-quantity="{$product.minimal_quantity}" data-token="{if isset($static_token) && $static_token}{$static_token}{/if}">
          <span class="text-addcart">{l s='Buy Now' d='Shop.Theme.Actions'}</span>
      </a>
      {else}
      <a href="#" class="btn product-btn disabled btn-fullwidth" disabled title="{l s='Sold Out' d='Shop.Theme.Actions'}" data-id-product="{$product.id}" data-minimal-quantity="{$product.minimal_quantity}">
          <span class="text-outofstock">{l s='Out of stock' d='Shop.Theme.Actions'}</span>
      </a>
      {/if}
  </div>
 </div>
