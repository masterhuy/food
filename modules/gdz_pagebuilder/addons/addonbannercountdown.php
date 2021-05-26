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

class gdzAddonBannerCountdown extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'bannercountdown';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Banner Countdown';
        $this->addondesc = 'Easy to add Banner + Countdown';
        $this->type = 'Shop Addons';
        $this->ordering = 85;
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
                'type' => 'tab',
                'name' => 'banner_image',
                'label' => $this->l('Banner Image'),
                'lang' => '0',
                'open' => 1
            ),
            array(
                'type' => 'image',
                'name' => 'banner',
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
                'type' => 'tab',
                'name' => 'banner_content',
                'label' => $this->l('Banner Content'),
                'lang' => '0'
            ),
            array(
                'type' => 'text',
                'name' => 'subtitle',
                'lang' => '1',
                'label' => $this->l('Subtitle'),
                'default' => 'Subtitle text',
                'desc' => 'Enter subtitle text for banner'
            ),
            array(
                'type' => 'text',
                'name' => 'title',
                'lang' => '1',
                'label' => $this->l('Title'),
                'default' => 'This is the heading',
                'desc' => 'Enter Title text for banner'
            ),
            array(
                'type' => 'select',
                'name' => 'title_tag',
                'label' => $this->l('Title Html Tag'),
                'lang' => '0',
                'desc' => 'Choose html tag for title',
                'options' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span' , 'p'),
                'default' => 'h5'
            ),
            array(
                'type' => 'textarea',
                'name' => 'description',
                'rows' => '20',
                'cols' => '60',
                'lang' => '1',
                'label' => $this->l('Description'),
                'default' => 'I am text block. Click edit button to change this text.',
                'desc' => 'Enter description text for banner'
            ),
            array(
                'type' => 'text',
                'name' => 'button_text',
                'lang' => '1',
                'label' => $this->l('Button Text'),
                'default' => 'View',
                'desc' => 'Button Text.',
            ),
            array(
                'type' => 'text',
                'name' => 'banner_link',
                'label' => $this->l('Banner Link'),
                'lang' => '0',
                'desc' => 'The absolute URL of the banner that will be linked.',
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
                'label' => $this->l('Banner Class'),
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
        $id_lang = $this->context->language->id;
        $subtitle = empty($addon->fields[3]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[3]->value->$id_lang);
        $title = empty($addon->fields[4]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[4]->value->$id_lang);
        $description = empty($addon->fields[6]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[6]->value->$id_lang);
        $button_text = empty($addon->fields[7]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[7]->value->$id_lang);
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'banner'    => $addon->fields[1]->value,
                'alt_text'  => $addon->fields[2]->value,
                'expire_time' => $addon->fields[0]->value,
                'subtitle'  => $subtitle,
                'title'  => $title,
                'title_tag'  => $addon->fields[5]->value,
                'description'  => $description,
                'button_text'  => $button_text,
                'banner_link' => $addon->fields[8]->value,
                'target' => $addon->fields[9]->value,
                'box_class' => $addon->fields[10]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
