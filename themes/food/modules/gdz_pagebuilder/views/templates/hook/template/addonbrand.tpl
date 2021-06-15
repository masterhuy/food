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
<% if(images.length == 0) { return } %>
<div class="pb-brand">
<div class="brand-carousel owl-carousel carousel-tpl" data-items="<% if (items_show_md) { %><%= items_show_md %><% } else { %>5<% } %>" data-lg="<% if (items_show_md) { %><%= items_show_md %><% } else { %>5<% } %>" data-md="<% if (items_show_md) { %><%= items_show_md %><% } else { %>4<% } %>" data-sm="<% if (items_show_sm) { %><%= items_show_sm %><% } else { %>3<% } %>" data-xs="<% if (items_show_xs) { %><%= items_show_xs %><% } else { %>2<% } %>" data-nav="<% if (navigation == '1') { %>true<% } else { %>false<% } %>" data-dots="<% if (pagination == '1') { %>true<% } else { %>false<% } %>" data-auto="<% if (autoplay == '1') { %>true<% } else { %>false<% } %>" data-rewind="<% if (rewind == '1') { %>true<% } else { %>false<% } %>" data-slidebypage="<% if (slidebypage == '1') { %>page<% } else { %>1<% } %>" data-margin="<% if (gutter != '') { %><%= gutter %><% } else { %>30<% } %>">
<% _.forEach(images, function(image) { %>
    <div class="brand-item">
        <% if (image.image) { %>
        <a href="<%= image.link %>" title="<%= image.alt %>">
            <img src="<%= image.image %>" />
        </a>
        <% } %>
    </div>
<% }); %>
</div>

<script type="text/javascript">
    {literal}
    iframeDoc = document.getElementById('pagebuilder-preview-iframe').contentWindow.document;
    $(iframeDoc).find('#main').find('.carousel-tpl').trigger('carousel');
    {/literal}
</script>
</div>
