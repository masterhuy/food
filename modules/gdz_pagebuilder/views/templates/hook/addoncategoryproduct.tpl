{*
* 2007-2020 PrestaShop
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
*  @copyright  2007-2020 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="pb-categoryproduct">
		{if $showcategoryname}
		<div class="pb-categoryproduct-name">
			<h3>{$category.name|escape:'htmlall':'UTF-8'}</h3>
		</div>
		{/if}
		{if $showviewall}
		<a class="pb-categoryproduct-viewall" href="{url entity='category' id=$category.id_category}" title="View all product in category">
		      {$viewall_text nofilter}
		      <i aria-hidden="true" class="fa fa-angle-right"></i>
		</a>
		{/if}
		{if isset($category.products) && $category.products|@count gt 0 && $view_type == 'carousel'}
		<div class="catproduct-carousel owl-carousel" data-items="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-lg="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-md="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if}" data-sm="{if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if}" data-xs="{if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
		    {foreach from = $category.products item = products_slide}
		        <div class="item">
		          {foreach from = $products_slide item = product}
		              {include file="catalog/_partials/miniatures/product.tpl" product=$product}
		          {/foreach}
		        </div>
		    {/foreach}
		</div>
		{elseif isset($category.products) && $category.products|@count gt 0}
		<div class="category-products products row">
		    {foreach from = $category.products item = product}
					<div class="col-md-{12/$cols_md} col-sm-{12/$cols_sm} col-xs-{12/$cols_xs}">
		        {include file="catalog/_partials/miniatures/product.tpl" product=$product}
					</div>
		    {/foreach}
		</div>
		{/if}
</div>
