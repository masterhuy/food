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

class gdzPage extends ObjectModel
{
    public $title;
    public $alias;
    public $meta_desc;
    public $meta_key;
    public $key_ref;
    public $css_file;
    public $js_file;
    public $page_class;
    public $params;
    public $active;
    public $ordering;

    public static $definition = array(
        'table' => 'gdz_pagebuilder_pages',
        'primary' => 'id_page',
        'multilang' => true,
        'fields' => array(
            'title'         =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 255),
            'alias'         =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 255),
            'meta_desc'     =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 500),
            'meta_key'      =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 500),
            'key_ref'       =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 200),
            'css_file'      =>  array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 30),
            'js_file'       =>  array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 30),
            'page_class'    =>  array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 100),
            'params'        =>  array('type' => self::TYPE_HTML, 'validate' => '', 'size' => 500000),
            'active'        =>  array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'ordering'      =>  array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt'),
        )
    );

    public function __construct($id_page = null, $id_lang = null, $id_shop = null)
    {
        parent::__construct($id_page, $id_lang, $id_shop);
    }

    public function add($autodate = true, $null_values = false)
    {
        $res = true;
        $context = Context::getContext();
        $id_shop = $context->shop->id;

        $res = parent::add($autodate, $null_values);
        $res &= Db::getInstance()->execute('INSERT INTO `'._DB_PREFIX_.'gdz_pagebuilder` (`id_page`,`id_shop` ) VALUES('.(int)$this->id.','.(int)$id_shop.')');
        return $res;
    }

    public function delete()
    {
        $res = true;
        $res &= parent::delete();
        return $res;
    }
    public function duplicateObject() {
      $context = Context::getContext();
      $id_shop = $context->shop->id;
      $duplicatePage = parent::duplicateObject();
      Db::getInstance()->execute('INSERT INTO `'._DB_PREFIX_.'gdz_pagebuilder` (`id_page`,`id_shop` ) VALUES('.(int)$duplicatePage->id.','.(int)$id_shop.')');
      return $duplicatePage;
    }
}
