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

<div class="btn-group menu-collapse compact-hidden gdz_ajax_search" id="gdz_ajax_search">
	<a href="#" class="btn-search dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
	<div id="search-form" class="dropdown-menu">
		<div class="search-box">
			<form method="get" action="{$link->getPageLink('search')|escape:'html':'UTF-8'}" class="searchbox">
				<input type="hidden" name="controller" value="search" />
				<input type="hidden" name="orderby" value="position" />
				<input type="hidden" name="orderway" value="desc" />
				<input type="text" id="ajax_search" name="search_query" placeholder="{l s='Search everything...' mod='gdz_ajaxsearch'}" class="form-control ajax_search" />
				<button type="submit" name="submit_search" class="button-search">
					<span>{l s='Search' mod='gdz_ajaxsearch'}</span>
				</button>
			</form>
			<div id="search_result"></div>
		</div>
	</div>
</div>
