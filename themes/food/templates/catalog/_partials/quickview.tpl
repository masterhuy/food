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
<div id="quickview-modal-{$product.id}-{$product.id_product_attribute}" class="modal fade quickview-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog container" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ptw-icon {$gdzSetting.close_icon}"></i>
                </button>
            </div>
            <div class="modal-body" id="main">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 left">
                        {block name='product_cover_thumbnails'}
                            {include file='catalog/_partials/product-cover-thumbnails-quickview.tpl'}
                        {/block}
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 right">
                        {block name='page_header_container'}
                            {block name='page_header'}
                                <h2 itemprop="name" class="product-name">{block name='page_title'}{$product.name}{/block}</h2>
                            {/block}
                        {/block}
                        {block name='product_prices'}
                            {include file='catalog/_partials/product-prices.tpl'}
                        {/block}

                        <div class="product-information">
                            {block name='product_description_short'}
                                <div id="product-description-short-{$product.id}" class="product-desc">{$product.description_short|truncate:350:"..." nofilter}</div>
                            {/block}

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
                                                            <div class="pack-product-container">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Products</th>
                                                                            <th>Price</th>
                                                                            <th>Quantity</th>
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

                                    </form>
                                {/block}
                            </div>

                            <ul class="other-info">
                                {if $product.reference}
                                    <!-- number of item in stock -->
                                    <li id="product_reference">
                                        <label>{l s='Product Code:' d='Shop.Theme.Catalog'}</label>
                                        <span class="editable">{$product.reference}</span>
                                    </li>
                                {/if}
                                <!-- availability or doesntExist -->
                                <li id="availability_statut">
                                    <label id="availability_label">
                                        {l s='Availability:' d='Shop.Theme.Catalog'}
                                    </label>
                                    <span id="availability_value" class="label-availability">
                                        {if $product.quantity|intval <= 0}
                                            {l s='Out stock' d='Shop.Theme.Catalog'}
                                        {else}
                                            {l s='In stock' d='Shop.Theme.Catalog'}
                                        {/if}
                                    </span>
                                </li>
                                <li>
                                    {if $product.additional_shipping_cost > 0}
                                        <label>{l s='Shipping tax: '}</label>
                                        <span class="shipping_cost">{$product.additional_shipping_cost}</span>
                                    {else}
                                        <label>{l s='Shipping tax:'}</label>
                                        <span class="shipping_cost">{l s=' Free'}</span>
                                    {/if}
                                </li>
                            </ul>
                        </div>
                        {if $gdzSetting.quickview_sharing}
                        {hook h='displayProductButtons' product=$product}
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
