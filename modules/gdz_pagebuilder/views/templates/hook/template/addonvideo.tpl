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
<%
  var video_id = '';
  var video_setting = '';
  if (video_type == 'youtube') {
      var parser = new URL(youtube_link);
      var queries = parser['search'].replace("?", '').split("&");
      for( i = 0; i < queries.length; i++ ) {
          split = queries[i].split('=');
          if(split[0] == 'v')
              var video_id = split[1];
      }
      var video_source = '//www.youtube.com/embed/' + video_id;
      if (autoplay == '1')
          video_setting += 'autoplay=1&mute=1';
      else
          video_setting += 'autoplay=0';
      if (loop == '1')
          video_setting += '&loop=1';
      else
          video_setting += '&loop=0';
      if(playercontrol == '1')
          video_setting += '&controls=1';
      else
          video_setting += '&controls=0';
      if(playertitleactions == '1')
          video_setting += '&showinfos=1';
      else
          video_setting += '&showinfos=0';
  } else {
      var parser = new URL(vimeo_link);
      var video_id = parser.pathname.replace("/", '');
      var video_source = '//player.vimeo.com/video/' + video_id;
      if (autoplay == '1')
          video_setting += 'autoplay=1&muted=1';
      else
          video_setting += 'autoplay=0';
      if (loop == '1')
          video_setting += '&loop=1';
      else
          video_setting += '&loop=0';
      if(introtitle == '1')
          video_setting += '&title=1';
      else
          video_setting += '&controls=0';
      if(introportrait == '1')
          video_setting += '&portrait=1';
      else
          video_setting += '&portrait=0';
      if(introbyline == '1')
          video_setting += '&byline=1';
      else
          video_setting += '&byline=0';
      if(controlscolor == '1')
          video_setting += '&color=1';
      else
          video_setting += '&color=0';
  }
%>
<div class="pb-video">
<% if (video_modal == '1') { %>
		<div class="pb-video-wrapper">
				<button class="pb-video-open-modal" data-toggle="modal" data-target="#pb-video-modal">
					<i class="fa fa-play-circle"></i>
				</button>
				<div class="modal fade pb-video-modal" id="pb-video-modal">
						<div class="modal-dialog" role="document">
								<div class="modal-content">
										<div class="modal-header">
												<span class="modal-title"></span>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
												</button>
										</div>
										<div class="modal-body">
												<iframe width="320" height="320" src="<%= video_source %>?<%= video_setting %>" frameborder="0" allowfullscreen=""></iframe>
										</div>
								</div>
						</div>
				</div>
		</div>
<% } else { %>
		<div class="pb-video-wrapper video-screen-<%= aspect_ratio %>">
		<% if (video_source) { %>
		<iframe width="320" height="320" src="<%= video_source %>?<%= video_setting %>" frameborder="0" allowfullscreen=""></iframe>
		<% } %>
		</div>
<% } %>
</div>
