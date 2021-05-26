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

class gdzAddonBanner extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'banner';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Image Banner';
        $this->addondesc = 'Easy to add Banner Image';
        $this->type = 'Addons';
        $this->ordering = 3;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
    }
    public function getInputs()
    {
        $inputs = array(
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
                'type' => 'screen-range',
                'name' => 'subtitle_fontsize',
                'label' => $this->l('SubTitle - Font Size (px)'),
                'min'  => 8,
                'max'  => 100,
                'lang' => '0',
                'default' => '14-12-10',
            ),
            array(
                'type' => 'screen-range',
                'name' => 'subtitle_lineheight',
                'label' => $this->l('SubTitle - Line Height (px)'),
                'min'  => 8,
                'max'  => 100,
                'lang' => '0',
                'default' => '21-18-15',
            ),
            array(
                'type' => 'color',
                'name' => 'subtitle_color',
                'label' => $this->l('SubTitle - Color'),
                'lang' => '0',
                'default' => ''
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
                'label' => $this->l('Title - Html Tag'),
                'lang' => '0',
                'desc' => 'Choose html tag for title',
                'options' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span' , 'p'),
                'default' => 'h5'
            ),
            array(
                'type' => 'screen-range',
                'name' => 'title_fontsize',
                'label' => $this->l('Title - Font Size (px)'),
                'min'  => 8,
                'max'  => 100,
                'lang' => '0',
                'default' => '16-14-12',
            ),
            array(
                'type' => 'screen-range',
                'name' => 'title_lineheight',
                'label' => $this->l('Title - Line Height (px)'),
                'min'  => 8,
                'max'  => 100,
                'lang' => '0',
                'default' => '24-21-18',
            ),
            array(
                'type' => 'color',
                'name' => 'title_color',
                'label' => $this->l('Title - Color'),
                'lang' => '0',
                'default' => ''
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
                'type' => 'screen-range',
                'name' => 'description_fontsize',
                'label' => $this->l('Description - Font Size (px)'),
                'min'  => 8,
                'max'  => 100,
                'lang' => '0',
                'default' => '14-12-10',
            ),
            array(
                'type' => 'screen-range',
                'name' => 'description_lineheight',
                'label' => $this->l('Description - Line Height (px)'),
                'min'  => 8,
                'max'  => 100,
                'lang' => '0',
                'default' => '21-18-15',
            ),
            array(
                'type' => 'color',
                'name' => 'description_color',
                'label' => $this->l('Description - Color'),
                'lang' => '0',
                'default' => ''
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
                'type' => 'select',
                'name' => 'content_position',
                'label' => $this->l('Content Position(Vertical - Horizontal)'),
                'lang' => '0',
                'desc' => 'Position of Content',
                'options' => array('top-left', 'top-right', 'top-center', 'center-left', 'center-right', 'bottom-left', 'bottom-right', 'bottom-center', 'center-center'),
                'default' => 'bottom-left'
            ),
            array(
                'type' => 'screen-range',
                'name' => 'v_offset',
                'label' => $this->l('Vertical Offset (px)'),
                'min'  => 0,
                'max'  => 500,
                'lang' => '0',
                'default' => '20-20-20'
            ),
            array(
                'type' => 'screen-range',
                'name' => 'h_offset',
                'label' => $this->l('Horizontal Offset (px)'),
                'min'  => 0,
                'max'  => 500,
                'lang' => '0',
                'default' => '20-20-20'
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
        //print_r($addon); exit;
        $id_lang = $this->context->language->id;
        $subtitle = empty($addon->fields[2]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[2]->value->$id_lang);
        $_title = empty($addon->fields[6]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[6]->value->$id_lang);
        $description = empty($addon->fields[11]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[11]->value->$id_lang);
        $button_text = empty($addon->fields[15]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[15]->value->$id_lang);
        $box_class = '';
        if(isset($addon->fields[22]->value) && $addon->fields[16]->value) $box_class = $addon->fields[22]->value;
        $banner_link = empty($addon->fields[16]->value) ? '' : $addon->fields[16]->value;
        $target = empty($addon->fields[17]->value) ? '' : $addon->fields[17]->value;
        $position = empty($addon->fields[18]->value) ? '' : $addon->fields[18]->value;
        $title_tag = $addon->fields[7]->value;
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'banner'    => $addon->fields[0]->value,
                'alt_text'  => $addon->fields[1]->value,
                'subtitle'  => $subtitle,
                'title'  => $_title,
                'title_tag'  => $title_tag,
                'description'  => $description,
                'button_text'  => $button_text,
                'banner_link' => $banner_link,
                'target' => $target,
                'position' => $position,
                'box_class' => $box_class
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
