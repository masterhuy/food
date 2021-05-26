<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" {$full_cldr_language_code}> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" {$full_cldr_language_code}> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" {$full_cldr_language_code}> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{l s='Pagebuilder Editor' mod='iqitelementor'}</title>
  {* heade section *}
  <script type="text/javascript">
    var iso_user = '{$iso_user|@addcslashes:'\''}';
    var lang_is_rtl = '{$lang_is_rtl|intval}';
    var full_language_code = '{$full_language_code|@addcslashes:'\''}';
    var full_cldr_language_code = '{$full_cldr_language_code|@addcslashes:'\''}';
    var country_iso_code = '{$country_iso_code|@addcslashes:'\''}';
    var _PS_VERSION_ = '{$smarty.const._PS_VERSION_|@addcslashes:'\''}';
    var roundMode = {$round_mode|intval};
    var token = '{$token|addslashes}';
    var youEditFieldFor = 'a';
    var baseAdminDir = '{$baseDir|addslashes}';
    var from_msg ='a';
    var token_admin_orders = '{getAdminToken tab='AdminOrders'}';
    var token_admin_customers = '{getAdminToken tab='AdminCustomers'}';
    var token_admin_customer_threads = '{getAdminToken tab='AdminCustomerThreads'}';
    var currentIndex = '{$currentIndex|@addcslashes:'\''}';
    var employee_token = '{getAdminToken tab='AdminEmployees'}';
    var default_language = '{$id_lang|intval}';
    var admin_modules_link = '{$link->getAdminLink("AdminModulesSf", true, ['route' => "admin_module_catalog_post"])|addslashes}';
    var tab_modules_list = '{if isset($tab_modules_list) && $tab_modules_list}{$tab_modules_list|addslashes}{/if}';
  </script>
  {if isset($css_files)}
    {foreach from=$css_files key=css_uri item=media}
      <link href="{$css_uri|escape:'html':'UTF-8'}" rel="stylesheet" type="text/css"/>
    {/foreach}
  {/if}
</head>
<body class="pagebuilder-editor-active">
<div id="pagebuilder-preview">
    <div id="pagebuilder-preview-wrapper" class="md-layout">
        <iframe id="pagebuilder-preview-iframe" name="pagebuilder-preview-iframe" sandbox="allow-same-origin allow-scripts allow-pointer-lock allow-presentation allow-forms" src="{$preview_link}"></iframe>
        <div class="pagebuilder-preview-overlay" style="display:none;">
          <div class="page-saved">{l s='Saved' mod='gdz_pagebuilder'}</div>
          <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</div>
<div id="pagebuilder-panel">
    <div class="vertical-panel">
        <div class="logo">
            <img src="../modules/gdz_pagebuilder/views/img/logo.png" />
        </div>
        <ul>
          <li id="style-manager"><a><i class="feather feather-edit"></i><span class="drop-text">{l s='Style Manager' mod='gdz_pagebuilder'}</span></a></li>
          <li id="addons" class="active"><a><i class="feather feather-box"></i><span class="drop-text">{l s='Addons' mod='gdz_pagebuilder'}</span></a></li>
          <li id="section"{if !$pro} class="pro"{/if}><a href="#"><i class="feather feather-grid"></i><span class="drop-text">{l s='Sections' mod='gdz_pagebuilder'}</span></a></li>
          <li id="page"{if !$pro} class="pro"{/if}><a href="#"><i class="feather feather-file-text"></i><span class="drop-text">{l s='Pages' mod='gdz_pagebuilder'}</span></a></li>
          <li id="users-sections"><a id="template-library" class="dialog-open" data-dialog="template-library" data-form="library"><i class="feather feather-user"></i><span class="drop-text">{l s='Users Sections' mod='gdz_pagebuilder'}</span></a></li>
          <li id="theme-setting"><a class="btn" target="_blank" href="{$link->getAdminLink('AdminGdzThemeSetting') nofilter}&configure=gdz_themesetting" title="{l s='Theme Setting' mod='gdz_pagebuilder'}"><i class="feather feather-settings"></i>{l s='Setting' mod='gdz_pagebuilder'}</i></a></li>
        </ul>
    </div>
    <div id="pagebuilder-mode-switch">
        <div class="mode-switch-inner">
          <i></i>
        </div>
    </div>
    <div class="gdz-tools" id="tool-addons">
        <div class="tool-search">
            <input type="text" id="search-addon" placeholder="{l s='Search for addon name' mod='gdz_pagebuilder'}.." />
            <i class="gdz-icon-search"></i>
        </div>
        <ul class="pagebuilder-addons clearfix">
          <li class="addon-group">{l s='Addons' mod='gdz_pagebuilder'}</li>
          {assign var="shop_addon" value="true"}
          {foreach from=$addonslist key=i item=addonlist}
            {if $addonlist.type == 'Shop Addons' && $shop_addon == 'true'}
            <li class="addon-group">{l s='Shop Addons' mod='gdz_pagebuilder'}</li>
            {assign var="shop_addon" value="false"}
            {/if}
            <li class="addon-cat-addons{if $addonlist.pro} pro{/if}" draggable="true">
              {$addonlist.addon nofilter}
            </li>
          {/foreach}
        </ul>
    </div>
    <div class="gdz-tools gdz-configuration bootstrap">
        <div class="config-heading"><a href="#" id="back" class="pb-config-back"><i></i>Back</a><span class="config-title">{l s='Row Setting' mod='gdz_pagebuilder'}</span></div>
        <div id="gdz-configuration" class="gdz-modal-body">
        </div>
    </div>
    <div class="gdz-tools gdz-configuration bootstrap studio-list" data-studio="sections" id="section-list">
        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="gdz-tools gdz-configuration bootstrap page-list" data-studio="pages" id="page-list">
        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    </div>
