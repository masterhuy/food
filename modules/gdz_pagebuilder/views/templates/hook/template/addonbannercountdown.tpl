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
<div class="pb-banner-countdown<<% if(box_class) { %> <%= box_class %><% } %><% if (banner) { %> countdown-has-banner<% } %>">
<% if (banner_link && banner) { %>
<a href="<%= banner_link %>" target="<%= target %>">
<% } %>
<% if (banner) { %>
<div class="pb-banner-countdown-img">
		<img src="<%= banner %>" alt="<%= alt_text %>" class="img-responsive" />
</div>
<% } %>
<% if (banner_link && banner) { %>
</a>
<% } %>
<div class="pb-banner-countdown-text">
	<% if (subtitle) { %><span class="pb-banner-countdown-subtitle"><span><%= subtitle %></span></span><% } %>
	<% if (title) { %><<%= title_tag %> class="pb-banner-countdown-title"><span><%= title %></span></<%= title_tag %>><% } %>
	<% if (description) { %><div class="pb-banner-countdown-desc"><span><%= description %></span></div><% } %>
	<% if (button_text) { %><div><div class="pb-banner-countdown-button btn"><span><%= button_text %></span></div></div><% } %>
</div>
<div class="pb-banner-countdown-time countdown">
	<%= expire_time %>
</div>

</div>
