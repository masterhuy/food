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
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzHelper.php');

class gdzAddonGrid extends gdzAddonBase
{
    public static $index = 0;
    public function __construct()
    {
        $this->modulename = _GDZ_PB_NAME_;
        $this->addonname = 'grid';
        $this->addontitle = 'grid';
        $this->addondesc = 'Grid';
        $this->type = 'Addons';
        $this->ordering = 86;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        self::$index++;
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'screen-grid',
                'responsive' => true,
                'name' => 'grid_column',
                'label' => $this->l('Column'),
                'lang' => '0',
                'default' => '4,4,4-12,12,12-12,12,12'
            ),
            // array(
            //     'type' => 'range',
            //     'name' => 'gutter',
            //     'label' => $this->l('margin'),
            //     'min'  => 1,
            //     'max'  => 5,
            //     'lang' => '0',
            //     'default' => '1'
            // )
        );
        return $inputs;
    }
    public function returnValue($addon)
    {
        if(!isset($addon->grid)) return;
        foreach ($addon->grid as $key => $col) {
            foreach ($col->addons as $add) {
                $add->return_value = gdzPageBuilderHelper::loadAddon($add);
            }
        }
        $this->context->smarty->assign(
            array(
                'grid' => $addon->grid,
            )
        );
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
