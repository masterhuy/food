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
<div id="js-product-list-top" class="filters-panel">
	<div class="row align-items-center">
		<div class="col-4 col-md-6 col-sm-5 text-left">
      {if $gdzSetting.shop_switchlist == 1}
			<div class="view-mode">
				<a class="switch-view view-grid {if $gdzSetting.shop_list == 'grid'}active{/if}" href="#"><i class="feather icon-grid"></i></a>
				<a class="switch-view view-list {if $gdzSetting.shop_list == 'list'}active{/if}" href="#"><i class="feather icon-list"></i></a>
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
