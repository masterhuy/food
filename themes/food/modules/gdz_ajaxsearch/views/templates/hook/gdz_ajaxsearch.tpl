{*
* 2007-2019 PrestaShop
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
*  @copyright  2007-2019 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="search-form" class="search-form">
    <div class="search-box">
		<form method="get" action="{$link->getPageLink('search')|escape:'html':'UTF-8'}" class="search-box">
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
        	<div class="input-group">
				<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M17.4593 16.6307H18.3809L24.2026 22.464L22.4643 24.2024L16.6309 18.3807V17.459L16.3159 17.1324C14.9859 18.2757 13.2593 18.964 11.3809 18.964C7.19261 18.964 3.79761 15.569 3.79761 11.3807C3.79761 7.19236 7.19261 3.79736 11.3809 3.79736C15.5693 3.79736 18.9643 7.19236 18.9643 11.3807C18.9643 13.259 18.2759 14.9857 17.1326 16.3157L17.4593 16.6307ZM6.13094 11.3807C6.13094 14.2857 8.47594 16.6307 11.3809 16.6307C14.2859 16.6307 16.6309 14.2857 16.6309 11.3807C16.6309 8.47572 14.2859 6.13072 11.3809 6.13072C8.47594 6.13072 6.13094 8.47572 6.13094 11.3807Z" fill="#3F2803"/>
				</svg>
    			<input type="text" name="search_query" placeholder="{l s='Search everything...' mod='gdz_ajaxsearch'}" class="gdz-search-input form-control search-input" />
    			<button type="submit" name="submit_search" class="button-search">
					{l s='Search' mod='gdz_ajaxsearch'}
    			</button>
        	</div>
		</form>
		<div class="search-result-area"></div>
    </div>
</div>
