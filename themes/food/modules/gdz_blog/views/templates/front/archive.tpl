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
<h3 class="title-blog text-center mb-50">{l s='Archive' d='Modules.JmsBlog'} : {$month nofilter}</h3>
{if isset($posts) AND $posts}		
	<div class="post-list">
		{foreach from=$posts item=post}
			{assign var=params value=['post_id' => $post.post_id, 'category_slug' => $post.category_alias, 'slug' => $post.alias]}			
			{assign var=catparams value=['category_id' => $post.category_id, 'slug' => $post.category_alias]}
			<article class="blog-post">
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
			</article>			
		{/foreach}
	</div>
{else}	
{l s='Sorry, dont have any post in this category' mod='gdz_blog'}
{/if}
{/block}

