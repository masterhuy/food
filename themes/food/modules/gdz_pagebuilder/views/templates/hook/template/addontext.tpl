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
<% if (content) { %>
<style type="text/css">
<%
fontsize_arr = [];
if(fontsize) fontsize_arr = fontsize.split("-");
%>
#<%= addonid %> .pb-text-content {
    font-size: <%= fontsize_arr[0] %>px;
    color:<%= textcolor %>;
    text-align:<%= text_align %>;
}
@media (max-width:991px) {
  #<%= addonid %> .pb-text-content {
      font-size: <%= fontsize_arr[1] %>px;
  }
}
@media (max-width:575px) {
  #<%= addonid %> .pb-text-content {
      font-size: <%= fontsize_arr[2] %>px;
  }
}
</style>
    <div class="pb-text-content"><%= content %></div>
<% } %>
