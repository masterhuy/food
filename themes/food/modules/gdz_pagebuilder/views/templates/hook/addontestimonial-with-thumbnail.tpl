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
	<div class="pb-testimonial with-thumbnails">
		<div class="pb-testimonial-carousel carousel-tpl">
			{foreach from=$testimonials item=testimonial}
				<div class="pb-testimonial-box">
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
					<div class="pb-testimonial-comment" >
						<span class="quote-1">
							<svg width="22" height="17" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M21.1436 0.137634V1.33392C19.4508 1.95241 18.1243 2.92898 17.1641 4.26361C16.2038 5.58197 15.7236 6.9573 15.7236 8.38959C15.7236 8.69883 15.7725 8.9267 15.8701 9.07318C15.9352 9.17084 16.0085 9.21967 16.0898 9.21967C16.1712 9.21967 16.2933 9.1627 16.4561 9.04877C16.9769 8.67442 17.6361 8.48724 18.4336 8.48724C19.3613 8.48724 20.1833 8.86973 20.8994 9.6347C21.6156 10.3834 21.9736 11.2786 21.9736 12.3203C21.9736 13.4107 21.5586 14.371 20.7285 15.2011C19.9147 16.0312 18.9219 16.4462 17.75 16.4462C16.3828 16.4462 15.2028 15.8847 14.21 14.7617C13.2171 13.6386 12.7207 12.1331 12.7207 10.2451C12.7207 8.04779 13.3962 6.07839 14.7471 4.33685C16.098 2.59532 18.2301 1.19558 21.1436 0.137634ZM9.40039 0.137634V1.33392C7.70768 1.95241 6.38118 2.92898 5.4209 4.26361C4.46061 5.58197 3.98047 6.9573 3.98047 8.38959C3.98047 8.69883 4.0293 8.9267 4.12695 9.07318C4.19206 9.17084 4.2653 9.21967 4.34668 9.21967C4.42806 9.21967 4.55013 9.1627 4.71289 9.04877C5.23372 8.67442 5.8929 8.48724 6.69043 8.48724C7.61816 8.48724 8.4401 8.86973 9.15625 9.6347C9.8724 10.3834 10.2305 11.2786 10.2305 12.3203C10.2305 13.4107 9.81543 14.371 8.98535 15.2011C8.17155 16.0312 7.17871 16.4462 6.00684 16.4462C4.63965 16.4462 3.45964 15.8847 2.4668 14.7617C1.47396 13.6386 0.977539 12.1331 0.977539 10.2451C0.977539 8.04779 1.65299 6.07839 3.00391 4.33685C4.35482 2.59532 6.48698 1.19558 9.40039 0.137634Z" fill="#3F2803"/>
							</svg>
						</span>
						{$testimonial->comment|escape:'html':'UTF-8'}
						<span class="quote-2">
							<svg width="22" height="17" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.856445 16.8622V15.666C2.54915 15.0475 3.87565 14.0709 4.83594 12.7363C5.79622 11.4179 6.27637 10.0426 6.27637 8.61029C6.27637 8.30105 6.22754 8.07318 6.12988 7.9267C6.06478 7.82904 5.99154 7.78021 5.91016 7.78021C5.82878 7.78021 5.70671 7.83718 5.54395 7.95111C5.02311 8.32546 4.36393 8.51263 3.56641 8.51263C2.63867 8.51263 1.81673 8.13015 1.10059 7.36517C0.38444 6.61648 0.0263672 5.72129 0.0263672 4.67963C0.0263672 3.58913 0.441406 2.62885 1.27148 1.79877C2.08529 0.968689 3.07812 0.55365 4.25 0.55365C5.61719 0.55365 6.7972 1.11517 7.79004 2.23822C8.78288 3.36127 9.2793 4.8668 9.2793 6.75482C9.2793 8.95209 8.60384 10.9215 7.25293 12.663C5.90202 14.4046 3.76986 15.8043 0.856445 16.8622ZM12.5996 16.8622V15.666C14.2923 15.0475 15.6188 14.0709 16.5791 12.7363C17.5394 11.4179 18.0195 10.0426 18.0195 8.61029C18.0195 8.30105 17.9707 8.07318 17.873 7.9267C17.8079 7.82904 17.7347 7.78021 17.6533 7.78021C17.5719 7.78021 17.4499 7.83718 17.2871 7.95111C16.7663 8.32546 16.1071 8.51263 15.3096 8.51263C14.3818 8.51263 13.5599 8.13015 12.8438 7.36517C12.1276 6.61648 11.7695 5.72129 11.7695 4.67963C11.7695 3.58913 12.1846 2.62885 13.0146 1.79877C13.8285 0.968689 14.8213 0.55365 15.9932 0.55365C17.3604 0.55365 18.5404 1.11517 19.5332 2.23822C20.526 3.36127 21.0225 4.8668 21.0225 6.75482C21.0225 8.95209 20.347 10.9215 18.9961 12.663C17.6452 14.4046 15.513 15.8043 12.5996 16.8622Z" fill="#3F2803"/>
							</svg>
						</span>
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
		<div class="testimonial-thumbnail-carousel">
			{foreach from=$testimonials item=testimonial}
				<div class="pb-testimonial-box">
					{if $show_image}
						<div class="pb-testimonial-img">
							<img class="img-responsive" src="{$testimonial->image|escape:'html':'UTF-8'}" />
						</div>
					{/if}	
				</div>
			{/foreach}
		</div>
	</div>
{/if}
