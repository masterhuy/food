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

class gdzAddonSocial extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'social';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Social Icon';
        $this->addondesc = 'Social Icons for your site';
        $this->type = 'Addons';
        $this->ordering = 10;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'social',
                'name' => 'socials',
                'label' => $this->l('Socials'),
                'lang' => '0',
                'default' => array(),
            ),
            array(
                'type' => 'select',
                'name' => 'icon_shape',
                'label' => $this->l('Icon Shape'),
                'lang' => '0',
                'desc' => 'Icon Shape from select list.',
                'options' => array('rounded', 'square','circle'),
                'default' => 'rounded'
            ),
            array(
                'type' => 'align',
                'name' => 'icon_align',
                'lang' => '0',
                'label' => $this->l('Icon Align'),
                'default' => 'center'
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
        $this->context->smarty->assign(array(
            'socials' => $addon->fields[0]->value,
            'icon_shape' => $addon->fields[1]->value,
            'icon_align' => $addon->fields[2]->value
        ));
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
