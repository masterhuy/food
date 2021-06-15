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
				{block name="page_content"}
				{capture name=path}{$current_category.title|escape:'html':'UTF-8'}{/capture}
				{if isset($posts) AND $posts}
					<div class="cat-post-list more-columns row">
						{foreach from=$posts item=post}
							{assign var=params value=['post_id' => $post.post_id, 'category_slug' => $post.category_alias, 'slug' => $post.alias]}
							{assign var=catparams value=['category_id' => $post.category_id, 'slug' => $post.category_alias]}
							<div class="item col-12">
								<div class="blog-post">
									<div class="post-thumb">
										{if $post.link_video && $gdz_blog_setting.GDZBLOG_SHOW_MEDIA}
											{$post.link_video}
										{elseif $post.image && $gdz_blog_setting.GDZBLOG_SHOW_MEDIA}
											<a class="link" href="{gdz_blog::getPageLink('gdz_blog-post', $params)}">
												<img src="{$image_baseurl|escape:'html':'UTF-8'}{$post.image|escape:'html':'UTF-8'}" alt=""/>
											</a>
										{/if}
									</div>
									<ul class="post-meta">
										{if $gdz_blog_setting.GDZBLOG_SHOW_CATEGORY}
											<li class="category-name">
												<span>
													{l s='In' d='Modules.gdz_blog'}
												</span>
												<a href="{gdz_blog::getPageLink('gdz_blog-category', $catparams)}">
													{$post.category_name|escape:'html':'UTF-8'}
												</a>
											</li>
										{/if}
										<li class="created">
											<span class="day">{$post.created|escape:'html':'UTF-8'|date_format:'%e'}</span>
											<span class="month">{$post.created|escape:'html':'UTF-8'|date_format:'%b'}</span>
										</li>
										{if $gdz_blog_setting.GDZBLOG_SHOW_VIEWS}
											<li>
												<span>{$post.views|escape:'html':'UTF-8'} {l s='view(s)' d='Modules.gdz_blog'}</span>
											</li>
										{/if}
										{if $gdz_blog_setting.GDZBLOG_SHOW_COMMENTS}
											<li>
												<span>
													{$post.comment_count|escape:'html':'UTF-8'}
													{if $post.comment_count > 0}
														{l s='comments' d='Modules.JmsPagebuilder'}
													{else}
														{l s='comment' d='Modules.JmsPagebuilder'}
													{/if}
												</span>
											</li>
										{/if}
									</ul>
									<div class="post-info">
										<h4 class="post-title">
											<a class="blog-list-title" href="{gdz_blog::getPageLink('gdz_blog-post', $params)}" alt="{l s='Blog Images' d='Modules.gdz_blog'}">{$post.title|escape:'htmlall':'UTF-8'}</a>
										</h4>
										<div class="post-intro">
											{$post.introtext|truncate:380:'...' nofilter}
										</div>
									</div>
									<a class="blog-readmore" href="{gdz_blog::getPageLink('gdz_blog-post', $params)}">
										{l s='Read more' d='Modules.gdz_blog'}
									</a>
								</div>
							</div>
						{/foreach}
					</div>
				{else}
					{l s='Sorry, dont have any post in this category' d='Modules.JmsBlog'}
				{/if}
				{/block}
            </section>
        {/block}
        {block name='page_footer_container'}{/block}
    </section>
{/block}
