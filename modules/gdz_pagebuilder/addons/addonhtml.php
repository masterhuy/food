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

class gdzAddonHtml extends gdzAddonBase
{
    public function __construct()
    {
        $this->modulename = _GDZ_PB_NAME_;
        $this->addonname = 'html';
        $this->addontitle = 'Html';
        $this->addondesc = 'Use to Add Html';
        $this->type = 'Addons';
        $this->ordering = 4;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'textarea',
                'name' => 'html_content',
                'rows' => '20',
                'cols' => '60',
                'lang' => '1',
                'label' => $this->l('Html Code'),
                'default' => 'I am <strong>html block</strong>. Enter html code here.'
            )
        );
        return $inputs;
    }
    public function returnValue($addon)
    {
        $id_lang = $this->context->language->id;
        $html_content = empty($addon->fields[0]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[0]->value->$id_lang);
        $this->context->smarty->assign(
            array(
                'html_content' => $html_content
            )
        );
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
