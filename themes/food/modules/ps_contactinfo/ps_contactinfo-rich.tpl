{*
* 2007-2019 PrestaShop
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
*  @copyright  2007-2019 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div class="contact-rich">
  <div class="addon-title">
    <h3>{l s='Contact Info' d='Shop.Theme.Global'}</h3>
  </div>
  <div class="block">
    <div class="address section">
      <p class="info-address">{$contact_infos.address.address1 nofilter}</p>
        {if $contact_infos.phone}
          <div class="data phone">
            {l s='Call' d='Shop.Theme.Global'}:
            <a href="tel:{$contact_infos.phone}">{$contact_infos.phone}</a>
          </div>
        {/if}
    </div>
  </div>
  {if $contact_infos.fax}
    <div class="block">
      <div class="icon"><i class="fa fa-phone"></i></div>
      <div class="data">
        {l s='Fax:' d='Shop.Theme.Global'}<br/>
        {$contact_infos.fax}
      </div>
    </div>
  {/if}
  {if $contact_infos.email}
    <div class="block">
      <div class="data email">
        {l s='Email' d='Shop.Theme.Global'}:
       <a href="mailto:{$contact_infos.email}">{$contact_infos.email}</a>
      </div>
    </div>
  {/if}
  <div class="contact-map">
    <iframe width="100%" height="500" style="border:0"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBwY_0PWuwH_A5y4iwNAqpaUbUjRPySkFc%0A%20%20%20%20&q=7563%20St.%20Vicent%20Place,%20Glasgow"
      allowfullscreen="">
    </iframe>
  </div>
  <div class="social_icon">
    <ul>
    <li><a href="#"><i class="ptw-icon {$gdzSetting.facebook_icon}"><span class="hidden">facebook</span></i></a></li>
    <li><a href="#"><i class="ptw-icon {$gdzSetting.twitter_icon}"><span class="hidden">twitter</span></i></a></li>
    <li><a href="#"><i class="fa fa-behance"><span class="hidden">behance</span></i></a></li>
    <li><a href="#"><i class="ptw-icon {$gdzSetting.pinterest_icon}"><span class="hidden">pinterest</span></i></a></li>
    <li><a href="#"><i class="ptw-icon {$gdzSetting.instagram_icon}"><span class="hidden">instagram</span></i></a></li>
    </ul>
  </div>
</div>
