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

class gdzAddonIcon extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'icon';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Icon Box';
        $this->addondesc = 'Add Icon box';
        $this->type = 'Addons';
        $this->ordering = 8;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'tab',
                'name' => 'icon_setting',
                'label' => $this->l('Icon Setting'),
                'lang' => '0',
                'open' => 1
            ),
            array(
                'type' => 'select',
                'name' => 'icon_type',
                'label' => $this->l('Icon Type'),
                'lang' => '0',
                'desc' => 'Icon or Image Type from select list.',
                'options' => array('icon', 'image'),
                'default' => 'icon'
            ),
            array(
                'type' => 'text',
                'name' => 'icon_class',
                'label' => $this->l('Icon Class'),
                'lang' => '0',
                'desc' => 'Enter Icon Class. example : "fa fa-truck" ...',
                'default' => 'fa fa-truck',
                'condition' => array(
                    'icon_type' => '==icon'
                ),
            ),
            array(
                'type' => 'range',
                'name' => 'icon_fontsize',
                'label' => $this->l('Icon Font Size (px)'),
                'min'  => 5,
                'max'  => 50,
                'lang' => '0',
                'default' => '30',
                'condition' => array(
                    'icon_type' => '==icon'
                ),
            ),
            array(
                'type' => 'image',
                'name' => 'image',
                'label' => $this->l('Icon Image'),
                'lang' => '0',
                'default' => $this->plh_img,
                'condition' => array(
                    'icon_type' => '==image'
                ),
            ),
            array(
                'type' => 'text',
                'name' => 'alt_text',
                'label' => $this->l('Image Alt'),
                'lang' => '0',
                'desc' => 'Insert Alt text, which is an important for SEO purposes and part of making a site accessible.',
                'default' => 'Image Alt',
                'condition' => array(
                    'icon_type' => '==image'
                ),
            ),
            array(
                'type' => 'range',
                'name' => 'image_width',
                'label' => $this->l('Image Width (%)'),
                'min'  => 10,
                'max'  => 100,
                'lang' => '0',
                'default' => '25',
                'condition' => array(
                    'icon_type' => '==image'
                ),
            ),
            array(
                'type' => 'align',
                'name' => 'text_align',
                'lang' => '0',
                'label' => $this->l('Text Align'),
                'default' => 'center'
            ),
            array(
                'type' => 'text',
                'name' => 'box_class',
                'label' => $this->l('Box Class'),
                'lang' => '0',
                'desc' => 'Use this class to style for feature/service box',
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
                'box_class' => $addon->fields[7]->value,
                'icon_type' => $addon->fields[0]->value,
                'icon_class' => $addon->fields[1]->value,
                'icon_fontsize' => $addon->fields[2]->value,
                'image' => $addon->fields[3]->value,
                'alt_text' => $addon->fields[4]->value,
                'image_width'  => $addon->fields[5]->value,
                'text_align' => $addon->fields[6]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