</div>
<div id="pagebuilder-setting">
    <div class="setting-left">
        <select id="select-language">
          {foreach from=$languages key=i item=language}
            <option value="{$language.id_lang nofilter}"{if $language.id_lang == $id_lang} selected="selected"{/if}>{l s='Language' mod='gdz_pagebuilder'} : {$language.name nofilter}</option>
          {/foreach}
        </select>
    </div>
    <div class="setting-center">
      <select id="select-page">
        {foreach from=$pages key=i item=page}
          <option value="{$page.id_page nofilter}"{if $page.id_page == $id_page} selected="selected"{/if}>{l s='Page' mod='gdz_pagebuilder'} : {$page.title nofilter}</option>
        {/foreach}
      </select>
      <div id="tool-device">
          <ul class="device-icons">
            <li class="active li-md" data-device="md"><a class="md-device btn-icon gdz-tooltip" data-toggle="tooltip" data-placement="bottom" title="{l s='Desktop Layout' mod='gdz_pagebuilder'}"><span class="icon"><i class="icon-desktop"></i></span></a></li>
            <li class="li-sm" data-device="sm"><a class="sm-device btn-icon gdz-tooltip" data-toggle="tooltip" data-placement="bottom" title="{l s='Tablet Layout' mod='gdz_pagebuilder'}"><span class="icon"><i class="icon-tablet"></i></span></a></li>
            <li class="li-xs" data-device="xs"><a class="xs-device btn-icon gdz-tooltip" data-toggle="tooltip" data-placement="bottom" title="{l s='Mobile Layout' mod='gdz_pagebuilder'}"><span class="icon"><i class="icon-mobile"></i></span></a></li>
          </ul>
      </div>
    </div>
    <div class="setting-right">
        <div class="dropdown btn-icon" id="template-tool">
          <a class="dropbtn" title="{l s='Menu' mod='gdz_pagebuilder'}"><i class="feather feather-menu"></i></a>
          <div class="dropdown-content">
            <ul class="drop-list template-icons">
              <li><a id="template-library" class="dialog-open" data-dialog="template-library" data-form="library"><span class="drop-text">{l s='Template Library' mod='gdz_pagebuilder'}</span></a></li>
              <li><a class="dialog-open" data-dialog="template-library" data-form="save"><span class="drop-text">{l s='Save to Template' mod='gdz_pagebuilder'}</span></a></li>
              <li><a class="dialog-open" data-dialog="template-library" data-form="file"><span class="drop-text">{l s='Save as File' mod='gdz_pagebuilder'}</span></a></li>
              <!--<li><a id="theme-export"><span class="drop-text">{l s='Save Theme' mod='gdz_pagebuilder'}</span></a></li>-->
              <li><a class="dialog-open" data-dialog="copy-lang" data-form="copy"><span class="drop-text">{l s='Copy Language' mod='gdz_pagebuilder'}</span></a></li>
              <li><a class="dialog-open" data-dialog="replace-url" data-form="replace"><span class="drop-text">{l s='Replace Url' mod='gdz_pagebuilder'}</span></a></li>
            </ul>
          </div>
        </div>
        <a class="btn-icon gdz-tooltip" data-toggle="tooltip" data-placement="bottom" href="#" title="{l s='Full Screen' mod='gdz_pagebuilder'}" id="full-screen"><i class="feather feather-maximize-2"></i></a>
        <a class="btn-icon gdz-tooltip" data-toggle="tooltip" data-placement="bottom" href="{$page_link}" title="{l s='Page Preview' mod='gdz_pagebuilder'}" target="_blank"><i class="feather feather-eye"></i></a>

        <a class="btn btn-active" id="save" href="#">{l s='Save' mod='gdz_pagebuilder'}</a>
    </div>
</div>
{* footer section *}

