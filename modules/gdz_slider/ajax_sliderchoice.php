<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Slider
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('controller/slidercontroller.php');
include_once('gdz_slider.php');

$module = new gdz_slider();

if (!Tools::isSubmit('secure_key') || Tools::getValue('secure_key') != $module->secure_key) {
    die(1);
}

$context = Context::getContext();
function getDisplay($id_slider)
{
    $sql = new DbQuery();
    $sql->select('s.id_slider, s.title');
    $sql->from('gdz_slider_slider', 's');
    $sql->where("s.id_slider = {$id_slider}");
    return Db::getInstance()->getRow($sql);
}
if (Tools::isSubmit('addHook')) {
    $res = array();
    $id_slider = (int)Tools::getValue('id_slider');
    $hooks = Tools::getValue('hooks');
    foreach ($hooks as $hook) {
        $sql = "INSERT INTO "._DB_PREFIX_."gdz_slider_slider_hook (id_slider, id_hook) VALUES ($id_slider, $hook)";
        $res[$hook] = Db::getInstance()->execute($sql);
    }
    die(Tools::jsonEncode($res));
} elseif (Tools::isSubmit('deleteHook')) {
    $res = false;
    $id_slider = (int)Tools::getValue('id_slider');
    $hook = Tools::getValue('hook');
    $sql = "DELETE FROM "._DB_PREFIX_."gdz_slider_slider_hook WHERE id_slider = {$id_slider} AND id_hook = {$hook}";
    $res = Db::getInstance()->execute($sql);
    die(Tools::jsonEncode(array('result' => $res)));
} elseif (Tools::isSubmit('addDisplay')) {
    $res = array();
    $sliders = Tools::getValue('sliders');
    if (!count($sliders)) {
        $res = array('result' => false);
        die(Tools::jsonEncode($res));
    }
    $hooks = Slider::getHooks();
    foreach ($sliders as $slider) {
        $display = getDisplay($slider);
        $display['position'] = '[{"id_hook":"5", "name":"displayHome"}]';
        $sql = "INSERT INTO "._DB_PREFIX_."gdz_slider_slider_hook (id_slider, id_hook) VALUES ({$slider}, 5)";
        try {
            $rs = Db::getInstance()->execute($sql);
        } catch (Exception $e) {
            $rs = false;
        }
        $context->smarty->assign(array(
            'display' => $display,
            'hooks' => $hooks
        ));
        if ($rs) {
            $html = $context->smarty->fetch(_PS_MODULE_DIR_ .'gdz_slider/views/templates/hook/display_row.tpl');
        } else {
            $html = '';
        }
        $res[] = array('slider' => $slider, 'result' => $rs, 'html' => $html);
    }
    die(Tools::jsonEncode($res));
} elseif (Tools::isSubmit('deleteDisplay')) {
    $res = false;
    $id_slider = (int)Tools::getValue('id_slider');
    $sql = "DELETE FROM "._DB_PREFIX_."gdz_slider_slider_hook WHERE id_slider = {$id_slider}";
    $res = Db::getInstance()->execute($sql);
    die(Tools::jsonEncode(array('result' => $res)));
}
