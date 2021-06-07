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

use PageBuilder\Editor;

if (!defined('_PS_VERSION_')) {
    exit;
}
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzHelper.php');
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/lib/awesome/icon.php');
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzPage.php');
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzTemplate.php');
class gdzPagebuilderEditorController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->display_header = true;
        parent::__construct();
        if (!$this->module->active) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
        }
        $this->name = 'gdzPagebuilderEditor';
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
    }
    public function initContent() {
        $this->setMedia();
        $this->initHeader();
    }
    public function setMedia($isNewTheme = false){
        if (version_compare(_PS_VERSION_, '1.7.7.0', '>=')) {
            parent::setMedia();
        } else {
            $this->addJquery();
        }
        $this->addJqueryPlugin('fancybox');
        $this->addJqueryPlugin('chosen');
        $this->addJqueryPlugin('autocomplete');
        $this->addJS(_PS_JS_DIR_.'admin.js');
        $this->addJS(_PS_BO_ALL_THEMES_DIR_.'default/js/tree.js');
        $this->addJqueryUI('ui.tooltip');

        $this->addCSS(array(
            __PS_BASE_URI__.$this->admin_webpath.'/themes/'.$this->bo_theme.'/css/admin-theme.css',
            __PS_BASE_URI__.$this->admin_webpath.'/themes/'.$this->bo_theme.'/public/theme.css',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/feather/feather.css',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/awesome/font-awesome.min.css',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/icon/style.css',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/bootstrap-colorpicker/bootstrap-colorpicker.min.css',
            _MODULE_DIR_._GDZ_PB_NAME_.'/views/css/editor.css',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/perfect-scrollbar/perfect-scrollbar.css'
        ));

        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/modal.css', 'all');
        $version = Configuration::get('PS_INSTALL_VERSION');
        $tiny_path = ($version >= '1.6.0.13') ? 'admin/' : '';
        $tiny_path .= 'tinymce.inc.js';
        $this->context->controller->addJqueryUi('ui.autocomplete');
        $this->addJS(array(
            __PS_BASE_URI__.$this->admin_webpath.'/themes/'.$this->bo_theme.'/js/vendor/bootstrap.min.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery-ui/core.min.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery-ui/widget.min.js?ver=1.11.4',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery-ui/mouse.min.js?ver=1.11.4',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery-ui/sortable.min.js?ver=1.11.4',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery-ui/resizable.min.js?ver=1.11.4',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery-ui/position.min.js?ver=1.11.4',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery-ui/draggable.min.js',
            _PS_JS_DIR_.'tiny_mce/tiny_mce.js',
            _PS_JS_DIR_.$tiny_path,
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/owl-carousel/owl.carousel.min.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/instagram-lite-master/instagramLite.min.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery.fractionslider.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/perfect-scrollbar/perfect-scrollbar.min.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery.plugin.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/jquery.countdown.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/lib/bootstrap-colorpicker/bootstrap-colorpicker.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/views/js/lodash.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/views/js/base.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/views/js/editor.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/views/js/configuration.js',
            _MODULE_DIR_._GDZ_PB_NAME_.'/views/js/input.js',

        ));
        $base_url = Tools::getHttpHost(true);
        $base_url = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE') ? $base_url : str_replace('https', 'http', $base_url);

        Hook::exec('actionAdminControllerSetMedia');

    }
    public function display(){
        $this->context->smarty->assign(array(
            'js_def_vars' => Media::getJsDef(),
        ));
        if(Tools::getValue('id_lang'))
          $id_lang = Tools::getValue('id_lang');
        else
          $id_lang = $this->context->language->id;
        $id_page = Tools::getValue('id_page');
        if((int)$id_page == 0) {
          echo "please select page"; die;
        }
        $pages = gdzPageBuilderHelper::getPages();
        $modules = gdzPageBuilderHelper::getModules();
        $modulenames = array();
        $modulenames[] = '';
        foreach($modules as $_module) {
          $modulenames[] = $_module['name'];
        }
        $page_link = $this->context->link->getModuleLink('gdz_pagebuilder', 'page', array(
            'id_page' => $id_page
        ),null,$id_lang, null, true);
        $link_params = explode("?", $page_link);
        parse_str($link_params[1], $link_args);

        if(isset($link_args['id_lang']) && (int)$link_args['id_lang'] > 0 && $id_lang) {
            $link_args['id_lang'] = $id_lang;
            $page_link = $link_params[0].'?'.urldecode(http_build_query($link_args));
        }
        $addons = gdzPageBuilderHelper::getAddonsList();
        $addonTitles = array();
        $addonslist = array();
        $addonstemplate = array();
        $addondefaults = array();
        $i = 0;
        foreach ($addons as $key => $addon) {
            $addonfile = 'addon'.$addon.'.php';
            $addonclass = 'gdzAddon'.Tools::ucfirst($addon);
            if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
                require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
            }
            $addon_instance = new $addonclass();
            $addonslist[$key]['ordering'] = $addon_instance->ordering;
            $addonslist[$key]['type'] = $addon_instance->type;
            $addonslist[$key]['pro'] = false;
            if(defined('_GDZ_PB_PROADDONS_') && in_array($addon, _GDZ_PB_PROADDONS_)) $addonslist[$key]['pro'] = true;
            $addonslist[$key]['addon'] = $addon_instance->genEditorAddonList();
            $addonTitles[$addon] = $addon_instance->addontitle;
            $addonstemplate[$i]['name'] = $addon;
            $addonstemplate[$i]['configuration'] = $addon_instance->genConfiguration();
            $addondefaults[$addon] = $addon_instance->defaultValue();
            $i++;
        }
        $_type = array_column($addonslist, 'type');
        array_multisort($_type, SORT_ASC, $addonslist);
        $preview_link = $this->context->link->getModuleLink('gdz_pagebuilder', 'preview', array(
            'id_page' => $id_page
        ),null,$id_lang,null, true);
        $link_params = explode("?", $preview_link);
        parse_str($link_params[1], $link_args);
        if(isset($link_args['id_lang']) && (int)$link_args['id_lang'] > 0 && $id_lang) {
            $link_args['id_lang'] = $id_lang;
            $preview_link = $link_params[0].'?'.urldecode(http_build_query($link_args));
        }
        $editor_link = $this->context->link->getAdminLink('gdzPagebuilderEditor');
        $ajax_link = $this->context->link->getModuleLink('gdz_pagebuilder', 'ajax', array(), true);
        if (strpos($ajax_link, '?') !== false) {
            $ajax_link .= '&';
        } else {
            $ajax_link .= '?';
        }
        require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/settings.php');
    		$rowSettings = gdzPageBuilderHelper::getSettingsDefaultValue($row_settings);
        $colSettings = gdzPageBuilderHelper::getSettingsDefaultValue($column_settings);
        $pagejson = Db::getInstance()->getValue('SELECT params FROM '._DB_PREFIX_.'gdz_pagebuilder_pages '.($id_page ? ' WHERE `id_page` = '.$id_page : ''));
        $awesomeicons = AwesomeIcon::getAwesomeIcons();
        Media::addJsDef(
            array(
              'PagebuilderConfig' => [
                'preview_link' => $preview_link,
                'editor_link' => $editor_link,
                'ajax_link' => $ajax_link,
                'secure_key' => $this->module->secure_key
              ],
              'addonTitles' => json_encode($addonTitles),
              'pagejson' => $pagejson,
              'rowSettings' => json_encode( $rowSettings ),
              'colSettings' => json_encode( $colSettings ),
              'addonDefaults' => json_encode( $addondefaults ),
              'awesomeIcons' => json_encode($awesomeicons),
              'root_url' => gdzPageBuilderHelper::getRootUrl()

            )
        );
        $this->context->smarty->assign(array(
            'js_def_vars' => Media::getJsDef(),
        ));
        $templates = gdzPageBuilderHelper::getTemplates();
        $fid = time();
        $languages = Language::getLanguages(false);
        $this->context->smarty->assign(array(
            'baseDir' => __PS_BASE_URI__.basename(_PS_ADMIN_DIR_).'/',
            'modules_url' => gdzPageBuilderHelper::getRootUrl().'modules/',
            'media_link' => $this->context->link->getAdminLink('AdminGdzpagebuilderMedia', true, array(), array('fid' => $fid)),
            'fid' => $fid,
            'page_link' => $page_link,
            'preview_link' => $preview_link,
            'pages' => $pages,
            'id_page' => $id_page,
            'id_lang' => $id_lang,
            'modules' => $modules,
            'addonslist' => $addonslist,
            'pro' => !defined('_GDZ_PB_PROADDONS_'),
            'addonstemplate' => $addonstemplate,
            'templates' => $templates,
            'row_settings' => $row_settings,
            'column_settings' => $column_settings,
            'languages' => $languages,
            'ad' => __PS_BASE_URI__.basename(_PS_ADMIN_DIR_),
            'converturl' => (int)Configuration::get('JPB_CONVERTURL'),
            'root_url' => $this->root_url
        ));

        $this->smartyOutputContent(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/views/templates/admin/editor.tpl');
    }
    public function ajaxProcessGetModule() {
        $module = Tools::getValue('module');
        $hook = Tools::getValue('hook');
        $module_content = gdzPageBuilderHelper::execModule($hook, array(), $module, $this->context->shop->id);
        echo $module_content;
        die;
    }
    public function ajaxProcessSavePage() {
        $page_id = (int)Tools::getValue('page_id');
        $page = new gdzPage($page_id);
        $page->params = Tools::getValue('jsonparams');
        $res = $page->update();
        die;
    }
    public function ajaxProcessDownloadThemeZip()
    {
        $filename = "themeSetting.zip";
        $template = file_get_contents('zip://test.zip#template.xml');
        $template = simplexml_load_string($template);
        $zipname = (string)$template->section->name;
        if (file_exists($filename)) {
            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename=".$zipname.".zip");
            header("Content-length: " . filesize($filename));
            header("Pragma: no-cache");
            header("Expires: 0");
            readfile($filename);
            exit;
        } else {
            die('file not exists');
        }
    }
    function zip($zip, $rootPath, $folder)
    {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath.$folder.'/'),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            if (!$file->isDir())
            {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath));
                $zip->addFile($filePath, $relativePath);
            }
        }

    }
    public function ajaxProcessExportTheme() {
        $rs = array('success' => true);
        if (!Module::isInstalled('gdz_themesetting')) {
            $rs['success'] = false;
            $rs['err'] = $this->module->l('Module gdz_themesetting is not installed');
        } else {
            try {
                $json = Tools::jsonDecode(Tools::getValue('json'), true);
                $pagename = Tools::getValue('pagename', 'new page');
                if (!$pagename) {
                    $pagename = 'New page';
                }
                $images = gdzTemplate::getImages($json);
                include_once _PS_MODULE_DIR_ . 'gdz_themesetting/controllers/admin/AdminGdzThemeSetting.php';
                $themeCtl = Controller::getController('AdminGdzThemeSettingController');
                $themeSetting = $themeCtl->getThemeSetting();
                $zip = new ZipArchive();
                $filename = "themeSetting.zip";
                if (file_exists($filename)) {
                    unlink($filename);
                }
                if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
                    $rs['success'] = false;
                    $rs['err'] = $this->module->l("cannot open zip");
                } else {
                    $zip->addFromString("themeSetting.json", $themeSetting);
                    $zip->addFromString("template.json", Tools::getValue('json'));
                    foreach ($images as $image) {
                        if ($image && is_file($_SERVER['DOCUMENT_ROOT'].$image)) {
                            $zip->addFile($_SERVER['DOCUMENT_ROOT'].$image, 'images/'.substr($image, strlen(__PS_BASE_URI__)));
                        }
                    }
                    // $this->zip($zip, _PS_THEME_DIR_, 'assets');
                    $xml = array(
                        'name' => $pagename,
                        'base_url' => __PS_BASE_URI__,
                    );
                    if (count($images)) {
                        $preview = 'preview.'.pathinfo($images[0], PATHINFO_EXTENSION);
                        $zip->addFile($_SERVER['DOCUMENT_ROOT'].$images[0], $preview);
                        $xml['preview'] = $preview;
                    }
                    $zip->addFromString("template.xml", $this->createThemeXml($xml));
                    $zip->close();
                    $rs['url'] = $this->context->link->getAdminLink('gdzPagebuilderEditor').'&ajax=1&action=DownloadThemeZip';
                }
            } catch (Exception $e) {
                $rs['success'] = false;
                $rs['err'] = $e->getMessage();
            }
        }
        die(Tools::jsonEncode($rs));
    }
    public function createThemeXml($arr)
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $root = $xml->createElement('section');
        $xml->appendChild($root);
        foreach ($arr as $key => $value) {
            $e = $xml->createElement($key, $value);
            $root->appendChild($e);
        }
        return $xml->saveXML();
    }
    public function ajaxProcessSaveTemplate() {
        $template = new gdzTemplate();
        $template->name = Tools::getValue('templatename');
        $template->params = Tools::getValue('jsonparams');
        $res = $template->add();
        die;
    }
    public function ajaxProcessDeleteTemplate() {
        $id_template = (int)Tools::getValue('id_template');
        $template = new gdzTemplate($id_template);
        $res = $template->delete();
        die;
    }
    public function ajaxProcessExportTemplate() {
        $id_template = (int)Tools::getValue('id_template');
        $template = new gdzTemplate($id_template);
        $filename = str_replace(' ', '_', $template->name).'.json';
        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="'.Tools::strtolower($filename).'"');
        $_output = $template->params;
        echo $_output;
        exit;
    }
    public function ajaxProcessGetTemplates() {
        $context = Context::getContext();
        $templates = gdzPageBuilderHelper::getTemplates();
        $context->smarty->assign(
            array(
                'templates' => $templates
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/admin/templates.tpl");
        echo $html;
        exit;
    }
    public function ajaxProcessReplaceUrl() {
        try {
            $rs = array('success' => true);
            $context = Context::getContext();
            $old_url = Tools::getValue('old_url');
            $new_url = Tools::getValue('new_url');
            $id_page = (int)Tools::getValue('id_page');
            $all_pages = (int)Tools::getValue('all_pages');
            if($all_pages == 1) {
                $pages = gdzPageBuilderHelper::getPages();
                $old_url_slash = str_replace('/', '\/', $old_url);
                $new_url_slash = str_replace('/', '\/', $new_url);
                $old_url_slash2 = str_replace('/', '\\/', $old_url);
                $new_url_slash2 = str_replace('/', '\\/', $new_url);
                foreach ($pages as $_page) {
                  $page = new gdzPage($_page['id_page']);
                  $page->params = str_replace($old_url, $new_url, $page->params);
                  $page->params = str_replace($old_url_slash, $new_url_slash, $page->params);
                  $page->params = str_replace($old_url_slash2, $new_url_slash2, $page->params);
                  if (!$page->update()) {
                      $rs['success'] = false;
                      $rs['err_mes'] = $this->l('Error in Replace Url in page '.$_page['title']);
                      die(Tools::jsonEncode($rs));
                  }
                }
                $rs['message'] = $this->l('all urls replaced success.');
            } else {
                $page = new gdzPage($id_page);
                $page->params = str_replace($old_url, $new_url, $page->params);
                $old_url_slash = str_replace('/', '\/', $old_url);
                $new_url_slash = str_replace('/', '\/', $new_url);
                $page->params = str_replace($old_url_slash, $new_url_slash, $page->params);
                $old_url_slash2 = str_replace('/', '\\/', $old_url);
                $new_url_slash2 = str_replace('/', '\\/', $new_url);
                $page->params = str_replace($old_url_slash2, $new_url_slash2, $page->params);
                if (!$page->update()) {
                    $rs['success'] = false;
                    $rs['err_mes'] = $this->l('Error in Replace Url.');
                } else {
                    $rs['message'] = $this->l('all urls replaced success.');
                }
            }

        } catch (Exception $e) {
            $rs['success'] = false;
            $rs['err_mes'] = $e->getMessage();
        }
        die(Tools::jsonEncode($rs));
    }
    public function ajaxProcessCopyLang() {
        try {
            $rs = array('success' => true);
            $context = Context::getContext();
            $src_lang_id = (int)Tools::getValue('source_lang');
            $id_page = (int)Tools::getValue('id_page');
            $all_pages = (int)Tools::getValue('copy_all_pages');
            if($all_pages == 1) {
                $pages = gdzPageBuilderHelper::getPages();
                foreach ($pages as $_page) {
                  $res = gdzPageBuilderHelper::cloneLangData($_page['id_page'], $src_lang_id);
                  if (!$res) {
                      $rs['success'] = false;
                      $rs['err_mes'] = $this->l('Error in Copy Language in page '.$_page['title']);
                      die(Tools::jsonEncode($rs));
                  }
                }
                $rs['message'] = $this->l('all pages copied language success.');
            } else {
                $res = gdzPageBuilderHelper::cloneLangData($id_page, $src_lang_id);
                if (!$res) {
                    $rs['success'] = false;
                    $rs['err_mes'] = $this->l('Error in Copy Language.');
                } else {
                    $rs['message'] = $this->l('The Page copied language success.');
                }
            }

        } catch (Exception $e) {
            $rs['success'] = false;
            $rs['err_mes'] = $e->getMessage();
        }
        die(Tools::jsonEncode($rs));
    }
    public function ajaxProcessGetBlog() {
        include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonblog.php');
        $blog = new gdzAddonBlog();
        $setting = Tools::getValue('setting');
        $obj = json_decode(json_encode($setting));
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $cols = $obj[16]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        if($cols)
            $cols_arr = explode("-", $cols);
        $posts = $blog->getPost($obj);
        if(count($posts) == 0) exit;
        $context->smarty->assign(
            array(
              'link' => $context->link,
              'posts' => $posts,
              'cols'  => $cols,
              'cols_md'   => $cols_arr[0],
              'cols_sm'   => $cols_arr[1],
              'cols_xs'   => $cols_arr[2],
              'navigation' => $obj[17]->value,
              'pagination' => $obj[18]->value,
              'autoplay' => $obj[19]->value,
              'rewind' => $obj[20]->value,
              'slidebypage' => $obj[21]->value,
              'show_category' => $obj[4]->value,
              'show_introtext' => $obj[5]->value,
              'show_readmore' => $obj[7]->value,
              'readmore_text' => $obj[8]->value->$id_lang,
              'show_time' => $obj[9]->value,
              'show_ncomments' => $obj[10]->value,
              'show_nviews' => $obj[11]->value,
              'show_media' => $obj[12]->value,
              'gutter' => $obj[14]->value,
              'image_url' => $blog->root_url.'modules/'.$blog->modulename.'/views/img/',
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addonblog.tpl");
        echo $html;
        exit;
    }
    public function ajaxProcessGetMenu() {
        $context = Context::getContext();
        include_once(_PS_MODULE_DIR_.'gdz_megamenu/classes/gdzMegamenuHelper.php');
        $menu_id = Tools::getValue('menu_id');
        $gdzhelper = new gdzMegamenuHelper();
        $menu_html = $gdzhelper->returnMenu($menu_id);
        $context->smarty->assign(
            array(
                'menu_html' => $menu_html
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addonmenu.tpl");
        echo $html;
        exit;
    }
    public function ajaxProcessGetSlider() {
        $addonclass = 'gdzAddonSliderLayer';
        $setting = array(
            'fields' => Tools::getValue('setting')
        );
        $setting = Tools::jsonDecode(Tools::jsonEncode($setting));
        $addonfile = 'addonsliderlayer.php';
        if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
            require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
        } else {
            die('Addon not found');
        }
        $addon_instance = new $addonclass();
        $html = $addon_instance->returnValue($setting);
        echo $html;
        exit;
    }
    public function ajaxProcessGetReel() {
        $addonclass = 'gdzAddonReel';
        $setting = array(
            'fields' => Tools::getValue('setting')
        );
        $setting = Tools::jsonDecode(Tools::jsonEncode($setting));
        $addonfile = 'addonreel.php';
        if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
            require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
        } else {
            die('Addon not found');
        }
        $addon_instance = new $addonclass();
        $html = $addon_instance->returnValue($setting);
        echo $html;
        exit;
    }
    public function ajaxProcessGetInstagram() {
        $addonclass = 'gdzAddonInstagram';
        $setting = array(
            'fields' => Tools::getValue('setting')
        );
        $setting = Tools::jsonDecode(Tools::jsonEncode($setting));
        $addonfile = 'addoninstagram.php';
        if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
            require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
        } else {
            die('Addon not found');
        }
        $addon_instance = new $addonclass();
        $html = $addon_instance->returnValue($setting);
        echo $html;
        exit;
    }
    public function ajaxProcessGetDeals() {
        include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonhotdeal.php');
        $gdzSetting = gdzPageBuilderHelper::genGdzSetting();
        $gdz_pagebuilder = Module::getInstanceByName(_GDZ_PB_NAME_);
        $configuration = $gdz_pagebuilder->getTemplateVarConfiguration();
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $hotdeal = new gdzAddonHotdeal();
        $setting = Tools::getValue('setting');
        $obj = json_decode(json_encode($setting));
        $_products = $hotdeal->getDeals($obj);
        $cols = $obj[3]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $context->smarty->assign(
            array(
                'gdzSetting' => $gdzSetting,
                'configuration' => $configuration,
                'link' => $context->link,
                'products' => $_products,
                'cols'  => $cols,
                'cols_md'   => $cols_arr[0],
                'cols_sm'   => $cols_arr[1],
                'cols_xs'   => $cols_arr[2],
                'navigation' => $obj[4]->value,
                'pagination' => $obj[5]->value,
                'autoplay' => $obj[6]->value,
                'rewind' => $obj[7]->value,
                'slidebypage' => $obj[8]->value,
                'showviewall' => $obj[0]->value,
                'viewall_text' => $obj[1]->value->$id_lang
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addonhotdeal.tpl");
        echo $html;
        exit;
    }
    public function ajaxProcessGetSectionList()
    {
        $context = Context::getContext();
        $params = [
            'type' => 'section',
        ];
        $studio = new gdzPageBuilderHelper();
        $sections = $studio->request($params);
        $context->smarty->assign(
            array(
                'sections' => $sections
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/admin/section-list.tpl");
        echo $html;
    }
    public function ajaxProcessGetPageList()
    {
        $context = Context::getContext();
        $params = [
            'type' => 'page',
        ];
        $studio = new gdzPageBuilderHelper();
        $pages = $studio->request($params);
        $context->smarty->assign(
            array(
                'pages' => $pages
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/admin/page-list.tpl");
        echo $html;
    }
}
