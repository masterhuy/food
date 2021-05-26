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
<div class="pb-video">
{if $video_modal}
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
												<iframe width="320" height="320" src="{$video_source nofilter}?{$video_setting nofilter}" frameborder="0" allowfullscreen=""></iframe>
										</div>
								</div>
						</div>
				</div>
		</div>
{else}
		<div class="pb-video-wrapper video-screen-{$aspect_ratio}">
		{if $video_source}
		<iframe width="320" height="320" src="{$video_source nofilter}?{$video_setting nofilter}" frameborder="0" allowfullscreen=""></iframe>
		{/if}
		</div>
{/if}
</div>
