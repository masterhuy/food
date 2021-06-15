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
<div id="header-top" class="header-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="layout-column col-3 header-left">
                {include file='_partials/headers/logo.tpl'}
            </div>
            <div class="layout-column col-6 col-menu">
                {if $gdzSetting.search}
                    {widget_block name="gdz_ajaxsearch"}
                        {include 'module:gdz_ajaxsearch/views/templates/hook/gdz_ajaxsearch.tpl'}
                    {/widget_block}
                {/if}
            </div>
            <div class="layout-column col-3 header-right">
                <div class="row justify-content-end">
                    {if ($gdzSetting.customersignin == 1)}
                        {widget_block name="ps_customersignin"}
                            {include 'module:ps_customersignin/ps_customersignin.tpl'}
                        {/widget_block}
                    {/if}
                    {if ($gdzSetting.wishlist == 1)}
                        {include file='_partials/headers/wishlist.tpl'}
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
<div class="sticky-wrapper header-bottom {if $gdzSetting.header_sticky == 1} header-sticky{/if}{if ($gdzSetting.header_sticky == 1) && ($gdzSetting.header_sticky_effect != '')} {$gdzSetting.header_sticky_effect}{/if}">
    <div class="container">
        <div class="row align-items-center">
            <div class="layout-column col-auto col-left">
                <div id="ver-menu" class="vermenu d-flex align-items-center">
                    <a href="#" class="vermenu-btn align-items-center" data-toggle="dropdown" data-display="static">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="icon/image/dehaze_24px">
                                <path id="icon/image/dehaze_24px_2" fill-rule="evenodd" clip-rule="evenodd" d="M2 8V6H22V8H2ZM2 11V13H22V11H2ZM2 16V18H22V16H2Z" fill="#3F2803"/>
                            </g>
                        </svg>
                        <span>{$gdzSetting.vermenu_button_text nofilter}</span>
                    </a>
                    <div class="dropdown-menu navbar{if $gdzSetting.vermenu_class} {$gdzSetting.vermenu_class}{/if}">
                        {widget name="gdz_megamenu" hook='VerMenu'}
                    </div>
                </div>
            </div>
            <div class="layout-column position-static col col-center">
                <div id="hor-menu" class="{if $gdzSetting.hormenu_class} {$gdzSetting.hormenu_class}{/if} align-left">
                    {widget name="gdz_megamenu" hook='HorMenu'}
                </div>
            </div>
            <div class="layout-column col-auto col-right">
                <div class="hotline">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="icon/notification/phone_in_talk_24px">
                            <path id="icon/notification/phone_in_talk_24px_2" fill-rule="evenodd" clip-rule="evenodd" d="M16.43 14.93C17.55 15.3 18.75 15.5 20 15.5C20.55 15.5 21 15.95 21 16.5V20C21 20.55 20.55 21 20 21C10.61 21 3 13.39 3 4C3 3.45 3.45 3 4 3H7.5C8.05 3 8.5 3.45 8.5 4C8.5 5.25 8.7 6.45 9.07 7.57C9.18 7.92 9.1 8.31 8.82 8.57L6.62 10.78C8.06 13.62 10.38 15.93 13.21 17.37L15.41 15.17C15.61 14.98 15.86 14.88 16.12 14.88C16.22 14.88 16.33 14.9 16.43 14.93ZM19 12H21C21 7.03 16.97 3 12 3V5C15.87 5 19 8.13 19 12ZM15 12H17C17 9.24 14.76 7 12 7V9C13.66 9 15 10.34 15 12ZM6.53 5C6.6 5.88 6.75 6.75 6.98 7.58L5.78 8.79C5.38 7.58 5.12 6.32 5.03 5H6.53ZM15.2 18.21C16.4 18.62 17.68 18.88 19 18.97V17.46C18.12 17.4 17.25 17.25 16.4 17.01L15.2 18.21Z" fill="white"/>
                        </g>
                    </svg>
                    <span>{l s='Hotline: (01) 028-6677-1223' d='Shop.jmstheme'}</span>
                </div>
            </div>
        </div>
    </div>
</div>

