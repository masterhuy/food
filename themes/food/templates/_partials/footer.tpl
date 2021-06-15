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
{if isset($smarty.get.footer_layout) && $smarty.get.footer_layout !=''}
    {assign var='footer_layout' value=$smarty.get.footer_layout}
    {assign var='footer_layout_link' value="_partials/footers/footer-`$smarty.get.footer_layout`.tpl"}
{else}
    {assign var='footer_layout' value=$gdzSetting.footer_layout}
    {assign var='footer_layout_link' value="_partials/footers/footer-`$gdzSetting.footer_layout`.tpl"}
{/if}
{block name="footer"}
    <footer id="footer" class="footer-{$footer_layout} {if $gdzSetting.footer_class} {$gdzSetting.footer_class}{/if}">
        {include file=$footer_layout_link}
    </footer>
{/block}

