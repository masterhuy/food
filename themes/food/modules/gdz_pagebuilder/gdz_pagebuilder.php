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
define('_GDZ_PB_NAME_', 'gdz_pagebuilder');
//define('_GDZ_PB_PROADDONS_', array('banner', 'service', 'video', 'sliderlayer', 'blog' ,'testimonial', 'popup', 'map', 'menu', 'producttab', 'categoryproduct', 'categorytab', 'countdown', 'bannercountdown', 'instagram', 'hotdeal', 'flashsale'));
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzHelper.php');
if (Module::isInstalled('gdz_themesetting')) {
  include_once(_PS_MODULE_DIR_.'gdz_themesetting/gdz_themesetting.php');
}
class gdz_pagebuilder extends Module
{
    public function __construct()
    {
        $this->name = _GDZ_PB_NAME_;
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Godzilla';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->id_homepage = Configuration::get('JPB_HOMEPAGE');
        parent::__construct();
        $this->displayName = $this->trans('Godzilla Pagebuilder', array(), 'Modules.gdzPageBuilder');
        $this->description = $this->l('Page Builder For Prestashop.');
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
        $this->secure_key = Tools::encrypt($this->name);
    }

    public function install()
    {
        if (parent::install() && $this->registerHook('moduleRoutes') && $this->registerHook('header') && $this->registerHook('displayBackOfficeHeader') && $this->registerHook('displayHome') && $this->registerHook('displayTop') && $this->registerHook('filterCmsContent') && $this->installSamples()) {
            $res = true;
            $res &= Configuration::updateValue('JPB_RTL', '0');
            $res &= Configuration::updateValue('JPB_CONVERTURL', 0);

            $tab_parent_id = (int)Tab::getIdFromClassName('GODZILLA');
            if($tab_parent_id <= 0) {
                $tab = new Tab();
                $tab->id_parent = 0;
                $tab->active = 1;
                $tab->class_name = "GODZILLA";
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'GODZILLA';
                }
                if(!$tab->add()) return false;
            }
            if(((int)Tab::getIdFromClassName('GODZILLA') > 0) && ((int)Tab::getIdFromClassName('AdminGdzpagebuilderDashboard') <= 0)) {
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzpagebuilderDashboard";
                $tab->position = 3;
                $tab->icon = 'description';
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Page Builder';
                }
                $tab->id_parent = (int)Tab::getIdFromClassName('GODZILLA');
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                //add pages menu
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzpagebuilderPages";
                $tab->position = 0;
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Pages';
                }
                $tab->id_parent = (int)Tab::getIdFromClassName('AdminGdzpagebuilderDashboard');
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                //add setting menu
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzpagebuilderSetting";
                $tab->position = 1;
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Setting';
                }
                $tab->id_parent = (int)Tab::getIdFromClassName('AdminGdzpagebuilderDashboard');
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                //add media menu
                $tab = new Tab();
                $tab->active = 0;
                $tab->class_name = "AdminGdzpagebuilderMedia";
                $tab->position = 2;
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Media';
                }
                $tab->id_parent = (int)Tab::getIdFromClassName('AdminGdzpagebuilderDashboard');
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                //add editor controller
                $tab = new Tab();
                $tab->active = 0;
                $tab->class_name = "gdzPagebuilderEditor";
                $tab->position = 3;
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Pagebuilder Editor';
                }
                $tab->id_parent = (int)Tab::getIdFromClassName('AdminGdzpagebuilderDashboard');
                $tab->module = $this->name;
                if(!$tab->add()) return false;
            }

            return $res;
        }
        return false;
    }
    public function installSamples()
    {
        $query = '';
        require_once( dirname(__FILE__).'/install/install.sql.php' );
        $return = true;
        if (isset($query) && !empty($query)) {
            if (!(Db::getInstance()->ExecuteS("SHOW TABLES LIKE '"._DB_PREFIX_."gdz_pagebuilder'"))) {
                $query = str_replace('_DB_PREFIX_', _DB_PREFIX_, $query);
                $query = str_replace('_MYSQL_ENGINE_', _MYSQL_ENGINE_, $query);
                $db_data_settings = preg_split("/;\s*[\r\n]+/", $query);
                foreach ($db_data_settings as $query) {
                    $query = trim($query);
                    if (!empty($query)) {
                        if (!Db::getInstance()->Execute($query)) {
                            $return = false;
                        }
                    }
                }
            }
        } else {
            $return = false;
        }
        return $return;
    }
    public function uninstall()
    {
        /* Deletes Module */
        if (parent::uninstall()) {
            $res = true;
            $res &= Configuration::deleteByName('JPB_RTL');
            $res &= Configuration::deleteByName('JPB_CONVERTURL');
            $res &= Configuration::deleteByName('JPB_HOMEPAGE');
            $sql = array();
            include(dirname(__FILE__).'/install/uninstall.php');
            foreach ($sql as $s) {
                Db::getInstance()->execute($s);
            }
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzpagebuilderDashboard');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzpagebuilderPages');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzpagebuilderSetting');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzpagebuilderMedia');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            $id_tab = (int)Tab::getIdFromClassName('gdzPagebuilderEditor');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            return $res;
        }
        return false;
    }

    public function getCurrentPage($id = 0)
    {
        $id_shop = $this->context->shop->id;
        if ($id) {
            $page_id = $id;
        } elseif (Tools::getValue('id_page')) {
            $page_id = Tools::getValue('id_page');
        } else {
            $page_id = Configuration::get('JPB_HOMEPAGE');
        }
        if((int)$page_id == 0) return;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT ph.* FROM '._DB_PREFIX_.'gdz_pagebuilder_pages ph LEFT JOIN '._DB_PREFIX_.'gdz_pagebuilder p ON ph.`id_page` = p.`id_page` WHERE ph.`id_page` = '.$page_id);
    }

    public function hookDisplayBackOfficeHeader()
    {
        if ($this->context->controller->controller_name == 'AdminCmsContent') {
            $this->context->controller->addJS($this->_path . 'views/js/cmsadd.js');
            global $kernel;
            $request = $kernel->getContainer()->get('request_stack')->getCurrentRequest();
            if (!isset($request->attributes)) {
                return;
            }
            $idPage = (int) $request->attributes->get('cmsPageId');
            $pages = gdzPageBuilderHelper::getPages('1');
            $this->smarty->assign(array(
                'pages' => $pages,
            ));
            return $this->fetch(_PS_MODULE_DIR_ .'/'. $this->name . '/views/templates/hook/pagebuilder_cmsbutton.tpl');
        }
    }
    public function getPageBody($id) {
        $page = $this->getCurrentPage($id);
        if (!$page) return '';
        $params = $page['params'];
        $page_result = gdzPageBuilderHelper::genRows($params);
        $this->context->controller->registerStylesheet('gdzpb-base-css', 'modules/'.$this->name.'/views/css/base.css', ['media' => 'all', 'priority' => 2]);
        $this->smarty->assign(array(
            'pagebuilder_css' => $page_result['css'],
            'rows' => $page_result['rows'],
            'root_url' => $this->root_url
        ));
         return $this->display(__FILE__, 'gdz_pagebuilder_body.tpl');
    }
    public function hookFilterCmsContent($a)
    {
        $match = array();
        $pattern = '/\[gdz_pagebuilder\s+page_id=(\d+)]/';
        if (preg_match_all($pattern, $a['object']['content'], $match)) {
            $this->hookDisplayHeader();
            $gdz_themesettingInstance = Module::getInstanceByName('gdz_themesetting');
            $gdz_themesettingInstance->hookDisplayHeader();
            $this->context->smarty->assign('configuration', $this->getTemplateVarConfiguration());
            foreach ($match[0] as $key => $fullmatch) {
                $a['object']['content'] = str_replace($fullmatch, $this->getPageBody($match[1][$key]), $a['object']['content']);
            }
        }
        return $a;
    }
    public function getTemplateVarConfiguration()
    {
        $quantity_discount_price = Configuration::get('PS_DISPLAY_DISCOUNT_PRICE');

        return array(
            'display_prices_tax_incl' => (bool) (new TaxConfiguration())->includeTaxes(),
            'taxes_enabled' => (bool) Configuration::get('PS_TAX'),
            'low_quantity_threshold' => (int) Configuration::get('PS_LAST_QTIES'),
            'is_b2b' => (bool) Configuration::get('PS_B2B_ENABLE'),
            'is_catalog' => (bool) Configuration::isCatalogMode(),
            'show_prices' => (bool) Configuration::showPrices(),
            'opt_in' => array(
                'partner' => (bool) Configuration::get('PS_CUSTOMER_OPTIN'),
            ),
            'return_enabled' => (int) Configuration::get('PS_ORDER_RETURN'),
            'number_of_days_for_return' => (int) Configuration::get('PS_ORDER_RETURN_NB_DAYS'),
        );
    }

    public function hookDisplayHeader()
    {
        if ($this->context->cookie->jpb_homepage != '') {
            $jpb_homepage = $this->context->cookie->jpb_homepage;
        } else {
            $jpb_homepage = Configuration::get('JPB_HOMEPAGE');
        }
        if ($this->context->cookie->jpb_rtl != '') {
            $jpb_rtl = $this->context->cookie->jpb_rtl;
        } else {
            $jpb_rtl = Configuration::get('JPB_RTL');
        }
        $page = $this->getCurrentPage();
        $this->context->controller->addCSS(array(
          _MODULE_DIR_.$this->name.'/lib/owl-carousel/owl.carousel.css',
          _MODULE_DIR_.$this->name.'/views/css/animate.css',
          _MODULE_DIR_.$this->name.'/views/css/base.css',
          _MODULE_DIR_.'/gdz_themesetting/views/css/custom.css'
        ));
        $this->context->controller->addJS(array(
            _MODULE_DIR_.$this->name.'/lib/jquery.plugin.js',
            _MODULE_DIR_.$this->name.'/lib/jquery.countdown.js',
            _MODULE_DIR_.$this->name.'/lib/owl-carousel/owl.carousel.min.js',
            _MODULE_DIR_.$this->name.'/views/js/base.js'
        ));
        $this->context->controller->addJqueryPlugin('fancybox');

        if ($page['css_file']) {
            $this->context->controller->registerStylesheet('gdzpb-home-css', '/assets/css/'.$page['css_file'], ['media' => 'all', 'priority' => 1000]);
        }
        if ($page['js_file']) {
            $this->context->controller->registerJavascript('gdzpb-home-js', '/assets/js/'.$page['js_file'], ['position' => 'bottom', 'priority' => 200]);
        }
        if ((int)$jpb_rtl || $this->context->language->is_rtl) {
            $this->context->controller->registerStylesheet('gdzpb-home-rtl', '/assets/css/rtl.css', ['media' => 'all', 'priority' => 1000]);
			      $this->context->controller->registerStylesheet('gdzpb-rtl-page', '/assets/css/rtl-'.$page['css_file'], ['media' => 'all', 'priority' => 1000]);
        }
        $this->context->smarty->assign('themename', _THEME_NAME_);
        $this->context->smarty->assign('jpb_homepage', $jpb_homepage);
        $this->context->smarty->assign('jpb_pageclass', $page['page_class']);
        $this->context->smarty->assign('jpb_rtl', $jpb_rtl);
    }
    public function hookdisplayHome()
    {
        if ((int)$this->id_homepage == 0) {
            return "You must select homepage!";
        }
        $homepage = $this->getCurrentPage();
        $params = $homepage['params'];
        $page_result = gdzPageBuilderHelper::genRows($params);
        $this->context->controller->registerStylesheet('gdzpb-base-css', 'modules/'.$this->name.'/views/css/base.css', ['media' => 'all', 'priority' => 2]);
        $this->smarty->assign(array(
            'rows' => $page_result['rows'],
            'pagebuilder_css' => $page_result['css'],
            'root_url' => $this->root_url
        ));
        return $this->display(__FILE__, 'gdz_pagebuilder_body.tpl');
    }
    public function hookModuleRoutes($params)
    {
        $html = '';
        return array(
            'gdz_pagebuilder-page' => array(
                'controller' => 'page',
                'rule' => 'page/{id_page}-{slug}',
                'keywords' => array(
                    'id_page' => array('regexp' => '[0-9]+', 'param' => 'id_page'),
                    'slug' =>   array('regexp' => '[_a-zA-Z0-9\x{0600}-\x{06FF}\pL\pS-]*'),
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'gdz_pagebuilder'
                )
            ),
            'gdz_pagebuilder-preview' => array(
                'controller' => 'preview',
                'rule' => 'page/{id_page}-{slug}',
                'keywords' => array(
                    'id_page' => array('regexp' => '[0-9]+', 'param' => 'id_page'),
                    'slug' =>   array('regexp' => '[_a-zA-Z0-9\x{0600}-\x{06FF}\pL\pS-]*'),
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'gdz_pagebuilder'
                )
            )
        );
    }
    public static function getgdzPagebuildergUrl()
    {
        $ssl_enable = Configuration::get('PS_SSL_ENABLED');
        $id_shop = (int)Context::getContext()->shop->id;
        //$rewrite_set = 1;
        $relative_protocol = false;
        $ssl = null;
        static $force_ssl = null;
        if ($ssl === null) {
            if ($force_ssl === null) {
                $force_ssl = (Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE'));
            }
            $ssl = $force_ssl;
        }
        if (1 && $id_shop !== null) {
            $shop = new Shop($id_shop);
        } else {
            $shop = Context::getContext()->shop;
        }
        if (!$relative_protocol) {
            $base = '//'.($ssl && $ssl_enable ? $shop->domain_ssl : $shop->domain);
        } else {
            $base = (($ssl && $ssl_enable) ? 'https://'.$shop->domain_ssl : 'http://'.$shop->domain);
        }
        return $base.$shop->getBaseURI();
    }
    public static function getPageLink($rewrite = 'gdz_pagebuilder', $params = null, $id_lang = null)
    {
        $url = gdz_pagebuilder::getgdzPagebuildergUrl();

        $dispatcher = Dispatcher::getInstance();
        if ($params != null) {
            return $url.$dispatcher->createUrl($rewrite, $id_lang, $params);
        } else {
            return $url.$dispatcher->createUrl($rewrite);
        }
    }
}
