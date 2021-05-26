<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Wishlist
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

$sql = array();
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_wishlist`';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_wishlist_email`';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_wishlist_product`';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_wishlist_product_cart`';
foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
