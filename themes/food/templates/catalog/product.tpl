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
{if $gdzSetting.product_page_layout == 'right-sidebar'}
  {assign var='layout' value='layouts/layout-right-column.tpl'}
{elseif $gdzSetting.product_page_layout == 'left-sidebar'}
  {assign var='layout' value='layouts/layout-left-column.tpl'}
{elseif $gdzSetting.product_page_layout == 'no-sidebar'}
  {assign var='layout' value='layouts/layout-full-width.tpl'}
{/if}
{if isset($smarty.get.product_page_layout) && $smarty.get.product_page_layout == 'right-sidebar'}
    {assign var='layout' value='layouts/layout-right-column.tpl'}
{elseif isset($smarty.get.product_page_layout) && $smarty.get.product_page_layout == 'left-sidebar'}
    {assign var='layout' value='layouts/layout-left-column.tpl'}
{elseif isset($smarty.get.product_page_layout) && $smarty.get.product_page_layout == 'no-sidebar'}
    {assign var='layout' value='layouts/layout-full-width.tpl'}
{/if}
{extends file=$layout}
{block name='head_seo' prepend}
    <link rel="canonical" href="{$product.canonical_url}">
{/block}

{block name='head' append}
    <meta property="og:type" content="product">
    <meta property="og:url" content="{$urls.current_url}">
    <meta property="og:title" content="{$page.meta.title}">
    <meta property="og:site_name" content="{$shop.name}">
    <meta property="og:description" content="{$page.meta.description}">
    <meta property="og:image" content="{$product.cover.large.url}">
    <meta property="product:pretax_price:amount" content="{$product.price_tax_exc}">
    <meta property="product:pretax_price:currency" content="{$currency.iso_code}">
    <meta property="product:price:amount" content="{$product.price_amount}">
    <meta property="product:price:currency" content="{$currency.iso_code}">
    {if isset($product.weight) && ($product.weight != 0)}
        <meta property="product:weight:value" content="{$product.weight}">
        <meta property="product:weight:units" content="{$product.weight_unit}">
    {/if}
{/block}

{block name='content'}
    <section id="main" itemscope itemtype="https://schema.org/Product">
        <meta itemprop="url" content="{$product.url}">
        {if isset($smarty.get.product_content_layout) && $smarty.get.product_content_layout !=''}
            {assign var='product_content_layout' value=$smarty.get.product_content_layout}
        {else}
            {assign var='product_content_layout' value=$gdzSetting.product_content_layout}
        {/if}
        {if $product_content_layout == '3-columns'}
          {include file='catalog/product-content-3columns.tpl'}
        {else}
          {include file='catalog/product-content.tpl'}
        {/if}
        {if $gdzSetting.product_page_moreinfos_type == 'accordion'}
        {include file='catalog/more-infos-accordion.tpl'}
        {else}
        {include file='catalog/more-infos-tab.tpl'}
        {/if}

        {block name='product_accessories'}
            {if $accessories && $gdzSetting.product_page_accessories}
                <section class="product-accessories clearfix">
                    <div class="addon-title">
                        <h3>{l s='Related Products' d='Shop.Theme.Catalog'}</h3>
                    </div>
                    <div class="products owl-carousel" data-items="4" data-lg="4" data-md="3" data-sm="2" data-xs="1">
                        {foreach from=$accessories item="product_accessory"}
                            <div class="item ajax_block_product">
                                {block name='product_miniature'}
                                    {include file='catalog/_partials/miniatures/product.tpl' product=$product_accessory}
                                {/block}
                            </div>
                        {/foreach}
                    </div>
                </section>
            {/if}
        {/block}

        {block name='product_footer_before'}
            {hook h='displayFooterBefore' product=$product category=$category}
        {/block}

        {block name='product_images_modal'}
            {include file='catalog/_partials/product-images-modal.tpl'}
        {/block}

        {block name='page_footer_container'}

        {/block}
    </section>
{/block}
