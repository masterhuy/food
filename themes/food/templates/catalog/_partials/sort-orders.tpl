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
<div class="inlude_sort_by">
	<span class="hidden-sm-down sort-by">{l s='Sorting:' d='Shop.Theme.Actions'}</span>
	<div class="{if !empty($listing.rendered_facets)}{else}{/if} products-sort-order dropdown">
		<a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
			<span>{if isset($listing.sort_selected)}{$listing.sort_selected}{else}{l s='Select' d='Shop.Theme.Actions'}{/if}</span>
			<i>
				<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="22" height="22" transform="translate(22) rotate(90)" fill="white"/>
					<path d="M6.7925 7.60376L11 11.8021L15.2075 7.60376L16.5 8.89626L11 14.3963L5.5 8.89626L6.7925 7.60376Z" fill="#3F2803" fill-opacity="0.7"/>
				</svg>
			</i>
		</a>
		<div class="dropdown-menu">
			{foreach from=$listing.sort_orders item=sort_order}
			<a
				rel="nofollow"
				href="{$sort_order.url}"
				class="select-list {['current' => $sort_order.current, 'js-search-link' => true]|classnames}"
			>
				{$sort_order.label}
			</a>
			{/foreach}
		</div>
	</div>
</div>

