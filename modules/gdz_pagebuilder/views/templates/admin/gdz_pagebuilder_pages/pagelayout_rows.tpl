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
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{foreach from=$rows key=i item=row}
			<div class="row" id="{$row->id nofilter}">
				<div class="row-title">
					<div class="pull-left">
						<span><i class="icon-arrows"></i></span>
						<strong class="row-name">{if isset($row->name)}{$row->name nofilter}{/if}</strong>
					</div>
					<div class="pull-right">
						<ul class="button-group" role="menu" aria-labelledby="dLabel">
							<li class="layout-action">
								<a class="btn btn-default label-tooltip" data-original-title="{l s='Row Layout' mod='gdz_pagebuilder'}"><i class="icon-th"></i></a>
								<ul class="column-list">
									<li><a data-original-title="12" data-layout="12" class="column-layout label-tooltip column-layout-12" href="#"></a></li>
									<li><a data-original-title="6,6" data-layout="6,6" class="column-layout label-tooltip column-layout-66" href="#"></a></li>
									<li><a data-original-title="4,4,4" data-layout="4,4,4" class="column-layout label-tooltip column-layout-444" href="#"></a></li>
									<li><a data-original-title="3,3,3,3" data-layout="3,3,3,3" class="column-layout label-tooltip column-layout-3333" href="#"></a></li>
									<li><a data-original-title="4,8" data-layout="4,8" class="column-layout label-tooltip column-layout-48" href="#"></a></li>
									<li><a data-original-title="3,9" data-layout="3,9" class="column-layout label-tooltip column-layout-39 active" href="#"></a></li>
									<li><a data-original-title="3,6,3" data-layout="3,6,3" class="column-layout label-tooltip column-layout-363" href="#"></a></li>
									<li><a data-original-title="2,6,4" data-layout="2,6,4" class="column-layout label-tooltip column-layout-264" href="#"></a></li>
									<li><a data-original-title="2,10" data-layout="2,10" class="column-layout label-tooltip column-layout-210" href="#"></a></li>
									<li><a data-original-title="5,7" data-layout="5,7" class="column-layout label-tooltip column-layout-57" href="#"></a></li>
									<li><a data-original-title="2,3,7" data-layout="2,3,7" class="column-layout label-tooltip column-layout-237" href="#"></a></li>
									<li><a data-original-title="2,5,5" data-layout="2,5,5" class="column-layout label-tooltip column-layout-255" href="#"></a></li>
									<li><a data-original-title="2,8,2" data-layout="2,8,2" class="column-layout label-tooltip column-layout-282" href="#"></a></li>
									<li><a data-original-title="2,4,4,2" data-layout="2,4,4,2" class="column-layout label-tooltip column-layout-2442" href="#"></a></li>
									<li><a data-original-title="Custom Layout" data-layout="custom" class="column-layout column-layout-custom label-tooltip" href="#"></a></li>
								</ul>
							</li>
							<li>
								<a class="btn btn-default row-setting label-tooltip" data-original-title="{l s='Row Setting' mod='gdz_pagebuilder'}"><i class="icon-cogs"></i></a>
							</li>
							<li>
								<a class="btn btn-default duplicate-row label-tooltip" data-original-title="{l s='Duplicate Row' mod='gdz_pagebuilder'}"><i class="icon-copy"></i></a>
							</li>
							<li>
								<a class="btn btn-default remove-row label-tooltip" data-original-title="{l s='Delete This Row' mod='gdz_pagebuilder'}"><i class="icon-trash"></i></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="row-columns">
					{foreach from=$row->cols key=cindex item=column}
						<div id="{$column->id nofilter}" class="layout-column {if isset($column->settings->lg_col) && $column->settings->lg_col}{$column->settings->lg_col}{/if}">
							<div class="column">
								{foreach from=$column->addons key=aindex item=addon}
									{$addon->addon_box nofilter}
								{/foreach}
							</div>
							<div class="col-tools">
								<a href="#" class="column-setting pull-right label-tooltip" data-original-title="Column Setting"><i class="icon-cog"></i><span>{l s='Setting' mod='gdz_pagebuilder'}</span></a>
							</div>
						</div>
					{/foreach}
				</div>
			</div>
{/foreach}
