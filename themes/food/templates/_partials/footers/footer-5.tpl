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
            <div class="col-12 col-md-3 wrapper block">
                <h3 class="h3 block-title">
                    {l s='Useful Links' d='Shop.jmstheme'}
                    <i class="feather icon-plus closing"></i>
                    <i class="feather icon-minus opening"></i>
                </h3>
                <div class="block-content">
                    <ul>
                        <li>
                            <a class="cms-page-link" href="index.php?id_cms=4&controller=cms&id_lang=1">
                                {l s='About Us' d='Shop.jmstheme'}
                            </a>
                        </li>
                        <li>
                            <a class="cms-page-link" href="index.php?controller=contact">
                                {l s='Contacts Us' d='Shop.jmstheme'}
                            </a>
                        </li>
                        <li>
                            <a class="cms-page-link" href="index.php?id_cms=5&controller=cms&id_lang=1">
                                {l s='Secure Shopping' d='Shop.jmstheme'}
                            </a>
                        </li>
                        <li>
                            <a class="cms-page-link" href="index.php?id_cms=6&controller=cms&id_lang=1">
                                {l s='Privacy Policy' d='Shop.jmstheme'}
                            </a>
                        </li>
                        <li>
                            <a class="cms-page-link" href="index.php?id_cms=2&controller=cms&id_lang=1">
                                {l s='Our Services' d='Shop.jmstheme'}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-3 wrapper block">
                <h3 class="h3 block-title">
                    {l s='Information' d='Shop.jmstheme'}
                    <i class="feather icon-plus closing"></i>
                    <i class="feather icon-minus opening"></i>
                </h3>
                <div class="block-content">
                    <ul>
                        <li>
                            <a class="cms-page-link" href="index.php?id_cms=4&controller=cms&id_lang=1">
                                {l s='Discount Program' d='Shop.jmstheme'}
                            </a>
                        </li>
                        <li>
                            <a class="cms-page-link" href="index.php?id_cms=5&controller=cms&id_lang=1">
                                {l s='Delivery Offer' d='Shop.jmstheme'}
                            </a>
                        </li>
                        <li>
                            <a class="cms-page-link" href="index.php?id_cms=6&controller=cms&id_lang=1">
                                {l s='Advanced Search' d='Shop.jmstheme'}
                            </a>
                        </li>
                        <li>
                            <a class="cms-page-link" href="index.php?id_cms=2&controller=cms&id_lang=1">
                                {l s='Terms & Condition' d='Shop.jmstheme'}
                            </a>
                        </li>
                        <li>
                            <a class="cms-page-link" href="index.php?controller=sitemap">
                                {l s='History Reservation' d='Shop.jmstheme'}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 wrapper block instagram">
                <h3 class="h3 block-title">
                    {l s='Instagram Gallery' d='Shop.jmstheme'}
                    <i class="feather icon-plus closing"></i>
                    <i class="feather icon-minus opening"></i>
                </h3>
                <div class="block-content">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <a href="#"><img class="w-100" src="{$urls.theme_assets}img/dishes/instagram-1.jpg"/></a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#"><img class="w-100" src="{$urls.theme_assets}img/dishes/instagram-2.jpg"/></a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#"><img class="w-100" src="{$urls.theme_assets}img/dishes/instagram-3.jpg"/></a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#"><img class="w-100" src="{$urls.theme_assets}img/dishes/instagram-4.jpg"/></a>
                        </div>
                    </div>
                </div>
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
                {if isset($gdzSetting.footer_payment_image) && $gdzSetting.footer_payment_image}
                    <div class="layout-column col-auto">
                        <img src="{$gdzSetting.footer_payment_image}" class="img-fluid" alt="{l s='Payments' d='Shop.jmstheme'}"/>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}
