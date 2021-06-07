<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Theme Setting
*
*  @author    Godzilla <joommasters@gmail.com>
*  @cyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/settings.php';
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/forms/GeneralForm.php';
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/forms/HeaderForm.php';
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/forms/FooterForm.php';
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/forms/SocialForm.php';
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/forms/MenuForm.php';
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/forms/PagesForm.php';
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/forms/ImportExportForm.php';
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/forms/CustomForm.php';
use Leafo\ScssPhp\Compiler;
class AdminGdzThemeSettingController extends ModuleAdminController
{
    private $sprefix;
    private $settings;
    public function __construct()
    {
        $this->name = 'gdzthemesetting';
        $this->bootstrap = true;
        $this->sprefix = Setting::$sprefix;
        parent::__construct();
        $this->settings = Setting::$settings;

    }
    public function initContent()
    {
        if (!$this->viewAccess()) {
            $this->errors[] = Tools::displayError('You do not have permission to view this.');
            return;
        }

        $this->content .= $this->renderSettingForm();
        $this->context->smarty->assign(array(
            'content' => $this->content,
        ));
    }
    public function initPageHeaderToolbar()
    {

        $this->page_header_toolbar_btn['savesetting'] = array(
            'href' => $this->context->link->getAdminLink('AdminGdzThemeSetting').'&saveSetting',
            'desc' => $this->l('Save Setting', null, null, false),
            'icon' => 'process-icon-save'
        );
        return parent::initPageHeaderToolbar();
    }
    public function getThemeSetting()
    {
        $var = array();
        $languages = Language::getLanguages(false);
        foreach ($this->settings as $key => $setting) {
            if($setting['type'] == 'html_lang') {
              foreach ($languages as $language) {
                  $var[$key][$language['id_lang']] = htmlspecialchars_decode(Configuration::get($this->sprefix  . $key, $language['id_lang']));
              }
            } else {
              $var[$key] = Configuration::get($this->sprefix  . $key);
            }
        }
        return json_encode($var);
    }
    public function ajaxProcessExportSetting()
    {
        // $var = array();
        // $languages = Language::getLanguages(false);
        // foreach ($this->settings as $key => $setting) {
        //     if($setting['type'] == 'html_lang') {
        //       foreach ($languages as $language) {
        //           $var[$key][$language['id_lang']] = htmlspecialchars_decode(Configuration::get($this->sprefix  . $key, $language['id_lang']));
        //       }
        //     } else {
        //       $var[$key] = Configuration::get($this->sprefix  . $key);
        //     }
        // }
        $var = $this->getThemeSetting();
        header('Content-disposition: attachment; filename=themesetting.json');
        header('Content-type: application/json');
        print_r($var);
        die;
    }
    public function convertScssVar($name, $type = 'default', $otions = '')
    {
        if ($type == 'default') {
            $val = Configuration::get($this->sprefix . $name);
            $var = '$' . $name . ': ' . (!empty($val) ? $val : 'null') . ';';
        } elseif ($type == 'background') {
            $bg_color = Configuration::get($this->sprefix . $name . '_color');
            $bg_image = Configuration::get($this->sprefix . $name . '_image');
            $bg_image = json_decode(Configuration::get($this->sprefix . $name. '_image'), true);
            if (Configuration::get($this->sprefix . $name) == 'image') {
              $bg_repeat = Configuration::get($this->sprefix . $name . '_repeat');
              $bg_attachment = Configuration::get($this->sprefix . $name . '_attachment');
              $bg_position = Configuration::get($this->sprefix . $name . '_position');
              $bg_size = Configuration::get($this->sprefix . $name . '_size');
                $var = '$' . $name . ': '.' url("' . $bg_image['image'] . '")' . str_replace('-',
                        ' ', $bg_image['position']) . ' / ' . $bg_image['size'] . ' ' . $bg_image['repeat'] . ' ' . $bg_image['attachment'] . ';';
            } elseif(Configuration::get($this->sprefix . $name) == 'color') {
                $var = '$' . $name . ': ' . (!empty($bg_color) ? $bg_color : 'null') . ';';
            } else {
              $var = null;
            }
        } elseif ($type == 'padding') {
            $_arr = json_decode(Configuration::get($this->sprefix . $name), true);
            $var = '';
            if($_arr[0] != '')
              $var .= '$' . $name . '_top: '.$_arr[0].'px'.';';
            if($_arr[1] != '')
                $var .= '$' . $name . '_right: '.$_arr[1].'px'.';';
            if($_arr[2] != '')
                $var .= '$' . $name . '_bottom: '.$_arr[2].'px'.';';
            if($_arr[3] != '')
                $var .= '$' . $name . '_left: '.$_arr[3].'px'.';';
        } elseif ($type == 'fontstyle') {
            $_arr = json_decode(Configuration::get($this->sprefix . $name), true);
            $var = '';
            if($_arr['size'] != '')
                $var .= '$' . $name . '_size: '.$_arr['size'].'px'.';';
            if($_arr['weight'] != '')
                $var .= '$' . $name . '_weight: '.$_arr['weight'].';';
            if($_arr['style'] != '')
                $var .= '$' . $name . '_style: '.$_arr['style'].';';
            if($_arr['transform'] != '')
                $var .= '$' . $name . '_transform: '.$_arr['transform'].';';
        } elseif ($type == 'border') {
            $_arr = json_decode(Configuration::get($this->sprefix . $name), true);
            $var = '';
            if($_arr['width'] != '')
                $var .= '$' . $name . '_width: '.$_arr['width'].'px'.';';
            if($_arr['style'] != '')
                $var .= '$' . $name . '_style: '.$_arr['style'].';';
            if($_arr['color'] != '')
                $var .= '$' . $name . '_color: '.$_arr['color'].';';
        } elseif ($type == 'font') {
            $font_google = json_decode(Configuration::get($this->sprefix . $name . '_google'), true);
            $font_system = Configuration::get($this->sprefix . $name . '_system');
            $font_face = Configuration::get($this->sprefix . $name . '_face');
            //if (Configuration::get($this->sprefix . $name) == 'system' && $font_system) {
            //    $var = '$' . $name . ':'.$font_system.';';
            //} elseif(Configuration::get($this->sprefix . $name) == 'google' && $font_google) {
                //$var = '$' . $name . ':'.$font_google['family'].';';
            //  } elseif(Configuration::get($this->sprefix . $name) == 'fontface' && $font_face) {
            //    $var = '$' . $name . ':'.$font_face.';';
            //} else {
              $var = null;
            //}
        }

        return $var;
    }
    public function genAssets()
    {
        include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/scssphp/scss.inc.php';

        $css = '';
        $vars = '';
        $compiler = new Compiler();
        $compiler->setIgnoreErrors(true);
        $compiler->setImportPaths(_PS_ROOT_DIR_.'/modules/gdz_themesetting/views/scss/');
        foreach ($this->settings as $key => $setting) {

            if (isset($setting['css'])) {
                switch ($setting['css']) {
                    case 'no':
                        continue;
                        break;
                    case 'background':
                        $vars .= ' ' . $this->convertScssVar($key, 'background') . PHP_EOL;
                        break;
                    case 'padding':
                        $vars .= ' ' . $this->convertScssVar($key, 'padding') . PHP_EOL;
                        break;
                    case 'fontstyle':
                        $vars .= ' ' . $this->convertScssVar($key, 'fontstyle') . PHP_EOL;
                        break;
                    case 'border':
                        $vars .= ' ' . $this->convertScssVar($key, 'border') . PHP_EOL;
                        break;
                    case 'font':
                        $vars .= ' ' . $this->convertScssVar($key, 'font') . PHP_EOL;
                        break;
                }
            } else {
                $vars .= ' ' . $this->convertScssVar($key) . PHP_EOL;
            }
        }
        try {
            $css .= $compiler->compile($vars . ' @import "scssmain.scss";');
        } catch (Exception $e) {
            print_r($e->getMessage()); exit;
            $message = '<div class="alert alert-danger">' . $this->l('error in SCSS compiler');
            $message .= '<ul><li>' . $e->getMessage() . ' </li></ul></div>';
            return ['success' => false, 'message' => $message];
        }

        $css = trim(preg_replace('/\s+/', ' ', $css));
        $myFile = _PS_ROOT_DIR_ . "/modules/gdz_themesetting/views/css/custom.css";

        file_put_contents($myFile, $css);

    }
    public function postProcess()
    {
        $languages = Language::getLanguages(false);
        if(Tools::isSubmit('importSetting')) {
            if (isset($_FILES['settingFile'])) {

                try{
                    $str = file_get_contents($_FILES['settingFile']['tmp_name']);
                    $arr = json_decode($str, true);
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

                    $this->genAssets();
                    Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzThemeSetting', true).'&conf=18');
                } catch(Exception $ex){
                    $this->content .= $this->module->displayError($this->l('No setting file found'));
                }
            } else {
                $this->content .= $this->module->displayError($this->l('No setting file found'));
            }

        } elseif (Tools::isSubmit('saveSetting')) {
          $var = array();
          foreach ($this->settings as $key => $setting) {
              if ($setting['type'] == 'html_lang') {
                  $content_array = array();
                  foreach ($languages as $language) {
                       $content_array[$language['id_lang']] = htmlspecialchars(Tools::getValue($key.'_'.$language['id_lang']));
                  }
                  Configuration::updateValue($this->sprefix . $key, $content_array, true);
              } elseif ($setting['type'] == 'text_lang') {
                  $content_array = array();
                  foreach ($languages as $language) {
                      $content_array[$language['id_lang']] = Tools::getValue($key.'_'.$language['id_lang']);
                  }
                  Configuration::updateValue($this->sprefix . $key, $content_array, true);
              } elseif ($setting['type'] == 'fontstyle') {
                  $fontstyle = array();
                  $fontstyle['size'] = Tools::getValue($key.'_size');
                  $fontstyle['weight'] = Tools::getValue($key.'_weight');
                  $fontstyle['style'] = Tools::getValue($key.'_style');
                  $fontstyle['transform'] = Tools::getValue($key.'_transform');
                  Configuration::updateValue($this->sprefix . $key, json_encode($fontstyle), true);
              } elseif ($setting['type'] == 'background-img') {
                  $bgimg = array();
                  $bgimg['image'] = Tools::getValue($key);
                  $bgimg['size'] = Tools::getValue($key.'_size');
                  $bgimg['position'] = Tools::getValue($key.'_position');
                  $bgimg['repeat'] = Tools::getValue($key.'_repeat');
                  $bgimg['attachment'] = Tools::getValue($key.'_attachment');
                  Configuration::updateValue($this->sprefix . $key, json_encode($bgimg), true);
              } elseif ($setting['type'] == 'border') {
                  $border = array();
                  $border['width'] = Tools::getValue($key.'_width');
                  $border['style'] = Tools::getValue($key.'_style');
                  $border['color'] = Tools::getValue($key.'_color');
                  Configuration::updateValue($this->sprefix . $key, json_encode($border), true);
              /*} elseif ($setting['type'] == 'googlefont') {
                  $google_font = Tools::getValue($key);
                  Configuration::updateValue($this->sprefix . $key, json_encode($google_font), true);*/
              } elseif ($setting['type'] == 'html') {
                  Configuration::updateValue($this->sprefix . $key, htmlspecialchars(Tools::getValue($key)), true);
              } elseif ($setting['type'] == 'padding' || $setting['type'] == 'checkbox2') {
                  Configuration::updateValue($this->sprefix . $key, json_encode(Tools::getValue($key)));
              } elseif ($setting['type'] == 'custom_code') {
                  $customfile = fopen(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/'.$this->sprefix . $key.".txt", "w") or die("Unable to open file!");
                  fwrite($customfile, Tools::getValue($key));
                  fclose($customfile);
              } elseif ($setting['type'] == 'edit_file') {
                  //$customfile = fopen(_PS_THEME_DIR_.'assets/css/custom.css', "w") or die("Unable to open file!");
                  //fwrite($customfile, Tools::getValue($key));
                  //fclose($customfile);
              } else {
                  Configuration::updateValue($this->sprefix . $key, Tools::getValue($key));
              }

              if (isset($setting['front'])) {
                  $var[$key] = Tools::getValue($key);
              }

          }
          Configuration::updateValue($this->sprefix . 'settings', json_encode($var));

          $this->genAssets();

          Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzThemeSetting', true).'&conf=6');

        }

        parent::postProcess();
    }

    protected function buildHelper()
    {
        $helper = new HelperForm();

        $helper->module = $this->module;
        $helper->override_folder = 'settingform/';
        $helper->identifier = $this->className;
        $helper->languages = $this->_languages;
        $helper->currentIndex = $this->context->link->getAdminLink('Admin'.$this->name);
        $helper->default_form_language = $this->default_form_language;
        $helper->allow_employee_form_lang = $this->allow_employee_form_lang;
        $helper->toolbar_scroll = true;
        $helper->toolbar_btn = $this->initToolbar();

        return $helper;
    }

    public function renderSettingForm()
    {
        $helper = $this->buildHelper();
        $helper->submit_action = 'saveSetting';
        $helper->fields_value = $this->getConfigFieldsValues();
        $root_url = Tools::getHttpHost(true);
        $root_url = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE') ? $root_url : str_replace('https', 'http', $root_url);
        $base_url = $root_url.__PS_BASE_URI__;
        //print_r($root_url); exit;
        $helper->tpl_vars = array(
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
            'current_link' => $this->context->link->getAdminLink('AdminGdzThemeSetting'),
            'root_url' => $root_url,
            'base_url' => $base_url
        );
        $generalform = new gdzGeneralForm();
        $generalfields = $generalform->getGeneralForm();
        $headerform = new gdzHeaderForm();
        $headerfields = $headerform->getHeaderForm();
        $footerform = new gdzFooterForm();
        $footerfields = $footerform->getFooterForm();
        $socialform = new gdzSocialForm();
        $socialfields = $socialform->getSocialForm();
        $menuform = new gdzMenuForm();
        $menufields = $menuform->getMenuForm();
        $pagesform = new gdzPagesForm();
        $pagesfields = $pagesform->getPagesForm();
        $importexportform = new gdzImportExportForm();
        $importexportfields = $importexportform->getImportExportForm();
        $customform = new gdzCustomForm();
        $customfields = $customform->getCustomForm();
        return $helper->generateForm(array_merge($generalfields, $headerfields, $menufields, $pagesfields, $footerfields, $socialfields, $importexportfields, $customfields));
    }
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia();
        $this->addJS(_MODULE_DIR_ . $this->module->name . '/views/js/setting.js');
        $this->addJS(_MODULE_DIR_ . $this->module->name . '/views/js/googlefont.js');
        $this->addCSS(_MODULE_DIR_ . $this->module->name . '/views/css/setting.css');
        $this->addCSS(_MODULE_DIR_ . $this->module->name . '/views/fonts/font-icon.css');
    }
    public function getConfigFieldsValues()
    {
        $languages = Language::getLanguages(false);
        $var = array();
        foreach ($this->settings as $key => $setting) {
            if($setting['type'] == 'html_lang') {
                foreach ($languages as $language) {
                    $var[$key][$language['id_lang']] = htmlspecialchars_decode(Configuration::get($this->sprefix  . $key, $language['id_lang']));
                }
            } elseif($setting['type'] == 'text_lang') {
                foreach ($languages as $language) {
                    $var[$key][$language['id_lang']] = Configuration::get($this->sprefix  . $key, $language['id_lang']);
                }
            } elseif($setting['type'] == 'fontstyle') {
                $var[$key] = json_decode(Configuration::get($this->sprefix  . $key), true);
            } elseif($setting['type'] == 'background-img') {
                $var[$key] = json_decode(Configuration::get($this->sprefix  . $key), true);
            } elseif($setting['type'] == 'border') {
                $var[$key] = json_decode(Configuration::get($this->sprefix  . $key), true);
            } elseif ($setting['type'] == 'googlefont') {
                $var[$key] = json_decode(Configuration::get($this->sprefix  . $key), true);
            } elseif ($setting['type'] == 'html') {
                $var[$key] = htmlspecialchars_decode(Configuration::get($this->sprefix  . $key));
            } elseif ($setting['type'] == 'padding' || $setting['type'] == 'checkbox2') {
                $var[$key] = json_decode(Configuration::get($this->sprefix  . $key));
            } elseif ($setting['type'] == 'custom_code') {
                if(!file_exists(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/'.$this->sprefix . $key.".txt")) {
                    $customfile = fopen(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/'.$this->sprefix . $key.".txt", "w");
                    fclose($customfile);
                }
                $var[$key] = file_get_contents(_PS_MODULE_DIR_.'gdz_themesetting/views/customfiles/'.$this->sprefix . $key.".txt");
            } elseif ($setting['type'] == 'edit_file') {
                $var[$key] = file_get_contents(_PS_THEME_DIR_.'assets/css/custom.css');
            } else {
                $var[$key] = Configuration::get($this->sprefix  . $key);
            }
        }
        //print_r($var); exit;
        return $var;
    }
}
