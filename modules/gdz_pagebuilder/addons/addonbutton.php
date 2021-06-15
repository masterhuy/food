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

class gdzAddonButton extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'button';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Button';
        $this->addondesc = 'Add Button';
        $this->type = 'Addons';
        $this->ordering = 7;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'text',
                'name' => 'button_text',
                'lang' => '1',
                'label' => $this->l('Button Text'),
                'default' => 'Button Text',
                'desc' => 'Button Text.',
            ),
            array(
                'type' => 'text',
                'name' => 'button_link',
                'label' => $this->l('Button Link'),
                'lang' => '0',
                'desc' => 'The absolute URL of the button that will be linked.',
                'default' => '#'
            ),
            array(
                'type' => 'select2',
                'name' => 'target',
                'label' => $this->l('Target for Link'),
                'lang' => '0',
                'options_name' => array('value','title'),
                'desc' => 'Open link in same or in new window',
                'options' => array(0 => array('value'=> '', 'title' => 'same window'), 1 => array('value'=> '_blank', 'title' => 'new window') ),
                'default' => ''
            ),
            array(
                'type' => 'select2',
                'name' => 'button_style',
                'label' => $this->l('Button Style'),
                'lang' => '0',
                'options_name' => array('value','title'),
                'desc' => 'Open link in same or in new window',
                'options' => array(0 => array('value'=> 'default', 'title' => 'Default'), 1 => array('value'=> 'success', 'title' => 'Success'), 2 => array('value'=> 'info', 'title' => 'Info'), 3 => array('value'=> 'warning', 'title' => 'Warning'), 4 => array('value'=> 'danger', 'title' => 'Danger') ),
                'default' => 'default'
            ),
            array(
                'type' => 'select2',
                'name' => 'button_size',
                'label' => $this->l('Button Size'),
                'lang' => '0',
                'options_name' => array('value','title'),
                'desc' => 'Open link in same or in new window',
                'options' => array(0 => array('value'=> 'xs', 'title' => 'Extra Small'), 1 => array('value'=> 'sm', 'title' => 'Small'), 2 => array('value'=> 'md', 'title' => 'Medium'), 3 => array('value'=> 'lg', 'title' => 'Large'), 4 => array('value'=> 'xl', 'title' => 'Extra Large') ),
                'default' => 'md'
            ),
            array(
                'type' => 'align',
                'name' => 'button_align',
                'lang' => '0',
                'justify' => 1,
                'label' => $this->l('Button Align'),
                'default' => 'left'
            ),
            array(
                'type' => 'text',
                'name' => 'box_class',
                'label' => $this->l('Box Class'),
                'lang' => '0',
                'desc' => 'Use this class to style for button box',
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
        $button_text = empty($addon->fields[0]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[0]->value->$id_lang);
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'button_text'  => $button_text,
                'button_link' => $addon->fields[1]->value,
                'target' => $addon->fields[2]->value,
                'button_style' => $addon->fields[3]->value,
                'button_size' => $addon->fields[4]->value,
                'button_align' => $addon->fields[5]->value,
                'box_class' => $addon->fields[6]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
