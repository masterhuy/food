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
<style type="text/css">
#<%= addonid %> .pb-divider {
    padding-top:<%= divider_gap %>px;
    padding-bottom:<%= divider_gap %>px;
    text-align:<%= divider_align %>;
}
#<%= addonid %> .pb-divider-separator {
    border-top-style: <%= divider_style %>;
    border-top-width: <%= divider_weight %>px;
    width: <%= divider_width %>%;
    border-top-color: <%= divider_color %>;
}
</style>
<div class="pb-divider<% if(box_class) { %> <%= box_class %><% } %>">
  <span class="pb-divider-separator"></span>
</div>
