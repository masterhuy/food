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
 <div class="product-cover">
    {if count($product.flags) > 0}
    <ul class="product-flags">
      {foreach from=$product.flags item=flag}
        <li class="product-flag {$flag.type}">{$flag.label}</li>
      {/foreach}
    </ul>
    {/if}
    <img class="js-qv-product-cover{if $gdzSetting.product_image_zoom == 'elevatezoom'} product-image-zoom{/if}" src="{$product.default_image.bySize.large_default.url}" data-zoom-image="{$product.default_image.bySize.large_default.url}" alt="{$product.default_image.legend}" title="{$product.default_image.legend}" style="width:100%;" itemprop="image">
    <div class="zoom-icon hidden-xs" data-toggle="modal" data-target="#product-modal">
    <i class="ptw-icon icon-search-5_medium"></i>
    </div>
</div>
