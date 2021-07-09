{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
{include file='_partials/form-errors.tpl' errors=$errors['']}

{* TODO StarterTheme: HOOKS!!! *}

<form id="login-form" action="{$action}" method="post">
    <section>
        {block name='form_fields'}
            {foreach from=$formFields item="field"}
                {block name='form_field'}
                    {form_field field=$field}
                {/block}
            {/foreach}
        {/block}
    </section>
    <footer class="form-footer clearfix">
        <input type="hidden" name="submitLogin" value="1">
        {block name='form_buttons'}
        <button class="btn btn-active" data-link-action="sign-in" type="submit" class="form-control-submit">
            {l s='Login' d='Shop.Theme.Actions'}
        </button>
        {/block}
        <div class="authentication-links">
            <div class="forgot-password">
                <a class="btn-link" href="{$urls.pages.password}" rel="nofollow">
                    {l s='Forgot Your Password?' d='Shop.Theme.Customeraccount'}
                </a>
            </div>
            <div class="return-store">
                <a class="btn-link return-to-store" href="{$urls.base_url}">{l s='Return to store' d='Shop.Theme.Global'}</a>
            </div>
        </div>
    </footer>
</form>
