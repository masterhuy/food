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

class gdzStyle extends ObjectModel
{
    public $id_layer;
    public $type;
    public $data_style = 'normal';
    public $data_font_size = 14;
    public $data_line_height = 14;
    public $data_font_weight = 400;
    public $data_x = 0;
    public $data_y = 0;
    public $data_show = 1;
    public $data_width = 0;
    public $data_height = 0;
    public static $definition = array(
        'table' => 'gdz_slider_layer_style',
        'primary' => 'id_style',
        'fields' => array(
            'id_layer' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'type' => array('type'=>self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 50),
            'data_style' => array('type'=>self::TYPE_STRING, 'validate'=>'isCleanHtml',  'size' => 50),
            'data_font_size' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_line_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_font_weight' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_x' => array('type' => self::TYPE_INT),
            'data_y' => array('type' => self::TYPE_INT),
            'data_show' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'data_width' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
        )
    );
    public static function newType($type)
    {
        $style = new self();
        $style->type = $type;
        return $style;
    }
}
