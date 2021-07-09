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
 *``
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div class="user-info btn-group">
	<a href="#" class="link-dropdown" data-toggle="dropdown" data-display="static">
		<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g id="Acc">
				<path id="icon/action/account_circle_24px" fill-rule="evenodd" clip-rule="evenodd" d="M15 2.5C8.1 2.5 2.5 8.1 2.5 15C2.5 21.9 8.1 27.5 15 27.5C21.9 27.5 27.5 21.9 27.5 15C27.5 8.1 21.9 2.5 15 2.5ZM8.83751 22.85C9.37501 21.725 12.65 20.625 15 20.625C17.35 20.625 20.6375 21.725 21.1625 22.85C19.4625 24.2 17.325 25 15 25C12.675 25 10.5375 24.2 8.83751 22.85ZM15 18.125C16.825 18.125 21.1625 18.8625 22.95 21.0375C24.225 19.3625 25 17.275 25 15C25 9.4875 20.5125 5 15 5C9.4875 5 5 9.4875 5 15C5 17.275 5.775 19.3625 7.05 21.0375C8.8375 18.8625 13.175 18.125 15 18.125ZM15 7.5C12.575 7.5 10.625 9.45 10.625 11.875C10.625 14.3 12.575 16.25 15 16.25C17.425 16.25 19.375 14.3 19.375 11.875C19.375 9.45 17.425 7.5 15 7.5ZM13.125 11.875C13.125 12.9125 13.9625 13.75 15 13.75C16.0375 13.75 16.875 12.9125 16.875 11.875C16.875 10.8375 16.0375 10 15 10C13.9625 10 13.125 10.8375 13.125 11.875Z" fill="#3F2803"/>
			</g>
		</svg>
	</a>
	{if $logged}
		<div id="login" class="dropdown-menu user-info-content{if $gdzSetting.customersignin_type =='sidebar'} user-info-sidebar{/if}{if $gdzSetting.customersignin_class} {$gdzSetting.customersignin_class}{/if}">
			<ul>
				{if $gdzSetting.customersignin_logged_links && 'my-account'|in_array:$gdzSetting.customersignin_logged_links}
					<li><a href="{$my_account_url}">{l s='My Account' d='Shop.Theme.Actions'}</a></li>
				{/if}
				{if $gdzSetting.customersignin_logged_links && 'my-orders'|in_array:$gdzSetting.customersignin_logged_links}
					<li><a href="{$urls.pages.history}">{l s='My Order' d='Shop.Theme.Actions'}</a></li>
				{/if}
				{if $gdzSetting.customersignin_logged_links && 'checkout'|in_array:$gdzSetting.customersignin_logged_links}
					<li><a href="{$link->getPageLink('order', true)}" title="{l s='Checkout' d='Shop.Theme.Customeraccount'}" class="account" rel="nofollow">{l s='Checkout' d='Shop.Theme.Customeraccount'} </a></li>
				{/if}
				{if $gdzSetting.customersignin_logged_links && 'logout'|in_array:$gdzSetting.customersignin_logged_links}
					<li><a class="logout" href="{$logout_url}" rel="nofollow" >{l s='Log out' d='Shop.Theme.Actions'}</a></li>
				{/if}
			</ul>
		</div>
	{else}
	<div id="login" class="dropdown-menu user-info-content{if $gdzSetting.customersignin_type =='sidebar'} user-info-sidebar{/if}{if $gdzSetting.customersignin_class} {$gdzSetting.customersignin_class}{/if}">
		<ul>
			{if $gdzSetting.customersignin_logged_links && 'register'|in_array:$gdzSetting.customersignin_notlogged_links}
				<li><a href="{$urls.pages.register}" title="{l s='Register' d='Shop.Theme.Customeraccount'}" class="account" rel="nofollow">{l s='Register' d='Shop.Theme.Customeraccount'} </a></li>
			{/if}
			{if $gdzSetting.customersignin_logged_links && 'login'|in_array:$gdzSetting.customersignin_notlogged_links}
				<li><a class="login" href="{$my_account_url}" title="{l s='Login' d='Shop.Theme.Customeraccount'}" rel="nofollow" >{l s='Log In' d='Shop.Theme.Actions'}</a></li>
			{/if}
		</ul>
	</div>
	{/if}
</div>

