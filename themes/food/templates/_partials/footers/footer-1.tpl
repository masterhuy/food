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
<svg width="1920" height="95" viewBox="0 0 1920 95" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M963 32.446C1405.8 91.2088 1788.17 56.9305 1924 32.446V95H0V32.446C136.5 7.96148 520.2 -26.3168 963 32.446Z" fill="#F4F4F4"/>
</svg>
<div id="footer-main" class="footer-main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                {include file='_partials/headers/logo.tpl'}
                <div class="contact">
                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.25 20.8332C6.25 10.4791 14.6458 2.08325 25 2.08325C35.3542 2.08325 43.75 10.4791 43.75 20.8332V41.6666C43.75 45.1249 40.9583 47.9166 37.5 47.9166H25V43.7499H39.5833V41.6666H31.25V24.9999H39.5833V20.8332C39.5833 12.7708 33.0625 6.24992 25 6.24992C16.9375 6.24992 10.4167 12.7708 10.4167 20.8332V24.9999H18.75V41.6666H12.5C9.04167 41.6666 6.25 38.8749 6.25 35.4166V20.8332ZM14.5833 29.1666V37.4999H12.5C11.3542 37.4999 10.4167 36.5624 10.4167 35.4166V29.1666H14.5833ZM39.5833 29.1666V37.4999H35.4167V29.1666H39.5833Z" fill="#F1402A"/>
                    </svg>
                    <div class="info">
                        <div class="text">{l s='Got Questions?' d='Shop.jmstheme'}</div>
                        <div class="phone-number">{l s='(01) 028-6677-1223 / 1224' d='Shop.jmstheme'}</div>
                    </div>
                </div>
                <p>{l s='Store: 237 Madison Ave, New York, USA' d='Shop.jmstheme'}</p>
                <p>{l s='Email: Koganicfood@demo.com' d='Shop.jmstheme'}</p>
                {include file='_partials/socials.tpl'} 
            </div>
            {block name='hook_footer'}
                {hook h='displayFooter'}
            {/block}
        </div>
    </div>
</div>
{block name='footer-copyright'}
    <div id="footer-copyright" class="footer-copyright{if $gdzSetting.footer_copyright_class} {$gdzSetting.footer_copyright_class}{/if}">
        <div class="container">
            <div class="row align-items-center">
                {if isset($gdzSetting.footer_copyright_content) && $gdzSetting.footer_copyright_content}
                    <div class="layout-column col">
                        {$gdzSetting.footer_copyright_content nofilter}
                    </div>
                {/if}
                {if isset($gdzSetting.footer_payment_image) && $gdzSetting.footer_payment_image}
                    <div class="layout-column col-auto">
                        <img src="{$gdzSetting.footer_payment_image}" class="img-fluid" alt="{l s='Payments' d='Shop.jmstheme'}"/>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}
