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
<div class="pagebuilder-dialog" id="pagebuilder-copy-lang" style="display: none;">
    <div class="pagebuilder-dialog-content" style="top: 70px;">
        <div class="pagebuilder-dialog-content-wrapper">
            <div class="pagebuilder-dialog-header">
                <div class="pagebuilder-dialog-header-left pull-left">
                    <h3>{l s='Copy Language' mod='gdz_pagebuilder'}</h3>
                </div>
                <div class="pagebuilder-dialog-header-right pull-right">

                    <div class="pagebuilder-dialog-close pagebuilder-dialog-element">
                        <i class="feather feather-x"></i>
                    </div>
                </div>
            </div>
            <div class="pagebuilder-dialog-body">
                <form id="pagebuilder-copy-template-form" class="pagebuilder-template-form">

                    <div class="form-content">
                      <label>{l s='Copy Data From' mod='gdz_pagebuilder'}</label>
                      <select id="source-lang" name="source_lang" class="pagebuilder-dialog-input">
                      {foreach from=$languages key=i item=language}
                        <option value="{$language.id_lang nofilter}">{$language.name nofilter}</option>
                      {/foreach}
                      </select>
                      <button id="copy-lang-btn" class="pagebuilder-dialog-btn"><span class="elementor-state-icon"></span>{l s='Copy' mod='gdz_pagebuilder'}</button>
                    </div>
                    <div class="pagebuilder-dialog-checkbox">
                        <input type="checkbox" name="copy_all_pages" id="copy-all-pages" value="1" />{l s='Apply for all pages' mod='gdz_pagebuilder'}
                    </div>
              	</form>
            </div>
        </div>
    </div>
</div>
