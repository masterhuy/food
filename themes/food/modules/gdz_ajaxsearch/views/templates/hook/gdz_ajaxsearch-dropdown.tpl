{*
 * @package Jms Ajax Search
 * @version 1.1
 * @Copyright (C) 2009 - 2015 Joommasters.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @Website: http://www.joommasters.com
*}
<div class="btn-group gdz_ajax_search col-auto{if $gdzSetting.search_box_type} {$gdzSetting.search_box_type}{/if}" id="gdz_ajax_search">
	<a href="#" class="btn-search" data-toggle="dropdown" data-display="static">
		<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M21.2005 20.1944H22.3197L29.3888 27.2778L27.278 29.3886L20.1947 22.3194V21.2003L19.8122 20.8036C18.1972 22.1919 16.1005 23.0278 13.8197 23.0278C8.73383 23.0278 4.61133 18.9053 4.61133 13.8194C4.61133 8.73358 8.73383 4.61108 13.8197 4.61108C18.9055 4.61108 23.028 8.73358 23.028 13.8194C23.028 16.1003 22.1922 18.1969 20.8038 19.8119L21.2005 20.1944ZM7.44466 13.8194C7.44466 17.3469 10.2922 20.1944 13.8197 20.1944C17.3472 20.1944 20.1947 17.3469 20.1947 13.8194C20.1947 10.2919 17.3472 7.44442 13.8197 7.44442C10.2922 7.44442 7.44466 10.2919 7.44466 13.8194Z" fill="#3F2803"/>
		</svg>
	</a>
	<div id="search-form-dropdown" class="search-form dropdown-menu">
		<div class="search-box">
			<form method="get" action="{$link->getPageLink('search')|escape:'html':'UTF-8'}">
				<input type="hidden" name="controller" value="search" />
				<input type="hidden" name="orderby" value="position" />
				<input type="hidden" name="orderway" value="desc" />
				<div class="input-group">
					<button type="submit" name="submit_search" class="button-search">
						<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M21.2005 20.1944H22.3197L29.3888 27.2778L27.278 29.3886L20.1947 22.3194V21.2003L19.8122 20.8036C18.1972 22.1919 16.1005 23.0278 13.8197 23.0278C8.73383 23.0278 4.61133 18.9053 4.61133 13.8194C4.61133 8.73358 8.73383 4.61108 13.8197 4.61108C18.9055 4.61108 23.028 8.73358 23.028 13.8194C23.028 16.1003 22.1922 18.1969 20.8038 19.8119L21.2005 20.1944ZM7.44466 13.8194C7.44466 17.3469 10.2922 20.1944 13.8197 20.1944C17.3472 20.1944 20.1947 17.3469 20.1947 13.8194C20.1947 10.2919 17.3472 7.44442 13.8197 7.44442C10.2922 7.44442 7.44466 10.2919 7.44466 13.8194Z" fill="#3F2803"/>
						</svg>
					</button>
					<input type="text" name="search_query" placeholder="{l s='Search everything...' mod='gdz_ajaxsearch'}" class="gdz-search-input form-control search-input" />
				</div>
			</form>
			<div class="search-result-area"></div>
		</div>
	</div>
</div>
