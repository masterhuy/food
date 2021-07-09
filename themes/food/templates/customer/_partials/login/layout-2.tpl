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
{block name='page_content'}
    {block name='login_form_container'}
        <div class="login-layout-2 row" id="login-wrapper">
            <div class="col-12 col-md-6 login-image" id="login-image">
                <div class="login-box">
                    <img width="100%" src="{$gdzSetting.login_page_image}" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-box login-form">
                    <h3>{l s='Login' d='Shop.Theme.Customeraccount'}</h3>
                    {render file='customer/_partials/login-form.tpl' ui=$login_form}
                    {block name='display_after_login_form'}
                        {hook h='displayCustomerLoginFormAfter'}
                    {/block}
                </div>
                <div class="login-row">
                    <div class="login-box signup-form">
                        <h3>{l s='Sign Up' d='Shop.Theme.Customeraccount'}</h3>
                        <div class="signup-content">
                            {$gdzSetting.login_page_signup_content nofilter}
                        </div>
                        <div class="no-account">
                            <a class="btn-link" href="{$urls.pages.register}" data-link-action="display-register-form">
                                {l s='No account? Create one here' d='Shop.Theme.Customeraccount'}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {/block}
{/block}
