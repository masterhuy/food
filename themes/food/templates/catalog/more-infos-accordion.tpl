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
<div id="more_info_block" class="accordion">
    {block name='product_tabs'}
    <div class="panel-group" id="accordion">
        {if $product.description}
        <div class="panel panel-default">
              <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#description">{l s='Description' d='Shop.Theme.Catalog'}</a>
                    </h4>
              </div>
              <div id="description" class="panel-collapse collapse show">
                    <div class="panel-body">
                        {block name='product_description'}
                          <div class="product-description">{$product.description nofilter}</div>
                        {/block}
                    </div>
              </div>
        </div>
        {/if}
        <div class="panel panel-default">
              <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#product-details">{l s='Product Details' d='Shop.Theme.Catalog'}</a>
                  </h4>
              </div>
              <div id="product-details" class="panel-collapse collapse">
                  <div class="panel-body">
                    {block name='product_details'}
                        {include file='catalog/_partials/product-details.tpl'}
                    {/block}
                  </div>
              </div>
        </div>
        {if $product.attachments}
        <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#attachments">{l s='Attachments' d='Shop.Theme.Catalog'}</a>
                </h4>
              </div>
              <div id="attachments" class="panel-collapse collapse">
                  <div class="panel-body">
                  {block name='product_attachments'}
                  {if $product.attachments}
                      <div class="tab-pane fade in" id="attachments" role="tabpanel">
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
                  {/block}
                  </div>
            </div>
      </div>
      {/if}
      {foreach from=$product.extraContent item=extra key=extraKey}
      <div class="panel panel-default">
          <div class="panel-heading">
              <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#extra-{$extraKey}">{$extra.title}</a>
              </h4>
          </div>
          <div id="extra-{$extraKey}" class="panel-collapse collapse">
              <div class="panel-body">
                  {foreach from=$product.extraContent item=extra key=extraKey}
                      <div class="tab-pane fade in {$extra.attr.class}" id="extra-{$extraKey}" role="tabpanel" {foreach $extra.attr as $key => $val} {$key}="{$val}"{/foreach}>
                          {$extra.content nofilter}
                        </div>
                  {/foreach}
              </div>
          </div>
      </div>
      {/foreach}
  </div>
  {/block}
</div>
