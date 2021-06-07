{**
 * 2007-2019 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div>
	<div class="user-info menu-collapse btn-group compact-hidden type-1">
		{if $logged}
			<a href="#" class="account dropdown-toggle p-relative" data-toggle="dropdown"></a>
			<div id="login" class="dropdown-menu">
				<ul>
					<li><a href="{$link->getPageLink('my-account', true)}">{$customerName}</a></li>
					<li><a href="{$link->getPageLink('order', true)}" title="{l s='Checkout' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Checkout' d='Shop.Theme.CustomerAccount'} </a></li>
					<li><a class="logout" href="{$logout_url}" rel="nofollow" >{l s='Log out' d='Shop.Theme.Actions'}</a></li>
				</ul>
			</div>
		{else}
			<a href="#" class="account dropdown-toggle p-relative" data-toggle="dropdown"></a>
			<div id="login" class="dropdown-menu">
				<ul>
					<li><a href="{$urls.pages.register}" title="{l s='Register' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Register' d='Shop.Theme.CustomerAccount'} </a></li>
					<li><a class="login" href="{$my_account_url}" title="{l s='Login' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >{l s='Log In' d='Shop.Theme.Actions'}</a></li>
				</ul>
			</div>
		{/if}
	</div>
	<div class="user-info menu-collapse btn-group compact-hidden type-2">
		{if $logged}
			<a href="#" class="account dropdown-toggle" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" data-toggle="dropdown" data-display="static">
				{$customerName}
		  	</a>
			<div id="login" class="dropdown-menu">
				<ul>
					<li><a href="{$link->getPageLink('my-account', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='My Account' d='Shop.Theme.CustomerAccount'} </a></li>
					<li><a href="{$link->getPageLink('order', true)}" title="{l s='Checkout' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Checkout' d='Shop.Theme.CustomerAccount'} </a></li>
					<li><a class="logout" href="{$logout_url}" rel="nofollow" >{l s='Log out' d='Shop.Theme.Actions'}</a></li>
				</ul>
			</div>
		{else}
			<a href="#" class="account dropdown-toggle" title="{l s='Login/Register' d='Shop.Theme.CustomerAccount'}" data-toggle="dropdown" data-display="static">
				{l s='Login / Register' d='Shop.Theme.Actions'}
			</a>
			<div id="login" class="dropdown-menu">
				<ul>
					<li><a href="{$link->getPageLink('order', true)}" title="{l s='Checkout' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Checkout' d='Shop.Theme.CustomerAccount'} </a></li>
					<li><a class="logout" href="{$link->getPageLink('my-account', true)}" title="{l s='Login' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >{l s='Log In' d='Shop.Theme.Actions'}</a></li>
				</ul>
			</div>
		{/if}
	</div>
</div>
