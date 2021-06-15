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
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonbase.php');

class gdzAddonPopup extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'popup';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Popup';
        $this->addondesc = 'Show Popup Advertising';
        $this->type = 'Addons';
        $this->ordering = 17;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
    }
    public function getInputs()
    {
        $modulenames = array();
        $modulenames = gdzPageBuilderHelper::getModuleNames();
        $inputs = array(
            array(
                'type' => 'text',
                'name' => 'popup_title',
                'label' => $this->l('Popup Title'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as addon title. Leave blank if no title is needed.',
                'default' => 'Popup Title'
            ),
            array(
                'type' => 'select',
                'name' => 'loadtime',
                'label' => $this->l('Popup Load On'),
                'lang' => '0',
                'desc' => 'Popup will load on First Time Load or all Time',
                'options' => array('firstload', 'alltime'),
                'default' => 'firstload'
            ),
            array(
                'type' => 'select',
                'name' => 'pageshow',
                'label' => $this->l('Popup Show On Page'),
                'lang' => '0',
                'desc' => 'Popup Show On Home page or All Page',
                'options' => array('homepage', 'allpage'),
                'default' => 'allpage'
            ),
            array(
                'type' => 'select',
                'name' => 'popuptype',
                'label' => $this->l('Popup Content Type'),
                'lang' => '0',
                'desc' => 'Popup Content Type : Custom Html or Module Assign',
                'options' => array('custom_html', 'module'),
                'default' => 'custom_html'
            ),
            array(
                'type' => 'editor',
                'name' => 'html_content',
                'rows' => '20',
                'cols' => '60',
                'lang' => '1',
                'label' => $this->l('Html Content'),
                'desc' => 'Enter texts for the content.',
                'default' => 'I am text block. Click edit button to change this text',
                'condition' => array(
                    'popuptype' => '==custom_html'
                ),
            ),
            array(
                'type' => 'select',
                'name' => 'modulename',
                'label' => $this->l('Module Assign'),
                'lang' => '0',
                'desc' => 'Select Module Name for "Module Assign" Option.',
                'options' => $modulenames,
                'default' => $modulenames,
                'condition' => array(
                    'popuptype' => '==module'
                ),
            ),
            array(
                'type' => 'select',
                'name' => 'modulehook',
                'label' => $this->l('Module Hook'),
                'lang' => '0',
                'desc' => 'Select Hook for Module Assign.',
                'options' => array('widget','displayTop','displayNav','displayTopColumn','displayHome','displayLeftColumn','displayRightColumn','displayFooter'),
                'default' => 'displayTop',
                'condition' => array(
                    'popuptype' => '==module'
                ),
            ),
            array(
                'type' => 'text',
                'name' => 'popup_width',
                'label' => $this->l('Popup Width'),
                'lang' => '0',
                'desc' => 'Popup Width in px(pixel)',
                'default' => '700'
            ),
            array(
                'type' => 'text',
                'name' => 'popup_height',
                'label' => $this->l('Popup Height'),
                'lang' => '0',
                'desc' => 'Popup Height in px(pixel)',
                'default' => '500'
            ),

            array(
                'type' => 'text',
                'name' => 'overwrite_tpl',
                'label' => $this->l('Overwrite Tpl File'),
                'lang' => '0',
                'desc' => 'Use When you want overwrite template file'
            )
        );
        return $inputs;
    }
    public function returnValue($addon)
    {
        if (file_exists(_PS_THEME_DIR_.'js/modules/'._GDZ_PB_NAME_.'/views/js/popupadvertising.js')) {
            $this->context->controller->addJS($this->root_url.'themes/'._THEME_NAME_.'/js/modules/'._GDZ_PB_NAME_.'/views/js/popupadvertising.js', 'all');
        } else {
            $this->context->controller->addJS($this->root_url.'modules/'._GDZ_PB_NAME_.'/views/js/popupadvertising.js', 'all');
        }
        $this->context = Context::getContext();
        $id_shop = $this->context->shop->id;
        $id_lang = $this->context->language->id;
        $pageshow = $addon->fields[2]->value;
        if ($pageshow == 'homepage') {
            if (!isset($this->context->controller->php_self) || $this->context->controller->php_self != 'index') {
                return;
            }
        }
        $popuptype = $addon->fields[3]->value;
        if ($popuptype == 'module') {
            $popup_content = gdzPageBuilderHelper::execModule($addon->fields[6]->value, array(), $addon->fields[5]->value, $id_shop);
        } else {
            $popup_content = gdzPageBuilderHelper::decodeHTML($addon->fields[4]->value->$id_lang);
        }
        $popup_title = empty($addon->fields[0]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[0]->value->$id_lang);

        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'popup_title' => $popup_title,
                'loadtime' => $addon->fields[1]->value,
                'popup_width' => $addon->fields[7]->value,
                'popup_height' => $addon->fields[8]->value,
                'popup_content' => $popup_content
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
