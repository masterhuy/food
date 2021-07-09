{**
 * 2007-2017 PrestaShop
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
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div id="header-top" class="header-top{if $gdzSetting.header_sticky == 1} header-sticky{/if}{if ($gdzSetting.header_sticky == 1) && ($gdzSetting.header_sticky_effect != '')} {$gdzSetting.header_sticky_effect}{/if}">
    <div class="container">
        <div class="row align-items-center">
            <div class="layout-column col-auto header-left">
                {include file='_partials/headers/logo.tpl'}
            </div>
            <div class="layout-column col">
                <div id="hor-menu" class="{if $gdzSetting.hormenu_class} {$gdzSetting.hormenu_class}{/if} align-left">
                    {widget name="gdz_megamenu" hook='HorMenu'}
                </div>
            </div>
            <div class="layout-column col-auto header-right">
                <div class="row justify-content-end align-items-center">
                    <div class="hotline">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="icon/notification/phone_in_talk_24px">
                            <path id="icon/notification/phone_in_talk_24px_2" fill-rule="evenodd" clip-rule="evenodd" d="M16.4299 14.93C17.5499 15.3 18.7499 15.5 19.9999 15.5C20.5499 15.5 20.9999 15.95 20.9999 16.5V20C20.9999 20.55 20.5499 21 19.9999 21C10.6099 21 2.99988 13.39 2.99988 4C2.99988 3.45 3.44988 3 3.99988 3H7.49988C8.04988 3 8.49988 3.45 8.49988 4C8.49988 5.25 8.69988 6.45 9.06988 7.57C9.17988 7.92 9.09988 8.31 8.81988 8.57L6.61988 10.78C8.05988 13.62 10.3799 15.93 13.2099 17.37L15.4099 15.17C15.6099 14.98 15.8599 14.88 16.1199 14.88C16.2199 14.88 16.3299 14.9 16.4299 14.93ZM18.9999 12H20.9999C20.9999 7.03 16.9699 3 11.9999 3V5C15.8699 5 18.9999 8.13 18.9999 12ZM14.9999 12H16.9999C16.9999 9.24 14.7599 7 11.9999 7V9C13.6599 9 14.9999 10.34 14.9999 12ZM6.52988 5C6.59988 5.88 6.74988 6.75 6.97988 7.58L5.77988 8.79C5.37988 7.58 5.11988 6.32 5.02988 5H6.52988ZM15.1999 18.21C16.3999 18.62 17.6799 18.88 18.9999 18.97V17.46C18.1199 17.4 17.2499 17.25 16.3999 17.01L15.1999 18.21Z" fill="#3F2803"/>
                            </g>
                        </svg>
                        <span>{l s='(01) 028-6677-1223' d='Shop.jmstheme'}</span>
                    </div>
                    {if $gdzSetting.search}
                        {if $gdzSetting.search_box_type != 'dropdown'}
                            {widget_block name="gdz_ajaxsearch"}
                                {include 'module:gdz_ajaxsearch/views/templates/hook/gdz_ajaxsearch-button.tpl'}
                            {/widget_block}
                        {else}
                            {widget_block name="gdz_ajaxsearch"}
                                {include 'module:gdz_ajaxsearch/views/templates/hook/gdz_ajaxsearch-dropdown.tpl'}
                            {/widget_block}
                        {/if}
                    {/if}
                    {if ($gdzSetting.cart == 1)}
                        {widget_block name="ps_shoppingcart"}
                            {include 'module:ps_shoppingcart/ps_shoppingcart.tpl'}
                        {/widget_block}
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

