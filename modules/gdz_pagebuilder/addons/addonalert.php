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

class gdzAddonAlert extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'alert';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Alert Box';
        $this->addondesc = 'Create Alert Text Box: Success/Warning/Info/Danger';
        $this->type = 'Addons';
        $this->ordering = 22;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'select',
                'name' => 'alert_type',
                'label' => $this->l('Alert Type'),
                'lang' => '0',
                'desc' => 'Alert Box Type',
                'options' => array('success', 'info','warning','danger'),
                'default' => 'info'
            ),
            array(
                'type' => 'editor',
                'name' => 'alert_message',
                'rows' => '20',
                'cols' => '60',
                'lang' => '1',
                'label' => $this->l('Alert Message'),
                'desc' => 'Enter texts for the content.',
                'default' => 'I am content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_close_btn',
                'label' => $this->l('Show Close Button'),
                'lang' => '0',
                'desc' => 'Show/Hide Close Button',
                'default' => '1'
            ),
            array(
                'type' => 'text',
                'name' => 'box_class',
                'label' => $this->l('Box Class'),
                'lang' => '0',
                'desc' => 'Use this class to style for alert box',
                'default' => ''
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
        $id_lang = $this->context->language->id;
        $alert_message = empty($addon->fields[1]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[1]->value->$id_lang);
        $this->context->smarty->assign(
            array(
                'box_class' => $addon->fields[3]->value,
                'alert_type' => $addon->fields[0]->value,
                'alert_message' => $alert_message,
                'show_close_btn' => $addon->fields[2]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
