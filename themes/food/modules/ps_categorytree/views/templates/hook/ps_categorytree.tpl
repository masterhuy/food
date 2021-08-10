{*
* 2007-2019 PrestaShop
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
*  @copyright  2007-2019 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{function name="categories" nodes=[] depth=0}
    {strip}
        {if $nodes|count}
            <ul class="category-sub-menu collapse show" id="category-sub-menu">
                {foreach from=$nodes item=node}
                <li data-depth="{$depth}" class="cat-item">
                    {if $depth===0}
                        <a class="category-sub-link" href="{$node.link}">
                            {$node.name}
                        </a>
                        {if $node.children}
                            <span class="navbar-toggler collapse-icons collapsed" data-toggle="collapse" data-target="#exCollapsingNavbar{$node.id}">
                                <i class="closing">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="22" height="22" transform="translate(22) rotate(90)" fill="white"/>
                                        <path d="M6.7925 7.60376L11 11.8021L15.2075 7.60376L16.5 8.89626L11 14.3963L5.5 8.89626L6.7925 7.60376Z" fill="#3F2803" fill-opacity="0.7"/>
                                    </svg>
                                </i>
                                <i class="opening">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="22" height="22" transform="translate(0 22) rotate(-90)" fill="white"/>
                                        <path d="M15.2075 14.3962L11 10.1979L6.7925 14.3962L5.5 13.1037L11 7.60374L16.5 13.1037L15.2075 14.3962Z" fill="#3F2803" fill-opacity="0.7"/>
                                    </svg>
                                </i>
                            </span>
                        {/if}
                        {if $node.children}
                            <div class="sub-list collapse" id="exCollapsingNavbar{$node.id}">
                                {categories nodes=$node.children depth=$depth+1}
                            </div>
                        {/if}
                    {else}
                        <a class="category-sub-link" href="{$node.link}">{$node.name}
                            {if $node.children}
                                <span class="navbar-toggler collapse-icons" data-toggle="collapse" data-target="#exCollapsingNavbar{$node.id}">
                                    <i class="closing">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="22" height="22" transform="translate(22) rotate(90)" fill="white"/>
                                            <path d="M6.7925 7.60376L11 11.8021L15.2075 7.60376L16.5 8.89626L11 14.3963L5.5 8.89626L6.7925 7.60376Z" fill="#3F2803" fill-opacity="0.7"/>
                                        </svg>
                                    </i>
                                    <i class="opening">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="22" height="22" transform="translate(0 22) rotate(-90)" fill="white"/>
                                            <path d="M15.2075 14.3962L11 10.1979L6.7925 14.3962L5.5 13.1037L11 7.60374L16.5 13.1037L15.2075 14.3962Z" fill="#3F2803" fill-opacity="0.7"/>
                                        </svg>
                                    </i>
                                </span>
                            {/if}
                        </a>
                        {if $node.children}
                            <div class="collapse" id="exCollapsingNavbar{$node.id}">
                            {categories nodes=$node.children depth=$depth+1}
                            </div>
                        {/if}
                    {/if}
                </li>
                {/foreach}
            </ul>
        {/if}
    {/strip}
{/function}

<div class="block-categories hidden-sm-down">
	{if $page.page_name != 'index'}
		<div class="title-block">
			<h3 class="d-flex cursor-pointer" data-toggle="collapse" data-target="#category-sub-menu">
                {l s='Categories' d='Shop.Theme.Category_tree'}
            </h3>
		</div>
	{/if}
	{categories nodes=$categories.children}
</div>
