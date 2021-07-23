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
<div id="footer-main" class="footer-main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 contact">
                <h3>Contact with Us In Any time</h3>
                <p class="hotline">{l s='Hotline: (01) 028-6677-1223 / 1224' d='Shop.jmstheme'}</p>
                <p>{l s='Store: 237 Madison Ave, New York City, United Stated' d='Shop.jmstheme'}</p>
                <p>{l s='Email: Koganicfood@demo.com' d='Shop.jmstheme'}</p>
                <p>{l s='Open: 10:00am - 9:00pm, Everyday. Except holidays' d='Shop.jmstheme'}</p>
                <div class="block-socials"> 
                    {include file='_partials/socials.tpl'}
                    <div class="block-right">
                        {widget_block name="ps_currencyselector"}
                            {include 'module:ps_currencyselector/ps_currencyselector-dropdown.tpl'}
                        {/widget_block}
                        {widget_block name="ps_languageselector"}
                            {include 'module:ps_languageselector/ps_languageselector-dropdown.tpl'}
                        {/widget_block}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7946.623555960864!2d-122.42918367213517!3d37.775516207291936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1623644029168!5m2!1svi!2s" width="630" height="280" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="line"></div>
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
                <div class="layout-column col-auto">
                    <img src="{$urls.theme_assets}img/payment-methods-2.png" alt="{l s='Payments method' d='Shop.jmstheme'}"/>
                </div>
            </div>
        </div>
    </div>
{/block}
