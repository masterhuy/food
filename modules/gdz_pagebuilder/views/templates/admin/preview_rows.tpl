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
{foreach from=$rows item=row}
		<div id="{if isset($row->id)}{$row->id}{/if}" class="gdz-row {$row->class|escape:'htmlall':'UTF-8'}"{if isset($row->layout)} data-layout="{$row->layout nofilter}"{/if}>
        {if isset($row->style) && $row->style}
        <style type="text/css">
          {$row->style nofilter}
        </style>
        {/if}
        <div class="pb-row-overlay">
            <div class="pb-row-tools">
                <a href="#" class="pb-drag-arrow pb-row-tool"><i class="feather feather-move"></i></a>
                <div class="btn-group pb-row-layout pb-row-tool">
                  <a href="#" data-toggle="dropdown" data-display="static" class="row-layout-setting"><i class="feather feather-layout"></i></a>
                  <div class="dropdown-menu pb-row-layout-dropdown">
                      <div class="pb-row-layout-dropdown-container">
                        <ul class="pb-column-list">
                      		<li><a title="12" data-layout="12" class="column-layout label-tooltip column-layout-12" href="#"></a></li>
                      		<li><a title="6,6" data-layout="6,6" class="column-layout label-tooltip column-layout-66" href="#"></a></li>
                      		<li><a title="4,4,4" data-layout="4,4,4" class="column-layout label-tooltip column-layout-444" href="#"></a></li>
                      		<li><a title="3,3,3,3" data-layout="3,3,3,3" class="column-layout label-tooltip column-layout-3333" href="#"></a></li>
                      		<li><a title="4,8" data-layout="4,8" class="column-layout label-tooltip column-layout-48" href="#"></a></li>
                      		<li><a title="3,9" data-layout="3,9" class="column-layout label-tooltip column-layout-39" href="#"></a></li>
                      		<li><a title="3,6,3" data-layout="3,6,3" class="column-layout label-tooltip column-layout-363" href="#"></a></li>
                      		<li><a title="2,6,4" data-layout="2,6,4" class="column-layout label-tooltip column-layout-264" href="#"></a></li>
                      		<li><a title="2,10" data-layout="2,10" class="column-layout label-tooltip column-layout-210" href="#"></a></li>
                      		<li><a title="5,7" data-layout="5,7" class="column-layout label-tooltip column-layout-57" href="#"></a></li>
                      	</ul>
                        <div class="pb-custom-layout clearfix align-items-center">
                          <div class="pb-custom-label width-auto"><span>{l s='Custom' mod='gdz_pagebuilder'}</span></div>
                          <div class="pb-custom-input"><input type="text" class="custom-layout" placeholder="4,4,4" value="4,4,4"></div>
                          <div class="pb-custom-btn width-auto"><a href="#" class="pb-btn pb-btn-primary column-layout" data-layout="custom">Add</a></div>
                        </div>
                      </div>
                  </div>
                </div>
                <a href="#" class="pb-row-setting pb-row-tool"><i class="feather feather-edit"></i></a>
                <a href="#" class="pb-row-duplicate pb-row-tool"><i class="feather feather-copy"></i></a>
                <a href="#" class="pb-row-delete pb-row-tool"><i class="feather feather-trash-2"></i></a>
            </div>
        </div>
				<div class="container{if isset($row->settings->fluid) && $row->settings->fluid == '1'}-fluid{/if} pb-row-inner">
						<div class="row">
						{foreach from=$row->cols key=cindex item=column}
							<div id="{$column->id|escape:'htmlall':'UTF-8'}" class="layout-column {$column->class|escape:'htmlall':'UTF-8'} addon-sortable">
                <div class="pb-column-tools">
                  <a href="#" class="pb-column-setting"><i class="feather feather-edit"></i></a>
                </div>
								{foreach from=$column->addons key=aindex item=addon}
								   <div id="{$addon->id|escape:'htmlall':'UTF-8'}" class="addon-box" data-name="{$addon->type}">
                      <div class="pb-addon-tools">
                        <a href="#" class="pb-drag-arrow pull-right"><i class="feather feather-move"></i></a>
                  	    <a href="#" class="pb-addon-setting pull-right"><i class="feather feather-edit"></i></a>
                        <a href="#" class="pb-addon-duplicate pull-right"><i class="feather feather-copy"></i></a>
                        <a href="#" class="pb-addon-delete pull-right"><i class="feather feather-trash-2"></i></a>
                  		</div>
                      <div class="addon-body">
                          {if isset($addon->return_value) && $addon->return_value}{$addon->return_value nofilter}{/if}
                      </div>
									 </div>
								{/foreach}
							</div>
						{/foreach}
						</div>
				</div>
        <div class="pb-add-row btn-group dropup">
            <a href="#" data-toggle="dropdown" data-display="static"><i class="feather feather-plus"></i></a>
            <div class="dropdown-menu pb-add-row-dropup">
                <div class="pb-add-row-dropup-container">
                  <ul class="pb-column-list">
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
              		</ul>
                  <div class="pb-custom-layout clearfix align-items-center">
                    <div class="pb-custom-label width-auto"><span>{l s='Custom' mod='gdz_pagebuilder'}</span></div>
                    <div class="pb-custom-input"><input type="text" class="custom-layout" placeholder="4,4,4" value="4,4,4"></div>
                    <div class="pb-custom-btn width-auto"><a href="#" class="pb-btn pb-btn-primary column-layout" data-layout="custom">{l s='Add' mod='gdz_pagebuilder'}</a></div>
                  </div>
                </div>
            </div>
        </div>
	</div>
{/foreach}
