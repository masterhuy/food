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
{if isset($smarty.get.header_layout) && $smarty.get.header_layout !=''}
    {assign var='header_layout' value=$smarty.get.header_layout}
{else}
    {assign var='header_layout' value=$gdzSetting.header_layout}
{/if}
<a href="{$urls.base_url}">
    {if $gdzSetting.logo_source == 'default'}
        <img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
    {elseif $gdzSetting.logo_source == 'image'}
        {assign var='image_length' value=$gdzSetting.logo_image|count_characters-4}
        <img
            class="logo img-responsive"
            src="{$gdzSetting.logo_image|substr:0:$image_length}-{$header_layout}.{$gdzSetting.logo_image|pathinfo:$smarty.const.PATHINFO_EXTENSION}"
            alt="{$shop.name}"
        />
    {elseif $gdzSetting.logo_source == 'text'}
        <span class="site-logo-text">{$gdzSetting.logo_text}</span>
    {/if}
</a>
