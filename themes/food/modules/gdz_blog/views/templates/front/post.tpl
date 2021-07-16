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
{if isset($smarty.get.page_layout) && $smarty.get.page_layout !=''}
    {assign var='page_layout' value=$smarty.get.page_layout}
{/if}
{if $page_layout == 'no'}
	{assign var="layout" value="layouts/layout-full-width.tpl"}
{elseif $page_layout == 'right'}
	{assign var="layout" value="layouts/layout-right-column.tpl"}
{else}
	{assign var="layout" value="layouts/layout-left-column.tpl"}
{/if}
{extends file=$layout}
{block name='content'}
    <section id="main">
        {block name='page_content_container'}
            <section id="content" class="page-content">
                {block name='page_content_top'}{/block}
				{block name="page_content"}
				{capture name=path}{$post.title|escape:'html':'UTF-8'}{/capture}
				<div class="single-blog">
					<div class="blog-post">
						{assign var=params value=['post_id' => $post.post_id, 'category_slug' => $post.category_alias, 'slug' => $post.alias]}
						{assign var=catparams value=['category_id' => $post.category_id, 'slug' => $post.category_alias]}
						<h1 class="title">{$post.title|escape:'html':'UTF-8'}</h1>
						<ul class="post-meta">
							{if $gdz_blog_setting.GDZBLOG_SHOW_CATEGORY}
								<li class="category-name">
									<span>
										{l s='In' d='Modules.JmsBlog'}
										<a href="{gdz_blog::getPageLink('gdz_blog-category', $catparams)}">
											{$post.category_name|escape:'html':'UTF-8'}
										</a>
									</span>
								</li>
							{/if}
							<li class="post-created">
								{l s='Posted:' d='Modules.JmsBlog'}
								<span>{$post.created|escape:'htmlall':'UTF-8'|date_format:"%B %e, %Y"}</span>
							</li>
							{if $gdz_blog_setting.GDZBLOG_SHOW_VIEWS}
								<li>
									<span>{$post.views|escape:'html':'UTF-8'} {l s='view(s)' d='Modules.JmsBlog'}</span>
								</li>
							{/if}
							{if $gdz_blog_setting.GDZBLOG_SHOW_COMMENTS}
								<li>
									<span>{$comments|@count}{l s=' comments' d='Modules.JmsBlog'}</span>
								</li>
							{/if}
						</ul>
						{if $post.link_video && $gdz_blog_setting.GDZBLOG_SHOW_MEDIA}
							<div class="post-video">
								{$post.link_video}
							</div>
						{elseif $post.image && $gdz_blog_setting.GDZBLOG_SHOW_MEDIA}
							<div class="post-thumb">
								<img src="{$image_baseurl|escape:'html':'UTF-8'}{$post.image|escape:'html':'UTF-8'}" alt="{l s='Image Blog' d='Modules.JmsBlog'}" />
							</div>
						{/if}
						<div class="post-fulltext">
							{$post.fulltext nofilter}
						</div>
						{if $gdz_blog_setting.GDZBLOG_SHOW_SOCIAL_SHARING}
							<div class="social-sharing">
								{literal}
									<script type="text/javascript">var switchTo5x=true;</script>
									<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
									<script type="text/javascript">stLight.options({publisher: "a6f949b3-864b-44c5-b0ec-4140186ad958", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
								{/literal}
								<span class='st_sharethis_large' displayText='ShareThis'></span>
								{if $gdz_blog_setting.GDZBLOG_SHOW_FACEBOOK}
									<span class='st_facebook_large' displayText='Facebook'></span>
								{/if}
								{if $gdz_blog_setting.GDZBLOG_SHOW_TWITTER}
									<span class='st_twitter_large' displayText='Tweet'></span>
								{/if}
								{if $gdz_blog_setting.GDZBLOG_SHOW_GOOGLEPLUS}
									<span class='st_googleplus_large' displayText='Google +'></span>
								{/if}
								{if $gdz_blog_setting.GDZBLOG_SHOW_LINKEDIN}
									<span class='st_linkedin_large' displayText='LinkedIn'></span>
								{/if}
								{if $gdz_blog_setting.GDZBLOG_SHOW_PINTEREST}
									<span class='st_pinterest_large' displayText='Pinterest'></span>
								{/if}
								{if $gdz_blog_setting.GDZBLOG_SHOW_EMAIL}
									<span class='st_email_large' displayText='Email'></span>
								{/if}
							</div>
						{/if}
					</div>
				</div>
				{if $gdz_blog_setting.GDZBLOG_COMMENT_ENABLE}
					<div id="comments">
						{if $gdz_blog_setting.GDZBLOG_FACEBOOK_COMMENT == 0}
							{if $msg == 1}
								<div class="alert alert-success">
									{l s='Your comment submited' d='Modules.JmsBlog'} ! {if $gdz_blog_setting.GDZBLOG_AUTO_APPROVE_COMMENT == 0} {l s='Please waiting approve from Admin' d='Modules.JmsBlog'}.{/if}
								</div>
							{/if}
							{if $cerrors|@count gt 0}
								<ul>
								{foreach from=$cerrors item=cerror}
									<li class="error">{$cerror}</li>
								{/foreach}
								</ul>
							{/if}
							{if $comments}
								<div id="accordion" class="panel-group">
									<div class="panels">
										<h3>{l s='Comments' d='Modules.JmsBlog'}</h3>
										<div id="post-comments">
											{foreach from=$comments item=comment key = k}
												<div class="post-comment clearfix">
													<div class="post-comment-info">
														<div>
															<div class="user-image">
																<svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M29.1068 46.5H42.8932V43.5H29.1068V46.5ZM42.8932 46.5C48.1989 46.5 52.5 50.8011 52.5 56.1068H55.5C55.5 49.1443 49.8557 43.5 42.8932 43.5V46.5ZM29.1068 43.5C22.1443 43.5 16.5 49.1443 16.5 56.1068H19.5C19.5 50.8011 23.8011 46.5 29.1068 46.5V43.5ZM43.5 27C43.5 31.1421 40.1421 34.5 36 34.5V37.5C41.799 37.5 46.5 32.799 46.5 27H43.5ZM36 34.5C31.8579 34.5 28.5 31.1421 28.5 27H25.5C25.5 32.799 30.201 37.5 36 37.5V34.5ZM28.5 27C28.5 22.8579 31.8579 19.5 36 19.5V16.5C30.201 16.5 25.5 21.201 25.5 27H28.5ZM36 19.5C40.1421 19.5 43.5 22.8579 43.5 27H46.5C46.5 21.201 41.799 16.5 36 16.5V19.5ZM61.5 36C61.5 50.0833 50.0833 61.5 36 61.5V64.5C51.7401 64.5 64.5 51.7401 64.5 36H61.5ZM36 61.5C21.9167 61.5 10.5 50.0833 10.5 36H7.5C7.5 51.7401 20.2599 64.5 36 64.5V61.5ZM10.5 36C10.5 21.9167 21.9167 10.5 36 10.5V7.5C20.2599 7.5 7.5 20.2599 7.5 36H10.5ZM36 10.5C50.0833 10.5 61.5 21.9167 61.5 36H64.5C64.5 20.2599 51.7401 7.5 36 7.5V10.5Z" fill="white"/>
																</svg>
															</div>
														</div>
														<div class="post-info">
															<div class="title">
																<span>{$comment.customer_name|escape:'html':'UTF-8'}</span><span class="time-add">{$comment.time_add|escape:'html':'UTF-8'|date_format:'%B %e, %Y'}</span>
															</div>
															<p class="post-comment-content">{$comment.comment|truncate:200:'...'|escape:'html':'UTF-8'}</p>
														</div>
													</div>
												</div>
											{/foreach}
										</div>
									</div>
								</div>
							{/if}
							{if $gdz_blog_setting.GDZBLOG_ALLOW_GUEST_COMMENT || (!$gdz_blog_setting.GDZBLOG_ALLOW_GUEST_COMMENT && $logged)}
							<div class="commentForm">
								<h3>{l s='Leave a comment' d='Modules.JmsBlog'}</h3>
								<form id="commentForm" enctype="multipart/form-data" method="post" action="index.php?fc=module&module=gdz_blog&controller=post&post_id={$post.post_id|escape:'html':'UTF-8'}&action=submitComment">
									<div class="row">
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
												<input id="customer_name" placeholder="{l s='Your name' d='Modules.JmsBlog'}" class="form-control" name="customer_name" type="text" value="{$customer.firstname}{$customer.lastname}" required />
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
												<input id="comment_title" placeholder="{l s='Your email' d='Modules.JmsBlog'}" class="form-control" name="email" type="text" value="{$customer.email}" required />
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
												<input id="customer_site" placeholder="{l s='Your website' d='Modules.JmsBlog'}" class="form-control" name="customer_site" type="text" value=""/>
											</div>
										</div>
									</div>
									<div class="form-group">
										<textarea id="comment" placeholder="{l s='Your message' d='Modules.JmsBlog'}" class="form-control" name="comment" rows="3" required></textarea>
									</div>
									<div id="new_comment_form_footer">
										<input id="item_id_comment_send" name="post_id" type="hidden" value="{$post.post_id|escape:'html':'UTF-8'}" />
										<input id="item_id_comment_reply" name="post_id_comment_reply" type="hidden" value="" />
										<button id="submitComment" class="btn btn-active" name="submitComment" type="submit">{l s='Submit' d='Modules.JmsBlog'}</button>
									</div>
								</form>
							</div>
							{/if}
							{if !$gdz_blog_setting.GDZBLOG_ALLOW_GUEST_COMMENT && !$logged}
								{l s='Please Login to comment' d='Modules.JmsBlog'}
							{/if}
						{else}
							{include file="modules/gdz_blog/views/templates/front/comment_facebook.tpl"}
						{/if}
					</div>
				{/if}
				{/block}
            </section>
        {/block}
        {block name='page_footer_container'}{/block}
    </section>
{/block}
