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
 {if isset($smarty.get.product_content_layout) && $smarty.get.product_content_layout !=''}
    {assign var='product_content_layout' value=$smarty.get.product_content_layout}
 {else}
    {assign var='product_content_layout' value=$gdzSetting.product_content_layout}
 {/if}
 {if $product_content_layout == 'thumbs-gallery'}
    {include file='catalog/_partials/product-cover-thumbnails-gallery.tpl'}
 {elseif $product_content_layout == 'thumbs-left'}
    {include file='catalog/_partials/product-cover-thumbnails-left.tpl'}
 {elseif $product_content_layout == 'thumbs-right'}
    {include file='catalog/_partials/product-cover-thumbnails-right.tpl'}
 {elseif $product_content_layout == '3-columns'}
     {include file='catalog/_partials/product-cover-thumbnails-3-columns.tpl'}
 {else}
     {include file='catalog/_partials/product-cover-thumbnails-bottom.tpl'}
 {/if}
