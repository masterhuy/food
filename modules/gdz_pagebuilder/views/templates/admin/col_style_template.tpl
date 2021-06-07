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
{literal}
<style type="text/css" class="col-style" id="col_style_template">
#<%= col_id %> {
    <% if (text_color) { %>color: <%= text_color %>;<% } %>
    <% if (background_color) { %>background-color: <%= background_color %>!important;<% } %>
    <% if (background_img) { %>background-image: url(<%= background_img %>)!important;<% } %>
    <% if (background_size) { %>background-size: <%= background_size %>;<% } %>
    <% if (background_repeat) { %>background-repeat: <%= background_repeat %>!important;<% } %>
    <% if (background_position) { %>background-position: <%= background_position %>!important;<% } %>
    <% if (background_attachment) { %>background-attachment: <%= background_attachment %>!important;<% } %>
    <% if (animation_duration) { %>animation-duration: <%= animation_duration %>!important;<% } %>
    <% if (animation_delay) { %>animation-delay: <%= animation_delay %>!important;<% } %>
    padding: <%= obj['md_padding_top']?obj['md_padding_top']:0 %>px <%= obj['md_padding_right']?obj['md_padding_right']:0 %>px <%= obj['md_padding_bottom']?obj['md_padding_bottom']:0 %>px <%= obj['md_padding_left']?obj['md_padding_left']:0 %>px!important;
    margin: <%= obj['md_margin_top']?obj['md_margin_top']:0 %>px <%= obj['md_margin_right']?obj['md_margin_right']:0 %>px <%= obj['md_margin_bottom']?obj['md_margin_bottom']:0 %>px <%= obj['md_margin_left']?obj['md_margin_left']:0 %>px!important;

}
@media screen and (max-width: 991px) {
    #<%= col_id %> {
        padding: <%= obj['sm_padding_top']?obj['sm_padding_top']:0 %>px <%= obj['sm_padding_right']?obj['sm_padding_right']:0 %>px <%= obj['sm_padding_bottom']?obj['sm_padding_bottom']:0 %>px <%= obj['sm_padding_left']?obj['sm_padding_left']:0 %>px!important;
        margin: <%= obj['sm_margin_top']?obj['sm_margin_top']:0 %>px <%= obj['sm_margin_right']?obj['sm_margin_right']:0 %>px <%= obj['sm_margin_bottom']?obj['sm_margin_bottom']:0 %>px <%= obj['sm_margin_left']?obj['sm_margin_left']:0 %>px!important;
    }
}
@media screen and (max-width: 575px) {
    #<%= col_id %> {
        padding: <%= obj['xs_padding_top']?obj['xs_padding_top']:0 %>px <%= obj['xs_padding_right']?obj['xs_padding_right']:0 %>px <%= obj['xs_padding_bottom']?obj['xs_padding_bottom']:0 %>px <%= obj['xs_padding_left']?obj['xs_padding_left']:0 %>px!important;
        margin: <%= obj['xs_margin_top']?obj['xs_margin_top']:0 %>px <%= obj['xs_margin_right']?obj['xs_margin_right']:0 %>px <%= obj['xs_margin_bottom']?obj['xs_margin_bottom']:0 %>px <%= obj['xs_margin_left']?obj['xs_margin_left']:0 %>px!important;
    }
}

</style>
{/literal}
