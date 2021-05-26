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
{extends file="layouts/layout-full-width.tpl"}
{block name='head_seo_title'}{$gdz_pagebuilder_page.title}{/block}
{block name='head_seo_description'}{$gdz_pagebuilder_page.meta_desc}{/block}
{block name='head_seo_keywords'}{$gdz_pagebuilder_page.meta_key}{/block}
{block name='content'}
    <section id="main">
        {block name='page_content_container'}
            <section id="content" class="page-content rowlist row-sortable">
                {block name='page_content_top'}{/block}
								{block name="page_content"}
                {include file="module:gdz_pagebuilder/views/templates/admin/preview_rows.tpl"}
                <div class="gdz-row row-add">
                  <div class="container">
                      <div class="pb-add-row pb-add-btn btn-group dropup">
                        <a href="#" data-toggle="dropdown" data-display="static">{l s='Add New Row' mod='gdz_pagebuilder'}</a>
                        <div class="dropdown-menu pb-add-row-dropup">
                            <div class="pb-add-row-dropup-container">
                                <ul class="pb-column-list">
                                  <li><a data-original-title="12" data-layout="12" class="column-layout label-tooltip column-layout-12" href="#"></a></li>
                                  <li><a data-original-title="6,6" data-layout="6,6" class="column-layout label-tooltip column-layout-66" href="#"></a></li>
                                  <li><a data-original-title="4,4,4" data-layout="4,4,4" class="column-layout label-tooltip column-layout-444" href="#"></a></li>
                                  <li><a data-original-title="3,3,3,3" data-layout="3,3,3,3" class="column-layout label-tooltip column-layout-3333" href="#"></a></li>
                                  <li><a data-original-title="4,8" data-layout="4,8" class="column-layout label-tooltip column-layout-48" href="#"></a></li>
                                  <li><a data-original-title="3,9" data-layout="3,9" class="column-layout label-tooltip column-layout-39 active" href="#"></a></li>
                                  <li><a data-original-title="3,6,3" data-layout="3,6,3" class="column-layout label-tooltip column-layout-363" href="#"></a></li>
                                  <li><a data-original-title="2,6,4" data-layout="2,6,4" class="column-layout label-tooltip column-layout-264" href="#"></a></li>
                                  <li><a data-original-title="2,10" data-layout="2,10" class="column-layout label-tooltip column-layout-210" href="#"></a></li>
                                  <li><a data-original-title="5,7" data-layout="5,7" class="column-layout label-tooltip column-layout-57" href="#"></a></li>
                                </ul>
                                <div class="pb-custom-layout clearfix align-items-center">
                                  <div class="pb-custom-label width-auto"><span>{l s='Custom' mod='gdz_pagebuilder'}</span></div>
                                  <div class="pb-custom-input"><input type="text" class="custom-layout" placeholder="4,4,4" value="4,4,4"></div>
                                  <div class="pb-custom-btn width-auto"><a href="#" class="pb-btn pb-btn-primary column-layout" data-layout="custom">{l s='Add' mod='gdz_pagebuilder'}</a></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="pb-add-template pb-add-btn">
                          <a href="#">{l s='Add Template' mod='gdz_pagebuilder'}</a>
                      </div>
                      <span class="drag-addon-here">{l s='Or drag addon here to create new row + dragged addon' mod='gdz_pagebuilder'}</span>
                  </div>
                </div>
								{/block}
            </section>
        {/block}
        {block name='page_footer_container'}
        {/block}
    </section>

<div id="pb-right-menu" style="display:none;">
    <ul>
    <li class="edit-row"><a href="#"><i class="feather feather-edit"></i>{l s='Edit Row' mod='gdz_pagebuilder'}</a></li>
    <li class="duplicate-row seperator"><a href="#"><i class="feather feather-copy"></i>{l s='Duplicate' mod='gdz_pagebuilder'}</a></li>
    <li class="copy-style-row"><a href="#"><i class="feather feather-clipboard"></i>{l s='Copy Style' mod='gdz_pagebuilder'}</a></li>
    <li class="paste-style-row"><a href="#"><i class="feather feather-corner-up-right"></i>{l s='Paste Style' mod='gdz_pagebuilder'}</a></li>
    <li class="reset-style-row seperator"><a href="#"><i class="feather feather-corner-up-left"></i>{l s='Reset Style' mod='gdz_pagebuilder'}</a></li>
    <li class="save-template-row" data-dialog="template-library" data-form="save"><a href="#"><i class="feather feather-save"></i>{l s='Save as Template' mod='gdz_pagebuilder'}</a></li>
    <li class="export-row seperator"><a href="#"><i class="feather feather-download"></i>{l s='Export to File' mod='gdz_pagebuilder'}</a></li>
    <li class="delete-row"><a href="#"><i class="feather feather-trash"></i>{l s='Delete' mod='gdz_pagebuilder'}</a></li>
    </ul>
</div>
{foreach from=$addonstemplate key=i item=addontpl}
<script id="pb-tmpl-addon-{$addontpl.name}" type="x-tmpl-lodash">
  {$addontpl.tpl nofilter}
</script>
{/foreach}
{/block}
