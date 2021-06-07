<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Theme Setting
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/settings.php';
class gdz_themesetting extends Module
{
    public function __construct()
    {
        $this->name = 'gdz_themesetting';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'prestawork';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->sprefix = Setting::$sprefix;
        $this->controllers = array('preview');
        parent::__construct();
        $this->displayName = $this->trans('Godzilla Theme Setting', array(), 'Modules.gdz_themesetting');
        $this->description = $this->l('Theme Setting For Godzilla.');
        $this->settings = Setting::$settings;
    }
    public function importSettingDefault() {
        $languages = Language::getLanguages(false);
        require_once( dirname(__FILE__).'/install/themesetting.php' );
        $arr = json_decode($settingjson, true);
        $html_lang_fields = array('topbar_content' ,'footer_copyright_content' ,'login_page_signup_content' );
        $padding_fields = array('customersignin_logged_links');
        foreach ($arr as $key => $value) {
            if(in_array($key, $html_lang_fields)) {
                $content_array = array();
                foreach ($languages as $language) {
                    $content_array[$language['id_lang']] = $value[$language['id_lang']];
                }
                Configuration::updateValue($this->sprefix . $key, $content_array, true);
            } elseif (in_array($key, $padding_fields)) {
                Configuration::updateValue($this->sprefix . $key, json_encode(json_decode($value)));
            } else {
                Configuration::updateValue($this->sprefix . $key, $value);
            }
        }
        //exit;
        $var = array();
        foreach ($this->settings as $key => $setting) {
            if (isset($setting['front'])) {
                $var[$key] = Configuration::get($this->sprefix . $key);
            }
        }
        Configuration::updateValue($this->sprefix . 'settings', json_encode($var));
        return true;
    }
    public function install()
    {
        $res = true;
        if (parent::install() && $this->registerHook('displayBackOfficeHeader') && $this->registerHook('header')) {
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
            if(((int)Tab::getIdFromClassName('GODZILLA') > 0) && ((int)Tab::getIdFromClassName('AdminGdzThemeSetting') <= 0)) {
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzThemeSetting";
                $tab->position = 0;
                $tab->icon = 'settings';
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Theme Setting';
                }
                $tab->id_parent = (int)Tab::getIdFromClassName('GODZILLA');
                $tab->module = $this->name;
                if(!$tab->add()) return false;
            }
            $this->importSettingDefault();
        }
        return $res;
    }

    public function uninstall()
    {
        /* Deletes Module */
        if (parent::uninstall()) {
            $res = true;
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzThemeSetting');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            return $res;
        }
        return false;
    }
    public function genIcon($settings) {
        foreach ($this->settings as $key => $setting) {
            if($setting['type'] == 'icon') {

            }
        }
    }
    public function hookDisplayHeader()
    {
        $settingjson = Configuration::get($this->sprefix . 'settings');
        $settings = json_decode($settingjson, true);
        $settings['customersignin_logged_links'] = json_decode(Configuration::get($this->sprefix . 'customersignin_logged_links'));
        $settings['customersignin_notlogged_links'] = json_decode(Configuration::get($this->sprefix . 'customersignin_notlogged_links'));
        $settings['cart_links'] = json_decode(Configuration::get($this->sprefix . 'cart_links'));
        $settings['logo_text'] = Configuration::get($this->sprefix . 'logo_text', $this->context->language->id);
        $settings['topbar_content'] = htmlspecialchars_decode(Configuration::get($this->sprefix . 'topbar_content', $this->context->language->id));
        $settings['header_html'] = htmlspecialchars_decode(Configuration::get($this->sprefix . 'header_html', $this->context->language->id));
        $settings['footer_copyright_content'] = htmlspecialchars_decode(Configuration::get($this->sprefix . 'footer_copyright_content', $this->context->language->id));
        $settings['footer_html'] = htmlspecialchars_decode(Configuration::get($this->sprefix . 'footer_html', $this->context->language->id));
        $settings['vermenu_button_text'] = Configuration::get($this->sprefix . 'vermenu_button_text', $this->context->language->id);
        $settings['login_page_signup_content'] = htmlspecialchars_decode(Configuration::get($this->sprefix . 'login_page_signup_content', $this->context->language->id));
        if(Configuration::get($this->sprefix . 'body_font_google') && strlen(Configuration::get($this->sprefix . 'body_font_google')) > 2) {
            $body_google_font = json_decode(Configuration::get($this->sprefix . 'body_font_google'));
            $google_font_link = 'https://fonts.googleapis.com/css?family=';
            $fontname = array();
            foreach ($body_google_font as $key => $font) {
              $fontval = $font->name;
              if(count($font->weight) > 0) $fontval .= ":" . implode(",", $font->weight);
              $fontname[] = $fontval;
            }
            $this->context->controller->registerStylesheet('gdzpb-google-font', $google_font_link.implode("|", $fontname), ['server' => 'remote', 'media' => 'all', 'priority' => 2]);
        }
        if(Configuration::get($this->sprefix . 'awesome_font')) {
            if(Configuration::get($this->sprefix . 'awesome_from')) {
                $this->context->controller->registerStylesheet('gdzpb-awesome-font', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', ['server' => 'remote', 'media' => 'all', 'priority' => 2]);
            } elseif(Configuration::get($this->sprefix . 'awesome_font_url')) {
                $this->context->controller->registerStylesheet('gdzpb-awesome-font', Configuration::get($this->sprefix . 'awesome_font_url'), ['server' => 'remote', 'media' => 'all', 'priority' => 2]);
            }
        }
        if(Configuration::get($this->sprefix . 'body_fontcssurl')) {
            $body_fontcssurl = json_decode(Configuration::get($this->sprefix . 'body_fontcssurl'));
            foreach ($body_fontcssurl as $key => $url) {
              $this->context->controller->registerStylesheet('custom-css-'.$key, $url, ['server' => 'remote', 'media' => 'all', 'priority' => 2]);
            }
        }
        foreach ($this->settings as $key => $setting) {
            if($setting['type'] == 'icon') {
                $str_at = strpos($settings[$key], "_");
                if($str_at && $settings['icon_thickness']) {
                    $settings[$key] =  substr($settings[$key], 0, $str_at);
                    $settings[$key] .=  $settings['icon_thickness'];
                }
            }
        }
        if(file_exists(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/gdz_custom_js.txt')) {
            $settings['custom_js'] = file_get_contents(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/gdz_custom_js.txt');
        }
        if(file_exists(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/gdz_custom_css.txt')) {
            $settings['custom_css'] = file_get_contents(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/gdz_custom_css.txt');
        }

        Media::AddJsDef(array('gdzSetting' => array('carousel_lazyload' => $settings['carousel_lazyload'], 'product_content_layout' => $settings['product_content_layout'], 'product_thumbs_show' => $settings['product_thumbs_show'], 'shop_grid_column' => $settings['shop_grid_column'], 'footer_block_collapse' => $settings['footer_block_collapse'], 'right_icon' => $settings['right_icon'], 'left_icon' => $settings['left_icon'])));
        $this->context->smarty->assign('gdzSetting', $settings);

    }
}
