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
class gdzAddonAccordion extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'accordion';
        $this->addontitle = 'Accordion';
        $this->addondesc = 'Show accordion';
        $this->type = 'Addons';
        $this->ordering = 21;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'accordion',
                'name' => 'accordions',
                'label' => $this->l('Accordion'),
                'lang' => '0',
                'default' => array(),
            ),
            array(
                'type' => 'text',
                'name' => 'overwrite_tpl',
                'label' => $this->l('Overwrite Tpl File'),
                'lang' => '0',
                'desc' => 'Use When you want overwrite template file'
            ),
        );
        return $inputs;
    }
    public function returnValue($addon)
    {
        $this->context->smarty->assign(
            array(
                'accordions' => $addon->fields[0]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
