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
<div class="pb-popup popup-newsletter gdz-popup-overlay" style="display:none;">
	<div class="gdz-popup">
		<div class="gdz-popup-content">
			{if $popup_title}
				<h2>
					{$popup_title|escape:'htmlall':'UTF-8' nofilter}
				</h2>
			{/if}
			<p class="desc">{l s='Be the first to know about our special offers and get 20% off your first purchase!' d='Shop.Theme.Global'}</p>
			<div class="popup-content">
				<div>
					{$popup_content nofilter}
				</div>
			</div>
			<p>{l s='By entering your email, you agree to our Terms of Service and Privacy Policy' d='Shop.Theme.Global'}</p>
		</div>
		{include file='../../../../../templates/_partials/socials.tpl'} 
		<div class="dontshow">
			<input type="checkbox" name="dontshowagain" value="1" id="dontshowagain" />
			<label>{l s='Dont show this popup again' d='Shop.Theme.Actions'}</label>
		</div>
		<a class="popup-close">
			<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g id="icon/navigation/close_24px">
				<path id="icon/navigation/close_24px_2" d="M23.75 8.0125L21.9875 6.25L15 13.2375L8.0125 6.25L6.25 8.0125L13.2375 15L6.25 21.9875L8.0125 23.75L15 16.7625L21.9875 23.75L23.75 21.9875L16.7625 15L23.75 8.0125Z" fill="black" fill-opacity="0.54"/>
				</g>
			</svg>
		</a>
		<input type="hidden" name="width_default" id="width-default" value="{$popup_width|escape:'htmlall':'UTF-8'}" />
		<input type="hidden" name="height_default" id="height-default" value="{$popup_height|escape:'htmlall':'UTF-8'}" />
		<input type="hidden" name="loadtime" id="loadtime" value="{$loadtime|escape:'htmlall':'UTF-8'}" />
	</div>
</div>
