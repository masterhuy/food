<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla MegaMenu
*
*  @author    Godzilla<joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

class gdzMenu extends ObjectModel
{
    public $name;
    public $id_shop;
    public $active;
    public static $definition = array(
        'table' => 'gdz_megamenu',
        'primary' => 'menu_id',
        'multilang' => false,
        'fields' => array(
            'id_shop'   =>      array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true),
            'active'    =>      array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'name'      =>      array('type' => self::TYPE_STRING, 'lang' => false, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 255)
        )
    );

    public function __construct($menu_id = null, $id_shop = null)
    {
        parent::__construct($menu_id, $id_shop);
    }

    public function add($autodate = true, $null_values = false)
    {
        $res = true;
        $res = parent::add($autodate, $null_values);
        return $res;
    }

    public function delete()
    {
        $res = true;
        $res &= $this->delMenuItems();
        $res &= parent::delete();
        return $res;
    }


    public function delMenuItems()
    {
        $res = true;
        $menu_id = $this->id;
        $context = Context::getContext();
        $sql = '
            DELETE mi,mil
            FROM `'._DB_PREFIX_.'gdz_megamenu_items` mi INNER JOIN `'._DB_PREFIX_.'gdz_megamenu_items_lang` mil ON mi.`mitem_id` = mil.`mitem_id`
            WHERE mi.`menu_id` = '.$menu_id;
        $res &= Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
        return $res;
    }
}
