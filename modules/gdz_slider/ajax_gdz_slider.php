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

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('gdz_slider.php');


$module = new gdz_slider();

if (!Tools::isSubmit('secure_key') || Tools::getValue('secure_key') != $module->secure_key) {
    die(1);
}

$context = Context::getContext();
$slides = array();
function videoType($url)
{
    if (strpos($url, 'youtube') > 0) {
        return 'youtube';
    } elseif (strpos($url, 'vimeo') > 0) {
        return 'vimeo';
    } else {
        return 'unknown';
    }
}
if (Tools::getValue('action') == 'addLayer' && Tools::getValue('id_slide')) {
    $data_type = Tools::getValue('data_type');
    if ($data_type == 'text') {
        $data_text = Tools::getValue('data_text');
        $data_title =Tools::strlen(Tools::getValue('data_title'))==0?'New Layer Text':Tools::getValue('data_title');
        $width = "200";
        $height = "50";
        $data_image = '';
        $data_video = '';
        $data_video_auotplay = '';
        $data_vide_loop = '';
        $data_video_controls = '';
        $data_video_muted = '';
    } elseif ($data_type=='image') {
        $path = dirname(__FILE__).'/views/img/layers/';
        if ($_FILES['data_image']['name']) {
            $st_name = preg_replace('/[^A-Za-z0-9\._\-]/', '', $_FILES['data_image']['name']);
            $name = str_replace(' ', '-', $st_name);
            $img_extend = array('png', 'jpg', 'gif', 'jpeg');
            $type = Tools::strtolower(Tools::substr(strrchr($_FILES['data_image']['name'], '.'), 1));
            $path = dirname(__FILE__).'/views/img/layers/';
            if (!file_exists($path.$name)) {
                move_uploaded_file($_FILES['data_image']['tmp_name'], $path.$name);
            }
            $data_image = $name;
        } else {
            $data_image = Tools::getValue('data_s_image');
        }
        list($width, $height) = getimagesize($path.$data_image);
        $data_text = '';
        $data_video = '';
        $data_video_auotplay = '';
        $data_vide_loop = '';
        $data_video_controls = '';
        $data_video_muted = '';
        $data_title =Tools::strlen(Tools::getValue('title_image_new'))==0?'New Layer Image'
                                        :Tools::getValue('title_image_new');
    } elseif ($data_type == 'video') {
        $data_text = '';
        $data_image = '';
        $data_video = Tools::getValue('data_video');
        $data_video_auotplay = '1';
        $data_vide_loop = '1';
        $data_video_controls = '1';
        $data_video_muted = '0';
        $width = '200';
        $height = '100';
        $data_title =Tools::strlen(Tools::getValue('data_title'))==0?'New Layer Video':Tools::getValue('data_title');
    }

    $id_slide = (int)Tools::getValue('id_slide');
    $layer = new gdzLayerObject();
    $layer->id_slide = $id_slide;
    $layer->data_title = $data_title;
    $layer->data_class_suffix = '';
    $layer->data_fixed = 0;
    $layer->data_delay = 1000;
    $layer->data_in = 'left';
    $layer->data_out = 'right';
    $layer->data_ease_in = 'linear';
    $layer->data_ease_out = 'linear';
    $layer->data_step = '0';
    $layer->data_special = '';
    $layer->data_type = $data_type;
    $layer->data_image = $data_image;
    $layer->data_html = $data_text;
    $layer->data_color = '#FFFFFF';
    $layer->data_video = $data_video;
    $layer->data_video_muted = $data_video_muted;
    $layer->data_video_controls = $data_video_controls;
    $layer->data_video_auotplay = $data_video_auotplay;
    $layer->data_vide_loop = $data_vide_loop;
    $layer->data_vide_bg = '0';
    $layer->data_width = $width;
    $layer->data_height = $height;
    $layer->data_order = 0;
    $layer->data_status = 1;
    $layer->desktop = gdzStyle::newType('desktop');
    $layer->mobile = gdzStyle::newType('mobile');
    $layer->mobile2 = gdzStyle::newType('mobile2');
    $layer->tablet = gdzStyle::newType('tablet');
    $layer->add();
} elseif (Tools::getValue('action') == 'deleteLayer' && Tools::getValue('id_layer')) {
    $layer = new gdzLayerObject((int)Tools::getValue('id_layer'));
    $layer->delete();
} elseif (Tools::getValue('action') == 'updateSlidesOrdering' && Tools::getValue('slides')) {
    $slides = Tools::getValue('slides');
    foreach ($slides as $position => $id_slide) {
        $res = Db::getInstance()->execute('
            UPDATE `'._DB_PREFIX_.'gdz_slider_slides` SET `order` = '.(int)$position.'
            WHERE `id_slide` = '.(int)$id_slide);
    }
    $jms_slider = new gdzSlideObject();
    $jms_slider->clearCache();
} elseif (Tools::getValue('action') == 'updateSliderOrdering' && Tools::getValue('slider')) {
    $slider = Tools::getValue('slider');
    foreach ($slider as $position => $id_slider) {
        $res = Db::getInstance()->execute('
            UPDATE `'._DB_PREFIX_.'gdz_slider_slider` SET `order` = '.(int)$position.'
            WHERE `id_slider` = '.(int)$id_slider);
    }
} elseif (Tools::getValue('action') == 'quickEdit') {
    $res = array();
    $res['status'] = false;
    if (!Tools::isSubmit('id_layer') || !Validate::isUnsignedInt(Tools::getValue('id_layer'))) {
        $res['mes'] = 'ID is invalid';
        die(Tools::jsonEncode($res));
    }
    $layer = new gdzLayerObject((int)Tools::getValue('id_layer'));
    if (Tools::getValue('type') == 'text') {
        $layer->data_html = Tools::getValue('text');
    } elseif (Tools::getValue('type') == 'video') {
        $layer->data_video = Tools::getValue('text');
    }
    $res['status'] = $layer->update();
    die(Tools::jsonEncode($res));
} elseif (Tools::getValue('action') == 'updateImageLayer') {
    $path = dirname(__FILE__).'/views/img/layers/';
    if ($_FILES['data_image']['name']) {
        $st_name = preg_replace('/[^A-Za-z0-9\._\-]/', '', $_FILES['data_image']['name']);
        $name = str_replace(' ', '-', $st_name);
        $img_extend = array('png', 'jpg', 'gif', 'jpeg');
        $type = Tools::strtolower(Tools::substr(strrchr($_FILES['data_image']['name'], '.'), 1));
        $path = dirname(__FILE__).'/views/img/layers/';
        if (!file_exists($path.$name)) {
            move_uploaded_file($_FILES['data_image']['tmp_name'], $path.$name);
        }
        $data_image = $name;
    } else {
        $data_image = Tools::getValue('data_s_image');
    }
    list($width, $height) = getimagesize($path.$data_image);
    $data_title =Tools::strlen(Tools::getValue('title_image_new'))==0?'New Layer Image'
                                        :Tools::getValue('title_image_new');
    $id_layer = (int)Tools::getValue('id_layer');
    $layer = new gdzLayerObject($id_layer);
    $layer->data_image = $data_image;
    $layer->data_width = $width;
    $layer->data_height = $height;
    $layer->data_title = $data_title;
    $res = $layer->update();
    die(Tools::jsonEncode(array('update' => $res, 'img' => $data_image)));
} elseif (Tools::getValue('action') == 'duplicateLayer') {
    $id_layer = (int)Tools::getValue('id_layer');
    $layer = new gdzLayerObject($id_layer);
    $res = $layer->duplicateObject();
    die(Tools::jsonEncode(array('duplicate' => true)));
}
