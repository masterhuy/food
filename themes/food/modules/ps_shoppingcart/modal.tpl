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
<div id="blockcart-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="icon/navigation/close_24px">
                    <path id="icon/navigation/close_24px_2" d="M23.75 8.0125L21.9875 6.25L15 13.2375L8.0125 6.25L6.25 8.0125L13.2375 15L6.25 21.9875L8.0125 23.75L15 16.7625L21.9875 23.75L23.75 21.9875L16.7625 15L23.75 8.0125Z" fill="black" fill-opacity="0.54"/>
                    </g>
                </svg>
            </button>
            <div class="modal-body">
                <h4 class="modal-title text-xs-center" id="myModalLabel">{l s='Add to cart successfully!' d='Shop.Theme.Checkout'}</h4>
                <img class="product-image" src="{$product.cover.medium.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}" itemprop="image">
                <div class="product-link">{$product.name}</div>
                <div class="content_price">
                    <span class="price new">{$product.price}</span>
                </div>
                {hook h='displayProductPriceBlock' product=$product type="unit_price"}
                <div class="product-attributes">
                    {foreach from=$product.attributes item="property_value" key="property"}
                        <span>{l s='%label%:' sprintf=['%label%' => $property] d='Shop.Theme.Global'}<strong> {$property_value}</strong></span>
                    {/foreach}
                </div>
                {if $cart.products_count > 1}
                    <p class="cart-products-count">{l s='There are %products_count% items in your cart.' sprintf=['%products_count%' => $cart.products_count] d='Shop.Theme.Checkout'}</p>
                {else}
                    <p class="cart-products-count">{l s='There is %product_count% item in your cart.' sprintf=['%product_count%' =>$cart.products_count] d='Shop.Theme.Checkout'}</p>
                {/if}
                {if $cart.subtotals.shipping.value}
                    <div class="row align-items-center">
                        <span class="col-6 label">{l s='Shipping:' d='Shop.Theme.Checkout'}</span>
                        <span class="col-6 shipping value">{$cart.subtotals.shipping.value} {hook h='displayCheckoutSubtotalDetails' subtotal=$cart.subtotals.shipping}</span>
                    </div>
                {/if}
                <div class="total-price price row align-items-center">
                    <span class="col-6 label">{l s='Total:' d='Shop.Theme.Checkout'}</span>
                    <span class="col-6 value">{$cart.totals.total.value} {$cart.labels.tax_short}</span>
                </div>
                <div class="group-btn">
                    <a class="btn btn-default" data-dismiss="modal">
                        {l s='Continue shopping' d='Shop.Theme.Actions'}
                    </a>
                    <a class="btn btn-default" href="{$cart_url}" rel="nofollow">
                        {l s='View cart' d='Shop.Theme.Actions'}
                    </a>
                </div>
                <a href="{$cart_url}" class="btn btn-active w-100">
                    {l s='Proceed to checkout' d='Shop.Theme.Actions'}
                </a>
            </div>
        </div>
    </div>
</div>
