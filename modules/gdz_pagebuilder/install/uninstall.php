<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Pagebuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

$sql = array();
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_pagebuilder`';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_pagebuilder_pages`';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_pagebuilder_pages_lang`';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_pagebuilder_templates`';
