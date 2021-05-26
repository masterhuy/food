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
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $testimonials|@count gt 0}
<div class="pb-testimonial">
		<div class="pb-testimonial-carousel owl-carousel carousel-tpl" data-items="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}5{/if}" data-lg="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}5{/if}" data-md="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-sm="{if $items_show_sm}{$items_show_sm|escape:'htmlall':'UTF-8'}{else}3{/if}" data-xs="{if $items_show_xs}{$items_show_xs|escape:'htmlall':'UTF-8'}{else}2{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
		{foreach from=$testimonials item=testimonial}
		<div class="pb-testimonial-box">
			{if $show_image}
			<div class="pb-testimonial-img">
				<img class="img-responsive" src="{$testimonial->image|escape:'html':'UTF-8'}" />
			</div>
			{/if}			
			<h5 class="pb-testimonial-author">
				{$testimonial->author|escape:'html':'UTF-8'}
			</h5>
			{if $show_position}
			<div class="pb-testimonial-position">
				{$testimonial->position|escape:'html':'UTF-8'}
			</div>
			{/if}
			{if $show_rating}
			<div class="pb-testimonial-rating">
				{for $x=1 to 5}
						<span class="fa fa-star{if $x <= $testimonial->rating} checked{/if}"></span>
				{/for}
			</div>
			{/if}
			<div class="pb-testimonial-comment" >
				{$testimonial->comment|escape:'html':'UTF-8'}
			</div>
		</div>
		{/foreach}
		</div>
</div>
{/if}
