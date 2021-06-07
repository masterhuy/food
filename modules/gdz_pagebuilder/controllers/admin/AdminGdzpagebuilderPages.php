<?php
/**
* 2007-2020 PrestaShop
*
Godzilla PageBuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzPage.php');
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzTemplate.php');
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzHelper.php');
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzImportExport.php');
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/lib/awesome/icon.php');
class AdminGdzpagebuilderPagesController extends ModuleAdminControllerCore
{
    public function __construct()
    {
        $this->name = _GDZ_PB_NAME_;
        $this->tab = 'front_office_features';
        $this->bootstrap = true;
        $this->lang = true;
        $this->context = Context::getContext();
        $this->secure_key = Tools::encrypt($this->name);
        $_controller = Tools::getValue('controller');
        $this->classname = $_controller;
        $this->addon_folder = _PS_ROOT_DIR_.'/modules/'._GDZ_PB_NAME_.'/addons';
        $ffs = scandir($this->addon_folder);
        $addons_arr = array();
        $i = 0;
        foreach ($ffs as $ff) {
            $ext = pathinfo($ff, PATHINFO_EXTENSION);
            if (!is_dir($this->addon_folder.'/'.$ff) && ($ext == 'php') && !in_array($ff, array('index.php','addonbase.php'))) {
                $addons_arr[$i] = Tools::substr($ff, 5, Tools::strlen($ff) - 9);
                $i++;
            }
        }
        $this->addons = $addons_arr;
        $this->json_path = _PS_ROOT_DIR_.'/modules/'._GDZ_PB_NAME_.'/json/';
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
        parent::__construct();
    }
    public function initPageHeaderToolbar()
    {
        if (Tools::getValue('config_id_page')) {
            $this->page_header_toolbar_btn['new'] = array(
                'short' => 'AddRow',
                'href' => 'javascript:;',
                'desc' => $this->l('Add Row'),
                'confirm' => 1
            );
            $this->page_header_toolbar_btn['save'] = array(
                'short' => 'SaveLayout',
                'href' => 'javascript:;',
                'desc' => $this->l('Save Layout'),
                'confirm' => 1
            );
        } elseif(!Tools::getValue('addPage') && !Tools::getValue('edit_id_page')) {
            $this->page_header_toolbar_btn['new'] = array(
                'short' => 'AddPage',
                'href' => $this->context->link->getAdminLink('AdminGdzpagebuilderPages').'&configure=gdz_pagebuilder&addPage=1',
                'desc' => $this->l('Add Page'),
                'confirm' => 1
            );
        }
        parent::initPageHeaderToolbar();
    }
    public function renderList()
    {
        $this->_html = $this->headerHTML();
        /* Validate & process */
        if (Tools::isSubmit('addPage') || (Tools::isSubmit('edit_id_page') && $this->pageExists((int)Tools::getValue('edit_id_page')))) {
            $this->_html .= $this->renderNavigation();
            $this->_html .= $this->renderAddPage();
        } elseif (Tools::isSubmit('submitPage') || Tools::isSubmit('delete_id_page') || Tools::isSubmit('status_id_page') || Tools::isSubmit('export_id_page') || Tools::isSubmit('import_id_page') || (Tools::isSubmit('duplicate_id_page') && $this->pageExists((int)Tools::getValue('duplicate_id_page'))) || Tools::isSubmit('saveLayout') || Tools::isSubmit('lang_id_page')) {
            if ($this->_postValidation()) {
                $this->_postProcess();
                $this->_html .= $this->renderListPage();
            } else {
                $this->_html .= $this->renderAddPage();
            }
        } elseif (Tools::isSubmit('config_id_page') && $this->pageExists((int)Tools::getValue('config_id_page'))) {
            $this->_html .= $this->renderPageLayout();
        } else {
            $this->_html .= $this->renderListPage();
        }
        return $this->_html;
    }

    private function _postValidation()
    {
        $errors = array();
        /* Validation for configuration */
        if (Tools::isSubmit('submitPage')) {
            $languages = Language::getLanguages(false);
            foreach ($languages as $language) {
                if (Tools::strlen(Tools::getValue('title_'.$language['id_lang'])) > 255) {
                    $errors[] = $this->l('The title is too long.');
                }
                if (Tools::strlen(Tools::getValue('alias_'.$language['id_lang'])) > 255) {
                    $errors[] = $this->l('The URL is too long.');
                }
            }
        } elseif (Tools::isSubmit('delete_id_page')) {
            if ((!Validate::isInt(Tools::getValue('delete_id_page')) || !$this->pageExists((int)Tools::getValue('delete_id_page')))) {
                $errors[] = $this->l('Invalid id_page');
            }
        } elseif (Tools::isSubmit('export_id_page')) {
            if ((!Validate::isInt(Tools::getValue('export_id_page')) || !$this->pageExists((int)Tools::getValue('export_id_page')))) {
                $errors[] = $this->l('Invalid id_page');
            }
        }
        /* Display errors if needed */
        if (count($errors)) {
            $this->_html .= Tools::displayError(implode('<br />', $errors));
            return false;
        }
        /* Returns if validation is ok */
        return true;
    }
    private function _postProcess()
    {
        $errors = array();
        if (Tools::isSubmit('submitPage')) {
            if (Tools::getValue('id_page')) {
                $id_page = Tools::getValue('id_page');
            } else {
                $id_page = null;
            }
            $errors = array();
            if ($id_page) {
                $page = new gdzPage($id_page);
            } else {
                $page = new gdzPage();
            }
            //$page->title = Tools::getValue('title');
            $page->css_file = Tools::getValue('css_file');
            $page->js_file = Tools::getValue('js_file');
            $page->page_class = Tools::getValue('page_class');
            $page->active = Tools::getValue('active');
            $languages = Language::getLanguages(false);
            foreach ($languages as $language) {
                $page->title[$language['id_lang']] = Tools::getValue('title_'.$language['id_lang']);
                $page->alias[$language['id_lang']] = Tools::getValue('alias_'.$language['id_lang']);
                if (!$page->alias[$language['id_lang']]) {
                    $alias = $page->title[$language['id_lang']];
                    $alias    = preg_replace('/[^a-z A-Z0-9-]*/', '', $alias);
                    $alias    = preg_replace('/-{2,}/', '-', $alias);
                    $alias    = preg_replace('/ /', '-', $alias);
                    $alias    = trim(Tools::strtolower($alias));
                    $alias    = ltrim($alias, '-');
                    $page->alias[$language['id_lang']]    = rtrim($alias, '-');
                }
                $page->meta_desc[$language['id_lang']] = Tools::getValue('meta_desc_'.$language['id_lang']);
                $page->meta_key[$language['id_lang']] = Tools::getValue('meta_key_'.$language['id_lang']);
                $page->key_ref[$language['id_lang']] = Tools::getValue('key_ref_'.$language['id_lang']);
            }

            if ((int)$id_page == 0) {
                if (!$page->add()) {
                    $errors[] = $this->displayError($this->l('The item could not be added.'));
                }
            } elseif (!$page->update()) {
                $errors[] = $this->displayError($this->l('The item could not be updated.'));
            }
        } elseif (Tools::isSubmit('delete_id_page') && $this->pageExists(Tools::getValue('delete_id_page'))) {
            $page = new gdzPage(Tools::getValue('delete_id_page'));
            if (!$page->delete()) {
                $this->_html .= Tools::displayError('Could not delete');
            } else {
                $sql = "DELETE FROM `"._DB_PREFIX_."gdz_pagebuilder` WHERE `id_page` = ".(int)Tools::getValue('delete_id_page');
                $res = Db::getInstance()->Execute($sql);
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=1&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
            }
        } elseif (Tools::isSubmit('duplicate_id_page')) {
            $newPage = new gdzPage(Tools::getValue('duplicate_id_page'));
            $duplicatePage = $newPage->duplicateObject();
            $languages = Language::getLanguages(false);
            //print_r($duplicatePage); exit;
            foreach ($languages as $language) {
                $duplicatePage->title[$language['id_lang']] = $duplicatePage->title[$language['id_lang']].'- Copy';
            }
            $duplicatePage->params = $newPage->params;
            if (!$duplicatePage->update()) {
                $errors[] = 'The duplicated Page Error.';
            }
        } elseif (Tools::isSubmit('export_id_page')) {
            $gdz_importexport = new gdzImportExport();
            $res = $gdz_importexport->exportPage(Tools::getValue('export_id_page'));
        } elseif (Tools::isSubmit('import_id_page')) {
            $import_file = Tools::getValue('import_file');
            $jsonfile = fopen($this->json_path.$import_file, "r") or die("Unable to open file!");
            $jsontext = fread($jsonfile, filesize($this->json_path.$import_file));
            $page = new gdzPage((int)Tools::getValue('import_id_page'));
            $page->params = $jsontext;
            $res = $page->update();
            fclose($jsonfile);
            if (!$res) {
                $this->_html .= Tools::displayError('The Import is error.');
            } else {
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=4&config_id_page='.Tools::getValue('import_id_page'));
            }
        } elseif (Tools::isSubmit('status_id_page')) {
            $page = new gdzPage((int)Tools::getValue('status_id_page'));
            if ($page->active == 0) {
                $page->active = 1;
            } else {
                $page->active = 0;
            }
            $res = $page->update();
            if (!$res) {
                $this->_html .= Tools::displayError('The status could not be updated.');
            } else {
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=5&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
            }
        } elseif (Tools::isSubmit('saveLayout')) {
            $jsonparams = Tools::getValue('gdzformjson');
            $page_id = (int)Tools::getValue('json_page_id');
            $page = new gdzPage($page_id);
            $page->params = $jsonparams;
            $res = $page->update();
            if (!$res) {
                $this->_html .= Tools::displayError('The layout could not be saved.');
            } else {
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&config_id_page='.$page_id);
            }
        } elseif (Tools::isSubmit('lang_id_page')) {
            $page_id = (int)Tools::getValue('lang_id_page');
            $src_lang_id = (int)Tools::getValue('src_lang_id');
            $res = gdzPageBuilderHelper::cloneLangData($page_id, $src_lang_id);
            if (!$res) {
                $this->_html .= Tools::displayError('The clone data havent finished.');
            } else {
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&config_id_page='.$page_id);
            }
        }
        if (count($errors)) {
            $this->_html .= Tools::displayError(implode('<br />', $errors));
        } elseif (Tools::isSubmit('submitPage') && Tools::getValue('id_page')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        } elseif (Tools::isSubmit('delete_id_page') && Tools::getValue('delete_id_page')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        } elseif (Tools::isSubmit('changePageStatus') && Tools::getValue('id_page')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        } elseif (Tools::getValue('duplicate_id_page')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&conf=3&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        }
    }
    public function genAddonsList()
    {
        $addons = $this->addons;
        $result = array();
        foreach ($addons as $key => $addon) {
            $addonfile = 'addon'.$addon.'.php';
            $addonclass = 'gdzAddon'.Tools::ucfirst($addon);
            if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
                require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
            }
            $addon_instance = new $addonclass();
            $result[$key]['ordering'] = $addon_instance->ordering;
            $result[$key]['type'] = $addon_instance->type;
            $result[$key]['pro'] = false;
            if(defined('_GDZ_PB_PROADDONS_') && in_array($addon, _GDZ_PB_PROADDONS_)) $result[$key]['pro'] = true;
            $result[$key]['addon'] = $addon_instance->genAddonList($addon);
        }
        $_type = array_column($result, 'type');
        //$_ordering = array_column($result, 'ordering');
        array_multisort($_type, SORT_ASC, $result);
        return $result;
    }


    public function pageExists($id_page)
    {
        $req = 'SELECT hs.`id_page`
                FROM `'._DB_PREFIX_.'gdz_pagebuilder_pages` hs
                WHERE hs.`id_page` = '.(int)$id_page;
        $page = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);
        return ($page);
    }

    public function renderListPage()
    {
        $this->context->controller->addJqueryUI('ui.draggable');
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/admin_page.css', 'all');
        $pages = gdzPageBuilderHelper::getPages();
        //print_r($pages); exit;
        $this->override_folder = 'gdz_pagebuilder_pages/';
        $tpl = $this->createTemplate('listpage.tpl');
        $tpl->assign(array('link' => $this->context->link,'pages' => $pages,'adminlink' => $this->context->link->getAdminLink($this->classname)));
        return $tpl->fetch();
    }
    public function renderNavigation()
    {
        $html = '<div class="navigation">';
        $html .= '<a class="btn btn-default" href="'.AdminController::$currentIndex.
            '&configure='.$this->name.'
                &token='.Tools::getAdminTokenLite($this->classname).'" title="Back to Dashboard"><i class="icon-page"></i>Back to Dashboard</a>';
        $html .= '</div>';
        return $html;
    }
    public function renderAddPage()
    {
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/admin_page.css', 'all');
        $this->context->controller->addJqueryUI('ui.draggable');
        $html_content = '<div class="pagebuilder-content">
            <a target="_blank" href="'.$this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&config_id_page='.Tools::getValue('edit_id_page').'">Edit With Pagebuilder Layout</a>
            <a target="_blank" href="'.$this->context->link->getAdminLink('gdzPagebuilderEditor').'&id_page='.Tools::getValue('edit_id_page').'">Edit with Live Editor</a>
        </div>';
        $input_arr = array();
        $input_arr[] = array(
            'type' => 'text',
            'label' => $this->l('Title'),
            'name' => 'title',
            'lang' => true,
        );
        $input_arr[] = array(
            'type' => 'text',
            'label' => $this->l('Alias'),
            'name' => 'alias',
            'lang' => true,
        );
        $input_arr[] = array(
            'type' => 'text',
            'label' => $this->l('Meta Description'),
            'name' => 'meta_desc',
            'lang' => true,
            'desc' => $this->l('An optional paragraph to be used as the description of the page in the HTML output. This will generally display in the results of search engines.')
        );
        $input_arr[] = array(
            'type' => 'text',
            'label' => $this->l('Meta Keywords'),
            'name' => 'meta_key',
            'lang' => true,
            'desc' => $this->l('An optional comma-separated list of keywords and/or phrases to be used in the HTML output.')
        );
        $input_arr[] = array(
            'type' => 'text',
            'label' => $this->l('Key Reference'),
            'name' => 'key_ref',
            'lang' => true,
            'desc' => $this->l('Used to store information referring to an external resource .')
        );
        $input_arr[] = array(
            'type' => 'text',
            'label' => $this->l('Css File'),
            'name' => 'css_file',
            'class' => 'fixed-width-xl',
        );
        $input_arr[] = array(
            'type' => 'text',
            'label' => $this->l('Javascript File'),
            'name' => 'js_file',
            'class' => 'fixed-width-xl',
        );
        $input_arr[] = array(
            'type' => 'text',
            'label' => $this->l('Page Class'),
            'name' => 'page_class',
            'class' => 'fixed-width-xl',
        );
        $input_arr[] = array(
            'type' => 'switch',
            'label' => $this->l('Active'),
            'name' => 'active',
            'is_bool' => true,
            'values' => array(
                array(
                    'id' => 'active_on',
                    'value' => 1,
                    'label' => $this->l('Yes')
                ),
                array(
                    'id' => 'active_off',
                    'value' => 0,
                    'label' => $this->l('No')
                )
            ),
        );
        if(Tools::isSubmit('edit_id_page'))
            $input_arr[] = array(
                'type' => 'html',
                'label' => $this->l('Page Content'),
                'name' => 'page_content',
                'html_content' => $html_content,
            );

        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Page Informations'),
                'icon' => 'icon-cogs'
            ),
            'input' => $input_arr,
            'submit' => array(
                'title' => $this->l('Save'),
                'name' => 'submitPage'
            )
        );
        if (Tools::isSubmit('edit_id_page')) {
            $this->fields_form['input'][] = array('type' => 'hidden', 'name' => 'id_page');
        }
        $this->fields_value = $this->getPageFieldsValues();
        return adminController::renderForm();
    }
    public function getPageFieldsValues()
    {
        $id_page = (int)Tools::getValue('edit_id_page');
        $fields = array();
        if ($id_page) {
            $page = new gdzPage($id_page);
            $fields['id_page']  = (int)Tools::getValue('edit_id_page', $page->id);
        } else {
            $page = new gdzPage();
        }
        $fields['css_file'] = Tools::getValue('css_file', $page->css_file);
        $fields['js_file'] = Tools::getValue('js_file', $page->js_file);
        $fields['page_class'] = Tools::getValue('page_class', $page->page_class);
        $fields['active'] = Tools::getValue('active', $page->active);
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            if (isset($page->title[$lang['id_lang']])) {
                $fields['title'][$lang['id_lang']]  = Tools::getValue('title_'.(int)$lang['id_lang'], $page->title[$lang['id_lang']]);
                $fields['alias'][$lang['id_lang']]  = Tools::getValue('alias_'.(int)$lang['id_lang'], $page->alias[$lang['id_lang']]);
                $fields['meta_desc'][$lang['id_lang']] = Tools::getValue('meta_desc_'.(int)$lang['id_lang'], $page->meta_desc[$lang['id_lang']]);
                $fields['meta_key'][$lang['id_lang']] = Tools::getValue('meta_key_'.(int)$lang['id_lang'], $page->meta_key[$lang['id_lang']]);
                $fields['key_ref'][$lang['id_lang']] = Tools::getValue('key_ref_'.(int)$lang['id_lang'], $page->key_ref[$lang['id_lang']]);
            } else {
                $fields['title'][$lang['id_lang']]  = Tools::getValue('title_'.(int)$lang['id_lang']);
                $fields['alias'][$lang['id_lang']]  = Tools::getValue('alias_'.(int)$lang['id_lang']);
                $fields['meta_desc'][$lang['id_lang']] = Tools::getValue('meta_desc_'.(int)$lang['id_lang']);
                $fields['meta_key'][$lang['id_lang']] = Tools::getValue('meta_key_'.(int)$lang['id_lang']);
                $fields['key_ref'][$lang['id_lang']] = Tools::getValue('key_ref_'.(int)$lang['id_lang']);
            }
        }
        return $fields;
    }

    public function headerHTML()
    {
        if (Tools::getValue('controller') != 'AdminGdzpagebuilderPages' && Tools::getValue('configure') != $this->name) {
            return;
        }
        $this->context->controller->addJqueryUI('ui.resizable');
        $this->context->controller->addJqueryUI('ui.sortable');
        /* Style & js for fieldset 'rows configuration' */
        $html = '<script type="text/javascript">
            $(function() {
                var $mypages = $(".page");

                $mypages.sortable({
                    opacity: 0.6,
                    cursor: "move",
                    update: function() {
                        var order = $(this).sortable("serialize") + "&action=updatePagesOrdering";
                        $.post("'.$this->context->shop->physical_uri.$this->context->shop->virtual_uri.'modules/'.$this->name.'/ajax_'.$this->name.'.php?secure_key='.$this->secure_key.'", order);
                    },
                    stop: function( event, ui ) {
                        showSuccessMessage("Saved!");
                    }
                });
                $mypages.hover(function() {
                    $(this).css("cursor","move");
                    },
                    function() {
                    $(this).css("cursor","auto");
                });
            });
        </script>';

        return $html;
    }

    public function loadAddon($addon)
    {
        $addonfile = 'addon'.$addon->type.'.php';
        $addonclass = 'gdzAddon'.Tools::ucfirst($addon->type);
        if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
            require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
        }
        $addon_instance = new $addonclass();
        return $addon_instance->genAddonLayout($addon);
    }
    public function renderPageLayout()
    {
        $id_lang = Tools::getValue('id_lang');
        require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/settings.php');
        $languages = Language::getLanguages(false);
        $this->context->controller->addJS(_PS_JS_DIR_.'tiny_mce/tiny_mce.js');
        $version = Configuration::get('PS_INSTALL_VERSION');
        $tiny_path = ($version >= '1.6.0.13') ? 'admin/' : '';
        $tiny_path .= 'tinymce.inc.js';
        $this->context->controller->addJqueryUi('ui.autocomplete');
        $this->context->controller->addJS(_PS_JS_DIR_.$tiny_path);
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/lib/awesome/font-awesome.min.css', 'all');
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/lib/feather/feather.css', 'all');
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/lib/icon/style.css', 'all');
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/admin_style.css', 'all');
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/responsive.css', 'all');
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/modal.css', 'all');
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/lib/bootstrap-colorpicker/bootstrap-colorpicker.min.css', 'all');
        $this->context->controller->addJS(_MODULE_DIR_.$this->module->name.'/lib/bootstrap-colorpicker/bootstrap-colorpicker.js', 'all');
        $this->context->controller->addJS(_MODULE_DIR_.$this->module->name.'/views/js/input.js', 'all');
        $this->context->controller->addJS(_MODULE_DIR_.$this->module->name.'/views/js/admin_script.js', 'all');
        $this->context->controller->addJqueryUI('ui.draggable');
        $id_page = Tools::getValue('config_id_page');
        $selectedpage = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT * FROM '._DB_PREFIX_.'gdz_pagebuilder_pages '.($id_page ? ' WHERE `id_page` = '.$id_page : ''));
        $params = $selectedpage['params'];
        $rows = (array)Tools::jsonDecode($params);
        foreach ($rows as $key => $row) {
            $columns = $rows[$key]->cols;
            foreach ($columns as $ckey => $column) {
                $addons = $column->addons;
                foreach ($addons as $akey => $addon) {
                    $rows[$key]->cols[$ckey]->addons[$akey]->addon_box = $this->loadAddon($addon);
                }
            }
        }
        $this->override_folder = 'gdz_pagebuilder_pages/';
        $tpl = $this->createTemplate('pagelayout.tpl');
        $defaultFormLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
        $mediatoken = Tools::getAdminTokenLite('AdminGdzpagebuilderMedia');
        $pages = gdzPageBuilderHelper::getPages();
        $page_link = $this->context->link->getModuleLink('gdz_pagebuilder', 'page', array(
            'id_page' => $id_page
        ), true);
        $row_settings_default = gdzPageBuilderHelper::getSettingsDefaultValue($row_settings);
        $column_settings_default = gdzPageBuilderHelper::getSettingsDefaultValue($column_settings);
        $addondefaults = array();
        $addons = gdzPageBuilderHelper::getAddonsList();
        foreach ($addons as $addon) {
          $addonfile = 'addon'.$addon.'.php';
          $addonclass = 'gdzAddon'.Tools::ucfirst($addon);
          if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
              require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
          }
          $addon_instance = new $addonclass();
          $addondefaults[$addon] = $addon_instance->defaultValue();
        }
        $awesomeicons = AwesomeIcon::getAwesomeIcons();
        $preview_link = $this->context->link->getModuleLink('gdz_pagebuilder', 'preview', array(
            'id_page' => $id_page
        ), true);
        $link_params = explode("?", $preview_link);
        parse_str($link_params[1], $link_args);

        if(isset($link_args['id_lang']) && intval($link_args['id_lang']) > 0 && $id_lang) {
            $link_args['id_lang'] = $id_lang;
            $preview_link = $link_params[0].'?'.urldecode(http_build_query($link_args));
        }
        $editor_link = $this->context->link->getAdminLink('gdzPagebuilderEditor');
        $backend_link = $this->context->link->getAdminLink('AdminGdzpagebuilderPages');
        Media::addJsDef(
            array(
              'PagebuilderConfig' => [
                'preview_link' => $preview_link,
                'editor_link' => $editor_link,
                'backend_link' => $backend_link
              ],
              'root_url' => $this->root_url,
              'pageJson' => $params,
              'addonDefaults' => json_encode( $addondefaults ),
              'rowSettings' => json_encode( $row_settings ),
              'columnSettings' => json_encode( $column_settings ),
              'rowSettingsDefault' => json_encode( $row_settings_default, JSON_UNESCAPED_UNICODE ),
              'columnSettingsDefault' => json_encode( $column_settings_default, JSON_UNESCAPED_UNICODE ),
              'awesomeIcons' => json_encode($awesomeicons)
            )
        );
        $templates = gdzPageBuilderHelper::getTemplates();
        $fid = time();
        $tpl->assign(
            array(
                'link' => $this->context->link,
                'modules_url' => $this->root_url.'modules/',
                'row_settings' => $row_settings,
                'column_settings' => $column_settings,
                'rows' => $rows,
                'rowSettingsDefault' => json_encode( $row_settings_default, JSON_UNESCAPED_UNICODE ),
                'jsontext' => str_replace('"', '&quot;', $params),
                'selectedpage' => $selectedpage,
                'pages' => $pages,
                'page_link' => $page_link,
                'live_link' => $editor_link.'&id_page='.$id_page,
                'mediatoken' => $mediatoken,
                'addonslist' => $this->genAddonsList(),
                'id_lang' => $id_lang,
                'languages' => $languages,
                'templates' => $templates,
                'pro' => !defined('_GDZ_PB_PROADDONS_'),
                'fid' => $fid,
                'defaultFormLanguage' => $defaultFormLanguage,
                'ad' => __PS_BASE_URI__.basename(_PS_ADMIN_DIR_),
                'converturl' => (int)Configuration::get('JPB_CONVERTURL'),
                'root_url' => $this->root_url
                )
        );
        return $tpl->fetch();
    }
    public function ajaxProcessImportTemplate() {
        $context = Context::getContext();
        $id_template = (int)Tools::getValue('id_template');
        $template = new gdzTemplate($id_template);
        $params = $template->params;
        if(Tools::getValue('id_lang')) {
            $id_lang    = (int)Tools::getValue('id_lang');
        } else {
            $id_lang = (int)(Configuration::get('PS_LANG_DEFAULT'));
        }
        $id_shop = $context->shop->id;
        $rows = (array)Tools::jsonDecode($params);
        $bresult = array();
        $b_index = 0;
        foreach ($rows as $key => $row) {
            $row->id = 'row-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
            $bresult[] = $row;
            $columns = $rows[$key]->cols;
            foreach ($columns as $ckey => $column) {
                $column->id = 'col-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                $addons = $column->addons;
                foreach ($addons as $akey => $addon) {
                    $addon->id = 'addon-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                    $rows[$key]->cols[$ckey]->addons[$akey]->addon_box = $this->loadAddon($addon);
                    $bresult[$b_index]->cols[$ckey]->addons[$akey]->return_value = $this->loadAddon($addon);
                }
            }
            $b_index++;
        }

        $context->smarty->assign(
            array(
                'rows' => $bresult
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_ ._GDZ_PB_NAME_."/views/templates/admin/gdz_pagebuilder_pages/pagelayout_rows.tpl");
        $rs = array(
            'html' => $html,
            'params' => $rows,
        );
        die(Tools::jsonEncode($rs));
    }
}
