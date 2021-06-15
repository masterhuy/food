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

class gdzAddonService extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'service';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Service Box';
        $this->addondesc = 'Create Customizable feature/service box';
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
                'name' => 'service_icon',
                'label' => $this->l('Service Icon'),
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
                'type' => 'tab',
                'name' => 'service_content',
                'label' => $this->l('Service Content'),
                'lang' => '0',
                'open' => 1
            ),
            array(
                'type' => 'text',
                'name' => 'title',
                'label' => $this->l('Title'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as heading title for service.',
                'default' => 'Service Title'
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
                'type' => 'editor',
                'name' => 'description',
                'rows' => '20',
                'cols' => '60',
                'lang' => '1',
                'label' => $this->l('Description'),
                'desc' => 'Enter text for the description.',
                'default' => 'I am text block. Click edit button to change this text'
            ),
            array(
                'type' => 'text',
                'name' => 'button_text',
                'label' => $this->l('Button Text'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as button text. Leave blank if no button is needed.',
                'default' => 'Read More'
            ),
            array(
                'type' => 'text',
                'name' => 'button_link',
                'label' => $this->l('Button Link'),
                'lang' => '0',
                'desc' => 'The absolute URL of the button that will be linked.',
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
        $title = empty($addon->fields[6]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[6]->value->$id_lang);
        $description = empty($addon->fields[8]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[8]->value->$id_lang);
        $button_text = empty($addon->fields[9]->value->$id_lang) ? '' : gdzPageBuilderHelper::decodeHTML($addon->fields[9]->value->$id_lang);
        $this->context->smarty->assign(
            array(
                'title' => $title,
                'title_tag'  => $addon->fields[7]->value,
                'box_class' => $addon->fields[13]->value,
                'icon_type' => $addon->fields[0]->value,
                'icon_class' => $addon->fields[1]->value,
                'icon_fontsize' => $addon->fields[2]->value,
                'image' => $addon->fields[3]->value,
                'image_width'  => $addon->fields[5]->value,
                'alt_text'  => $addon->fields[4]->value,
                'description' => $description,
                'button_text' => $button_text,
                'button_link' => $addon->fields[10]->value,
                'target' => $addon->fields[11]->value,
                'text_align' => $addon->fields[12]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
