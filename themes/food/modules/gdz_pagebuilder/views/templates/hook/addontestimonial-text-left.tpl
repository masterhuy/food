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
		<div class="pb-testimonial-carousel text-left owl-carousel carousel-tpl" data-items="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}5{/if}" data-lg="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}5{/if}" data-md="{if $items_show_md}{$items_show_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-sm="{if $items_show_sm}{$items_show_sm|escape:'htmlall':'UTF-8'}{else}3{/if}" data-xs="{if $items_show_xs}{$items_show_xs|escape:'htmlall':'UTF-8'}{else}2{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
			{foreach from=$testimonials item=testimonial}
				<div class="pb-testimonial-box">	
					<div class="pb-testimonial-comment" >
						{$testimonial->comment|escape:'html':'UTF-8'}
						<div class="quote">
							<svg width="64" height="50" viewBox="0 0 64 50" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M2.56958 49.5869V45.998C7.64771 44.1426 11.6272 41.2129 14.5081 37.209C17.3889 33.2539 18.8293 29.1279 18.8293 24.8311C18.8293 23.9033 18.6829 23.2197 18.3899 22.7803C18.1946 22.4873 17.9749 22.3408 17.7307 22.3408C17.4866 22.3408 17.1204 22.5117 16.6321 22.8535C15.0696 23.9766 13.092 24.5381 10.6995 24.5381C7.91626 24.5381 5.45044 23.3906 3.302 21.0957C1.15356 18.8496 0.0793457 16.1641 0.0793457 13.0391C0.0793457 9.76758 1.32446 6.88672 3.8147 4.39648C6.2561 1.90625 9.23462 0.661133 12.7502 0.661133C16.8518 0.661133 20.3918 2.3457 23.3704 5.71484C26.3489 9.08398 27.8381 13.6006 27.8381 19.2646C27.8381 25.8564 25.8118 31.7646 21.759 36.9893C17.7063 42.2139 11.3098 46.4131 2.56958 49.5869ZM37.7991 49.5869L37.7991 45.998C42.8772 44.1426 46.8567 41.2129 49.7375 37.209C52.6184 33.2539 54.0588 29.1279 54.0588 24.8311C54.0588 23.9033 53.9124 23.2197 53.6194 22.7803C53.4241 22.4873 53.2043 22.3408 52.9602 22.3408C52.7161 22.3408 52.3499 22.5117 51.8616 22.8535C50.2991 23.9766 48.3215 24.5381 45.929 24.5381C43.1458 24.5381 40.6799 23.3906 38.5315 21.0957C36.3831 18.8496 35.3088 16.1641 35.3088 13.0391C35.3088 9.76758 36.554 6.88672 39.0442 4.39648C41.4856 1.90625 44.4641 0.661133 47.9797 0.661133C52.0813 0.661133 55.6213 2.3457 58.5999 5.71484C61.5784 9.08398 63.0676 13.6006 63.0676 19.2646C63.0676 25.8564 61.0413 31.7646 56.9885 36.9893C52.9358 42.2139 46.5393 46.4131 37.7991 49.5869Z" fill="#FF3514" fill-opacity="0.2"/>
							</svg>
						</div>
					</div>
					<div class="pb-testimonial-author">
						{if $show_image}
							<div class="pb-testimonial-img">
								<img class="img-responsive" src="{$testimonial->image|escape:'html':'UTF-8'}" />
							</div>
						{/if}
						<div class="author-info">
							<div class="name">{$testimonial->author|escape:'html':'UTF-8'}</div>  
							{if $show_position}
								<div class="position">{$testimonial->position|escape:'html':'UTF-8'}</div>
							{/if}
						</div>
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
