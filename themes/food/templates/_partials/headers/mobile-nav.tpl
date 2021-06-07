{**
 * 2007-2017 PrestaShop
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
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}

 <div id="mobile-nav">
   <div class="container">
      <div class="row align-items-center no-margin">
          <div class="layout-column header-left">
              <div class="btn-group col-auto">
                  <a href="javascript:history.back()" class="mobile-nav-back"><i class="feather icon-arrow-left"></i></a>
                  {if $page.page_name == 'cms'}
                    {$cms.meta_title|truncate:16:"..."}
                  {elseif $page.page_name == 'cms_category'}
                    {$cms_category.name|truncate:16:" ..."}
                  {elseif $page.page_name == 'category'}
                    {$category.name|truncate:16:" ..."}
                  {elseif $page.page_name == 'product'}
                    {$product.name|truncate:16:" ..."}
                  {elseif $page.page_name == 'module-gdz_pagebuilder-page'}
                    {$gdz_pagebuilder_page.title|truncate:16:" ..."}
                  {elseif $page.page_name == 'module-gdz_blog-categories'}
                    {l s="categories" d="Shop.Theme"}
                  {elseif $page.page_name == 'contact'}
                    {l s="Contact" d="Shop.Theme"}
                  {else}
                    {$page.page_name}
                  {/if}
              </div>
          </div>
          <div class="layout-column col-auto header-right">
              <div class="btn-group col-auto">
                  <a href="index.php"><i class="feather icon-home"></i></a>
              </div>
              {if $gdzSetting.search}
                  {if $gdzSetting.search_box_type != 'dropdown'}
                  {widget_block name="gdz_ajaxsearch"}
                      {include 'module:gdz_ajaxsearch/views/templates/hook/gdz_ajaxsearch-button.tpl'}
                  {/widget_block}
                  {else}
                  {widget_block name="gdz_ajaxsearch"}
                      {include 'module:gdz_ajaxsearch/views/templates/hook/gdz_ajaxsearch-dropdown.tpl'}
                  {/widget_block}
                  {/if}
              {/if}
              {if ($gdzSetting.cart == 1)}
                  {widget_block name="ps_shoppingcart"}
                      {include 'module:ps_shoppingcart/ps_shoppingcart.tpl'}
                  {/widget_block}
              {/if}
          </div>
      </div>
   </div>
 </div>
