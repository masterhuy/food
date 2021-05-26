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

class gdzAddonHeading extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'heading';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Heading';
        $this->addondesc = 'Heading';
        $this->type = 'Addons';
        $this->ordering = 0;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'text',
                'name' => 'heading',
                'lang' => '1',
                'label' => $this->l('Heading Text'),
                'default' => 'This is the heading',
                'desc' => 'Enter Title text for Heading'
            ),
            array(
                'type' => 'select',
                'name' => 'heading_tag',
                'label' => $this->l('Heading Html Tag'),
                'lang' => '0',
                'desc' => 'Choose html tag for title',
                'options' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span' , 'p'),
                'default' => 'h5'
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
                'name' => 'headingcolor',
                'label' => $this->l('Heading Color'),
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
                'desc' => 'Use this class to style for banner box',
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
    public function returnValue($addon, $id_lang = null)
    {
        if($id_lang == null)
          $id_lang = $this->context->language->id;
        $heading = empty($addon->fields[0]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[0]->value->$id_lang);
        if($heading == '') return;
        $this->context->smarty->assign(
            array(
                'heading'  => $heading,
                'heading_tag'  => $addon->fields[1]->value,
                'box_class' => $addon->fields[5]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
