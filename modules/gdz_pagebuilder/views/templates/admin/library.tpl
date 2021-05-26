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
<div class="pagebuilder-dialog save" id="pagebuilder-template-library" style="display: none;">
    <div class="pagebuilder-dialog-content" style="top: 70px;">
        <div class="pagebuilder-dialog-content-wrapper">
            <div class="pagebuilder-dialog-header">
                <div class="pagebuilder-dialog-header-left pull-left">
                    <h3>{l s='Users Templates' mod='gdz_pagebuilder'}</h3>
                </div>
                <div class="pagebuilder-dialog-header-right pull-right">
                    <div class="pagebuilder-dialog-switch-form pagebuilder-dialog-element pagebuilder-dialog-switch-library" data-form="library">
                        <i class="feather feather-file"></i>
                    </div>
                    <div class="pagebuilder-dialog-switch-form pagebuilder-dialog-element pagebuilder-dialog-switch-load" data-form="load">
                        <i class="feather feather-upload"></i>
                    </div>
                    <div class="pagebuilder-dialog-switch-form pagebuilder-dialog-element pagebuilder-dialog-switch-file" data-form="file">
                        <i class="feather feather-download"></i>
                    </div>
                    <div class="pagebuilder-dialog-switch-form pagebuilder-dialog-element pagebuilder-dialog-switch-save" data-form="save">
                        <i class="feather feather-save"></i>
                    </div>
                    <div class="pagebuilder-dialog-close pagebuilder-dialog-element">
                        <i class="feather feather-x"></i>
                    </div>
                </div>
            </div>
            <div class="pagebuilder-dialog-body">
                <form id="pagebuilder-library-template-form" class="pagebuilder-template-form">
                  <div class="template-list" id="pagebuilder-template-list">
                      {foreach from=$templates item=template}
                        <div class="template-row" data-id="{$template.id_template}">
                            <div class="template-name">{$template.name}</div>
                            <div class="template-tools pull-right">
                                <a class="template-export"><i class="gdz-icon-export"></i><span>{l s='Export' mod='gdz_pagebuilder'}</span></a>
                                <a class="template-delete"><i class="gdz-icon-delete"></i><span>{l s='Delete' mod='gdz_pagebuilder'}</span></a>
                                <a class="template-import"><i class="gdz-icon-import"></i><span>{l s='Import' mod='gdz_pagebuilder'}</span></a>
                            </div>
                        </div>
                      {/foreach}
                  </div>
                </form>
                <form id="pagebuilder-save-template-form" class="pagebuilder-template-form">
                    <div class="form-desc">{l s='Enter template name to save this page (row) as template to Library' mod='gdz_pagebuilder'}.</div>
                    <div class="form-content">
                        <input id="library-template-name" name="title" class="pagebuilder-dialog-input" placeholder="{l s='Enter Template Name' mod='gdz_pagebuilder'}" required="">
                        <button id="library-save-template" class="pagebuilder-dialog-btn"><span class="elementor-state-icon"></span>{l s='Save' mod='gdz_pagebuilder'}</button>
                    </div>
                </form>
                <form id="pagebuilder-load-template-form" class="pagebuilder-template-form" enctype="multipart/form-data">
                    <div class="form-desc">{l s='Enter template name + select file to upload it as template in Library' mod='gdz_pagebuilder'}.</div>
                    <div class="form-content">
                        <input id="library-load-template-name" class="pagebuilder-dialog-input" type="text" placeholder="{l s='Enter Template Name' mod='gdz_pagebuilder'}" name="name" required="">
                  		  <input id="library-template-file" class="pagebuilder-dialog-input" type="file" name="file" required="">
                  		  <button id="library-load-template" class="pagebuilder-dialog-btn"><span class="elementor-state-icon"></span>{l s='Upload' mod='gdz_pagebuilder'}</button>
                    </div>
              	</form>
                <form id="pagebuilder-file-template-form" class="pagebuilder-template-form">
                    <div class="form-desc">{l s='Enter File Name to Export this page as json file' mod='gdz_pagebuilder'}.</div>
                    <div class="form-content">
                        <input id="library-file-name" name="title" class="pagebuilder-dialog-input" placeholder="Enter File Name" required="">
                        <button id="save-template-file" class="pagebuilder-dialog-btn"><span class="elementor-state-icon"></span>{l s='Save' mod='gdz_pagebuilder'}</button>
                    </div>
              	</form>
            </div>
        </div>
    </div>
</div>
