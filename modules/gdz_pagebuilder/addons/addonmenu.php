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
if (Module::isInstalled('gdz_megamenu')) {
    include_once(_PS_MODULE_DIR_.'gdz_megamenu/classes/gdzMegamenuHelper.php');
}
class gdzAddonMenu extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'menu';
        $this->modulename = 'gdz_megamenu';
        $this->addontitle = 'Menu';
        $this->addondesc = 'Display Menu On Frontpage';
        $this->type = 'Addons';
        $this->ordering = 20;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        $this->_items = array();
        $this->gens = array();
    }
    public function getInputs()
    {
        if (!Module::isInstalled('gdz_megamenu'))  return;
        $gdzhelper = new gdzMegamenuHelper();
        $menus = $gdzhelper->getMenus();
        $inputs = array(
            array(
                'type' => 'select2',
                'name' => 'menu_id',
                'label' => $this->l('Select Menu to Show'),
                'lang' => '0',
                'desc' => 'Select Menu to Show.',
                'options' => $menus,
                'options_name' => array('menu_id','name'),
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
        $menu_id = $addon->fields[0]->value;
        $gdzhelper = new gdzMegamenuHelper();
        $menu_html = $gdzhelper->returnMenu($menu_id);

        $this->context->smarty->assign(
            array(
                'menu_html' => $menu_html
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
