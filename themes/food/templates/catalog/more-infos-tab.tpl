{**
 * 2007-2019 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div id="more_info_block" class="tabs tab-{$gdzSetting.product_page_tab_align}">
    {block name='product_tabs'}
    <ul class="nav nav-tabs">
        {if $product.description}<li class="nav-item"><a data-toggle="tab" href="#description" class="nav-link active">{l s='Description' d='Shop.Theme.Catalog'}</a></li>{/if}
        <li class="nav-item"><a data-toggle="tab" href="#product-details" class="nav-link">{l s='Product Details' d='Shop.Theme.Catalog'}</a></li>
        {if $product.attachments}<li><a data-toggle="tab" href="#attachments">{l s='Attachments' d='Shop.Theme.Catalog'}</a></li>{/if}
        {foreach from=$product.extraContent item=extra key=extraKey}
        <li class="nav-item"><a data-toggle="tab" href="#extra-{$extraKey}" class="nav-link">{$extra.title}</a></li>
        {/foreach}
    </ul>
    <div class="tab-content">
        {if $product.description}
        <div class="tab-pane active" id="description" role="tabpanel" aria-labelledby="description-tab">
          {block name='product_description'}
            <div class="product-description">{$product.description nofilter}</div>
          {/block}
        </div>
        {/if}
        <div class="tab-pane" id="product-details" role="tabpanel" aria-labelledby="product-details-tab">
          {block name='product_details'}
              {include file='catalog/_partials/product-details.tpl'}
          {/block}
        </div>
        {if $product.attachments}
        <div class="tab-pane" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
            <section class="product-attachments">
                    <h3 class="h5 text-uppercase">{l s='Download' d='Shop.Theme.Actions'}</h3>
                    {foreach from=$product.attachments item=attachment}
                    <div class="attachment">
                        <h4><a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">{$attachment.name}</a></h4>
                        <p>{$attachment.description}</p
                        <a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">
                        {l s='Download' d='Shop.Theme.Actions'} ({$attachment.file_size_formatted})
                        </a>
                    </div>
                    {/foreach}
            </section>
        </div>
        {/if}
        {foreach from=$product.extraContent item=extra key=extraKey}
        <div class="tab-panel {$extra.attr.class}" id="extra-{$extraKey}" role="tabpanel" aria-labelledby="extra-{$extraKey}-tab">{$extra.content nofilter}</div>
        {/foreach}
    </div>
    {/block}
</div>