{if isset($js_def_vars) && is_array($js_def_vars) && $js_def_vars|@count}
  <script type="text/javascript">
    {foreach from=$js_def_vars key=k item=def}
    var {$k} = {$def|json_encode nofilter};
    {/foreach}
  </script>
{/if}
{if isset($js_files) && count($js_files)}
  {include file=$smarty.const._PS_ALL_THEMES_DIR_|cat:"javascript.tpl"}
{/if}
<div id="pb-tmpl-row" class="hidden">
    <div class="gdz-row">
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
                            <li><a title="3,9" data-layout="3,9" class="column-layout label-tooltip column-layout-39 active" href="#"></a></li>
                            <li><a title="3,6,3" data-layout="3,6,3" class="column-layout label-tooltip column-layout-363" href="#"></a></li>
                            <li><a title="2,6,4" data-layout="2,6,4" class="column-layout label-tooltip column-layout-264" href="#"></a></li>
                            <li><a title="2,10" data-layout="2,10" class="column-layout label-tooltip column-layout-210" href="#"></a></li>
                            <li><a title="5,7" data-layout="5,7" class="column-layout label-tooltip column-layout-57" href="#"></a></li>
                          </ul>
                          <div class="pb-custom-layout clearfix align-items-center">
                            <div class="pb-custom-label width-auto"><span>Custom</span></div>
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
        <div class="container pb-row-inner">
            <div class="row">
            </div>
        </div>
        <div class="pb-add-row btn-group dropup">
          <a href="#" data-toggle="dropdown" data-display="static"><i class="feather feather-plus"></i></a>
          <div class="dropdown-menu pb-add-row-dropup">
              <div class="pb-add-row-dropup-container">
                  <ul class="pb-column-list">
                    <li><a title="12" data-layout="12" class="column-layout label-tooltip column-layout-12" href="#"></a></li>
                    <li><a title="6,6" data-layout="6,6" class="column-layout label-tooltip column-layout-66" href="#"></a></li>
                    <li><a title="4,4,4" data-layout="4,4,4" class="column-layout label-tooltip column-layout-444" href="#"></a></li>
                    <li><a title="3,3,3,3" data-layout="3,3,3,3" class="column-layout label-tooltip column-layout-3333" href="#"></a></li>
                    <li><a title="4,8" data-layout="4,8" class="column-layout label-tooltip column-layout-48" href="#"></a></li>
                    <li><a title="3,9" data-layout="3,9" class="column-layout label-tooltip column-layout-39 active" href="#"></a></li>
                    <li><a title="3,6,3" data-layout="3,6,3" class="column-layout label-tooltip column-layout-363" href="#"></a></li>
                    <li><a title="2,6,4" data-layout="2,6,4" class="column-layout label-tooltip column-layout-264" href="#"></a></li>
                    <li><a title="2,10" data-layout="2,10" class="column-layout label-tooltip column-layout-210" href="#"></a></li>
                    <li><a title="5,7" data-layout="5,7" class="column-layout label-tooltip column-layout-57" href="#"></a></li>
                  </ul>
                  <div class="pb-custom-layout clearfix align-items-center">
                    <div class="pb-custom-label width-auto"><span>Custom</span></div>
                    <div class="pb-custom-input"><input type="text" class="custom-layout" placeholder="4,4,4" value="4,4,4"></div>
                    <div class="pb-custom-btn width-auto"><a href="#" class="pb-btn pb-btn-primary column-layout" data-layout="custom">{l s='Add' mod='gdz_pagebuilder'}</a></div>
                  </div>
              </div>
          </div>
        </div>
    </div>
</div>
<div id="pb-tmpl-column" class="hidden">
    <div class="addon-sortable layout-column">
        <div class="pb-column-tools">
            <a href="#" class="pb-column-setting"><i class="feather feather-edit"></i></a>
        </div>
    </div>
</div>
<div id="pb-tmpl-addon-tools" class="hidden">
  <div class="pb-addon-tools">
    <a href="#" class="pb-drag-arrow pull-right"><i class="feather feather-move"></i></a>
    <a href="#" class="pb-addon-setting pull-right"><i class="feather feather-edit"></i></a>
    <a href="#" class="pb-addon-duplicate pull-right"><i class="feather feather-copy"></i></a>
    <a href="#" class="pb-addon-delete pull-right"><i class="feather feather-trash-2"></i></a>
  </div>
</div>
{include file="module:gdz_pagebuilder/views/templates/admin/row_style_template.tpl"}
{include file="module:gdz_pagebuilder/views/templates/admin/col_style_template.tpl"}
{foreach from=$addonstemplate key=i item=addontpl}
<div style="display:none" id="pb-config-addon-{$addontpl.name}" type="text/html">
      {$addontpl.configuration nofilter}
</div>
{/foreach}
<div class="bootstrap">
      {include file="./row_settings.tpl"}
      {include file="./column_settings.tpl"}
</div>
{include file="module:gdz_pagebuilder/views/templates/admin/library.tpl"}
{include file="module:gdz_pagebuilder/views/templates/admin/replace_url.tpl"}
{include file="module:gdz_pagebuilder/views/templates/admin/copy_lang.tpl"}
</body>
</html>
