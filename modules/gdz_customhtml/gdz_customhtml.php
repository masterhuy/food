<?php
/**
 * 2007-2020 PrestaShop
 *
 * Godzilla Custom Html
 *
 *  @author    Godzilla <joommasters@gmail.com>
 *  @copyright 2007-2020 Godzilla
 *  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *  @Website: https://www.godzillabuilder.com
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class gdz_customhtml extends Module
{
    private $_html       = '';
    private $_postErrors = array();
    public function __construct()
    {
        $this->name          = 'gdz_customhtml';
        $this->tab           = 'front_office_features';
        $this->version       = '1.0.0';
        $this->author        = 'Godzilla';
        $this->bootstrap     = true;
        $this->need_instance = 0;
        parent::__construct();
        $this->displayName = $this->l('Godzilla Custom Html');
        $this->description = $this->l('Enter html codes and show it in Left/Right/Footer/Top/LeftProduct/RightProduct Hook.');
    }

    public function install()
    {
        if (parent::install() && $this->registerHook('displayLeftColumn') && $this->registerHook('displayRightColumn') && $this->registerHook('displayTop') && $this->registerHook('displayFooter') && $this->registerHook('displayLeftColumnProduct') && $this->registerHook('displayRightColumnProduct') && $this->registerHook('displayHome')) {
            $res = $this->installFixtures();
            return $res;
        }
        return true;
    }
    public function uninstall()
    {
        if (parent::uninstall()) {
            $res = true;
            $res &= Configuration::deleteByName('GDZ_CUSTOMHTML_LEFT');
            $res &= Configuration::deleteByName('GDZ_CUSTOMHTML_RIGHT');
            $res &= Configuration::deleteByName('GDZ_CUSTOMHTML_TOP');
            $res &= Configuration::deleteByName('GDZ_CUSTOMHTML_FOOTER');
            $res &= Configuration::deleteByName('GDZ_CUSTOMHTML_PRODUCTLEFT');
            $res &= Configuration::deleteByName('GDZ_CUSTOMHTML_PRODUCTRIGHT');
            $res &= Configuration::deleteByName('GDZ_CUSTOMHTML_HOME');
            return $res;
        }
        return false;
    }
    public function getContent()
    {
        /* Validate & process */
        if (Tools::isSubmit('saveHtml')) {
            $this->_postProcess();
            $this->_html = $this->initForm();
        } else {
            $this->_html = $this->initForm();
        }
        return $this->_html;
    }
    private function _postProcess()
    {
        $errors = array();
        /* Processes Slider */
        if (Tools::isSubmit('saveHtml')) {
            //print_r(Tools::getValue('GDZ_CUSTOMHTML_LEFT', true)); exit;
            $languages           = Language::getLanguages(false);
            $custom_left         = array();
            $custom_right        = array();
            $custom_top          = array();
            $custom_footer       = array();
            $custom_productleft  = array();
            $custom_productright = array();
            $custom_home         = array();
            foreach ($languages as $language) {
                $custom_left[$language['id_lang']]         = Tools::getValue('GDZ_CUSTOMHTML_LEFT_' . $language['id_lang']);
                $custom_right[$language['id_lang']]        = Tools::getValue('GDZ_CUSTOMHTML_RIGHT_' . $language['id_lang']);
                $custom_top[$language['id_lang']]          = Tools::getValue('GDZ_CUSTOMHTML_TOP_' . $language['id_lang']);
                $custom_footer[$language['id_lang']]       = Tools::getValue('GDZ_CUSTOMHTML_FOOTER_' . $language['id_lang']);
                $custom_productleft[$language['id_lang']]  = Tools::getValue('GDZ_CUSTOMHTML_PRODUCTLEFT_' . $language['id_lang']);
                $custom_productright[$language['id_lang']] = Tools::getValue('GDZ_CUSTOMHTML_PRODUCTRIGHT_' . $language['id_lang']);
                $custom_home[$language['id_lang']]         = Tools::getValue('GDZ_CUSTOMHTML_HOME_' . $language['id_lang']);
            }
            $res = Configuration::updateValue('GDZ_CUSTOMHTML_LEFT', $custom_left, true);
            $res &= Configuration::updateValue('GDZ_CUSTOMHTML_RIGHT', $custom_right, true);
            $res &= Configuration::updateValue('GDZ_CUSTOMHTML_TOP', $custom_top, true);
            $res &= Configuration::updateValue('GDZ_CUSTOMHTML_FOOTER', $custom_footer, true);
            $res &= Configuration::updateValue('GDZ_CUSTOMHTML_PRODUCTLEFT', $custom_productleft, true);
            $res &= Configuration::updateValue('GDZ_CUSTOMHTML_PRODUCTRIGHT', $custom_productright, true);
            $res &= Configuration::updateValue('GDZ_CUSTOMHTML_HOME', $custom_home, true);

            if (!$res) {
                $errors[] = $this->displayError($this->l('The html could not be updated.'));
            } else {
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true) . '&conf=6&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&config=1');
            }

        }

        /* Display errors if needed */
        if (count($errors)) {
            $this->_html .= $this->displayError(implode('<br />', $errors));
        } elseif (Tools::isSubmit('saveHtml')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true) . '&conf=3&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name);
        }

    }

    public function initForm()
    {
        $context     = Context::getContext();
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Custom Html'),
                    'icon'  => 'icon-cogs',
                ),
                'input'  => array(
                    array(
                        'type'         => 'textarea',
                        'label'        => $this->l('Html On Hook Left'),
                        'lang'         => true,
                        'name'         => 'GDZ_CUSTOMHTML_LEFT',
                        'cols'         => 40,
                        'rows'         => 15,
                        'class'        => 'rte',
                        'autoload_rte' => true,
                    ),
                    array(
                        'type'         => 'textarea',
                        'label'        => $this->l('Html On Hook Right'),
                        'lang'         => true,
                        'name'         => 'GDZ_CUSTOMHTML_RIGHT',
                        'cols'         => 40,
                        'rows'         => 15,
                        'class'        => 'rte',
                        'autoload_rte' => true,
                    ),
                    array(
                        'type'         => 'textarea',
                        'label'        => $this->l('Html On Hook Top'),
                        'lang'         => true,
                        'name'         => 'GDZ_CUSTOMHTML_TOP',
                        'cols'         => 40,
                        'rows'         => 15,
                        'class'        => 'rte',
                        'autoload_rte' => true,
                    ),
                    array(
                        'type'         => 'textarea',
                        'label'        => $this->l('Html On Hook Footer'),
                        'lang'         => true,
                        'name'         => 'GDZ_CUSTOMHTML_FOOTER',
                        'cols'         => 40,
                        'rows'         => 15,
                        'class'        => 'rte',
                        'autoload_rte' => true,
                    ),
                    array(
                        'type'         => 'textarea',
                        'label'        => $this->l('Html On Hook Product Left'),
                        'lang'         => true,
                        'name'         => 'GDZ_CUSTOMHTML_PRODUCTLEFT',
                        'cols'         => 40,
                        'rows'         => 15,
                        'class'        => 'rte',
                        'autoload_rte' => true,
                    ),
                    array(
                        'type'         => 'textarea',
                        'label'        => $this->l('Html On Hook Product Right'),
                        'lang'         => true,
                        'name'         => 'GDZ_CUSTOMHTML_PRODUCTRIGHT',
                        'cols'         => 40,
                        'rows'         => 15,
                        'class'        => 'rte',
                        'autoload_rte' => true,
                    ),
                    array(
                        'type'         => 'textarea',
                        'label'        => $this->l('Html On Hook Home'),
                        'lang'         => true,
                        'name'         => 'GDZ_CUSTOMHTML_HOME',
                        'cols'         => 40,
                        'rows'         => 15,
                        'class'        => 'rte',
                        'autoload_rte' => true,
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );

        $helper                           = new HelperForm();
        $helper->show_toolbar             = false;
        $helper->table                    = $this->table;
        $lang                             = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language    = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form                = array();
        $helper->module                   = $this;
        $helper->identifier               = $this->identifier;
        $helper->submit_action            = 'saveHtml';
        $helper->currentIndex             = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token                    = Tools::getAdminTokenLite('AdminModules');
        $language                         = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->tpl_vars                 = array(
            'language'     => array(
                'id_lang'  => $language->id,
                'iso_code' => $language->iso_code,
            ),
            'fields_value' => $this->getFieldsValues(),
            'languages'    => $this->context->controller->getLanguages(),
            'id_language'  => $this->context->language->id,
        );

        $helper->override_folder = '/';
        return $helper->generateForm(array($fields_form));
    }
    public function getFieldsValues()
    {
        $fields    = array();
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $fields['GDZ_CUSTOMHTML_LEFT'][$lang['id_lang']]         = Configuration::get('GDZ_CUSTOMHTML_LEFT', $lang['id_lang']);
            $fields['GDZ_CUSTOMHTML_RIGHT'][$lang['id_lang']]        = Configuration::get('GDZ_CUSTOMHTML_RIGHT', $lang['id_lang']);
            $fields['GDZ_CUSTOMHTML_TOP'][$lang['id_lang']]          = Configuration::get('GDZ_CUSTOMHTML_TOP', $lang['id_lang']);
            $fields['GDZ_CUSTOMHTML_FOOTER'][$lang['id_lang']]       = Configuration::get('GDZ_CUSTOMHTML_FOOTER', $lang['id_lang']);
            $fields['GDZ_CUSTOMHTML_PRODUCTLEFT'][$lang['id_lang']]  = Configuration::get('GDZ_CUSTOMHTML_PRODUCTLEFT', $lang['id_lang']);
            $fields['GDZ_CUSTOMHTML_PRODUCTRIGHT'][$lang['id_lang']] = Configuration::get('GDZ_CUSTOMHTML_PRODUCTRIGHT', $lang['id_lang']);
            $fields['GDZ_CUSTOMHTML_HOME'][$lang['id_lang']]         = Configuration::get('GDZ_CUSTOMHTML_HOME', $lang['id_lang']);
        }
        return $fields;
    }
    public function hookLeftColumn()
    {

        $customhtml = Configuration::get('GDZ_CUSTOMHTML_LEFT', $this->context->language->id);
        $this->smarty->assign(array(
            'customhtml' => $customhtml,
        ));
        return $this->display(__FILE__, 'customhtml.tpl');
    }
    public function hookRightColumn()
    {
        $customhtml = Configuration::get('GDZ_CUSTOMHTML_RIGHT', $this->context->language->id);
        $this->smarty->assign(array(
            'customhtml' => $customhtml,
        ));
        return $this->display(__FILE__, 'customhtml.tpl');
    }
    public function hookLeftColumnProduct()
    {
        $customhtml = Configuration::get('GDZ_CUSTOMHTML_PRODUCTLEFT', $this->context->language->id);
        $this->smarty->assign(array(
            'customhtml' => $customhtml,
        ));
        return $this->display(__FILE__, 'customhtml.tpl');
    }
    public function hookRightColumnProduct()
    {
        $customhtml = Configuration::get('GDZ_CUSTOMHTML_PRODUCTRIGHT', $this->context->language->id);
        $this->smarty->assign(array(
            'customhtml' => $customhtml,
        ));
        return $this->display(__FILE__, 'customhtml.tpl');
    }
    public function hookHome()
    {
        $customhtml = Configuration::get('GDZ_CUSTOMHTML_HOME', $this->context->language->id);
        $this->smarty->assign(array(
            'customhtml' => $customhtml,
        ));
        return $this->display(__FILE__, 'customhtml.tpl');
    }
    public function hookTop()
    {
        $customhtml = Configuration::get('GDZ_CUSTOMHTML_TOP', $this->context->language->id);
        $this->smarty->assign(array(
            'customhtml' => $customhtml,
        ));
        return $this->display(__FILE__, 'customhtml.tpl');
    }
    public function hookFooter()
    {
        $customhtml = Configuration::get('GDZ_CUSTOMHTML_FOOTER', $this->context->language->id);
        $this->smarty->assign(array(
            'customhtml' => $customhtml,
        ));
        return $this->display(__FILE__, 'customhtml.tpl');
    }
    public function installFixtures()
    {
        $languages   = Language::getLanguages(false);
        $sample_html = array();
        $footer_sample = array();
        foreach ($languages as $language) {
            $sample_html[$language['id_lang']] = 'I am html block. Enter html code here';
            $footer_sample[$language['id_lang']] = '<div class="layout-column wrapper block"><a href="#"> <span class="site-logo-text">October</span> </a> <br />A simple new land is built to make online store great and everyone can confortable when touched. No skill coding require.</div>';
        }

        $res = Configuration::updateValue('GDZ_CUSTOMHTML_LEFT', $sample_html, true);
        $res &= Configuration::updateValue('GDZ_CUSTOMHTML_RIGHT', $sample_html, true);
        $res &= Configuration::updateValue('GDZ_CUSTOMHTML_TOP', $sample_html, true);
        $res &= Configuration::updateValue('GDZ_CUSTOMHTML_FOOTER', $footer_sample, true);
        $res &= Configuration::updateValue('GDZ_CUSTOMHTML_PRODUCTLEFT', $sample_html, true);
        $res &= Configuration::updateValue('GDZ_CUSTOMHTML_PRODUCTRIGHT', $sample_html, true);
        $res &= Configuration::updateValue('GDZ_CUSTOMHTML_HOME', $sample_html, true);
        return $res;
    }
}
