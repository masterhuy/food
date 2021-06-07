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
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzHelper.php');
class AdminGdzpagebuilderSettingController extends ModuleAdminController
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
        parent::__construct();
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
    }
    public function renderList()
    {
        $this->_html = '';
        /* Validate & process */
        if (Tools::isSubmit('submitSetting')) {
            if ($this->_postValidation()) {
                $this->_postProcess();
            }
        } else {
            $this->_html .= $this->renderSettingForm();
        }
        return $this->_html;
    }

    private function _postValidation()
    {
        return true;
    }

    private function _postProcess()
    {
        $errors = array();
        /* Processes*/
        if (Tools::isSubmit('submitSetting')) {
            $res = Configuration::updateValue('JPB_HOMEPAGE', (int)(Tools::getValue('JPB_HOMEPAGE')));
            $res &= Configuration::updateValue('JPB_RTL', (int)(Tools::getValue('JPB_RTL')));
            $res &= Configuration::updateValue('JPB_CONVERTURL', (int)(Tools::getValue('JPB_CONVERTURL')));
        }
        if (!$res) {
            $errors[] = $this->displayError($this->l('The configuration could not be updated.'));
        } else {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderSetting', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        }
    }

    public function renderSettingForm()
    {
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/setting.css', 'all');
        $pages = gdzPageBuilderHelper::getPages('1');
        $input_arr = array();
        $input_arr[] =  array(
                'type' => 'select',
                'label' => $this->l('Home Page'),
                'name' => 'JPB_HOMEPAGE',
                'options' => array('query' => $pages,'id' => 'id_page','name' => 'title'),
                'tab' => 'general'
            );
        $input_arr[] =  array(
                'type' => 'switch',
                'label' => $this->l('RTL'),
                'name' => 'JPB_RTL',
                'desc' => $this->l('Direction : Right to Left.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Enabled')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('Disabled'))
                ),
                'tab' => 'general'
            );
        $input_arr[] =  array(
                'type' => 'switch',
                'label' => $this->l('Editor Auto Convert URL'),
                'name' => 'JPB_CONVERTURL',
                'desc' => $this->l('Enable/Disable Auto Convert URL. Auto add site url to image src.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Enabled')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('Disabled'))
                ),
                'tab' => 'general'
            );
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Setting'),
                'icon' => 'icon-cogs'
            ),
            'tabs' => array('general' => 'General'),
            'input' => $input_arr,
            'submit' => array(
                'title' => $this->l('Save'),
                'name' => 'submitSetting'
            )
        );
        $this->tpl_folder = 'form/';
        $this->fields_value = $this->getConfigFieldsValues();
        return adminController::renderForm();
    }
    public function getConfigFieldsValues()
    {
        return array(
            'JPB_HOMEPAGE' => Tools::getValue('JPB_HOMEPAGE', Configuration::get('JPB_HOMEPAGE')),
            'JPB_RTL' => Tools::getValue('JPB_RTL', Configuration::get('JPB_RTL')),
            'JPB_CONVERTURL' => Tools::getValue('JPB_CONVERTURL', Configuration::get('JPB_CONVERTURL'))
        );
    }
}
