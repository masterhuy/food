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
<div class="product-add-to-cart">
    {if !$configuration.is_catalog}
        {block name='product_quantity'}
            <div class="product-quantity">
                <div class="customs">
                    <div class="qty">
                        <input
                            type="text"
                            name="qty"
                            id="quantity_wanted"
                            value="{$product.quantity_wanted}"
                            class="input-group"
                            min="{$product.minimal_quantity}"
                            aria-label="{l s='Quantity' d='Shop.Theme.Actions'}"
                        />
                    </div>
                </div>
      		      <div class="add">
                    <button
                        title="{if $product.quantity < 1}{l s='Sold Out' d='Shop.Theme.Actions'}{else}{l s='Add to Cart' d='Shop.Theme.Actions'}{/if}"
                        class="btn btn-default btn-active add-to-cart product-btn cart-button
                        {if $product.quantity < 1}disabled{/if}"
                        data-button-action="add-to-cart"
                        type="submit"
                        data-dismiss="modal"
                        {if !$product.add_to_cart_url}disabled{/if}
                    >
                        <span class="icon spinner">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                            <path fill="#fff" d="M12.9 3.1c1.3 1.2 2.1 3 2.1 4.9 0 3.9-3.1 7-7 7s-7-3.1-7-7c0-1.9 0.8-3.7 2.1-4.9l-0.8-0.8c-1.4 1.5-2.3 3.5-2.3 5.7 0 4.4 3.6 8 8 8s8-3.6 8-8c0-2.2-0.9-4.2-2.3-5.7l-0.8 0.8z"></path>
                            </svg>
                        </span>
				        <span class="icon check">
                            <svg width="16" height="16" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="229.153px" height="229.153px" viewBox="0 0 229.153 229.153" style="enable-background:new 0 0 229.153 229.153;"
                                xml:space="preserve">
                            <g>
                                <path fill="#fff" d="M92.356,223.549c7.41,7.5,23.914,5.014,25.691-6.779c11.056-73.217,66.378-134.985,108.243-193.189
                                    C237.898,7.452,211.207-7.87,199.75,8.067C161.493,61.249,113.274,117.21,94.41,181.744
                                    c-21.557-22.031-43.201-43.853-67.379-63.212c-15.312-12.265-37.215,9.343-21.738,21.737
                                    C36.794,165.501,64.017,194.924,92.356,223.549z"/>
                            </g>
                            </svg>
                        </span>
                        {if $product.quantity >= 1}
                        <span class="text-addcart">{l s='Add to cart' d='Shop.Theme.Actions'}</span>
                        {else}
                        <span class="text-outofstock">{l s='Out of stock' d='Shop.Theme.Actions'}</span>
                        {/if}
                    </button>
                </div>
                {hook h='displayProductActions' product=$product}
            </div>
            {block name='product_availability'}
            {if $product.show_availability && $product.availability_message}
                <span id="product-availability">
                    {if $product.availability == 'available'}
                        
                    {elseif $product.availability == 'last_remaining_items'}
                        <span>{l s='last item' d='Shop.Theme.Catalog'}</span>
                    {else}
                        <span>{$product.availability_message}</span>
                    {/if}
                </span>
            {/if}
        {/block}
            {if $gdzSetting.productbox_wishlist}
                <a href="#" class="addToWishlist" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|escape:'html'}', false, 1); return false;" data-id-product="{$product.id_product|escape:'html'}" title="{l s='Add to Wishlist'}">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 4.30067C11.4537 3.18067 12.915 2.47192 14.4375 2.47192C17.1325 2.47192 19.25 4.58942 19.25 7.28442C19.25 10.5892 16.2799 13.2825 11.7798 17.3631L11.7688 17.3732L10.5 18.5282L9.23125 17.3819L9.19671 17.3505C4.7098 13.2731 1.75 10.5835 1.75 7.28442C1.75 4.58942 3.8675 2.47192 6.5625 2.47192C8.085 2.47192 9.54625 3.18067 10.5 4.30067ZM10.5 16.1657L10.5875 16.0782C14.7525 12.3069 17.5 9.81317 17.5 7.28442C17.5 5.53442 16.1875 4.22192 14.4375 4.22192C13.09 4.22192 11.7775 5.08817 11.3225 6.28692H9.68625C9.2225 5.08817 7.91 4.22192 6.5625 4.22192C4.8125 4.22192 3.5 5.53442 3.5 7.28442C3.5 9.81317 6.2475 12.3069 10.4125 16.0782L10.5 16.1657Z" fill="#3F2803" fill-opacity="0.7"/>
                    </svg>
                    <span>{l s='Add to wishlist' d='Shop.Theme.Catalog'}</span>
                </a>
            {/if}
            <div class="clearfix"></div>
        {/block}
        {block name='product_minimal_quantity'}
            <p class="product-minimal-quantity">
                {if $product.minimal_quantity > 1}
                    {l
                        s='The minimum purchase order quantity for the product is %quantity%.'
                        d='Shop.Theme.Checkout'
                        sprintf=['%quantity%' => $product.minimal_quantity]
                    }
                {/if}
            </p>
        {/block}
        
    {/if}
</div>
