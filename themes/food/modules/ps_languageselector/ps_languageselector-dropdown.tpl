{*
* 2007-2019 PrestaShop
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
*  @copyright  2007-2019 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!-- Block languages module -->
{if count($languages) > 1}
	<div class="languages-info btn-group">
		<a href="#" class="link-dropdown" data-toggle="dropdown" data-display="static">
			{$current_language.name_simple}
			<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.41 0.294922L6 4.87492L10.59 0.294922L12 1.70492L6 7.70492L0 1.70492L1.41 0.294922Z" fill="#3F2803"/>
			</svg>
		</a>
		<div class="dropdown-menu">
			<ul>
				{foreach from=$languages key=k item=language name="languages"}
					<li {if $language.id_lang == $current_language.id_lang} class="current" {/if}>
						<a href="{url entity='language' id=$language.id_lang}" class="collapse-item">
							{$language.name_simple}
						</a>
					</li>
				{/foreach}
			</ul>
		</div>
	</div>
{/if}
<!-- /Block languages module -->
