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

class gdzAddonDivider extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'divider';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Divider';
        $this->addondesc = 'Easy to create Divider';
        $this->type = 'Addons';
        $this->ordering = 5;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'range',
                'name' => 'divider_gap',
                'label' => $this->l('Gap (px)'),
                'min'  => 1,
                'max'  => 100,
                'lang' => '0',
                'default' => '10'
            ),
            array(
                'type' => 'select',
                'name' => 'divider_style',
                'label' => $this->l('Divider Style'),
                'lang' => '0',
                'desc' => 'Divider Style',
                'options' => array('solid', 'double','dotted','dashed'),
                'default' => 'solid'
            ),
            array(
                'type' => 'color',
                'name' => 'divider_color',
                'label' => $this->l('Divider Color'),
                'lang' => '0',
                'desc' => 'Divider Color',
                'default' => ''
            ),
            array(
                'type' => 'range',
                'name' => 'divider_weight',
                'label' => $this->l('Weight (px)'),
                'min'  => 1,
                'max'  => 10,
                'lang' => '0',
                'default' => '1'
            ),
            array(
                'type' => 'range',
                'name' => 'divider_width',
                'label' => $this->l('Divider Width(%)'),
                'min'  => 1,
                'max'  => 100,
                'lang' => '0',
                'default' => '40'
            ),
            array(
                'type' => 'align',
                'name' => 'divider_align',
                'lang' => '0',
                'label' => $this->l('Divider Align'),
                'default' => 'center'
            ),
            array(
                'type' => 'text',
                'name' => 'box_class',
                'label' => $this->l('Box Class'),
                'lang' => '0',
                'desc' => 'Use this class to style for box',
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
        $this->context->smarty->assign(
            array(
                'divider_gap' => $addon->fields[0]->value,
                'divider_style' => $addon->fields[1]->value,
                'divider_color' => $addon->fields[2]->value,
                'divider_weight' => $addon->fields[3]->value,
                'divider_width' => $addon->fields[4]->value,
                'divider_align' => $addon->fields[5]->value,
                'box_class' => $addon->fields[6]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
