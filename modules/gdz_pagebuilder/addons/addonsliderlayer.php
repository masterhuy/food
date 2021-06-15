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
if (Module::isInstalled('gdz_slider')) {
  include_once(_PS_MODULE_DIR_.'gdz_slider/classes/gdzSliderObject.php');
  include_once(_PS_MODULE_DIR_.'gdz_slider/classes/gdzSlideObject.php');
  include_once(_PS_MODULE_DIR_.'gdz_slider/classes/gdzLayerObject.php');
}
class gdzAddonSliderLayer extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'sliderlayer';
        $this->modulename = 'gdz_slider';
        $this->addontitle = 'Slider Layer';
        $this->addondesc = 'Show Slider Layer On Page';
        $this->type = 'Addons';
        $this->ordering = 12;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
      if (!Module::isInstalled('gdz_slider')) return;
      $sql = 'SELECT id_slider,title FROM `'._DB_PREFIX_.'gdz_slider_slider`
              WHERE `active` = 1 ORDER BY `order` ASC';
      $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
      $sql = 'SELECT id_slider FROM `'._DB_PREFIX_.'gdz_slider_slider`
              WHERE `active` = 1 ORDER BY `order` ASC';
      $default = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        $inputs = array(
            array(
                'type' => 'select2',
                'name' => 'slider_id',
                'label' => $this->l('Slider'),
                'lang' => '0',
                'desc' => 'Select Slider to Show.',
                'options' => $result,
                'options_name' => array('id_slider','title'),
                'default' => $default
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
        $slider_id = (int)$addon->fields[0]->value;

        if ($slider_id < 0) {
            return '';
        }
        $slider = new gdzSliderObject($slider_id);
        $slider->slides = $slider->getSlides(true);
        foreach ($slider->slides as $slide) {
            $slide->layers = $slide->getLayers();
        }
        $root_url = Tools::getHttpHost(true).__PS_BASE_URI__;
        $this->context->smarty->assign(
            array(
            'slider' => $slider,
            'root_url' => $root_url,
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
