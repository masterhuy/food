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
{if $gdzSetting.shop_layout == 'right-sidebar'}
 {assign var='layout' value='layouts/layout-right-column.tpl'}
{elseif $gdzSetting.shop_layout == 'left-sidebar'}
 {assign var='layout' value='layouts/layout-left-column.tpl'}
{elseif $gdzSetting.shop_layout == 'no-sidebar'}
 {assign var='layout' value='layouts/layout-full-width.tpl'}
{/if}
{if isset($smarty.get.shop_layout) && $smarty.get.shop_layout == 'right-sidebar'}
    {assign var='layout' value='layouts/layout-right-column.tpl'}
{elseif isset($smarty.get.shop_layout) && $smarty.get.shop_layout == 'left-sidebar'}
    {assign var='layout' value='layouts/layout-left-column.tpl'}
{elseif isset($smarty.get.shop_layout) && $smarty.get.shop_layout == 'no-sidebar'}
    {assign var='layout' value='layouts/layout-full-width.tpl'}
{/if}
{if isset($smarty.get.shop_list) && $smarty.get.shop_list != ''}
    {assign var='shop_list' value=$smarty.get.shop_list}
{else}
    {assign var='shop_list' value=$gdzSetting.shop_list}
{/if}
{if isset($smarty.get.shop_grid_column) && $smarty.get.shop_grid_column != ''}
    {assign var='shop_grid_column' value=$smarty.get.shop_grid_column}
{else}
    {assign var='shop_grid_column' value=$gdzSetting.shop_grid_column}
{/if}
{extends file=$layout}
{block name='content'}
    <section id="main">
        {block name='product_list_header'}
            <h2 id="js-product-list-header" class="h2">{$listing.label}</h2>
        {/block}
        <section id="products">
            {if $listing.products|count}
                <div id="products-top">
                    {block name='product_list_top'}
                        {include file='catalog/_partials/products-top.tpl' listing=$listing}
                    {/block}
                </div>
                {if $gdzSetting.shop_activefilter == 1}
                    {block name='product_list_active_filters'}
                        <div id="active-filter" class="hidden-sm-down">
                            {$listing.rendered_active_filters nofilter}
                        </div>
                    {/block}
                {/if}
                <div id="product_list" data-grid="{$shop_grid_column}" class="product_list {if $shop_list == 'grid'}products-grid grid-{$shop_grid_column}{else}products-list{/if}">
                    {if $shop_grid_column == '1-2-1-2' || $shop_grid_column == '1-3-1-3' || $shop_grid_column == '2-1-2-1' || $shop_grid_column == '3-1-3-1'}
                        {block name='product_list'}
                            {include file='catalog/_partials/products-big.tpl' listing=$listing}
                        {/block}
                    {else}
                        {block name='product_list'}
                            {include file='catalog/_partials/products.tpl' listing=$listing}
                        {/block}
                    {/if}
                </div>
                <div id="js-product-list-bottom">
                    {block name='product_list_bottom'}
                        {include file='catalog/_partials/products-bottom.tpl' listing=$listing}
                    {/block}
                </div>
            {else}
                {include file='errors/not-found.tpl'}
            {/if}
        </section>
    </section>
{/block}
