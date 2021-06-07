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

include_once(_PS_MODULE_DIR_.'gdz_slider/classes/gdzStyle.php');
class gdzLayerObject extends ObjectModel
{
    public $id_slide;
    public $data_title;
    public $data_class_suffix;
    public $data_fixed;
    public $data_delay;
    public $data_time;
    public $data_in;
    public $data_out;
    public $data_ease_in;
    public $data_ease_out;
    public $data_transform_in;
    public $data_transform_out;
    public $data_type;
    public $data_image;
    public $data_html;
    public $data_color;
    public $data_video;
    public $data_video_bg;
    public $videotype;
    public $data_video_controls;
    public $data_video_autoplay;
    public $data_video_loop;
    public $data_video_muted;
    public $data_width;
    public $data_height;
    public $data_order;
    public $data_status;
    public $styles = array('desktop', 'mobile', 'tablet', 'mobile2');

    public static $definition = array(
        'table' => 'gdz_slider_slides_layers',
        'primary' => 'id_layer',
        'fields' => array(
            'id_slide' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_title' => array('type'=>self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'data_class_suffix' => array('type'=>self::TYPE_STRING, 'validate'=>'isCleanHtml',  'size' => 255),
            'data_fixed' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_delay' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_time' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_in' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'data_out' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'data_ease_in' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml','size' => 255),
            'data_ease_out' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'data_transform_in' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml','size' => 255),
            'data_transform_out' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'data_type' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml',  'size' => 255),
            'data_image' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'data_html' => array('type' => self::TYPE_HTML, 'validate' => 'isCleanHtml'),
            'data_color' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml'),
            'data_video' => array('type' => self::TYPE_HTML, 'validate' => 'isCleanHtml'),
            'data_video_bg' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'data_video_muted' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_video_autoplay' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_video_loop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_video_controls' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_width' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_order' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'data_status' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            )
        );

    public function __construct($id_slide = null, $id_shop = null, $id_lang = null)
    {
        parent::__construct($id_slide, $id_shop, $id_lang);
        if ($this->id) {
            foreach ($this->styles as $style) {
                $this->$style = $this->getStyle($style);
            }
        }
    }

    public function add($autodate = true, $null_values = false)
    {
        $res=true;
        $res&=parent::add($autodate, $null_values);
        foreach ($this->styles as $style) {
            $this->$style->id_layer = $this->id;
            $res &= $this->$style->add();
        }
        return $res;
    }
    public function update($null_values = false)
    {
        $res = parent::update($null_values);
        foreach ($this->styles as $style) {
            if (isset($this->$style) && $this->$style !== false) {
                $res &= $this->$style->update();
            }
        }
        return $res;
    }
    public function delete()
    {
        $res= true;
        $res&= parent::delete();
        foreach ($this->styles as $style) {
            $res &= $this->$style->delete();
        }
        return $res;
    }
    public function hydrate(array $data, $id_lang = null)
    {
        parent::hydrate($data, $id_lang);
        if ($this->data_type=='video') {
            $this->videotype = $this->videoType($this->data_video);
        }
        if ($this->id) {
            foreach ($this->styles as $style) {
                $this->$style = $this->getStyle($style);
            }
        }
    }
    private function videoType($url)
    {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }
    public function getStyle($type)
    {
        $style = new PrestaShopCollection('gdzStyle');
        $style->where('id_layer', '=', $this->id);
        $style->where('type', '=', $type);
        return $style->getFirst();
    }
    public function duplicateObject()
    {
        $dupObj = parent::duplicateObject();
        foreach ($this->styles as $style) {
            $dupStyle = $this->$style->duplicateObject();
            $dupStyle->id_layer = $dupObj->id;
            // $dupStyle->data_x += 20;
            // $dupStyle->data_y += 20;
            $dupStyle->data_x += 0;
            $dupStyle->data_y += 0;
            $dupStyle->update();
        }
        return $dupObj;
    }
}
