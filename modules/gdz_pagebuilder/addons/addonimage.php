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

class gdzAddonImage extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'image';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Image';
        $this->addondesc = 'Easy to add Image';
        $this->type = 'Addons';
        $this->ordering = 1;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'image',
                'name' => 'image',
                'label' => $this->l('Image'),
                'lang' => '0',
                'default' => $this->plh_img
            ),
            array(
                'type' => 'text',
                'name' => 'alt_text',
                'label' => $this->l('Image Alt'),
                'lang' => '0',
                'desc' => 'Insert Alt text, which is an important for SEO purposes and part of making a site accessible.',
                'default' => 'Image Alt'
            ),
            array(
                'type' => 'text',
                'name' => 'image_link',
                'label' => $this->l('Image Link'),
                'lang' => '0',
                'desc' => 'The absolute URL of the image that will be linked.',
                'default' => '#'
            ),
            array(
                'type' => 'select2',
                'name' => 'target',
                'label' => $this->l('Target for Link'),
                'lang' => '0',
                'options_name' => array('value','title'),
                'desc' => 'Open link in same or in new window',
                'options' => array(0 => array('value'=> '', 'title' => 'same window'), 1 => array('value'=> '_blank', 'title' => 'new window') ),
                'default' => ''
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
    public function returnValue($addon)
    {
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'image'    => $addon->fields[0]->value,
                'alt_text'  => $addon->fields[1]->value,
                'image_link' => $addon->fields[2]->value,
                'target' => $addon->fields[3]->value,
                'box_class' => $addon->fields[4]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
