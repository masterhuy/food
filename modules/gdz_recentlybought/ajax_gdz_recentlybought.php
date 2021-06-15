<?php
/**
* 2007-2020 PrestaShop
*
* Prestashop Recently Bought
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('classes/gdzRBHelper.php');
include_once('gdz_recentlybought.php');

$module = new gdz_recentlybought();
if (Tools::isSubmit('action') &&
    Tools::isSubmit('_token') &&
    Tools::getValue('_token') == $module->secure_key) {
    $helper = new gdzRBHelper();
    $products = $helper->getProducts(true);
    die(Tools::jsonEncode($products));
} else {
    die('Access Denied');
}
