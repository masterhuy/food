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
{if isset($smarty.get.header_layout) && $smarty.get.header_layout !=''}
    {assign var='header_layout' value=$smarty.get.header_layout}
    {assign var='header_layout_link' value="_partials/headers/header-`$smarty.get.header_layout`.tpl"}
{else}
    {assign var='header_layout' value=$gdzSetting.header_layout}
    {assign var='header_layout_link' value="_partials/headers/header-`$gdzSetting.header_layout`.tpl"}
{/if}

<div id="desktop-header" class="header-{$header_layout} {if $gdzSetting.header_class} {$gdzSetting.header_class}{/if}">
    {include file=$header_layout_link}
</div>
<div id="mobile-header" class="header-mobile-{$gdzSetting.header_mobile_layout} {if $gdzSetting.header_class} {$gdzSetting.header_class}{/if}">
    {if $gdzSetting.header_mobile_layout == 1}
        {include file='_partials/headers/header-mobile-1.tpl'}
    {elseif $gdzSetting.header_mobile_layout == 2}
        {include file='_partials/headers/header-mobile-2.tpl'}
    {elseif $gdzSetting.header_mobile_layout == 3}
        {include file='_partials/headers/header-mobile-3.tpl'}
    {else}
        {include file='_partials/headers/header-mobile-4.tpl'}
    {/if}
</div>
