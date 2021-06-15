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

class gdzAddonCountdown extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'countdown';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Countdown';
        $this->addondesc = 'Easy to add Countdown Text';
        $this->type = 'Shop Addons';
        $this->ordering = 84;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'text',
                'name' => 'expire_time',
                'lang' => '0',
                'label' => $this->l('Expire Time'),
                'default' => '2025-05-05 12:00:00',
                'desc' => 'Select Expire Time. Format : yyyy-mm-dd h:i:s. Example :2025-05-05 12:00:00'
            ),
            array(
                'type' => 'screen-range',
                'name' => 'fontsize',
                'label' => $this->l('Font Size (px)'),
                'min'  => 8,
                'max'  => 100,
                'lang' => '0',
                'default' => '20-18-14',
            ),
            array(
                'type' => 'color',
                'name' => 'textcolor',
                'label' => $this->l('Text Color'),
                'lang' => '0',
                'default' => '',
            ),
            array(
                'type' => 'align',
                'name' => 'text_align',
                'lang' => '0',
                'justify' => 1,
                'label' => $this->l('Text Align'),
                'default' => 'center'
            ),
            array(
                'type' => 'text',
                'name' => 'box_class',
                'label' => $this->l('Box Class'),
                'lang' => '0',
                'desc' => 'Use this class to style for countdown box',
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
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'expire_time' => $addon->fields[0]->value,
                'box_class' => $addon->fields[4]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
