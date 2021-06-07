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
<%
component = $('#gdz-configuration').data('component');
if(popuptype == 'custom_html') {
		popup_content = html_content;
} else {
		popup_content = '';
		var post_data = 'module=' + modulename + '&hook=' + modulehook;
		$.ajax({
				type: 'POST',
				url: PagebuilderConfig.editor_link + '&action=GetModule&ajax=1',
				data:post_data,
				success: function(data)
				{
						popup_content = data;
						component.find('.gdz-popup-content').html(popup_content);
				}
		});
}
if(component) {
		var window_w = $('#pagebuilder-preview-iframe').width();
		var window_h = $('#pagebuilder-preview-iframe').height();
		var width_default  = popup_width;
		var height_default  = popup_height;
		if(window_w > width_default) {
			var popup_width = width_default;
			var popup_left = (window_w - width_default)/2;
		} else {
			var popup_width = window_w - 40;
			component.find('.gdz-popup').css('width', window_w - 40);
			var popup_left = 20;
		}
		if(window_h > height_default) {
			var popup_height = height_default;
			var popup_top = (window_h - height_default)/2;
		} else {
			var popup_height = window_h - 40;
			var popup_top = 20;
		}
}
%>
<style type="text/css">
#<%= addonid %> .gdz-popup {
	width:<%= popup_width %>px;
	height:<%= popup_height %>px;
	top:<%= popup_top %>px;
	left:<%= popup_left %>px;
}
</style>
<div class="pb-popup gdz-popup-overlay" style="display:block;">
	<div class="gdz-popup">
		<div class="gdz-popup-content">
				<% if (popup_title) { %>
				<h2>
					<%= popup_title %>
				</h2>
				<% } %>
				<div class="gdz-popup-content">
					<div>
							<%= popup_content %>
					</div>
				</div>
		</div>
		<div class="dontshow">
			<input type="checkbox" name="dontshowagain" value="1" id="dontshowagain" />
			<label>{l s='Dont show this box again' mod='gdz_pagebuilder'}</label>
		</div>
		<a class="popup-close"><i class="fa fa-close"></i></a>
		<input type="hidden" name="width_default" id="width-default" value="<%= popup_width %>" />
		<input type="hidden" name="height_default" id="height-default" value="<%= popup_height %>" />
		<input type="hidden" name="loadtime" id="loadtime" value="<%= loadtime %>" />
	</div>
</div>
