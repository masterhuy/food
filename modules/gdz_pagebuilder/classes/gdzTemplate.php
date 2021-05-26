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

class gdzTemplate extends ObjectModel
{
    public $name;
    public $params;

    public static $definition = array(
        'table' => 'gdz_pagebuilder_templates',
        'primary' => 'id_template',
        'multilang' => false,
        'fields' => array(
            'name'         =>  array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 200),
            'params'        =>  array('type' => self::TYPE_HTML, 'validate' => '', 'size' => 500000)
        )
    );

    public function __construct($id_template = null, $id_lang = null, $id_shop = null)
    {
        parent::__construct($id_template, $id_lang, $id_shop);
    }

    public function add($autodate = true, $null_values = false)
    {
        $res = true;
        $context = Context::getContext();
        $res = parent::add($autodate, $null_values);
        return $res;
    }

    public function delete()
    {
        $res = true;
        $res &= parent::delete();
        return $res;
    }
    public static function getImages($json)
    {
        $img = array();
        foreach ($json as $row) {
            foreach ($row['cols'] as $col) {
                foreach ($col['addons'] as $addon) {
                    foreach ($addon['fields'] as $field) {
                        if ($field['type'] == 'image') {
                            $img[] = $field['value'];
                        } elseif ($field['type'] == 'images') {
                            foreach ($field['value'] as $value) {
                                $img[] = $value['image'];
                            }
                        }
                    }
                }
            }
        }
        return $img;
    }
}
