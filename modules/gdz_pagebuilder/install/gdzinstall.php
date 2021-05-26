<?php
/**
* 2007-2019 PrestaShop
*
* Jms Page Builder
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2019 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

include_once(_PS_MODULE_DIR_.'gdz_pagebuilder/classes/gdzPage.php');
class gdzPageBuilderInstall
{
    public function createTable()
    {
        $sql = array();
        $sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_pagebuilder`;
        CREATE TABLE `'._DB_PREFIX_.'gdz_pagebuilder` (
          `id_page` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
          `id_shop` int(10) UNSIGNED NOT NULL,
          PRIMARY KEY (`id_page`,`id_shop`)
        ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';
        $sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_pagebuilder_pages`;
        CREATE TABLE `'._DB_PREFIX_.'gdz_pagebuilder_pages` (
          `id_page` int(11) NOT NULL AUTO_INCREMENT,
          `css_file` varchar(30) NOT NULL,
          `js_file` varchar(30) NOT NULL,
          `page_class` varchar(100) NOT NULL,
          `params` mediumtext NOT NULL,
          `active` tinyint(1) NOT NULL,
          `ordering` int(11) NOT NULL,
          PRIMARY KEY (`id_page`)
        ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';
        $sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_pagebuilder_pages_lang`;
        CREATE TABLE `'._DB_PREFIX_.'gdz_pagebuilder_pages_lang` (
          `id_page` int(10) UNSIGNED NOT NULL,
          `id_lang` int(10) UNSIGNED NOT NULL,
          `title` varchar(100) NOT NULL,
          `alias` varchar(255) NOT NULL,
          `meta_desc` varchar(255) NOT NULL,
          `meta_key` varchar(255) NOT NULL,
          `key_ref` varchar(255) NOT NULL,
          PRIMARY KEY (`id_page`,`id_lang`)
        ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
        $sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_pagebuilder_templates`;
        CREATE TABLE `'._DB_PREFIX_.'gdz_pagebuilder_templates` (
          `id_template` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(200) NOT NULL,
          `params` mediumtext NOT NULL,
          PRIMARY KEY (`id_template`)
        ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';
        foreach ($sql as $s) {
            if (!Db::getInstance()->execute($s)) {
                return false;
            }
        }
    }
    public function _addPage($title, $importfile, $ordering, $css_file = '', $js_file = '', $page_class = '')
    {
        $page = new gdzPage();
        $alias = $title;
        $alias    = preg_replace('/[^a-z A-Z0-9-]*/', '', $alias);
        $alias    = preg_replace('/-{2,}/', '-', $alias);
        $alias    = preg_replace('/ /', '-', $alias);
        $alias    = trim(Tools::strtolower($alias));
        $alias    = ltrim($alias, '-');
        $alias    = rtrim($alias, '-');
        $languages = Language::getLanguages(false);
        foreach ($languages as $language) {
            $page->title[$language['id_lang']] = $title;
            $page->alias[$language['id_lang']] = $alias;
        }
        $page->css_file = $css_file;
        $page->js_file = $js_file;
        $page->page_class = $page_class;
        $page->ordering = $ordering;
        $page->active = 1;
        $jsonfile = fopen(_PS_MODULE_DIR_.'/gdz_pagebuilder/json/'.$importfile, "r") or die("Unable to open file!");
        $jsontext = fread($jsonfile, filesize(_PS_MODULE_DIR_.'/gdz_pagebuilder/json/'.$importfile));
        $jsontext = str_replace('/prestashop17/befer2/', __PS_BASE_URI__, $jsontext);
        $page->params = $jsontext;
        $page->add();
        return $page->id;
    }
    public function installDemo()
    {
        $page1_id = $this->_addPage('Basic - Home Page', 'home_1.json', 0, 'home1.css', 'home1.js', '');
    		Configuration::updateValue('JPB_HOMEPAGE', $page1_id);
    }
}
