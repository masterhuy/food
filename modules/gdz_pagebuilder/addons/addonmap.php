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

class gdzAddonMap extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'map';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Google Map';
        $this->addondesc = 'Add Map location to your site';
        $this->type = 'Addons';
        $this->ordering = 18;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'text',
                'name' => 'address',
                'label' => $this->l('Address'),
                'lang' => '0',
                'desc' => 'Enter your shop address to here to get map show.',
                'default' => 'London, England'
            ),
            array(
                'type' => 'range',
                'name' => 'height',
                'label' => $this->l('Height (px)'),
                'min'  => 50,
                'max'  => 1500,
                'lang' => '0',
                'default' => '460'
            ),
            array(
                'type' => 'range',
                'name' => 'zoom',
                'label' => $this->l('Zoom'),
                'min'  => 1,
                'max'  => 20,
                'lang' => '0',
                'default' => '12'
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
        if($addon->fields[0]->value == '') return;
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'address'    => $addon->fields[0]->value,
                'height'  => $addon->fields[1]->value,
                'zoom' => $addon->fields[2]->value,
                'box_class' => $addon->fields[4]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
