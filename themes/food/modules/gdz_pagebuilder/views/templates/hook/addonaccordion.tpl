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
{if $accordions|@count gt 0}
<div class="pb-accordion">
  {assign var=accordion_id value=1000|mt_rand:9999}
  <div class="accordions">
  {foreach from=$accordions key=index item=accordion}
      <div class="card accordion-item">
        <div class="card-header" id="heading-{$accordion_id}-{$index}">
          <h5 class="collapsed" data-toggle="collapse" data-target="#accordion-{$accordion_id}-{$index}" aria-expanded="false">
              {$accordion->title|escape:'htmlall':'UTF-8'}
          </h5>
        </div>
        <div id="accordion-{$accordion_id}-{$index}" class="collapse{if $index == 0} show{/if}" aria-labelledby="heading-{$accordion_id}-{$index}">
          <div class="card-body accordion-content">
              {$accordion->content|escape:'htmlall':'UTF-8'}
          </div>
        </div>
      </div>
  {/foreach}
  </div>
</div>
{/if}
