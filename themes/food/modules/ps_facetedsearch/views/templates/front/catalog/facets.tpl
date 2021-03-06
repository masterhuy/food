{**
  * 2007-2019 PrestaShop.
  *
  * NOTICE OF LICENSE
  *
  * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
  * that is bundled with this package in the file LICENSE.txt.
  * It is also available through the world-wide-web at this URL:
  * https://opensource.org/licenses/AFL-3.0
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
  * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
  * International Registered Trademark & Property of PrestaShop SA
  *}
{if $displayedFacets|count}
    <div id="search_filters" class="hidden-md-down">
        {block name='facets_clearall_button'}
            {if $activeFilters|count}
                {block name='facets_title'}
                    <div class="filter-by" data-target="#filter-block" data-toggle="collapse">
                        <h3 class="facet-title">
                            {l s='Filters' d='Shop.Theme.Actions'}
                        </h3>
                    </div>
                {/block}
                <div id="filter-block" class="collapse show">
                    <ul>
                        {foreach from=$activeFilters item="filter"}
                            {block name='active_filters_item'}
                                <li class="filter-block">
                                    <a class="js-search-link icon-close" href="{$filter.nextEncodedFacetsURL}">
                                        <svg width="15" height="15" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="icon/navigation/close_24px">
                                            <path id="icon/navigation/close_24px_2" d="M23.75 8.0125L21.9875 6.25L15 13.2375L8.0125 6.25L6.25 8.0125L13.2375 15L6.25 21.9875L8.0125 23.75L15 16.7625L21.9875 23.75L23.75 21.9875L16.7625 15L23.75 8.0125Z" fill="#3F2803" fill-opacity="0.7"/>
                                            </g>
                                        </svg>
                                    </a>
                                    {l s='%1$s: ' d='Shop.Theme.Catalog' sprintf=[$filter.facetLabel]}
                                    {$filter.label}
                                </li>
                            {/block}
                        {/foreach}
                    </ul>
                    <div id="_desktop_search_filters_clear_all" class="clear-all-wrapper">
                        <button data-search-url="{$clear_all_link}" class="btn btn-active btn-clear-all js-search-filters-clear-all">
                            {l s='Clear all' d='Shop.Theme.Actions'}
                        </button>
                    </div>
                </div>
            {/if}
        {/block}
        {foreach from=$displayedFacets item="facet"}
        <section class="facet {$facet.label} clearfix">
            {assign var=_expand_id value=10|mt_rand:100000}
            {assign var=_collapse value=true}
            {foreach from=$facet.filters item="filter"}
                {if $filter.active}{assign var=_collapse value=false}{/if}
            {/foreach}
            <div class="title" data-target="#facet_{$_expand_id}" data-toggle="collapse"{if !$_collapse} aria-expanded="true"{/if}>
                <h3 class="facet-title">{$facet.label}</h3>
            </div>

            {if in_array($facet.widgetType, ['radio', 'checkbox'])}
                {block name='facet_item_other'}
                    <ul id="facet_{$_expand_id}" class="collapse show">
                        {foreach from=$facet.filters key=filter_key item="filter"}
                            {if !$filter.displayed}
                                {continue}
                            {/if}
                            <li>
                                <label class="facet-label{if $filter.active} active {/if}" for="facet_input_{$_expand_id}_{$filter_key}">
                                    {if $facet.multipleSelectionAllowed}
                                    <span class="custom-checkbox">
                                        <input
                                            id="facet_input_{$_expand_id}_{$filter_key}"
                                            data-search-url="{$filter.nextEncodedFacetsURL}"
                                            type="checkbox"
                                            {if $filter.active }checked{/if}
                                        >
                                        <span class="checkmark"></span>
                                        {if isset($filter.properties.color)}
                                            <span class="color" style="background-color:{$filter.properties.color}"></span>
                                        {elseif isset($filter.properties.texture)}
                                            <span class="color texture" style="background-image:url({$filter.properties.texture})"></span>
                                        {else}
                                            <span {if !$js_enabled} class="ps-shown-by-js" {/if}><i class="material-icons rtl-no-flip checkbox-checked">&#xE5CA;</i></span>
                                        {/if}
                                    </span>
                                    {else}
                                    <span class="custom-radio">
                                        <input
                                            id="facet_input_{$_expand_id}_{$filter_key}"
                                            data-search-url="{$filter.nextEncodedFacetsURL}"
                                            type="radio"
                                            name="filter {$facet.label}"
                                            {if $filter.active }checked{/if}
                                        >
                                        <span class="checkmark"></span>
                                        <span {if !$js_enabled} class="ps-shown-by-js" {/if}></span>
                                    </span>
                                    {/if}
                                    <a
                                        href="{$filter.nextEncodedFacetsURL}"
                                        class="_gray-darker search-link js-search-link"
                                        rel="nofollow"
                                    >
                                        {$filter.label}
                                        {if $filter.magnitude and $show_quantities}
                                            <span class="magnitude">({$filter.magnitude})</span>
                                        {/if}
                                    </a>
                                </label>    
                            </li>
                        {/foreach}
                    </ul>
                {/block}
            {elseif $facet.widgetType == 'dropdown'}
                {block name='facet_item_dropdown'}
                    <ul id="facet_{$_expand_id}" class="collapse{if !$_collapse} in{/if}">
                        <li>
                            <div class="col-sm-12 col-xs-12 col-md-12 facet-dropdown dropdown">
                                <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {$active_found = false}
                                    <span>
                                    {foreach from=$facet.filters item="filter"}
                                        {if $filter.active}
                                        {$filter.label}
                                        {if $filter.magnitude and $show_quantities}
                                            ({$filter.magnitude})
                                        {/if}
                                        {$active_found = true}
                                        {/if}
                                    {/foreach}
                                    {if !$active_found}
                                        {l s='(no filter)' d='Shop.Theme.Global'}
                                    {/if}
                                    </span>
                                    <i class="material-icons float-xs-right">&#xE5C5;</i>
                                </a>
                                <div class="dropdown-menu">
                                    {foreach from=$facet.filters item="filter"}
                                    {if !$filter.active}
                                        <a
                                        rel="nofollow"
                                        href="{$filter.nextEncodedFacetsURL}"
                                        class="select-list"
                                        >
                                        {$filter.label}
                                        {if $filter.magnitude and $show_quantities}
                                            ({$filter.magnitude})
                                        {/if}
                                        </a>
                                    {/if}
                                    {/foreach}
                                </div>
                            </div>
                        </li>
                    </ul>
                {/block}
            {elseif $facet.widgetType == 'slider'}
                {block name='facet_item_slider'}
                    {foreach from=$facet.filters item="filter"}
                        <div class="d-flex">
                            <span>{l s='Ranger' d='Shop.Theme.Global'}</span>
                            <p id="facet_label_{$_expand_id}" class="ranger">
                                {$filter.label}
                            </p>
                        </div>
                        <ul id="facet_{$_expand_id}"
                            class="faceted-slider"
                            data-slider-min="{$facet.properties.min}"
                            data-slider-max="{$facet.properties.max}"
                            data-slider-id="{$_expand_id}"
                            data-slider-values="{$filter.value|@json_encode}"
                            data-slider-unit="{$facet.properties.unit}"
                            data-slider-label="{$facet.label}"
                            data-slider-specifications="{$facet.properties.specifications|@json_encode}"
                            data-slider-encoded-url="{$filter.nextEncodedFacetsURL}"
                        >
                            <li>
                                <div id="slider-range_{$_expand_id}"></div>
                            </li>
                        </ul>
                    {/foreach}
                {/block}
            {/if}
        </section>
        {/foreach}
    </div>
{/if}
