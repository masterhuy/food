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

class gdzAddonSpacer extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'spacer';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Empty Spacer';
        $this->addondesc = 'Add Empty Spacer To Layout';
        $this->type = 'Addons';
        $this->ordering = 6;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'screen-range',
                'name' => 'space',
                'label' => $this->l('Space (px)'),
                'lang' => '0',
                'desc' => 'Set the gap for space(Height of Space).',
                'min' => 0,
                'max' => 200,
                'default' => '50-40-30',
                'css_tag' => '.pb-spacer-inner'
            ),
            array(
                'type' => 'text',
                'name' => 'box_class',
                'label' => $this->l('Box Class'),
                'lang' => '0',
                'desc' => 'Use this class to style for space box',
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
                'link' => $this->context->link,
                'space' => $addon->fields[0]->value,
                'box_class' => $addon->fields[1]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
