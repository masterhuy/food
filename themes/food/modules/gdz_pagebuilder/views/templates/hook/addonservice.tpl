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
<div class="pb-service-box{if $box_class} {$box_class|escape:'htmlall':'UTF-8'}{/if}">
		<div class="pb-service-icon">
		{if $icon_type == 'image' && $image}
			<img src="{$image|escape:'html':'UTF-8'}" alt="{$alt_text|escape:'htmlall':'UTF-8'}" />
		{elseif $icon_class}
			<i class="{$icon_class|escape:'htmlall':'UTF-8'}"></i>
		{/if}
		</div>
		<div class="pb-service-content">
				{if $title}
				<{$title_tag} class="pb-service-title">{$title nofilter}</{$title_tag}>
				{/if}
				{if $description}
				<div class="pb-service-description">
				{$description nofilter}
				</div>
				{/if}
				{if $button_text}
				<a class="pb-service-button btn" href="{if $button_link}{$button_link|escape:'htmlall':'UTF-8'}{else}#{/if}"{if $target == '_blank'} target="_blank"{/if}>{$button_text|escape:'htmlall':'UTF-8'}</a>
				{/if}
		</div>
</div>
