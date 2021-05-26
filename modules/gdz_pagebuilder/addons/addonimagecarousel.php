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

class gdzAddonImageCarousel extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'imagecarousel';
        $this->addontitle = 'Image Carousel';
        $this->addondesc = 'Show Images Carousel';
        $this->type = 'Addons';
        $this->ordering = 11;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'tab',
                'name' => 'carousel_images',
                'label' => $this->l('Carousel Images'),
                'lang' => '0',
                'open' => 1
            ),
            array(
                'type' => 'images',
                'name' => 'images',
                'label' => $this->l(''),
                'lang' => '0',
                'default' => array(),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'link_enable',
                'label' => $this->l('Link Enable'),
                'lang' => '0',
                'desc' => 'Enable/Disable Link',
                'default' => '0'
            ),
            array(
                'type' => 'tab',
                'name' => 'carousel_setting',
                'label' => $this->l('Carousel Setting'),
                'lang' => '0',
                'open' => 0
            ),
            array(
                'type' => 'screen-range',
                'name' => 'items_show',
                'label' => $this->l('Items Show'),
                'min'  => 1,
                'max'  => 8,
                'lang' => '0',
                'default' => '1-1-1',
            ),
            array(
                'type' => 'range',
                'name' => 'gutter',
                'label' => $this->l('Gutter Width (px)'),
                'min'  => 0,
                'max'  => 100,
                'lang' => '0',
                'desc' => 'Gutter between item Width',
                'default' => 30
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'navigation',
                'label' => $this->l('Show Navigation'),
                'lang' => '0',
                'desc' => 'Enable/Disable Navigation',
                'default' => '1'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'pagination',
                'label' => $this->l('Show Pagination'),
                'lang' => '0',
                'desc' => 'Enable/Disable Pagination',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'autoplay',
                'label' => $this->l('Auto Play'),
                'lang' => '0',
                'desc' => 'Enable/Disable Auto Play',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'rewind',
                'label' => $this->l('ReWind Navigation'),
                'lang' => '0',
                'desc' => 'Enable/Disable ReWind Navigation',
                'default' => '1'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'slidebypage',
                'label' => $this->l('Slide By Page'),
                'lang' => '0',
                'desc' => 'Enable/Disable Slide By Page',
                'default' => '0'
            ),
            array(
                'type' => 'text',
                'name' => 'overwrite_tpl',
                'label' => $this->l('Overwrite Tpl File'),
                'lang' => '0',
                'desc' => 'Use When you want overwrite template file'
            ),
        );
        return $inputs;
    }
    public function returnValue($addon)
    {
        $items_show = $addon->fields[2]->value;
        $items_show_arr = array();
        if($items_show)
            $items_show_arr = explode("-", $items_show);
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'images' => $addon->fields[0]->value,
                'items_show' => $items_show,
                'items_show_md' => $items_show_arr[0],
                'items_show_sm' => $items_show_arr[1],
                'items_show_xs' => $items_show_arr[2],
                'link_enable' => $addon->fields[1]->value,
                'navigation' => $addon->fields[4]->value,
                'pagination' => $addon->fields[5]->value,
                'autoplay' => $addon->fields[6]->value,
                'rewind' => $addon->fields[7]->value,
                'slidebypage' => $addon->fields[8]->value,
                'gutter' => $addon->fields[3]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
