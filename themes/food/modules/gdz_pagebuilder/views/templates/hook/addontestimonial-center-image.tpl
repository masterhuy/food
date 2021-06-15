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
		<div class="pb-testimonial-carousel center-image carousel-tpl" data-items="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}5{/if}" data-lg="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}5{/if}" data-md="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-sm="{if $items_show_sm}{$items_show_sm|escape:'htmlall':'UTF-8'}{else}3{/if}" data-xs="{if $items_show_xs}{$items_show_xs|escape:'htmlall':'UTF-8'}{else}2{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
			{foreach from=$testimonials item=testimonial}
				<div class="pb-testimonial-box">
					{if $show_image}
						<div class="pb-testimonial-img">
							<img class="img-responsive" src="{$testimonial->image|escape:'html':'UTF-8'}" />
						</div>
					{/if}	
					<div class="pb-testimonial-comment" >
						{$testimonial->comment|escape:'html':'UTF-8'}
					</div>
					<div class="quote">
						<svg width="43" height="33" viewBox="0 0 43 33" xmlns="http://www.w3.org/2000/svg">
							<path d="M2.21289 32.7272V30.3346C5.59831 29.0976 8.2513 27.1445 10.1719 24.4752C12.0924 21.8385 13.0527 19.0878 13.0527 16.2233C13.0527 15.6048 12.9551 15.149 12.7598 14.8561C12.6296 14.6608 12.4831 14.5631 12.3203 14.5631C12.1576 14.5631 11.9134 14.677 11.5879 14.9049C10.5462 15.6536 9.22786 16.028 7.63281 16.028C5.77734 16.028 4.13346 15.263 2.70117 13.733C1.26888 12.2356 0.552734 10.4453 0.552734 8.36194C0.552734 6.18095 1.38281 4.26038 3.04297 2.60022C4.67057 0.940063 6.65625 0.109985 9 0.109985C11.7344 0.109985 14.0944 1.23303 16.0801 3.47913C18.0658 5.72522 19.0586 8.73629 19.0586 12.5123C19.0586 16.9069 17.7077 20.8457 15.0059 24.3287C12.304 27.8118 8.03971 30.6113 2.21289 32.7272ZM25.6992 32.7272L25.6992 30.3346C29.0846 29.0976 31.7376 27.1445 33.6582 24.4752C35.5788 21.8385 36.5391 19.0878 36.5391 16.2233C36.5391 15.6048 36.4414 15.149 36.2461 14.8561C36.1159 14.6608 35.9694 14.5631 35.8066 14.5631C35.6439 14.5631 35.3997 14.677 35.0742 14.9049C34.0326 15.6536 32.7142 16.028 31.1191 16.028C29.2637 16.028 27.6198 15.263 26.1875 13.733C24.7552 12.2356 24.0391 10.4453 24.0391 8.36194C24.0391 6.18095 24.8691 4.26038 26.5293 2.60022C28.1569 0.940063 30.1426 0.109985 32.4863 0.109985C35.2207 0.109985 37.5807 1.23303 39.5664 3.47913C41.5521 5.72522 42.5449 8.73629 42.5449 12.5123C42.5449 16.9069 41.194 20.8457 38.4922 24.3287C35.7904 27.8118 31.526 30.6113 25.6992 32.7272Z"/>
						</svg>
					</div>		
					<div class="pb-testimonial-author">
						<span class="pb-testimonial-author">{$testimonial->author|escape:'html':'UTF-8'}</span>  
						{if $show_position}<span class="pb-testimonial-position"><span>-</span> {$testimonial->position|escape:'html':'UTF-8'}</span>
					{/if}
					</div>
					
					{if $show_rating}
						<div class="pb-testimonial-rating">
							{for $x=1 to 5}
								<span class="fa fa-star{if $x <= $testimonial->rating} checked{/if}"></span>
							{/for}
						</div>
					{/if}
				</div>
			{/foreach}
		</div>
	</div>
{/if}
