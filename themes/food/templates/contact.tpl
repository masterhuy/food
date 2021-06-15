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

{extends file='layouts/layout-full-width.tpl'}
{block name='content'}
    <section id="main">
        {block name='page_content_container'}
            <section id="content" class="page-content">
                {block name='page_header_container'}{/block}
                {if $gdzSetting.contact_page_layout == 'layout-1'}
                {include file='_partials/contacts/layout-1.tpl'}
                {elseif $gdzSetting.contact_page_layout == 'layout-2'}
                {include file='_partials/contacts/layout-2.tpl'}
                {elseif $gdzSetting.contact_page_layout == 'layout-3'}
                {include file='_partials/contacts/layout-3.tpl'}
                {elseif $gdzSetting.contact_page_layout == 'layout-4'}
                {include file='_partials/contacts/layout-4.tpl'}
                {/if}
            </section>
        {/block}
        {block name='page_footer_container'}
        {/block}
    </section>
{/block}