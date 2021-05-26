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
<div class="panel">
	<h3><i class="icon-list-ul"></i> {l s='Comments' mod='gdz_blog'}
	{if $waiting_total gt 0}
		<div class="pull-right">
		{l s='There is ' mod='gdz_blog'} {$waiting_total nofilter} {l s='comments waiting approve' mod='gdz_blog'} 	
		<a href="{$link->getAdminLink('AdminGdzblogComment') nofilter}&configure=gdz_blog&ApproveAll" class="btn" title="#" >
		<i class="icon-warning"></i> {l s='Approve All' mod='gdz_blog'}
		</a>	
		</div>
	{/if}
	</h3>
	<div class="table-responsive-row clearfix">
		<table class="table tableDnD"><tbody id="posts">
			<tr class="heading">
				<th>{l s='ID' mod='gdz_blog'}</th>				
				<th>{l s='Name' mod='gdz_blog'}</th>
				<th>{l s='Time' mod='gdz_blog'}</th>				
				<th>{l s='Comment' mod='gdz_blog'}</th>				
				<th class="right">{l s='Action' mod='gdz_blog'}</th>
			</tr>
			{foreach from=$items key=i item=comment}
				<tr id="posts_{$comment.comment_id nofilter}" class="{if $i%2 == 1}odd{/if}">					
					<td class="row-id">
						{$comment.comment_id nofilter} 
					</td>					
					<td class="name">
						<h4 class="pull-left">{$comment.customer_name nofilter}</h4>
					</td>
					<td class="time">
						<h4 class="pull-left">{$comment.time_add nofilter}</h4>
					</td>
					<td class="comment">
						{$comment.comment nofilter}
					</td>					
					<td>
						<div class="btn-group-action pull-right">
							{if $comment.status == -2}
								<a href="{$link->getAdminLink('AdminGdzblogComment') nofilter}&configure=gdz_blog&status_id_comment={$comment.comment_id nofilter}&Approve" class="btn btn-warning" title="#" >
									<i class="icon-warning"></i> {if $comment.status == -2}{l s='Approve' mod='gdz_blog'}{/if}
								</a>
							{else}
								<a class="btn {if $comment.status == 1}btn-success{else}btn-danger{/if}"	href="{$link->getAdminLink('AdminGdzblogComment') nofilter}&configure=gdz_blog&status_id_comment={$comment.comment_id nofilter}&changeCommentStatus" title="{if $comment.status == 1}Enabled{else}Disabled{/if}">
								<i class="{if $comment.status == 1}icon-check{else}icon-remove{/if}"></i>{if $comment.status == 1}Enabled{else}Disabled{/if}
								</a>
							{/if}
							<a class="btn btn-default"
									href="{$link->getAdminLink('AdminGdzblogComment') nofilter}&configure=gdz_blog&delete_id_comment={$comment.comment_id nofilter}" onclick="return confirm('Are you sure you want to delete this item?');">
								<i class="icon-trash"></i>
								{l s='Delete' mod='gdz_blog'}
							</a>
						</div>
					</td>
				</tr>				
			{/foreach}
		</tbody></table>
	</div>		
</div>