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
<!doctype html>
<html lang="{$language.iso_code}">
    <head>
        {block name='head'}
            {include file='_partials/head.tpl'}
        {/block}
    </head>
    <body id="{$page.page_name}" class="{$page.body_classes|classnames} {$jpb_pageclass} {if $jpb_rtl} rtl{/if}{if $gdzSetting.carousel_nav_type} carousel-nav-{$gdzSetting.carousel_nav_type}{/if}{if $gdzSetting.carousel_nav_show} carousel-nav-{$gdzSetting.carousel_nav_show}{/if}{if $gdzSetting.carousel_pag_show} carousel-pag-{$gdzSetting.carousel_pag_show}{/if}">

        {hook h='displayAfterBodyOpeningTag'}
        <div class="main-site">
            {block name='product_activation'}
                {include file='catalog/_partials/product-activation.tpl'}
            {/block}
            <header id="header">
                {block name='header'}
                    {include file='_partials/header.tpl'}
                {/block}
            </header>

    		{if $page.page_name != 'index' && $gdzSetting.breadcrumb}
    			{block name='breadcrumb'}
    			   {include file='_partials/breadcrumb.tpl'}
    			{/block}
    		{/if}
            <div id="wrapper" class="{$layout}">
                {block name='notifications'}
                    {include file='_partials/notifications.tpl'}
                {/block}
                {if $page.page_name != 'index' && $page.page_name != 'module-gdz_pagebuilder-page' && $page.page_name != 'module-gdz_pagebuilder-preview'}
                    <div class="container">
                {/if}
                {if $layout != 'layouts/layout-full-width.tpl'}
                <div class="row {if $page.page_name == 'contact'}ml-0 mr-0{/if}">
                {/if}
                    {block name="left_column"}
                        <div id="left-column" class="left-column col-lg-3 col-12">
                            {if $page.page_name == 'product'}
                                {hook h='displayLeftColumnProduct'}
                            {else}
                                {hook h="displayLeftColumn"}
                            {/if}
                        </div>
                    {/block}
                    {block name="content_wrapper"}
                        <div id="content-wrapper">
                            {block name="content"}
                                <p>Hello world! This is HTML5 Boilerplate.</p>
                            {/block}
                        </div>
                    {/block}

                    {block name="right_column"}
                        <div id="right-column" class="right-column col-lg-3 col-12">
                            {if $page.page_name == 'product'}
                                {hook h='displayRightColumnProduct'}
                            {else}
                                {hook h="displayRightColumn"}
                            {/if}
                        </div>
                    {/block}
                {if $layout != 'layouts/layout-full-width.tpl'}
                </div>
                {/if}
                {if $page.page_name != 'index' && $page.page_name != 'module-gdz_pagebuilder-page' && $page.page_name != 'module-gdz_pagebuilder-preview'}
                </div>
                {/if}


    		</div>
            {block name="footer"}
                {include file="_partials/footer.tpl"}
            {/block}
            <div class="bg-overlay"></div>
        </div>



        {block name='javascript_bottom'}
            {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
        {/block}

        {hook h='displayBeforeBodyClosingTag'}
    </body>
</html>
