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

class gdzSlideObject extends ObjectModel
{
    public $id_slider;
    public $title;
    public $class_suffix;
    public $bg_type;
    public $bg_image;
    public $bg_color;
    public $slide_link;
    public $order;
    public $status;

    public static $definition = array(
        'table' => 'gdz_slider_slides',
        'primary' => 'id_slide',
        'multi_lange' => true,
        'fields' => array(
            'id_slider' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'title' =>array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml'),
            'class_suffix' =>array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml'),
            'bg_type' =>array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'bg_image' =>array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'bg_color' =>array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'slide_link' =>array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255),
            'order' =>array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'status' =>array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            )
        );

    public function __construct($id_slide = null, $id_shop = null, $id_lang = null)
    {
        parent::__construct($id_slide, $id_shop, $id_lang);
        Shop::addTableAssociation($this->def['table'], array('type' => 'shop'));
    }

    public function delete()
    {
        $res= true;
        $layers = $this->getLayers();
        foreach ($layers as $layer) {
            $layer->delete();
        }
        $res&= parent::delete();
        return $res;
    }
    public function getLayers()
    {
        $layers = new PrestashopCollection('gdzLayerObject');
        $layers->where('id_slide', '=', $this->id);
        return $layers->getResults();
    }
    public function duplicateSlide()
    {
        $dupSlide = parent::duplicateObject();
        if ($this->bg_type) {
            $bg_source = _PS_MODULE_DIR_.'gdz_slider/views/img/slides/'.$this->bg_image;
            $bg = explode('.', $this->bg_image);
            $new_bg = Tools::encrypt($bg[0]).'.'.$bg[1];
            $bg_dest = _PS_MODULE_DIR_.'gdz_slider/views/img/slides/'.$new_bg;
            copy($bg_source, $bg_dest);
            $dupSlide->bg_image = $new_bg;
        }
        $layers = $this->getLayers();
        foreach ($layers as $layer) {
            $dupLayer = $layer->duplicateObject();
            $dupLayer->id_slide = $dupSlide->id;
            $dupLayer->update();
        }
        return $dupSlide;
    }
}
