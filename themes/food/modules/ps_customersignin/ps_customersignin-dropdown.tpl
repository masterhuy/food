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
	<a href="#" class="link-dropdown" data-toggle="dropdown" data-display="static">{l s='Sign in' d='Shop.Theme.Actions'}</a>
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

