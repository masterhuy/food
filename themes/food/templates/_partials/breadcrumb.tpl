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
<div class="breadcrumb-wrapper hidden-sm-down">
    <div class="breadcrumb">
        <div class="container">
            <h3 class="{if $gdzSetting.breadcrumb_align}text-{$gdzSetting.breadcrumb_align}{/if}">
                {if $page.page_name == 'cms'}
                    {$cms.meta_title}
                {elseif $page.page_name == 'cms_category'}
                    {$cms_category.name}
                {elseif $page.page_name == 'category'}
                    {$category.name}
                {elseif $page.page_name == 'module-gdz_pagebuilder-page'}
                    {$gdz_pagebuilder_page.title}
                {elseif $page.page_name == 'module-gdz_blog-categories'}
                    {l s="Blog categories list" d="Shop.Theme.Catalog"}
                {elseif $page.page_name == 'module-gdz_blog-category'}
                    {l s="Blog list" d="Shop.Theme.Catalog"}
                {elseif $page.page_name == 'contact'}
                    {l s="Contact" d="Shop.Theme.Catalog"}
                {else}
                    {$page.meta.title}
                {/if}
            </h3>
            <div data-depth="{$breadcrumb.count}" class="row align-items-center{if $gdzSetting.breadcrumb_seperator} seperator-{$gdzSetting.breadcrumb_seperator}{/if}">
                <ul itemscope itemtype="http://schema.org/BreadcrumbList" class="{if $gdzSetting.breadcrumb_align}align-{$gdzSetting.breadcrumb_align}{/if}">
                    {foreach from=$breadcrumb.links item=path name=breadcrumb}
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            {if not $smarty.foreach.breadcrumb.last}
                                <a itemprop="item" href="{$path.url}"><span itemprop="name">{$path.title}</span></a>
                            {else}
                                <span itemprop="name">{$path.title}</span>
                            {/if}
                            <meta itemprop="position" content="{$smarty.foreach.breadcrumb.iteration}">
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
</div>
