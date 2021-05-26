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
if (Module::isInstalled('gdz_reels')) {
  include_once(_PS_MODULE_DIR_.'gdz_reels/object/Reel.php');
}
class gdzAddonReel extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'reel';
        $this->modulename = 'gdz_reels';
        $this->addontitle = 'Reels';
        $this->addondesc = 'Reels';
        $this->type = 'Addons';
        $this->ordering = 14;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
      if (!Module::isInstalled('gdz_reels')) return;
      $sql = 'SELECT id_reel,name FROM `'._DB_PREFIX_.'gdz_reel`
              ORDER BY `id_reel` ASC';
      $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
      $sql = 'SELECT id_reel FROM `'._DB_PREFIX_.'gdz_reel`
              ORDER BY `id_reel` ASC';
      $default = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        $inputs = array(
            array(
                'type' => 'select2',
                'name' => 'id_reel',
                'label' => $this->l('Reel'),
                'lang' => '0',
                'desc' => 'Select Slider to Show.',
                'options' => $result,
                'options_name' => array('id_reel','name'),
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
        $id_reel = (int)$addon->fields[0]->value;

        if ($id_reel <= 0) {
            return 'Reel not found';
        }
        $reel = new gdzReel($id_reel);
        $video = $reel->getVideo();
        if (!$video['success']) {
            return $video['err'];
        }
        $reel->video = $video;
        $reel->getLookBook();
        $id_lang = $this->context->language->id;
        $this->context->smarty->assign(
            array(
                'reel' => $reel,
                'id_lang' => $id_lang,
                'link' => $this->context->link,
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
