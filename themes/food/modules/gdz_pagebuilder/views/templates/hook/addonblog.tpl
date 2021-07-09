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
<div class="pb-blog">
{if $posts|@count gt 0}
<div class="blog-carousel owl-carousel" data-items="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-lg="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}4{/if}" data-md="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if}" data-sm="{if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if}" data-xs="{if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if}" data-nav="{if $navigation == '0'}false{else}true{/if}" data-dots="{if $pagination == '1'}true{else}false{/if}" data-auto="{if $autoplay == '1'}true{else}false{/if}" data-rewind="{if $rewind == '1'}true{else}false{/if}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}" data-margin="{if isset($gutter)}{$gutter|escape:'htmlall':'UTF-8'}{else}30{/if}">
	{foreach from = $posts item = posts_slide}
		<div class="item">
			{foreach from = $posts_slide item = post}
				{assign var=params value=['post_id' => $post.post_id, 'category_slug' => $post.category_alias, 'slug' => $post.alias]}
				{assign var=catparams value=['category_id' => $post.category_id, 'slug' => $post.category_alias]}
				<div class="blog-item">
						{if $post.link_video && ($show_media == '1')}
							<div class="post-thumb">
								{$post.link_video nofilter}
							</div>
						{elseif $post.image && ($show_media == '1')}
							<div class="post-thumb">
								<a href="{$post.postlink|escape:'htmlall':'UTF-8'|replace:'&amp;':'&'}"><img src="{$image_url nofilter}resized_{$post.image nofilter}" alt="{$post.title nofilter}" class="img-responsive" /></a>
							</div>
						{/if}
						<ul class="post-meta">
							{if $show_category == '1'}
								<li class="post-category">
									<span>{l s='Category:' d='Modules.Gdzblog.Addonblog'}</span>
									<a href="{$post.catlink|escape:'htmlall':'UTF-8'|replace:'&amp;':'&'}">{$post.category_name nofilter}</a>
								</li>
							{/if}
							{if $show_time == '1'}
								<li class="post-created">
									<span>{l s='Posted:' d='Modules.Gdzblog.Addonblog'}</span>
									{$post.created|escape:'html':'UTF-8'|date_format:'%B %e, %Y'}
								</li>
							{/if}
							{if $show_nviews == '1'}
								<li class="post-views">{$post.views nofilter} {l s='views' d='Modules.Gdzblog.Addonblog'}</li>
							{/if}
							{if $show_ncomments == '1'}
								<li class="post-comments">{$post.comment_count nofilter} {l s='comments' d='Modules.Gdzblog.Addonblog'}</li>
							{/if}
						</ul>
						<a class="post-title" href="{$post.postlink|escape:'htmlall':'UTF-8'|replace:'&amp;':'&'}">{$post.title nofilter}</a>
						{if $show_introtext == '1'}
							<div class="post-intro">{$post.introtext nofilter}</div>
						{/if}
						{if $show_readmore == '1'}
							<a class="btn btn-active post-readmore" href="{$post.postlink|escape:'htmlall':'UTF-8'|replace:'&amp;':'&'}"><span>{$readmore_text nofilter}</span></a>
						{/if}
				</div>
			{/foreach}
		</div>
	{/foreach}
</div>
{/if}
</div>
