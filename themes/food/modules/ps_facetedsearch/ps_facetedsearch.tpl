{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
{if isset($listing.rendered_facets)}
    <button class="d-flex d-lg-none btn-close js-close-filter">
        <svg width="20" height="20" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="icon/navigation/close_24px">
            <path id="icon/navigation/close_24px_2" d="M23.75 8.0125L21.9875 6.25L15 13.2375L8.0125 6.25L6.25 8.0125L13.2375 15L6.25 21.9875L8.0125 23.75L15 16.7625L21.9875 23.75L23.75 21.9875L16.7625 15L23.75 8.0125Z" fill="#3F2803" fill-opacity="0.7"/>
            </g>
        </svg>
        <span>{l s='Close' d='Shop.Theme.Actions'}</span>
    </button>
    <div id="search_filters_wrapper" class="hidden-sm-down">
        <div id="search_filter_controls" class="hidden-md-up">
            <span id="_mobile_search_filters_clear_all"></span>
        </div>
        {$listing.rendered_facets nofilter}
    </div>
{/if}
