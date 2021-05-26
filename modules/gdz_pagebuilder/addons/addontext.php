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

class gdzAddonText extends gdzAddonBase
{
    public function __construct()
    {
        $this->modulename = _GDZ_PB_NAME_;
        $this->addonname = 'text';
        $this->addontitle = 'Text';
        $this->addondesc = 'Use to Add Text';
        $this->type = 'Addons';
        $this->ordering = 2;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'editor',
                'name' => 'content',
                'rows' => '40',
                'cols' => '60',
                'lang' => '1',
                'label' => $this->l('Text Content'),
                'default' =>'I am text block. Click edit button to change this text.'
            ),
            array(
                'type' => 'screen-range',
                'name' => 'fontsize',
                'label' => $this->l('Font Size (px)'),
                'min'  => 8,
                'max'  => 100,
                'lang' => '0',
                'default' => '14-12-10',
            ),
            array(
                'type' => 'color',
                'name' => 'textcolor',
                'label' => $this->l('Text Color'),
                'lang' => '0',
                'default' => ''
            ),
            array(
                'type' => 'align',
                'name' => 'text_align',
                'lang' => '0',
                'justify' => 1,
                'label' => $this->l('Text Align'),
                'default' => 'left'
            ),
        );
        return $inputs;
    }
    public function returnValue($addon)
    {
        $id_lang = $this->context->language->id;
        $content = empty($addon->fields[0]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[0]->value->$id_lang);
        if($content == '') return;
        $this->context->smarty->assign(
            array(
                'content' => $content
            )
        );
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
