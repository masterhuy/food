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
{assign var=unique_id value=1|mt_rand:1000}
<div class="pb-producttab addon-tab">
		<ul class="nav nav-tabs tab-{$tab_align}">
		{$cf = 0}
			{if $producttabs.show_featured == '1'}
				<li class="nav-item"><a data-toggle="tab" href="#featured-{$unique_id}" class="nav-link active">{$producttabs.featured_text}</a></li>
			{$cf = $cf + 1}
			{/if}
			{if $producttabs.show_new eq '1'}
				<li class="nav-item"><a data-toggle="tab" href="#latest-{$unique_id}" class="nav-link{if $cf eq 0} active{/if}">{$producttabs.new_text}</a></li>
				{$cf = $cf + 1}
			{/if}
			{if $producttabs.show_topseller == '1'}
				<li class="nav-item"><a data-toggle="tab" href="#topseller-{$unique_id}" class="nav-link{if $cf eq 0} active{/if}">{$producttabs.topseller_text}</a></li>
				{$cf = $cf + 1}
			{/if}
			{if $producttabs.show_special == '1'}
				<li class="nav-item"><a data-toggle="tab" href="#special-{$unique_id}" class="nav-link{if $cf eq 0} active{/if}">{$producttabs.special_text}</a></li>
				{$cf = $cf + 1}
			{/if}
			{if $producttabs.show_onsale == '1'}
				<li class="nav-item"><a data-toggle="tab" href="#onsale-{$unique_id}" class="nav-link{if $cf eq 0} active{/if}">{$producttabs.onsale_text}</a></li>
				{$cf = $cf + 1}
			{/if}
		</ul>
</div>
<div class="tab-content">
	{$cf = 0}
	{if $producttabs.show_featured == '1'}
		 <div role="tabpanel" class="tab-pane active" id="featured-{$unique_id}">
			 {if $view_type == 'carousel'}
					 <div class="producttab-products owl-carousel" data-items="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-lg="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-md="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if}" data-sm="{if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if}" data-xs="{if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
						 {foreach from = $producttabs.featured_products item = products_slide}
							 <div class="item">
								 {foreach from = $products_slide item = product}
									 {include file="catalog/_partials/miniatures/product.tpl" product=$product}
								 {/foreach}
							 </div>
						 {/foreach}
					 </div>
			 {else}
					 <div class="producttab-products products row">
							{foreach from=$producttabs.featured_products item=product}
								<div class="col-md-{12/$cols_md} col-sm-{12/$cols_sm} col-xs-{12/$cols_xs}">
									{include file="catalog/_partials/miniatures/product.tpl" product=$product}
								</div>
							{/foreach}
					</div>
			 {/if}
		 </div>
		{$cf = $cf + 1}
	{/if}
	{if $producttabs.show_new == '1'}
		 <div role="tabpanel" class="tab-pane {if $cf eq 0}active{/if}" id="latest-{$unique_id}">
			 	{if $view_type == 'carousel'}
						<div class="producttab-products owl-carousel" data-items="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-lg="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-md="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if}" data-sm="{if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if}" data-xs="{if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
						 {foreach from = $producttabs.new_products item = products_slide}
							 <div class="item">
								 {foreach from = $products_slide item = product}
									 {include file="catalog/_partials/miniatures/product.tpl" product=$product}
								 {/foreach}
							 </div>
						 {/foreach}
					 </div>
 				{else}
						<div class="producttab-products products row">
							 {foreach from=$producttabs.new_products item=product}
								 <div class="col-md-{12/$cols_md} col-sm-{12/$cols_sm} col-xs-{12/$cols_xs}">
									 {include file="catalog/_partials/miniatures/product.tpl" product=$product}
								 </div>
							 {/foreach}
					 </div>
 				{/if}
		 </div>
		{$cf = $cf + 1}
	{/if}
	{if $producttabs.show_topseller == '1'}
		 <div role="tabpanel" class="tab-pane {if $cf eq 0}active{/if}" id="topseller-{$unique_id}">
			 {if $view_type == 'carousel'}
					 <div class="producttab-products owl-carousel" data-items="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-lg="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-md="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if}" data-sm="{if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if}" data-xs="{if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
						{foreach from = $producttabs.topseller_products item = products_slide}
							<div class="item">
								{foreach from = $products_slide item = product}
									{include file="catalog/_partials/miniatures/product.tpl" product=$product}
								{/foreach}
							</div>
						{/foreach}
					</div>
			 {else}
					 <div class="producttab-products products row">
							{foreach from=$producttabs.topseller_products item=product}
								<div class="col-md-{12/$cols_md} col-sm-{12/$cols_sm} col-xs-{12/$cols_xs}">
									{include file="catalog/_partials/miniatures/product.tpl" product=$product}
								</div>
							{/foreach}
					</div>
			 {/if}
		 </div>
		{$cf = $cf + 1}
	{/if}
	{if $producttabs.show_special == '1'}
		 <div role="tabpanel" class="tab-pane {if $cf eq 0}active{/if}" id="special-{$unique_id}">
			 {if $view_type == 'carousel'}
					 <div class="producttab-products owl-carousel" data-items="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-lg="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-md="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if}" data-sm="{if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if}" data-xs="{if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
						{foreach from = $producttabs.special_products item = products_slide}
							<div class="item">
								{foreach from = $products_slide item = product}
									{include file="catalog/_partials/miniatures/product.tpl" product=$product}
								{/foreach}
							</div>
						{/foreach}
					</div>
			 {else}
					 <div class="producttab-products products row">
							{foreach from=$producttabs.special_products item=product}
								<div class="col-md-{12/$cols_md} col-sm-{12/$cols_sm} col-xs-{12/$cols_xs}">
									{include file="catalog/_partials/miniatures/product.tpl" product=$product}
								</div>
							{/foreach}
					</div>
			 {/if}
		 </div>
		{$cf = $cf + 1}
	{/if}
	{if $producttabs.show_onsale == '1'}
		 <div role="tabpanel" class="tab-pane {if $cf eq 0}active{/if}" id="onsale-{$unique_id}">
			 {if $view_type == 'carousel'}
					 <div class="producttab-products owl-carousel" data-items="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-lg="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-md="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if}" data-sm="{if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if}" data-xs="{if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
						{foreach from = $producttabs.onsale_products item = products_slide}
							<div class="item">
								{foreach from = $products_slide item = product}
									{include file="catalog/_partials/miniatures/product.tpl" product=$product}
								{/foreach}
							</div>
						{/foreach}
					</div>
			 {else}
					 <div class="producttab-products products row">
							 {foreach from=$producttabs.onsale_products item=product}
								 <div class="col-md-{12/$cols_md} col-sm-{12/$cols_sm} col-xs-{12/$cols_xs}">
									 {include file="catalog/_partials/miniatures/product.tpl" product=$product}
								 </div>
							 {/foreach}
					 </div>
			 {/if}
		 </div>
		{$cf = $cf + 1}
	{/if}
</div>
