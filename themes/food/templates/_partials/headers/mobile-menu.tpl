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
<div class="bg-overlay"></div>
<a id="mobile-menu-toggle" class="open-button hidden-lg">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g id="icon/navigation/menu_24px">
            <path id="icon/navigation/menu_24px_2" fill-rule="evenodd" clip-rule="evenodd" d="M3 8V6H21V8H3ZM3 13H21V11H3V13ZM3 18H21V16H3V18Z" fill="#3F2803"/>
        </g>
    </svg>
</a>
<div class="mobile-menu-wrap hidden-lg">
    <button id="mobile-menu-close" class="close-button">
        <h3>{l s='Menu' d='Shop.Theme.Catalog'}</h3> 
        <svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="icon/navigation/close_24px">
                <path id="icon/navigation/close_24px_2" d="M23.75 8.0125L21.9875 6.25L15 13.2375L8.0125 6.25L6.25 8.0125L13.2375 15L6.25 21.9875L8.0125 23.75L15 16.7625L21.9875 23.75L23.75 21.9875L16.7625 15L23.75 8.0125Z" fill="#3F2803"/>
            </g>
        </svg>
    </button>
    <nav id="off-canvas-menu">
        {widget name="gdz_megamenu" hook='MobiMenu'}

        {widget_block name="ps_customersignin"}
            {include 'module:ps_customersignin/ps_customersignin-dropdown.tpl'}
        {/widget_block}
        {widget_block name="ps_currencyselector"}
            {include 'module:ps_currencyselector/ps_currencyselector.tpl'}
        {/widget_block}
        {widget_block name="ps_languageselector"}
            {include 'module:ps_languageselector/ps_languageselector.tpl'}
        {/widget_block}
    </nav>
</div>
