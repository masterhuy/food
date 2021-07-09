{**
 * 2007-2019 PrestaShop
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
<nav class="pagination row align-items-center">
    <div class="col-12 pagination-summary text-center">
        {block name='pagination_summary'}
        <span>
            {l s='Showing' d='Shop.Theme.Catalog'}
            <b>{l s='%total%' d='Shop.Theme.Catalog' sprintf=['%from%' => $pagination.items_shown_from ,'%to%' => $pagination.items_shown_to, '%total%' => $pagination.total_items]}</b>
            {l s='results' d='Shop.Theme.Catalog'}
        </span>
        {/block}
    </div>

    <div class="col-12 pagination-page-list">
        {block name='pagination_page_list'}
            {if $pagination.should_be_displayed}
                <ul class="page-list clearfix text-center">
                    {foreach from=$pagination.pages item="page"}
                        <li {if $page.current} class="current" {/if}>
                            {if $page.type === 'spacer'}
                                <span class="spacer">&hellip;</span>
                            {else}
                                <a
                                    rel="{if $page.type === 'previous'}prev{elseif $page.type === 'next'}next{else}nofollow{/if}"
                                    href="{$page.url}"
                                    class="{if $page.type === 'previous'}previous {elseif $page.type === 'next'}next {/if}{['disabled' => !$page.clickable, 'js-search-link' => true]|classnames}"
                                >
                                    {if $page.type === 'previous'}
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="icon/navigation/chevron_right_24px">
                                                <path id="icon/navigation/chevron_right_24px_2" d="M16.6775 21L18.3225 19.355L12.9792 14L18.3225 8.645L16.6775 7L9.67751 14L16.6775 21Z" fill="black" fill-opacity="0.54"/>
                                            </g>
                                        </svg>
                                    {elseif $page.type === 'next'}
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="icon/navigation/chevron_right_24px">
                                                <path id="icon/navigation/chevron_right_24px_2" d="M11.3225 7L9.67749 8.645L15.0208 14L9.67749 19.355L11.3225 21L18.3225 14L11.3225 7Z" fill="black" fill-opacity="0.54"/>
                                            </g>
                                        </svg>
                                    {else}
                                        <span>{$page.page}</span>
                                    {/if}
                                </a>
                            {/if}
                        </li>
                    {/foreach}
                </ul>
            {/if}
        {/block}
    </div>
</nav>
