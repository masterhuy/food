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

class gdzAddonModule extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'module';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Module';
        $this->addondesc = 'Show Module content';
        $this->type = 'Addons';
        $this->ordering = 19;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
        $modulenames = array();
        $modulenames = gdzPageBuilderHelper::getModuleNames();
        $inputs = array(
            array(
                'type' => 'select',
                'name' => 'modulename',
                'label' => $this->l('Module Assign'),
                'lang' => '0',
                'desc' => 'Select Module Name for "Module Assign" Option.',
                'options' => $modulenames,
                'default' => ''
            ),
            array(
                'type' => 'select',
                'name' => 'modulehook',
                'label' => $this->l('Module Hook'),
                'lang' => '0',
                'desc' => 'Select Hook for Module Assign.',
                'options' => array('widget','displayTop','displayNav','displayTopColumn','displayHome','displayLeftColumn','displayRightColumn','displayFooter'),
                'default' => 'displayTop'
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
        $module_content = gdzPageBuilderHelper::execModule($addon->fields[1]->value, array(), $addon->fields[0]->value, $this->context->shop->id);
        $this->context->smarty->assign(
            array(
                'module_content' => $module_content
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
