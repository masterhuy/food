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
{if isset($smarty.get.shop_grid_column) && $smarty.get.shop_grid_column != ''}
    {assign var='shop_grid_column' value=$smarty.get.shop_grid_column}
{else}
    {assign var='shop_grid_column' value=$gdzSetting.shop_grid_column}
{/if}
<div id="js-product-list-top" class="filters-panel">
	<div class="row align-items-center">
		<div class="col-4 col-md-6 col-sm-5 text-left">
			<div class="js-item-show d-none d-lg-inline"></div>
			{if !empty($listing.rendered_facets)}
				<button id="search_filter_toggler" class="btn btn-active d-lg-none mr-20">
					{l s='Filter' d='Shop.Theme.Actions'}
				</button>
			{/if}
			{if $gdzSetting.shop_switchlist == 1}
				<div class="view-mode">
					<a class="switch-view view-grid grid-2 {if $shop_grid_column == 2}active{/if}" href="#">
						<svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect width="5" height="19" fill="#E2E2E2"/>
							<rect x="7" width="5" height="19" fill="#E2E2E2"/>
						</svg>
					</a>
					<a
						class="switch-view view-grid grid-3 
						{if $gdzSetting.shop_list == 'grid' && $shop_grid_column == 3}
							active
						{elseif $gdzSetting.shop_list == 'grid' && $shop_grid_column == 2}

						{elseif $gdzSetting.shop_list == 'grid' && $shop_grid_column == 4}
						
						{else}
						
						{/if}" 
						href="#"
					>
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect width="5" height="19" fill="#E2E2E2"/>
							<rect x="7" width="5" height="19" fill="#E2E2E2"/>
							<rect x="14" width="5" height="19" fill="#E2E2E2"/>
						</svg>
					</a>
					<a class="switch-view view-grid grid-4 {if $shop_grid_column == 4}active{/if}" href="#">
						<svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect width="5" height="19" fill="#E2E2E2"/>
							<rect x="7" width="5" height="19" fill="#E2E2E2"/>
							<rect x="14" width="5" height="19" fill="#E2E2E2"/>
							<rect x="21" width="5" height="19" fill="#E2E2E2"/>
						</svg>
					</a>
					<a 
						class="switch-view view-list 
						{if $gdzSetting.shop_list == 'list' && $shop_grid_column != 2 && $shop_grid_column != 3 && $shop_grid_column != 4 && $shop_grid_column != 5 && $shop_grid_column != 6}
							active
						{/if}" 
						href="#"
					>
						<svg width="25" height="19" viewBox="0 0 25 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="19" width="5" height="25" transform="rotate(-90 0 19)" fill="#E2E2E2"/>
							<rect y="12" width="5" height="25" transform="rotate(-90 0 12)" fill="#E2E2E2"/>
							<rect y="5" width="5" height="25" transform="rotate(-90 0 5)" fill="#E2E2E2"/>
						</svg>
					</a>
				</div>
			{/if}
			
		</div>
		<div class="col-8 col-md-6 col-sm-7 text-right">
			<div class="sort-by">
				{if $gdzSetting.shop_sortby == 1}
					{block name='sort_by'}
						{include file='catalog/_partials/sort-orders.tpl' sort_orders=$listing.sort_orders}
					{/block}
				{/if}
			</div>
		</div>
	</div>
</div>
