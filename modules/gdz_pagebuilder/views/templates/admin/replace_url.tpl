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
<div class="pagebuilder-dialog" id="pagebuilder-replace-url" style="display: none;">
    <div class="pagebuilder-dialog-content" style="top: 70px;">
        <div class="pagebuilder-dialog-content-wrapper">
            <div class="pagebuilder-dialog-header">
                <div class="pagebuilder-dialog-header-left pull-left">
                    <h3>{l s='Replace Url' mod='gdz_pagebuilder'}</h3>
                </div>
                <div class="pagebuilder-dialog-header-right pull-right">

                    <div class="pagebuilder-dialog-close pagebuilder-dialog-element">
                        <i class="feather feather-x"></i>
                    </div>
                </div>
            </div>
            <div class="pagebuilder-dialog-body">
                <form id="pagebuilder-replace-template-form" class="pagebuilder-template-form">
                    <div class="form-desc">{l s='Enter old + new Url to Replace' mod='gdz_pagebuilder'}.</div>
                    <div class="form-content">
                        <input id="replace-old-url" name="old_url" class="pagebuilder-dialog-input" placeholder="Enter old Url" required="">
                        <input id="replace-new-url" name="new_url" class="pagebuilder-dialog-input" placeholder="Enter new Url" required="">
                        <button id="replace-url-btn" class="pagebuilder-dialog-btn"><span class="elementor-state-icon"></span>{l s='Replace' mod='gdz_pagebuilder'}</button>
                    </div>
                    <div class="pagebuilder-dialog-checkbox">
                        <input type="checkbox" name="all_pages" id="replace-all-pages" value="1" />{l s='Replace in all pages' mod='gdz_pagebuilder'}
                    </div>
              	</form>
            </div>
        </div>
    </div>
</div>
