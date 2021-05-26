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
<div class="result_div">
    {if $products}
        <div class="results">
            {foreach from=$products item=product name=i}
                <div class="row align-items-center clearfix">
					          {if $show_image == 1}
                    <a href="{$product.link nofilter}" title="{$product.name nofilter}" class="search-product-image layout-column">
    				            <img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default') nofilter}" alt="{$product.name nofilter}" />
    				        </a>
					          {/if}
                    <div class="product-info layout-column">
                        <a class="product-link" href="{$product.link nofilter}" title="{$product.name nofilter}">
                            {$product.name|truncate:35:'...' nofilter}
                        </a>
                        {if $show_desc == 1}
                        <p class="desc">{$product.desc|truncate:$desc_count:'...' nofilter}</p>
                        {/if}
                        {if $show_price == 1}
                        <div class="content_price">
                            <span class="price new">{$product.price nofilter}</span>
                        </div>
                        {/if}
                    </div>
                </div>
            {/foreach}
        </div>
    {else}
        {$no_text nofilter}
    {/if}
</div>
