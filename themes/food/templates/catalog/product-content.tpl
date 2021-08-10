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
<div class="row product-detail {$product_content_layout}">
    <div class="pb-left-column col-xl-6 col-lg-7 col-sm-12 col-12">
        <div class="pd-left-content">
            {block name='page_content_container'}
                <section class="page-content" id="content">
                    {block name='page_content'}
                        {block name='product_cover_thumbnails'}
                            {include file='catalog/_partials/product-cover-thumbnails.tpl'}
                        {/block}
                    {/block}
                </section>
            {/block}
        </div>
    </div>
    <div class="pb-right-column col-xl-6 col-lg-5 col-sm-12 col-12">
        <div class="pd-right-content">
            {block name='page_header_container'}
                {block name='page_header'}
                    <h1 itemprop="name" class="product-name">{block name='page_title'}{$product.name}{/block}</h1>
                {/block}
            {/block}
            {block name='product_prices'}
                {include file='catalog/_partials/product-prices.tpl'}
            {/block}
            <div class="rating">
                {hook h='displayProductButtons' product=$product}
            </div>
            <div class="product-information">
                {block name='product_description_short'}
                    <div id="product-description-short-{$product.id}" class="product-desc">{$product.description_short nofilter}</div>
                {/block}

                <div class="available-quantity">
                    <span></span>
                    {l s='available in stock' d='Shop.Theme.Catalog'}
                </div>
                
                {if isset($product.specific_prices.to) && $product.specific_prices.to > 0}
                    <div class="specific_prices">
                        <div class="countdown-box">
                            <div class="countdown">{$product.specific_prices.to}</div>
                        </div>
                    </div>
                {/if}

                {if $product.is_customizable && count($product.customizations.fields)}
                    {block name='product_customization'}
                        {include file="catalog/_partials/product-customization.tpl" customizations=$product.customizations}
                    {/block}
                {/if}

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
                                        <article>
                                            <div class="card">
                                                <div class="pack-product-container table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{l s='Products' d='Shop.Theme.Catalog'}</th>
                                                                <th>{l s='Price' d='Shop.Theme.Catalog'}</th>
                                                                <th>{l s='Quantity' d='Shop.Theme.Catalog'}</th>
                                                            </tr>
                                                        </thead>
                                                        {foreach from=$packItems item="product_pack"}
                                                            {block name='product_miniature'}
                                                                {include file='catalog/_partials/miniatures/pack-product.tpl' product=$product_pack}
                                                            {/block}
                                                        {/foreach}
                                                    </table>
                                                </div>
                                            </div>
                                        </article>
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
                                        {$product.category_name|escape:'html':'UTF-8'}
                                    </a
                                </li>
                                <li>
                                    {if $product.additional_shipping_cost > 0}
                                        <label>{l s='Shipping tax:' d='Shop.Theme.Catalog'}</label>
                                        <span class="shipping_cost">{$product.additional_shipping_cost}</span>
                                    {else}
                                        <label>{l s='Shipping tax:' d='Shop.Theme.Catalog'}</label>
                                        <span class="shipping_cost">{l s=' Free' d='Shop.Theme.Catalog'}</span>
                                    {/if}
                                </li>
                            </ul>
                            {hook h='displayReassurance'}
                            {block name='product_additional_info'}
                                {include file='catalog/_partials/product-additional-info.tpl'}
                            {/block}
                            {block name='product_refresh'}
                                <input class="product-refresh ps-hidden-by-js" name="refresh" type="submit" value="{l s='Refresh' d='Shop.Theme.Actions'}">
                            {/block}
                        </form>
                    {/block}
                </div>
                
            </div>
        </div>
    </div>
</div>
