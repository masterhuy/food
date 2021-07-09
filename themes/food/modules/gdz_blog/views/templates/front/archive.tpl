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
{extends file='page.tpl'}
{block name="page_content"}
{capture name=path}{l s='Archive' mod='gdz_blog'}-{$month nofilter}{/capture}
<h3 class="title-blog">{l s='Archive' mod='gdz_blog'} : {$month nofilter}</h3>
{if isset($posts) AND $posts}		
	<div class="post-list">
		{foreach from=$posts item=post}
			{assign var=params value=['post_id' => $post.post_id, 'category_slug' => $post.category_alias, 'slug' => $post.alias]}			
			{assign var=catparams value=['category_id' => $post.category_id, 'slug' => $post.category_alias]}
			<article class="blog-post">
				<h4 class="post-title"><a href="{gdz_blog::getPageLink('gdz_blog-post', $params) nofilter}">{$post.title|escape:'htmlall':'UTF-8'}</a></h4>
				<ul class="post-meta">
					{if $gdz_blog_setting.GDZBLOG_SHOW_CATEGORY}
					<li class="post-category"><span>{l s='Category' mod='gdz_blog'} :</span> <a href="{gdz_blog::getPageLink('gdz_blog-category', $catparams) nofilter}">{$post.category_name nofilter}</a></li>
					{/if}					
					<li class="post-created"><span>{l s='Created' mod='gdz_blog'} :</span> {$post.created nofilter|date_format:"%B %e, %Y"}</li>
					{if $gdz_blog_setting.GDZBLOG_SHOW_VIEWS}
					<li class="post-views"><span>{l s='Views' mod='gdz_blog'} :</span> {$post.views nofilter}</li>
					{/if}
					{if $gdz_blog_setting.GDZBLOG_SHOW_COMMENTS}
					<li class="post-comments"><span>{l s='Comments' mod='gdz_blog'} :</span> {$post.comment_count nofilter}</li>
					{/if}	
				</ul>									
				{if $post.link_video && $gdz_blog_setting.GDZBLOG_SHOW_MEDIA}
					<div class="post-thumb">
					{$post.link_video nofilter}
					</div>
				{elseif $post.image && $gdz_blog_setting.GDZBLOG_SHOW_MEDIA}
					<div class="post-thumb">
						<a href="#"><img src="{$image_baseurl nofilter}{$post.image nofilter}" alt="{$post.title|escape:'htmlall':'UTF-8'}" class="img-responsive" /></a>			 		
					</div>
				{/if}				
				<div class="blog-intro">{$post.introtext nofilter}</div>				
				<a class="btn btn-active blog-readmore" href="#">{l s='Read more' mod='gdz_blog'} ...</a>
			</article>			
		{/foreach}
	</div>
{else}	
{l s='Sorry, dont have any post in this category' mod='gdz_blog'}
{/if}
{/block}

