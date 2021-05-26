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
<div class="addon-title">
    <h2>
        {l s='Siga-nos no Instagram' d='jmspagebuilder'} @{$profile.username}
    </h2>
</div>
<div class="pb-instagram" data-option="{$instagram_options nofilter}">
    {if $view_type == 'grid'}
        <div class="pb-instagram-images pb-instagram-grid row">
            {foreach $images as $image}
                {if $options.linked}
                <a href="{$image['permalink']}" class="{$options.element_class}" style="display: inline-block;">
                    <img class="img-thumbnail" src="{$image['media_url']}" {if isset($image['caption'])}alt="{$image['caption']}"{/if}>
                </a>
                {else}
                <div class="{$options.element_class}">
                    <img class="img-thumbnail" src="{$image['media_url']}" {if isset($image['caption'])}alt="{$image['caption']}"{/if}>
                </div>
                {/if}
            {/foreach}
        </div>
    {else}
        <div class="pb-instagram-images pb-instagram-carousel pb-instagram" data-items="{if $cols}{$cols|escape:'htmlall':'UTF-8'}{else}4{/if}" data-lg="{if $cols_lg}{$cols_lg|escape:'htmlall':'UTF-8'}{else}4{/if}" data-md="{if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if}" data-sm="{if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if}" data-xs="{if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if}" data-nav="{$navigation}" data-dots="{$pagination}" data-auto="{$autoplay}" data-rewind="{$rewind}" data-slidebypage="{if $slidebypage == '1'}page{else}1{/if}">
            {foreach $images as $image}
                {if $options.linked}
                <a href="{$image['permalink']}" class="{$options.element_class}" style="display: inline-block;">
                    <img class="img-thumbnail" src="{$image['media_url']}" {if isset($image['caption'])}alt="{$image['caption']}"{/if}>
                </a>
                {else}
                <div class="{$options.element_class}">
                    <img class="img-thumbnail" src="{$image['media_url']}" {if isset($image['caption'])}alt="{$image['caption']}"{/if}>
                </div>
                {/if}
            {/foreach}
        </div>
    {/if}
</div>
