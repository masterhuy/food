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
<style type="text/css">
<%
v_offset_arr = [];
if(v_offset) v_offset_arr = v_offset.split("-");
h_offset_arr = [];
if(h_offset) h_offset_arr = h_offset.split("-");
v_direct = 'top';
if(content_position.includes('bottom')) v_direct = 'bottom';
h_direct = 'right';
if(content_position.includes('left')) h_direct = 'left';
st_size = [];
if(subtitle_fontsize) st_size = subtitle_fontsize.split("-");
st_lineheight = [];
if(subtitle_lineheight) st_lineheight = subtitle_lineheight.split("-");
t_size = [];
if(title_fontsize) t_size = title_fontsize.split("-");
t_lineheight = [];
if(title_lineheight) t_lineheight = title_lineheight.split("-");
d_size = [];
if(description_fontsize) d_size = description_fontsize.split("-");
d_lineheight = [];
if(description_lineheight) d_lineheight = description_lineheight.split("-");
%>
#<%= addonid %> .pb-banner-text {
    <%= v_direct %>: <%= v_offset_arr[0] %>px;
		<%= h_direct %>: <%= h_offset_arr[0] %>px;
		text-align: <%= text_align %>;
    <% if (h_direct == 'left') { %>
      right:auto;
    <% } else { %>
      left:auto;
    <% } %>
}
#<%= addonid %> .pb-banner-subtitle {
    font-size: <%= st_size[0] %>px;
    line-height: <%= st_lineheight[0] %>px;
    color: <%= subtitle_color %>;
}
#<%= addonid %> .pb-banner-title {
    font-size: <%= t_size[0] %>px;
    line-height: <%= t_lineheight[0] %>px;
    color: <%= title_color %>;
}
#<%= addonid %> .pb-banner-desc {
    font-size: <%= d_size[0] %>px;
    line-height: <%= d_lineheight[0] %>px;
    color: <%= description_color %>;
}
@media (max-width:991px) {
  #<%= addonid %> .pb-banner-text {
      <%= v_direct %>: <%= v_offset_arr[1] %>px;
			<%= h_direct %>: <%= h_offset_arr[1] %>px;
  }
  #<%= addonid %> .pb-banner-subtitle {
      font-size: <%= st_size[1] %>px;
      line-height: <%= st_lineheight[1] %>px;
  }
  #<%= addonid %> .pb-banner-title {
      font-size: <%= t_size[1] %>px;
      line-height: <%= t_lineheight[1] %>px;
  }
  #<%= addonid %> .pb-banner-desc {
      font-size: <%= d_size[1] %>px;
      line-height: <%= d_lineheight[1] %>px;
  }
}
@media (max-width:575px) {
  #<%= addonid %> .pb-banner-text {
      <%= v_direct %>: <%= v_offset_arr[2] %>px;
			<%= h_direct %>: <%= h_offset_arr[2] %>px;
  }
  #<%= addonid %> .pb-banner-subtitle {
      font-size: <%= st_size[2] %>px;
      line-height: <%= st_lineheight[2] %>px;
  }
  #<%= addonid %> .pb-banner-title {
      font-size: <%= t_size[2] %>px;
      line-height: <%= t_lineheight[2] %>px;
  }
  #<%= addonid %> .pb-banner-desc {
      font-size: <%= d_size[2] %>px;
      line-height: <%= d_lineheight[2] %>px;
  }
}
</style>
<div class="pb-banner<% if(box_class) { %> <%= box_class %><% } %>">
<% if (banner_link) { %>
<a href="<%= banner_link %>" target="<%= target %>">
<% } %>
<% if (banner) { %>
<div class="pb-banner-img">
		<img src="<%= banner %>" alt="<%= alt_text %>" class="img-responsive" />
</div>
<div class="pb-banner-text pb-banner-<%= content_position %>">
	<% if (subtitle) { %><span class="pb-banner-subtitle"><%= subtitle %></span><% } %>
	<% if (title) { %><<%= title_tag %> class="pb-banner-title"><%= title %></<%= title_tag %>><% } %>
	<% if (description) { %><div class="pb-banner-desc"><%= description %></div><% } %>
	<% if (button_text) { %><div><div class="pb-banner-button btn"><span><%= button_text %></span></div></div><% } %>
</div>
<% } %>
<% if (banner_link) { %>
</a>
<% } %>
</div>
