{*
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{extends file="layouts/layout-full-width.tpl"}
{block name='head_seo_title'}{$gdz_pagebuilder_page.title}{/block}
{block name='head_seo_description'}{$gdz_pagebuilder_page.meta_desc}{/block}
{block name='head_seo_keywords'}{$gdz_pagebuilder_page.meta_key}{/block}
{block name='content'}
    <section id="main">
        {block name='page_content_container'}
            <section id="content" class="page-content">
                {block name='page_content_top'}{/block}
								{block name="page_content"}
                <style id="pagebuilder-frontend-stylesheet" type="text/css">
                {$pagebuilder_css nofilter}
                </style>
								{foreach from=$rows item=row}
									<div id="{$row->id}" class="gdz-row {$row->class|escape:'htmlall':'UTF-8'}">
                    <div class="container{if isset($row->settings->fluid) && $row->settings->fluid == '1'}-fluid{/if}">
    										<div class="row">
    										{foreach from=$row->cols key=cindex item=column}
    											<div id="{$column->id}" class="layout-column {$column->class|escape:'htmlall':'UTF-8'}">
    												{foreach from=$column->addons key=aindex item=addon}
    													<div id="{$addon->id}" class="addon-box">
    														{if isset($addon->return_value) && $addon->return_value}{$addon->return_value nofilter}{/if}
    													</div>
    												{/foreach}
    											</div>
    										{/foreach}
    										</div>
										</div>
									</div>
								{/foreach}
								{/block}
            </section>
        {/block}
        {block name='page_footer_container'}
        {/block}
    </section>
{/block}
