<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Blog
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

include_once('../../config/config.inc.php');
include_once('../../init.php');

$context = Context::getContext();
$rows = array();
if (Tools::getValue('action') == 'updateCategoryOrdering' && Tools::getValue('categories')) {
    $categories = Tools::getValue('categories');

    foreach ($categories as $position => $id_category) {
        $sql = '
            UPDATE `'._DB_PREFIX_.'gdz_blog_categories` SET `ordering` = '.(int)$position.'
            WHERE `category_id` = '.(int)$id_category;
        $res = Db::getInstance()->execute($sql);
    }
}
