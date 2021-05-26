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
<div class="pb-button{if $box_class} {$box_class|escape:'htmlall':'UTF-8'}{/if}{if $button_align} pb-button-{$button_align}{/if}">
{if $button_text}
<a class="btn{if $button_size} btn-{$button_size}{/if}{if $button_style} btn-{$button_style}{/if}{if $button_align} btn-{$button_align}{/if}" href="{if $button_link}{$button_link nofilter}{else}#{/if}" target="{$target nofilter}">
	{$button_text}
</a>
{/if}
</div>
