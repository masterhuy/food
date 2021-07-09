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
			<g id="user">
				<path id="icon/action/perm_identity_24px" fill-rule="evenodd" clip-rule="evenodd" d="M15 5C12.2375 5 10 7.2375 10 10C10 12.7625 12.2375 15 15 15C17.7625 15 20 12.7625 20 10C20 7.2375 17.7625 5 15 5ZM17.5 10C17.5 8.625 16.375 7.5 15 7.5C13.625 7.5 12.5 8.625 12.5 10C12.5 11.375 13.625 12.5 15 12.5C16.375 12.5 17.5 11.375 17.5 10ZM22.5 21.25C22.25 20.3625 18.375 18.75 15 18.75C11.625 18.75 7.75 20.3625 7.5 21.2625V22.5H22.5V21.25ZM5 21.25C5 17.925 11.6625 16.25 15 16.25C18.3375 16.25 25 17.925 25 21.25V25H5V21.25Z" fill="#3F2803"/>
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

