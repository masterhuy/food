<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Pagebuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/
if (Module::isInstalled('gdz_themesetting')) {
    include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/settings.php';
}
class gdzPageBuilderHelper extends Module
{
    public function __construct()
    {
        $this->name = _GDZ_PB_NAME_;
        parent::__construct();
        $this->studio_url = 'http://localhost/prestashop17/befer2/index.php?fc=module&module=gdz_studio&controller=api';
    }

    public static function execModule($hook_name, $hook_args = array(), $id_module = null, $id_shop = null)
    {
        // Check arguments validity
        if (!Validate::isHookName($hook_name)) {
            throw new PrestaShopException('Invalid id_module or hook_name');
        }

        // Check if hook exists
        if (!$id_hook = Hook::getIdByName($hook_name)) {
            return false;
        }

        // Store list of executed hooks on this page
        Hook::$executed_hooks[$id_hook] = $hook_name;
        $context = Context::getContext();
        if (!isset($hook_args['cookie']) || !$hook_args['cookie']) {
            $hook_args['cookie'] = $context->cookie;
        }
        if (!isset($hook_args['cart']) || !$hook_args['cart']) {
            $hook_args['cart'] = $context->cart;
        }
        $retro_hook_name = Hook::getRetroHookName($hook_name);

        $altern = 0;
        $output = '';

        $different_shop = false;

        if ($id_shop !== null && Validate::isUnsignedId($id_shop) && $id_shop != $context->shop->getContextShopID()) {
            $old_context = $context->shop->getContext();
            $old_shop = clone $context->shop;
            $shop = new Shop((int)$id_shop);
            if (Validate::isLoadedObject($shop)) {
                $context->shop = $shop;
                $context->shop->setContext(Shop::CONTEXT_SHOP, $shop->id);
                $different_shop = true;
            }
        }

        if (!($moduleInstance = Module::getInstanceByName($id_module))) {
            return false;
        }

        // Check which / if method is callable
        $hook_callable = is_callable(array($moduleInstance, 'hook'.$hook_name));
        $hook_retro_callable = is_callable(array($moduleInstance, 'hook'.$retro_hook_name));
        if ($hook_callable || $hook_retro_callable) {
            $hook_args['altern'] = ++$altern;
            // Call hook method
            if ($hook_callable) {
                $display = Hook::coreCallHook($moduleInstance, 'hook'.$hook_name, $hook_args);
            } elseif ($hook_retro_callable) {
                $display = Hook::coreCallHook($moduleInstance, 'hook'.$retro_hook_name, $hook_args);
            } else {
                return false;
            }

            $output .= $display;

        } elseif (Hook::isDisplayHookName($hook_name)) {
            if ($moduleInstance instanceof PrestaShop\PrestaShop\Core\Module\WidgetInterface) {
                try {
                    $display = Hook::coreRenderWidget($moduleInstance, $hook_name, $hook_args);
                } catch (Exception $e) {
                    $display = '';
                }
                $output .= $display;
            }
        }

        if ($different_shop) {
            $context->shop = $old_shop;
            $context->shop->setContext($old_context, $shop->id);
        }

        return $output;
    }
    public static function decodeHTML($str)
    {
        $str = str_replace(htmlentities("_GDZQUOTE_"), '"', $str);
        $str = str_replace(htmlentities("_GDZQUOTE2_"), "'", $str);
        $str = str_replace(htmlentities("_GDZSLASH_"), "\\", $str);
        $str = str_replace(htmlentities("_GDZLB_"), "\n", $str);
        $str = str_replace(htmlentities("_GDZRN_"), "\r", $str);
        $str = str_replace(htmlentities("_GDZTAB_"), "\t", $str);
        return $str;
    }
    public static function getVideoSrc($src_url)
    {
        $video_url = parse_url($src_url);
        switch($video_url['host']) {
            case 'youtu.be':
                $id = trim($video_url['path'], '/');
                $src = '//www.youtube.com/embed/' . $id;
                break;

            case 'www.youtube.com':
            case 'youtube.com':
                parse_str($video_url['query'], $query);
                $id = $query['v'];
                $src = '//www.youtube.com/embed/' . $id;
                break;

            case 'vimeo.com':
            case 'www.vimeo.com':
                $id = trim($video_url['path'], '/');
                $src = "//player.vimeo.com/video/{$id}";
        }
        return $src;
    }
    public static function returnBytes($val)
    {
        $val = trim($val);
        $last = Tools::strtolower($val[Tools::strlen($val)-1]);
        $_val = Tools::substr($val, 0, Tools::strlen($val)-1);
        if ($last == 'g') {
             $result = $_val*1024*1024*1024;
        }
        if ($last == 'm') {
             $result = $_val*1024*1024;
        }
        if ($last == 'k') {
             $result = $_val*1024;
        }
        return $result;
    }
    public static function getAddonDesc($addonname, $findex)
    {
        $addonfile = 'addon'.addonname.'.php';
        $addonclass = 'gdzAddon'.Tools::ucfirst($addonname);
        if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
            require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
        }
        $addon_instance = new $addonclass();
        return $addon_instance->getDesc($findex);
    }


    public static function getFilePermission($file)
    {
        $length = Tools::strlen(decoct(fileperms($file)))-3;
        return Tools::substr(decoct(fileperms($file)), $length);
    }
    public static function hasSubDir($dir)
    {
        if (!is_readable($dir)) {
            return false;
        }
        $items = scandir($dir);
        if (count($items) <= 0) {
            return false;
        }
        foreach ($items as $item) {
            if (is_dir($dir.'/'.$item) && $item != '.' && $item != '..') {
                return true;
            }
        }
    }
    public static function getPages($active = '')
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $id_shop = $context->shop->id;
        $query = "SELECT pbp.id_page, pbpl.title, pbp.active
                  FROM "._DB_PREFIX_."gdz_pagebuilder_pages pbp
                  INNER JOIN "._DB_PREFIX_."gdz_pagebuilder_pages_lang pbpl ON pbp.id_page = pbpl.id_page
                  INNER JOIN "._DB_PREFIX_."gdz_pagebuilder pb ON pbp.id_page = pb.id_page
                  WHERE pbpl.id_lang = '".$id_lang."' AND pb.id_shop = '".$id_shop."'" ;
        if ($active != '') {
            $query .= " AND active = '".$active."'";
        }
        $query .= " ORDER BY pbp.ordering";
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
    }
    public static function getRootUrl()
    {
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
        if (isset($force_ssl) && $force_ssl) {
            $root_url = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            $root_url = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        return $root_url;
    }
    public static function getNbOfSales($id_product)
    {
        $res = Db::getInstance()->getRow('
            SELECT quantity FROM `'._DB_PREFIX_.'product_sale`
            WHERE `id_product` = '.(int)$id_product);
            return $res['quantity'];
    }
	  public static function getFiles($_folder, $_prefix)
    {
		$folder_path = _PS_ROOT_DIR_.'/themes/'._THEME_NAME_.'/'.$_folder;

        $ffs = scandir($folder_path);
		$result = array();
		foreach($ffs as $ff){
			if(!is_dir($folder_path.'/'.$ff) && $ff != '.' && $ff != '..' && (strpos($ff, $_prefix) === 0)) {
				$result[]['file'] = $ff;
			}
		}
		return $result;
    }
    public static function getModules()
    {
      $not_module = array('ps_mainmenu', 'ps_checkpayment', 'ps_currencyselector', 'ps_searchbar',
          'ps_facetedsearch', 'ps_languageselector', 'ps_shoppingcart', 'ps_customersignin',
          'pscleaner', 'revsliderprestashop', 'sekeywords','sendtoafriend', 'slidetopcontent', 'themeconfigurator', 'themeinstallator', 'trackingfront', 'watermark', 'videostab', 'yotpo', 'blocklayered', 'blocklayered_mod',
          'additionalproductstabs', 'addthisplugin', 'autoupgrade','sendtoafriend', 'bankwire', 'blockcart', 'blockcurrencies', 'blockcustomerprivacy', 'blocklanguages', 'blocksearch', 'blocksearch_mod', 'blocksharefb', 'blocktopmenu',
          'blockuserinfo', 'blockmyaccountfooter', 'carriercompare', 'cashondelivery','cheque', 'cookielaw', 'cronjobs', 'themeinstallator', 'crossselling', 'crossselling_mod', 'customcontactpage', 'dashactivity', 'dashgoals', 'dashproducts',
          'dashtrends', 'dateofdelivery', 'feeder','followup', 'gamification', 'ganalytics', 'gapi', 'graphnvd3', 'gridhtml', 'gsitemap', 'headerlinks',  'loyalty', 'mailalerts', 'manufacturertab', 'newsletter', 'onboarding', 'pagesnotfound', 'paypal', 'productcomments', 'productscategory',
          'productsmanufacturer', 'productsnavpn', 'producttooltip','referralprogram', 'statsbestcategories', 'statsbestcustomers', 'statsbestmanufacturers', 'statsbestproducts', 'statsbestsuppliers', 'statsbestvouchers', 'statscarrier', 'statscatalog', 'statscheckup',
          'statsdata', 'statsequipment', 'statsforecast','statslive', 'statsnewsletter', 'statsorigin', 'statspersonalinfos', 'statsproduct', 'statsregistrations', 'statssales', 'statssalesqty', 'statssearch', 'statsstock',
          'statsvisits', 'themeconfigurator', 'uecookie', 'blockwishlist', 'productpaymentlogos', 'gdz_pagebuilder', 'gdz_blog', 'gdz_facebookconnect', 'gdz_slider', 'gdz_productvideo','gdz_producttab','gdz_themesetting');
        $where = '';
        if (count($not_module) == 1) {
            $where = ' WHERE m.`name` <> \''.$not_module[0].'\'';
        } elseif (count($not_module) > 1) {
            $where = ' WHERE m.`name` NOT IN (\''.implode("','", $not_module).'\')';
        }
        $context = Context::getContext();
        $id_shop = $context->shop->id;
        $sql = 'SELECT m.name, m.id_module
                FROM `'._DB_PREFIX_.'module` m
                JOIN `'._DB_PREFIX_.'module_shop` ms ON (m.`id_module` = ms.`id_module` AND ms.`id_shop` = '.(int)$id_shop.')
                '.$where;
        $module_list = Db::getInstance()->ExecuteS($sql);
        $modules = array();
        foreach ($module_list as $m) {
            $iso = Tools::substr(Context::getContext()->language->iso_code, 0, 2);
            // Check if config.xml module file exists and if it's not outdated
            if ($iso == 'en') {
                $config_file = _PS_MODULE_DIR_ . $m['name'] . '/config.xml';
            } else {
                $config_file = _PS_MODULE_DIR_ . $m['name'] . '/config_' . $iso . '.xml';
            }
            if(file_exists($config_file)) {
              $xml_module = @simplexml_load_file($config_file);
              $m['short_desc'] = Tools::stripslashes(Translate::getModuleTranslation((string) $xml_module->name, Module::configXmlStringFormat($xml_module->description), (string) $xml_module->name));
              $m['short_desc'] = Tools::substr($m['short_desc'], 0, 40);
              $modules[] = $m;
            }
        }
        return $modules;
    }
    public static function getModuleNames()
    {
        $modules = gdzPageBuilderHelper::getModules();
        $modnames = array();
        foreach($modules as $_module) {
            $modnames[] = $_module['name'];
        }
        return $modnames;
    }
    public static function getAddonsList()
    {
        $addon_folder = _PS_ROOT_DIR_.'/modules/'._GDZ_PB_NAME_.'/addons';
        $ffs = scandir($addon_folder);
        $addons = array();
        $i = 0;
        foreach ($ffs as $ff) {
            $ext = pathinfo($ff, PATHINFO_EXTENSION);
            if (!is_dir($addon_folder.'/'.$ff) && ($ext == 'php') && !in_array($ff, array('index.php','addonbase.php'))) {
                $addons[$i] = Tools::substr($ff, 5, Tools::strlen($ff) - 9);
                $i++;
            }
        }
        return $addons;
    }
    public static function getSettingsDefaultValue( $attrs = array() ) {
  		  $default = array();
    		if ( !is_array($attrs) ){
    			return array( 'default' => $default );
    		}

    		foreach ( $attrs as $options ) {
          foreach ( $options['content'] as $opkey => $option ) {
            if ( isset( $option['default'] ) ) {
              $default[$opkey] = $option['default'];
            } else {
              $default[$opkey] = '';
            }
          }
        }
        return $default;
  	}
    public static function parseStyleItem($type = 'row', $item)
    {
        $settings = $item->settings;
        if($type == 'row') {
            $item_css = "#$item->id {";
            if(isset($settings->text_color) && $settings->text_color) {
                $item_css .= "color:$settings->text_color;";
            }
            if(isset($settings->background_color) && $settings->background_color) {
                $item_css .= "background-color:$settings->background_color;";
            }
            if($settings->background_img) {
                $item_css .= 'background-image:url('.$settings->background_img.');';
            }
            if($settings->background_size) {
                $item_css .= "background-size:$settings->background_size;";
            }
            if($settings->background_repeat) {
                $item_css .= "background-repeat:$settings->background_repeat;";
            }
            if($settings->background_position) {
                $item_css .= "background-position:$settings->background_position;";
            }
            if($settings->background_attachment) {
                $item_css .= "background-attachment:$settings->background_attachment;";
            }
            if($settings->animation_duration) {
                $item_css .= "animation-duration:$settings->animation_duration"."ms;";
            }
            if($settings->animation_delay) {
                $item_css .= "animation-delay:$settings->animation_delay"."ms;";
            }
            if(isset($settings->md_padding_top) && $settings->md_padding_top) {
                $item_css .= "padding-top:$settings->md_padding_top"."px;";
            }
            if(isset($settings->md_padding_right) && $settings->md_padding_right) {
                $item_css .= "padding-right:$settings->md_padding_right"."px;";
            }
            if(isset($settings->md_padding_bottom) && $settings->md_padding_bottom) {
                $item_css .= "padding-bottom:$settings->md_padding_bottom"."px;";
            }
            if(isset($settings->md_padding_left) && $settings->md_padding_left) {
                $item_css .= "padding-left:$settings->md_padding_left"."px;";
            }
            if(isset($settings->md_margin_top) && $settings->md_margin_top) {
                $item_css .= "margin-top:$settings->md_margin_top"."px;";
            }
            if(isset($settings->md_margin_right) && $settings->md_margin_right) {
                $item_css .= "margin-right:$settings->md_margin_right"."px;";
            }
            if(isset($settings->md_margin_bottom) && $settings->md_margin_bottom) {
                $item_css .= "margin-bottom:$settings->md_margin_bottom"."px;";
            }
            if(isset($settings->md_margin_left) && $settings->md_margin_left) {
                $item_css .= "margin-left:$settings->md_margin_left"."px;";
            }
            $item_css .= "}";
            $item_css .= " @media (max-width:991px) { #$item->id {";
            if(isset($settings->sm_padding_top) && $settings->sm_padding_top) {
                  $item_css .= "padding-top:$settings->sm_padding_top"."px;";
            }
            if(isset($settings->sm_padding_right) && $settings->sm_padding_right) {
                  $item_css .= "padding-right:$settings->sm_padding_right"."px;";
            }
            if(isset($settings->sm_padding_bottom) && $settings->sm_padding_bottom) {
                  $item_css .= "padding-bottom:$settings->sm_padding_bottom"."px;";
            }
            if(isset($settings->sm_padding_left) && $settings->sm_padding_left) {
                  $item_css .= "padding-left:$settings->sm_padding_left"."px;";
            }
            if(isset($settings->sm_margin_top) && $settings->sm_margin_top) {
                  $item_css .= "margin-top:$settings->sm_margin_top"."px;";
            }
            if(isset($settings->sm_margin_right) && $settings->sm_margin_right) {
                  $item_css .= "margin-right:$settings->sm_margin_right"."px;";
            }
            if(isset($settings->sm_margin_bottom) && $settings->sm_margin_bottom) {
                  $item_css .= "margin-bottom:$settings->sm_margin_bottom"."px;";
            }
            if(isset($settings->sm_margin_left) && $settings->sm_margin_left) {
                  $item_css .= "margin-left:$settings->sm_margin_left"."px;";
            }
            $item_css .= " }}";
            $item_css .= " @media (max-width:575px) { #$item->id {";
            if(isset($settings->xs_padding_top) && $settings->xs_padding_top) {
                  $item_css .= "padding-top:$settings->xs_padding_top"."px;";
            }
            if(isset($settings->xs_padding_right) && $settings->xs_padding_right) {
                  $item_css .= "padding-right:$settings->xs_padding_right"."px;";
            }
            if(isset($settings->xs_padding_bottom) && $settings->xs_padding_bottom) {
                  $item_css .= "padding-bottom:$settings->xs_padding_bottom"."px;";
            }
            if(isset($settings->xs_padding_left) && $settings->xs_padding_left) {
                  $item_css .= "padding-left:$settings->xs_padding_left"."px;";
            }
            if(isset($settings->xs_margin_top) && $settings->xs_margin_top) {
                  $item_css .= "margin-top:$settings->xs_margin_top"."px;";
            }
            if(isset($settings->xs_margin_right) && $settings->xs_margin_right) {
                  $item_css .= "margin-right:$settings->xs_margin_right"."px;";
            }
            if(isset($settings->xs_margin_bottom) && $settings->xs_margin_bottom) {
                  $item_css .= "margin-bottom:$settings->xs_margin_bottom"."px;";
            }
            if(isset($settings->xs_margin_left) && $settings->xs_margin_left) {
                  $item_css .= "margin-left:$settings->xs_margin_left"."px;";
            }
            $item_css .= " }}";
        } elseif($type == 'column') {
            $item_css = "#$item->id{";
            if(isset($settings->text_color) && $settings->text_color) {
                $item_css .= "color:$settings->text_color;";
            }
            if(isset($settings->background_color) && $settings->background_color) {
                $item_css .= "background-color:$settings->background_color;";
            }
            if($settings->background_img) {
                $item_css .= 'background-image:url('.$settings->background_img.');';
            }
            if($settings->background_size) {
                $item_css .= "background-size:$settings->background_size;";
            }
            if($settings->background_repeat) {
                $item_css .= "background-repeat:$settings->background_repeat;";
            }
            if($settings->background_position) {
                $item_css .= "background-position:$settings->background_position;";
            }
            if($settings->background_attachment) {
                $item_css .= "background-attachment:$settings->background_attachment;";
            }
            if($settings->animation_duration) {
                $item_css .= "animation-duration:$settings->animation_duration"."ms;";
            }
            if($settings->animation_delay) {
                $item_css .= "animation-delay:$settings->animation_delay"."ms;";
            }
            if(isset($settings->md_padding_top) && $settings->md_padding_top) {
                $item_css .= "padding-top:$settings->md_padding_top"."px;";
            }
            if(isset($settings->md_padding_right) && $settings->md_padding_right) {
                $item_css .= "padding-right:$settings->md_padding_right"."px;";
            }
            if(isset($settings->md_padding_bottom) && $settings->md_padding_bottom) {
                $item_css .= "padding-bottom:$settings->md_padding_bottom"."px;";
            }
            if(isset($settings->md_padding_left) && $settings->md_padding_left) {
                $item_css .= "padding-left:$settings->md_padding_left"."px;";
            }
            if(isset($settings->md_margin_top) && $settings->md_margin_top) {
                $item_css .= "margin-top:$settings->md_margin_top"."px;";
            }
            if(isset($settings->md_margin_right) && $settings->md_margin_right) {
                $item_css .= "margin-right:$settings->md_margin_right"."px;";
            }
            if(isset($settings->md_margin_bottom) && $settings->md_margin_bottom) {
                $item_css .= "margin-bottom:$settings->md_margin_bottom"."px;";
            }
            if(isset($settings->md_margin_left) && $settings->md_margin_left) {
                $item_css .= "margin-left:$settings->md_margin_left"."px;";
            }
            $item_css .= "}";
            $item_css .= " @media (max-width:991px) { #$item->id {";
            if(isset($settings->sm_padding_top) && $settings->sm_padding_top) {
                  $item_css .= "padding-top:$settings->sm_padding_top"."px;";
            }
            if(isset($settings->sm_padding_right) && $settings->sm_padding_right) {
                  $item_css .= "padding-right:$settings->sm_padding_right"."px;";
            }
            if(isset($settings->sm_padding_bottom) && $settings->sm_padding_bottom) {
                  $item_css .= "padding-bottom:$settings->sm_padding_bottom"."px;";
            }
            if(isset($settings->sm_padding_left) && $settings->sm_padding_left) {
                  $item_css .= "padding-left:$settings->sm_padding_left"."px;";
            }
            if(isset($settings->sm_margin_top) && $settings->sm_margin_top) {
                  $item_css .= "margin-top:$settings->sm_margin_top"."px;";
            }
            if(isset($settings->sm_margin_right) && $settings->sm_margin_right) {
                  $item_css .= "margin-right:$settings->sm_margin_right"."px;";
            }
            if(isset($settings->sm_margin_bottom) && $settings->sm_margin_bottom) {
                  $item_css .= "margin-bottom:$settings->sm_margin_bottom"."px;";
            }
            if(isset($settings->sm_margin_left) && $settings->sm_margin_left) {
                  $item_css .= "margin-left:$settings->sm_margin_left"."px;";
            }
            $item_css .= " }}";
            $item_css .= " @media (max-width:575px) { #$item->id {";
            if(isset($settings->xs_padding_top) && $settings->xs_padding_top) {
                  $item_css .= "padding-top:$settings->xs_padding_top"."px;";
            }
            if(isset($settings->xs_padding_right) && $settings->xs_padding_right) {
                  $item_css .= "padding-right:$settings->xs_padding_right"."px;";
            }
            if(isset($settings->xs_padding_bottom) && $settings->xs_padding_bottom) {
                  $item_css .= "padding-bottom:$settings->xs_padding_bottom"."px;";
            }
            if(isset($settings->xs_padding_left) && $settings->xs_padding_left) {
                  $item_css .= "padding-left:$settings->xs_padding_left"."px;";
            }
            if(isset($settings->xs_margin_top) && $settings->xs_margin_top) {
                  $item_css .= "margin-top:$settings->xs_margin_top"."px;";
            }
            if(isset($settings->xs_margin_right) && $settings->xs_margin_right) {
                  $item_css .= "margin-right:$settings->xs_margin_right"."px;";
            }
            if(isset($settings->xs_margin_bottom) && $settings->xs_margin_bottom) {
                  $item_css .= "margin-bottom:$settings->xs_margin_bottom"."px;";
            }
            if(isset($settings->xs_margin_left) && $settings->xs_margin_left) {
                  $item_css .= "margin-left:$settings->xs_margin_left"."px;";
            }
            $item_css .= " }}";
        } elseif($item->type == 'spacer') {
            $res_arr = array();
            if($item->fields[0]->value) {
                $res_arr = explode('-', $item->fields[0]->value);
            }
            $item_css = "";
            if($res_arr[0]) {
                $item_css .= " #$item->id .pb-spacer-inner{ height:$res_arr[0]px;}";
            }
            if($res_arr[1]) {
                $item_css .= " @media (max-width:991px) { #$item->id .pb-spacer-inner{ height:$res_arr[1]px;} }";
            }
            if($res_arr[2]) {
                $item_css .= " @media (max-width:575px) { #$item->id .pb-spacer-inner{ height:$res_arr[2]px;} }";
            }
        } elseif($item->type == 'divider') {
            $item_css = "#$item->id .pb-divider{";
            $item_css .= "padding-top:".$item->fields[0]->value."px;";
            $item_css .= "padding-bottom:".$item->fields[0]->value."px;";
            $item_css .= "text-align:".$item->fields[5]->value.";";
            $item_css .= "}";
            $item_css .= "#$item->id .pb-divider-separator{";
            $item_css .= "border-top-style:". $item->fields[1]->value .";";
            $item_css .= "border-top-width:". $item->fields[3]->value ."px;";
            $item_css .= "width:". $item->fields[4]->value ."%;";
            $item_css .= "border-top-color:". $item->fields[2]->value .";";
            $item_css .= "}";
        } elseif($item->type == 'service') {
            //print_r($item->fields[12]->value); exit;
            $item_css = "#$item->id .pb-service-box {";
            $item_css .= "text-align:".$item->fields[12]->value.";";
            $item_css .= "}";
            $item_css .= "#$item->id .pb-service-icon i{";
            $item_css .= "font-size:".$item->fields[2]->value."px;";
            $item_css .= "}";
            $item_css .= "#$item->id .pb-service-icon img{";
            $item_css .= "width:".$item->fields[5]->value."%;";
            $item_css .= "}";
        } elseif($item->type == 'icon') {
            $item_css = "#$item->id .gdz-icon-box {";
            $item_css .= "text-align:".$item->fields[6]->value.";";
            $item_css .= "}";
            $item_css .= "#$item->id .gdz-icon-box i{";
            $item_css .= "font-size:".$item->fields[2]->value."px;";
            $item_css .= "}";
            $item_css .= "#$item->id .gdz-icon-box img{";
            $item_css .= "width:".$item->fields[5]->value."%;";
            $item_css .= "}";
        } elseif($item->type == 'instagram') {
            $item_css = "#$item->id .pb-instagram-grid .il-item{";
            $item_css .= "padding:".((int)($item->fields[7]->value)/2)."px;";
            $item_css .= "}";
        } elseif($item->type == 'heading') {
            $fontsize_arr = array();
            if($item->fields[2]->value)
                $fontsize_arr = explode("-", $item->fields[2]->value);
            $item_css = "#$item->id .pb-heading{";
            $item_css .= "color: ".$item->fields[3]->value.";";
            $item_css .= "text-align: ".$item->fields[4]->value.";";
            $item_css .= "font-size: ".$fontsize_arr[0]."px;";
            $item_css .= "}";
            $item_css .= "@media (max-width:991px) {
              #$item->id .pb-heading {
                  font-size: ".$fontsize_arr[1]."px;
              }
            }";
            $item_css .= "@media (max-width:575px) {
              #$item->id .pb-heading {
                  font-size: ".$fontsize_arr[2]."px;
              }
            }";
        } elseif($item->type == 'text') {
            $fontsize_arr = array();
            if($item->fields[1]->value)
                $fontsize_arr = explode("-", $item->fields[1]->value);
            $item_css = "#$item->id .pb-text-content{";
            $item_css .= "color: ".$item->fields[2]->value.";";
            $item_css .= "text-align: ".$item->fields[3]->value.";";
            $item_css .= "font-size: ".$fontsize_arr[0]."px;";
            $item_css .= "}";
            $item_css .= "@media (max-width:991px) {
              #$item->id .pb-text-content {
                  font-size: ".$fontsize_arr[1]."px;
              }
            }";
            $item_css .= "@media (max-width:575px) {
              #$item->id .pb-text-content {
                  font-size: ".$fontsize_arr[2]."px;
              }
            }";
        } elseif($item->type == 'map') {
            $item_css = "#$item->id .pb-map iframe{";
            $item_css .= "height: ".$item->fields[1]->value."px;";
            $item_css .= "}";
        } elseif(in_array($item->type, array('productfilter', 'categoryproduct', 'categorytab', 'producttab', 'hotdeal', 'flashsale'))) {
            foreach($item->fields as $_field) {
                if($_field->name == 'gutter') $_padding = $_field->value/2;
            }
            /*$item_css = "#$item->id .row {";
            $item_css .= "margin-left: -".$_padding."px;";
            $item_css .= "margin-right: -".$_padding."px;";
            $item_css .= "}";*/
            $item_css = "#$item->id .row > div {";
            $item_css .= "padding-left: ".$_padding."px;";
            $item_css .= "padding-right: ".$_padding."px;";
            $item_css .= "}";
        } elseif($item->type == 'countdown') {
            $fontsize_arr = array();
            if($item->fields[1]->value)
                $fontsize_arr = explode("-", $item->fields[1]->value);
            $item_css = "#$item->id .countdown {";
            $item_css .= "color: ".$item->fields[2]->value.";";
            $item_css .= "text-align: ".$item->fields[3]->value.";";
            $item_css .= "font-size: ".$fontsize_arr[0]."px;";
            $item_css .= "}";
            $item_css .= "@media (max-width:991px) {
              #$item->id .countdown {
                  font-size: ".$fontsize_arr[1]."px;
              }
            }";
            $item_css .= "@media (max-width:575px) {
              #$item->id .countdown {
                  font-size: ".$fontsize_arr[2]."px;
              }
            }";
        } elseif($item->type == 'banner') {
            $item_css = '';
            $v_offset_arr =  array(0,0,0);
            if(isset($item->fields[19]->value) && $item->fields[19]->value)  $v_offset_arr = explode("-", $item->fields[19]->value);
            $h_offset_arr =  array(0,0,0);
            if(isset($item->fields[20]->value) && $item->fields[20]->value) $h_offset_arr = explode("-", $item->fields[20]->value);
            $text_align = 'center';
            if(isset($item->fields[21]->value) && $item->fields[18]->value) $text_align = $item->fields[21]->value;
            $v_direct = 'top';
            if (isset($item->fields[18]->value) && $item->fields[18]->value && strpos($item->fields[18]->value, 'bottom') !== false) {
              $v_direct = 'bottom';
            } else {
              $v_direct = 'top';
            }
            if (isset($item->fields[18]->value) && $item->fields[18]->value && strpos($item->fields[18]->value, 'left') !== false)
              $h_direct = 'left';
            else
              $h_direct = 'right';
            if(isset($item->fields[3]->value) && $item->fields[3]->value)  $st_size = explode("-", $item->fields[3]->value);
            if(isset($item->fields[4]->value) && $item->fields[4]->value)  $st_lineheight = explode("-", $item->fields[4]->value);
            if(isset($item->fields[8]->value) && $item->fields[8]->value)  $t_size = explode("-", $item->fields[8]->value);
            if(isset($item->fields[9]->value) && $item->fields[9]->value)  $t_lineheight = explode("-", $item->fields[9]->value);
            if(isset($item->fields[12]->value) && $item->fields[12]->value)  $d_size = explode("-", $item->fields[12]->value);
            if(isset($item->fields[13]->value) && $item->fields[13]->value)  $d_lineheight = explode("-", $item->fields[13]->value);
            $item_css = "#$item->id .pb-banner-text {";
            $item_css .= "$v_direct: ".$v_offset_arr[0]."px;";
            $item_css .= "$h_direct: ".$h_offset_arr[0]."px;";
            $item_css .= "text-align:".$text_align.";";
            $item_css .= "}";
            $item_css .= "#$item->id .pb-banner-subtitle {
                font-size:".$st_size[0]."px;
                line-height:".$st_lineheight[0]."px;
                color:".$item->fields[5]->value."
            }";
            $item_css .= "#$item->id .pb-banner-title {
                font-size:".$t_size[0]."px;
                line-height:".$t_lineheight[0]."px;
                color:".$item->fields[10]->value."
            }";
            $item_css .= "#$item->id .pb-banner-desc {
                font-size:".$d_size[0]."px;
                line-height:".$d_lineheight[0]."px;
                color:".$item->fields[14]->value."
            }";
            $item_css .= "@media (max-width:991px) {
              #$item->id .pb-banner-text {
                ".$v_direct.": ".$v_offset_arr[1]."px;
                ".$h_direct.": ".$h_offset_arr[1]."px;
              }
              #$item->id .pb-banner-subtitle {
                  font-size:".$st_size[1]."px;
                  line-height:".$st_lineheight[1]."px;
              }
              #$item->id .pb-banner-title {
                  font-size:".$t_size[1]."px;
                  line-height:".$t_lineheight[1]."px;
              }
              #$item->id .pb-banner-desc {
                  font-size:".$d_size[1]."px;
                  line-height:".$d_lineheight[1]."px;
              }
            }";
            $item_css .= "@media (max-width:575px) {
              #$item->id .pb-banner-text {
                ".$v_direct.": ".$v_offset_arr[2]."px;
                ".$h_direct.": ".$h_offset_arr[2]."px;
              }
              #$item->id .pb-banner-subtitle {
                  font-size:".$st_size[2]."px;
                  line-height:".$st_lineheight[2]."px;
              }
              #$item->id .pb-banner-title {
                  font-size:".$t_size[2]."px;
                  line-height:".$t_lineheight[2]."px;
              }
              #$item->id .pb-banner-desc {
                  font-size:".$d_size[2]."px;
                  line-height:".$d_lineheight[2]."px;
              }
            }";

        } else {
            return "";
        }
        return $item_css;
    }
    public static function genGdzSetting() {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $sprefix = Setting::$sprefix;
        $_settings = Setting::$settings;

        $settingjson = Configuration::get($sprefix . 'settings');
        $settings = json_decode($settingjson, true);
        //print_r($settings); exit;
        $settings['customersignin_logged_links'] = json_decode(Configuration::get($sprefix . 'customersignin_logged_links'));
        $settings['customersignin_notlogged_links'] = json_decode(Configuration::get($sprefix . 'customersignin_notlogged_links'));
        $settings['cart_links'] = json_decode(Configuration::get($sprefix . 'cart_links'));
        $settings['logo_text'] = Configuration::get($sprefix . 'logo_text', $id_lang);
        $settings['topbar_content'] = htmlspecialchars_decode(Configuration::get($sprefix . 'topbar_content', $id_lang));
        $settings['header_html'] = htmlspecialchars_decode(Configuration::get($sprefix . 'header_html', $id_lang));
        $settings['footer_copyright_content'] = htmlspecialchars_decode(Configuration::get($sprefix . 'footer_copyright_content', $id_lang));
        $settings['footer_html'] = htmlspecialchars_decode(Configuration::get($sprefix . 'footer_html', $id_lang));
        $settings['vermenu_button_text'] = Configuration::get($sprefix . 'vermenu_button_text', $id_lang);
        $settings['login_page_signup_content'] = htmlspecialchars_decode(Configuration::get($sprefix . 'login_page_signup_content', $id_lang));
        //$body_google_font = json_decode(Configuration::get($sprefix . 'body_font_google'), true);
        //$heading_google_font = json_decode(Configuration::get($sprefix . 'heading_font_google'), true);
        //$settings['heading_font_google_weightstyle'] = $heading_google_font['weightstyle'] ? implode(",", $heading_google_font['weightstyle']) : "";
        foreach ($_settings as $key => $setting) {
            if($setting['type'] == 'icon') {
                $str_at = strpos($settings[$key], "_");
                if($str_at && $settings['icon_thickness']) {
                    $settings[$key] =  Tools::substr($settings[$key], 0, $str_at);
                    $settings[$key] .=  $settings['icon_thickness'];
                }
            }
        }
        if(file_exists(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/gdz_custom_js.txt')) {
            $settings['custom_js'] = Tools::file_get_contents(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/gdz_custom_js.txt');
        }
        if(file_exists(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/gdz_custom_css.txt')) {
            $settings['custom_css'] = Tools::file_get_contents(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/gdz_custom_css.txt');
        }
        return $settings;
    }
    public static function getTemplates() {
        $query = "SELECT pbt.id_template, pbt.name
                  FROM "._DB_PREFIX_."gdz_pagebuilder_templates pbt" ;
        $query .= " ORDER BY pbt.id_template DESC";
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
    }
    public static function genRows($params) {
        $rows = (array)Tools::jsonDecode($params);
        $bresult = array();
        $b_index = 0;
        $pagebuilder_css = '';
        foreach ($rows as $key => $row) {
            $row_css = '';
            $row_css .= gdzPageBuilderHelper::parseStyleItem('row', $row);
            $row->class = $row->settings->custom_class;
            if($row->settings->animation) {
              $row->class .= " animated ".$row->settings->animation;
            }
            if(isset($row->settings->content_align) && $row->settings->content_align != '') {
              $row->class .= " ".$row->settings->content_align."-align";
            }
            if($row->settings->hidden_mobile) {
              $row->class .= " pb-hidden-xs";
            }
            if($row->settings->hidden_tablet) {
              $row->class .= " pb-hidden-sm";
            }
            if($row->settings->hidden_desktop) {
              $row->class .= " pb-hidden-md";
            }
            $bresult[] = $row;
            $columns = $rows[$key]->cols;
            foreach ($columns as $ckey => $column) {
                $row_css .= gdzPageBuilderHelper::parseStyleItem('column', $column);
                $column->class = $column->settings->lg_col." ".$column->settings->sm_col." ".$column->settings->xs_col." ".$column->settings->custom_class;
                if($column->settings->animation) {
                  $column->class .= " animated ".$column->settings->animation;
                }
                if(isset($column->settings->content_align) && $column->settings->content_align != '') {
                  $column->class .= " ".$column->settings->content_align."-align";
                }
                if($column->settings->hidden_mobile) {
                  $column->class .= " pb-hidden-xs";
                }
                if($column->settings->hidden_tablet) {
                  $column->class .= " pb-hidden-sm";
                }
                if($column->settings->hidden_desktop) {
                  $column->class .= " pb-hidden-md";
                }
                $addons = $column->addons;
                foreach ($addons as $akey => $addon) {
                    $row_css .= gdzPageBuilderHelper::parseStyleItem('addon', $addon);
                    $bresult[$b_index]->cols[$ckey]->addons[$akey]->return_value = gdzPageBuilderHelper::loadAddon($addon);
                    if (isset($addon->grid)) {
                        foreach ($addon->grid as $col) {
                            foreach ($col->addons as $subAddon) {
                               $row_css .= gdzPageBuilderHelper::parseStyleItem('addon', $subAddon);
                            }
                        }
                    }
                }
            }
            $bresult[$b_index]->style = $row_css;
            $pagebuilder_css .= $row_css;
            $b_index++;
        }
        return array('rows' => $bresult, 'css' => $pagebuilder_css);
    }
    public static function getPage($id_page) {
        $context = Context::getContext();
        $id_shop = $context->shop->id;
        $id_lang = $context->language->id;
        $query = "SELECT pbp.*, pbpl.title, pbpl.meta_desc, pbpl.meta_key, pbpl.alias
                  FROM "._DB_PREFIX_."gdz_pagebuilder_pages pbp
                  INNER JOIN "._DB_PREFIX_."gdz_pagebuilder_pages_lang pbpl ON pbp.id_page = pbpl.id_page
                  INNER JOIN "._DB_PREFIX_."gdz_pagebuilder pb ON pbp.id_page = pb.id_page
                  WHERE pbpl.id_lang = '".$id_lang."' AND pb.id_shop = '".$id_shop."' AND pbp.id_page = '".$id_page."' AND pbp.active = 1" ;
        $_page = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query);
        return $_page;
    }
    public static function loadAddon($addon) {
        $addonfile = 'addon'.$addon->type.'.php';
        $addonclass = 'gdzAddon'.Tools::ucfirst($addon->type);
        if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
            require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
        }
        $addon_instance = new $addonclass();
        return $addon_instance->returnValue($addon);
    }
    public function cloneLangData($id_page, $src_lang_id)
    {
        $langids = Language::getIDs();
        $page = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT * FROM '._DB_PREFIX_.'gdz_pagebuilder_pages '.($id_page ? ' WHERE `id_page` = '.$id_page : ''));
        $params = $page['params'];
        $rows = (array)Tools::jsonDecode($params);
        foreach ($rows as $key => $row) {
            $columns = $rows[$key]->cols;
            foreach ($columns as $ckey => $column) {
                $addons = $column->addons;
                foreach ($addons as $akey => $addon) {
                    $fields = $addon->fields;
                    foreach ($fields as $fkey => $field) {
                        if ($field->multilang == '1') {
                            foreach ($langids as $lang_id) {
                                $rows[$key]->cols[$ckey]->addons[$akey]->fields[$fkey]->value->$lang_id = $field->value->$src_lang_id;
                            }
                        }
                    }
                }
            }
        }
        $new_params = Tools::jsonEncode($rows);
        $page = new gdzPage($id_page);
        $page->params = $new_params;
        return $page->update();
    }
    public function request($params)
    {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $this->studio_url);
        curl_setopt($curlSession, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curlSession);
        curl_close($curlSession);
        return Tools::jsonDecode($response, true);
    }
}
