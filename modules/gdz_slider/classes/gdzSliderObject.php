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

class gdzSliderObject extends ObjectModel
{
    public $id_slider;
    public $title = "New Slider";
    public $delay = 1000;
    public $x = 0;
    public $y = 0;
    public $trans = 'fade';
    public $trans_in = 'left';
    public $trans_out = 'left';
    public $ease_in = 'easeInCubit';
    public $ease_out = 'easeOutExpo';
    public $speed_in = 300;
    public $speed_out = 0;
    public $duration = 7000;
    public $bg_animation = true;
    public $bg_ease = 'easeOutCubit';
    public $end_animate = true;
    public $full_width = true;
    public $responsive = true;
    public $max_width = 1920;
    public $max_height = 875;
    public $mobile_height = 420;
    public $tablet_height = 450;
    public $mobile2_height = 500;
    public $auto_change = true;
    public $pause_hover;
    public $show_pager = true;
    public $show_control = true;
    public $active = true;
    public $order = 0;
    public $lang = 0;

    public static $definition = array(
        'table' => 'gdz_slider_slider',
        'primary' => 'id_slider',
        'fields' => array(
            'title' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'delay' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'x' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'y' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'trans' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'trans_in' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'trans_out' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'ease_in' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'ease_out' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'speed_in' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'speed_out' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'duration' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'bg_animation' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'bg_ease' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'end_animate' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'full_width' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'responsive' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'max_width' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'max_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'mobile_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'mobile2_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'tablet_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'auto_change' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'pause_hover' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'show_pager' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'show_control' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'order' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
        ),
    );

    public function __construct($id_slide = null, $id_shop = null, $id_lang = null)
    {
        parent::__construct($id_slide, $id_shop, $id_lang);
        if ($this->id) {
            $this->lang = Db::getInstance()->getValue("SELECT id_lang FROM "._DB_PREFIX_."gdz_slider_slider_lang WHERE id_slider = {$this->id}");
        }
    }
    public function add($auto_date = true, $null_values = false)
    {
        $res = parent::add($auto_date, $null_values);
        $res &= Db::getInstance()->execute("INSERT INTO `"._DB_PREFIX_."gdz_slider_slider_lang` VALUES({$this->id}, {$this->lang})");
        return $res;
    }
    public function update($null_values = false)
    {
        $res = parent::update($null_values);
        $res &= Db::getInstance()->execute("UPDATE `"._DB_PREFIX_."gdz_slider_slider_lang` SET id_lang = {$this->lang} WHERE id_slider = {$this->id}");
        return $res;
    }
    public function delete()
    {
        $res= true;
        $slides = $this->getSlides();
        foreach ($slides as $slide) {
            $slide->delete();
        }
        $res&= parent::delete();
        $res &= Db::getInstance()->execute("DELETE FROM `"._DB_PREFIX_."gdz_slider_slider_lang` WHERE id_slider = {$this->id}");
        return $res;
    }
    public function getList($active = false, $hook = '', $idlang = 0)
    {
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('gdz_slider_slider', 's');
        if ($active) {
            $sql->where('active = 1');
        }
        if ($hook != '') {
            $sql->innerJoin('gdz_slider_slider_hook', 'sh', 's.id_slider = sh.id_slider');
            $sql->innerJoin('gdz_slider_hook', 'h', 'sh.id_hook = h.id_hook');
            $sql->where("h.name = '{$hook}'");
        }
        $sql->innerJoin('gdz_slider_slider_lang', 'sl', 's.id_slider = sl.id_slider');
        if ($idlang) {
            $sql->where("id_lang = 0 OR id_lang = {$idlang}");
        }
        $sql->orderBy('s.order');
        $rs = Db::getInstance()->executeS($sql);
        return ObjectModel::hydrateCollection('gdzSliderObject', $rs);
    }
    public function getSlides($active = false)
    {
        $slides = new PrestashopCollection('gdzSlideObject');
        $slides->where('id_slider', '=', $this->id);
        if ($active) {
            $slides->where('status', '=', 1);
        }
        $slides->orderBy('order');
        return $slides->getResults();
    }
    public function duplicateObject()
    {
        $dupSlider = parent::duplicateObject();
        $dupSlider->title = $this->title . ' - Copy';
        $dupSlider->lang = $this->lang;
        $dupSlider->update();
        Db::getInstance()->execute("INSERT INTO `"._DB_PREFIX_."gdz_slider_slider_lang` VALUES({$dupSlider->id}, {$dupSlider->lang})");
        $slides = $this->getSlides();
        foreach ($slides as $slide) {
            $dupSlide = $slide->duplicateSlide();
            $dupSlide->id_slider = $dupSlider->id;
            $dupSlide->update();
        }
    }
}
