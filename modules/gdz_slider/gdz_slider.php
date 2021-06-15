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

if (!defined('_PS_VERSION_')) {
    exit();
}
include_once(_PS_MODULE_DIR_.'gdz_slider/classes/gdzSlideObject.php');
include_once(_PS_MODULE_DIR_.'gdz_slider/classes/gdzLayerObject.php');
include_once(_PS_MODULE_DIR_.'gdz_slider/controller/slidercontroller.php');
class gdz_slider extends Module
{
    public $_html = '';
    public $_errors = array();

    public function __construct()
    {
        $this->name = 'gdz_slider';
        $this->version = '1.0.0';
        $this->author = 'Godzilla';
        $this->tab = 'front_office_features';
        $this->bootstrap = true;
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        parent::__construct();
        $this->displayName = $this->l('Godzilla Slider');
        $this->description = $this->l('Advanced Slider Layer for Prestashop');
    }

    public function installSamples()
    {
        $query = '';
        require_once(dirname(__FILE__).'/install/install.sql.php');
        $return = true;
        if (isset($query) && !empty($query)) {
            if (!(Db::getInstance()->ExecuteS("SHOW TABLES LIKE '"._DB_PREFIX_."gdz_slider_slides'"))) {
                $query = str_replace('_DB_PREFIX_', _DB_PREFIX_, $query);
                $query = str_replace('_MYSQL_ENGINE_', _MYSQL_ENGINE_, $query);
                $db_data_settings = preg_split("/;\s*[\r\n]+/", $query);
                foreach ($db_data_settings as $query) {
                    $query = trim($query);
                    if (!empty($query)) {
                        if (!Db::getInstance()->Execute($query)) {
                            $return = false;
                        }
                    }
                }
            }
        } else {
            $return = false;
        }
        return $return;
    }

    public function install()
    {
        if (parent::install() && $this->registerHook('header') && $this->registerHook('actionShopDataDuplication') && $this->registerHook('displayBeforeBodyClosingTag')) {
            $res = $this->installSamples();
            $sql = "SELECT * FROM "._DB_PREFIX_."gdz_slider_hook";
            $hooks = Db::getInstance()->executeS($sql);
            foreach ($hooks as $hook) {
                 $res &= $this->registerHook($hook['name']);
            }
            if ($res) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function uninstall()
    {
        if (parent::uninstall() && $this->dropTables()) {
            return true;
        }
        return false;
    }

    public function dropTables()
    {
        $res=(bool)Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_slider_slides`;');
        $res&=Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_slider_slider`;');
        $res&=Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_slider_slides_shop`;');
        $res&=Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_slider_slider_lang`;');
        $res&=Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_slider_slides_layers`;');
        $res&=Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_slider_hook`;');
        $res&=Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_slider_slider_hook`;');
        $res&=Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_slider_layer_style`;');
        return $res;
    }

    public function headerHTML()
    {
        if (Tools::getValue('controller') != 'AdminModules' && Tools::getValue('configure') != $this->name) {
            return;
        }

        $this->context->controller->addJqueryUI('ui.sortable');
    }
    private function generalVariables()
    {
        $this->smarty->assign(
            array(
                'secure_key' => $this->secure_key,
            )
        );
        return $this->display(__FILE__, 'variables.tpl');
    }
    public function getContent()
    {
        $slider = new Slider($this);
        $this->context->controller->addCSS($this->_path.'views/css/admin_style.css', 'all');
        $this->context->controller->addJqueryUI('ui.draggable');
        $this->context->controller->addJqueryUI('ui.resizable');
        $this->headerHTML();
        $this->_html .= $this->generalVariables();
        if (Tools::isSubmit('submitSlide') || Tools::isSubmit('submitLayer') || Tools::isSubmit('copySlide')) {
            $this->process();
        } elseif (Tools::isSubmit('changeSliderStatus') && Tools::isSubmit('id_slider')) {
            $slider->changeStatusSlider(Tools::getValue('id_slider'));
            $this->redirectAdmin(4, '');
        } elseif (Tools::isSubmit('changeStatus') && Tools::isSubmit('id_slide')) {
            $slider = $this->changeStatusSlide(Tools::getValue('id_slide'));
            $this->redirectAdmin(4, '&editSlider&id_slider='.$slider);
        } elseif (Tools::isSubmit('delete_id_slider')) {
            $slider->deleteSlider((int)Tools::getValue('delete_id_slider'));
            $this->redirectAdmin(2, '');
        } elseif (Tools::isSubmit('delete_id_slide')) {
            $slider = $this->deleteSlide((int)Tools::getValue('delete_id_slide'));
            $this->redirectAdmin(2, '&editSlider&id_slider='.$slider);
        } elseif (Tools::isSubmit('editSlide')) {
            $this->_html.= $this->renderFormSlide();
            $this->_html.= $this->renderListLayer();
        } elseif (Tools::isSubmit('addSlide')) {
            $this->_html.= $this->renderFormSlide();
        } elseif (Tools::isSubmit('copySlider') && Tools::isSubmit('id_slider')) {
            $slider = new gdzSliderObject(Tools::getValue('id_slider'));
            $slider->duplicateObject();
            $this->redirectAdmin(4, '');
        } elseif (Tools::isSubmit('addSlider')) {
            if (Tools::isSubmit('submitSlider')) {
                $res = $slider->validateConfigs();
                if ($res === true && $slider->saveSlider()) {
                    $this->redirectAdmin(4, '');
                } else {
                    $this->_html .= $res;
                }
            }
            $this->_html.= $slider->renderForm();
        } elseif (Tools::isSubmit('editSlider')) {
            if (Tools::isSubmit('submitSlider')) {
                $res = $slider->validateConfigs();
                if ($res === true && $slider->saveSlider(true)) {
                    $this->redirectAdmin(4, '&editSlider&id_slider='.Tools::getValue('id_slider'));
                } else {
                    $this->_html .= $res;
                }
            }
            $this->_html.= $slider->renderSlidesList();
            $this->_html.= $slider->renderForm(true);
        } elseif (Tools::isSubmit('layers')) {
            // $this->_html .= $this->renderLayerForm();
        } else {
            $this->context->controller->addJqueryPlugin('chosen');
            $this->context->controller->addJS(($this->_path).'views/js/sliderchoice.js', 'all');
            $this->_html .= $slider->renderList();
            $this->_html .= $slider->renderSliderChoice();
        }
        return $this->_html;
    }

    public function process()
    {
        $errs = array();
        // $errs_l=array();
        if (Tools::isSubmit('submitSlide')) {
            if (Tools::isSubmit('id_slide')) {
                $slide = new gdzSlideObject();
            } else {
                $slide = new gdzSlideObject((int)Tools::getValue('id_slide'));
            }

            if ((Tools::getValue('bg_type')==1 && empty($_FILES['bg_image']['name']) && Tools::strlen(Tools::getValue('old_image'))==0) || ( Tools::getValue('bg_type')==0 && Tools::strlen(Tools::getValue('bg_color'))==0)) {
                $errs[] = $this->l('Please choose an image or color for background!');
            }

            if (Tools::strlen(Tools::getValue('title_slide'))==0) {
                $errs[] = $this->l('Please not to empty title.');
            }

            if (Tools::strlen(Tools::getValue('class_slide'))==0) {
                $slide->class_suffix = 'slide';
            } else {
                $slide->class_suffix = 'slide '.Tools::getValue('class_slide');
            }

            if (isset($_FILES) && !empty($_FILES['bg_image']['name'])) {
                $ext = array('jpg', 'gif', 'png', 'bmp', 'jpeg');
                $type = Tools::strtolower(Tools::substr(strrchr($_FILES['bg_image']['name'], '.'), 1));
                $path=dirname(__FILE__).'/views/img/slides/';
                $old_image = Tools::getValue('old_image');
                $new_name = Tools::encrypt(time()).'.'.$type;
                if (!file_exists($path.$new_name)) {
                    if (move_uploaded_file($_FILES['bg_image']['tmp_name'], $path.$new_name)) {
                        $slide->bg_image = $new_name;
                        if (Tools::isSubmit('id_slide') && $new_name && file_exists($path.$_FILES['bg_image']['name'])) {
                            unlink($path.$old_image);
                        }
                    }
                }
                if (!in_array($type, $ext)) {
                    $errs[] = $this->l('Format image is incorrect. Try again!');
                }
            } elseif (Tools::getValue('id_slide') && empty($_FILES['bg_image']['name'])) {
                $new_name = Tools::getValue('old_image');
            }
        } elseif (Tools::isSubmit('submitLayer')) {
            $id_slide = (int)Tools::getValue('slide_id');
            $id_layers = Tools::getValue('layer_ids');
            $total_layer = count($id_layers);
            for ($i=0; $i < $total_layer; $i++) {
                $layer = new gdzLayerObject($id_layers[$i]);
                $id_layer = $id_layers[$i];
                $layer->id_slide = Tools::getValue('id_slide', $id_slide);

                if (Tools::strlen(Tools::getValue('data_title_'.$id_layer))==0) {
                    $layer->data_title = $layer->data_title;
                } else {
                    $layer->data_title = Tools::getValue('data_title_'.$id_layer, $layer->data_title);
                }
                if (Tools::isSubmit('data_show_'.$id_layer) && Validate::isBool(Tools::getValue('data_show_'.$id_layer))) {
                    $layer->desktop->data_show = Tools::getValue('data_show_'.$id_layer);
                } else {
                    $layer->desktop->data_show = 0;
                }
                if (Tools::isSubmit('data_mshow_'.$id_layer) && Validate::isBool(Tools::getValue('data_mshow_'.$id_layer))) {
                    $layer->mobile->data_show = Tools::getValue('data_mshow_'.$id_layer);
                } else {
                    $layer->mobile->data_show = 0;
                }
                if (Tools::isSubmit('data_m2show_'.$id_layer) && Validate::isBool(Tools::getValue('data_m2show_'.$id_layer))) {
                    $layer->mobile2->data_show = Tools::getValue('data_m2show_'.$id_layer);
                } else {
                    $layer->mobile2->data_show = 0;
                }
                if (Tools::isSubmit('data_tshow_'.$id_layer) && Validate::isBool(Tools::getValue('data_tshow_'.$id_layer))) {
                    $layer->tablet->data_show = Tools::getValue('data_tshow_'.$id_layer, 0);
                }

                if (Tools::strlen(Tools::getValue('data_class_suffix_'.$id_layer))==0) {
                    $layer->data_class_suffix = $layer->data_class_suffix;
                } else {
                    $layer->data_class_suffix = Tools::getValue('data_class_suffix_'.$id_layer, $layer->data_class_suffix);
                }

                if (Tools::strlen(Tools::getValue('data_delay_'.$id_layer))==0 || !Validate::isInt(Tools::getValue('data_delay_'.$id_layer)) || Tools::getValue('data_delay_'.$id_layer)<0) {
                    $layer->data_delay = $layer->data_delay;
                } else {
                    $layer->data_delay = Tools::getValue('data_delay_'.$id_layer, $layer->data_delay);
                }

                if (Tools::strlen(Tools::getValue('data_time_'.$id_layer))==0 || !Validate::isInt(Tools::getValue('data_time_'.$id_layer))
                    || Tools::getValue('data_time_'.$id_layer)<0) {
                    $layer->data_time = $layer->data_time;
                } else {
                    $layer->data_time = Tools::getValue('data_time_'.$id_layer, $layer->data_time);
                }


                if (Validate::isInt(Tools::getValue('data_x_'.$id_layer))) {
                    $layer->desktop->data_x = Tools::getValue('data_x_'.$id_layer);
                }
                if (Validate::isInt(Tools::getValue('data_y_'.$id_layer))) {
                    $layer->desktop->data_y = Tools::getValue('data_y_'.$id_layer);
                }

                if (Validate::isInt(Tools::getValue('data_ty_'.$id_layer))) {
                    $layer->tablet->data_y = Tools::getValue('data_ty_'.$id_layer);
                }
                if (Validate::isInt(Tools::getValue('data_tx_'.$id_layer))) {
                    $layer->tablet->data_x = Tools::getValue('data_tx_'.$id_layer);
                }

                if (Validate::isInt(Tools::getValue('data_mx_'.$id_layer))) {
                    $layer->mobile->data_x = Tools::getValue('data_mx_'.$id_layer);
                }

                if (Validate::isInt(Tools::getValue('data_my_'.$id_layer))) {
                    $layer->mobile->data_y = Tools::getValue('data_my_'.$id_layer, $layer->data_my);
                }
                if (Validate::isInt(Tools::getValue('data_m2x_'.$id_layer))) {
                    $layer->mobile2->data_x = Tools::getValue('data_m2x_'.$id_layer);
                }

                if (Validate::isInt(Tools::getValue('data_m2y_'.$id_layer))) {
                    $layer->mobile2->data_y = Tools::getValue('data_m2y_'.$id_layer, $layer->data_my);
                }

                if (Validate::isInt(Tools::getValue('data_width_'.$id_layer))) {
                    $layer->desktop->data_width = Tools::getValue('data_width_'.$id_layer);
                }
                if (Validate::isInt(Tools::getValue('data_height_'.$id_layer))) {
                    $layer->desktop->data_height = Tools::getValue('data_height_'.$id_layer);
                }

                if (Validate::isInt(Tools::getValue('data_theight_'.$id_layer))) {
                    $layer->tablet->data_height = Tools::getValue('data_theight_'.$id_layer);
                }
                if (Validate::isInt(Tools::getValue('data_twidth_'.$id_layer))) {
                    $layer->tablet->data_width = Tools::getValue('data_twidth_'.$id_layer);
                }

                if (Validate::isInt(Tools::getValue('data_mwidth'.$id_layer))) {
                    $layer->mobile->data_width = Tools::getValue('data_mwidth_'.$id_layer);
                }

                if (Validate::isInt(Tools::getValue('data_mheight_'.$id_layer))) {
                    $layer->mobile->data_height = Tools::getValue('data_mheight_'.$id_layer, $layer->data_my);
                }
                if (Validate::isInt(Tools::getValue('data_m2width_'.$id_layer))) {
                    $layer->mobile2->data_width = Tools::getValue('data_m2width_'.$id_layer);
                }

                if (Validate::isInt(Tools::getValue('data_m2height_'.$id_layer))) {
                    $layer->mobile2->data_height = Tools::getValue('data_m2height_'.$id_layer, $layer->data_my);
                }


                if (Validate::isUnsignedInt(Tools::getValue('data_font_size_'.$id_layer))) {
                    $layer->desktop->data_font_size = Tools::getValue('data_font_size_'.$id_layer);
                }
                if (Validate::isUnsignedInt(Tools::getValue('data_mfont_size_'.$id_layer))) {
                    $layer->mobile->data_font_size = Tools::getValue('data_mfont_size_'.$id_layer);
                }
                if (Validate::isUnsignedInt(Tools::getValue('data_m2font_size_'.$id_layer))) {
                    $layer->mobile2->data_font_size = Tools::getValue('data_m2font_size_'.$id_layer);
                }
                if (Validate::isUnsignedInt(Tools::getValue('data_tfont_size_'.$id_layer))) {
                    $layer->tablet->data_font_size = Tools::getValue('data_tfont_size_'.$id_layer);
                }

                if (Validate::isUnsignedInt(Tools::getValue('data_line_height_'.$id_layer))) {
                    $layer->desktop->data_line_height = Tools::getValue('data_line_height_'.$id_layer);
                }
                if (Validate::isInt(Tools::getValue('data_mline_height_'.$id_layer))) {
                    $layer->mobile->data_line_height = Tools::getValue('data_mline_height_'.$id_layer);
                }
                if (Validate::isInt(Tools::getValue('data_m2line_height_'.$id_layer))) {
                    $layer->mobile2->data_line_height = Tools::getValue('data_m2line_height_'.$id_layer);
                }
                if (Validate::isInt(Tools::getValue('data_tline_height_'.$id_layer))) {
                    $layer->tablet->data_line_height = Tools::getValue('data_tline_height_'.$id_layer);
                }


                if (Tools::strlen(Tools::getValue('data_width_'.$id_layer))==0 || !Validate::isInt(Tools::getValue('data_width_'.$id_layer))
                    || Tools::getValue('data_width_'.$id_layer)<0) {
                    $layer->data_width = $layer->data_width;
                } else {
                    $layer->data_width = Tools::getValue('data_width_'.$id_layer, $layer->data_width);
                }

                if (Tools::strlen(Tools::getValue('data_height_'.$id_layer))==0 || !Validate::isInt(Tools::getValue('data_height_'.$id_layer))
                    || Tools::getValue('data_height_'.$id_layer)<0) {
                    $layer->data_height = $layer->data_height;
                } else {
                    $layer->data_height = (int)Tools::getValue('data_height_'.$id_layer, $layer->data_height);
                }

                $layer->data_fixed = Tools::getValue('data_fixed_'.$id_layer, $layer->data_fixed);
                $layer->data_in = Tools::getValue('data_in_'.$id_layer, $layer->data_in);
                $layer->data_out = Tools::getValue('data_out_'.$id_layer, $layer->data_out);
                $layer->data_ease_in = Tools::getValue('data_ease_in_'.$id_layer, $layer->data_ease_in);
                $layer->data_ease_out = Tools::getValue('data_ease_out_'.$id_layer, $layer->data_ease_out);
                $layer->data_transform_in = Tools::getValue('data_transform_in_'.$id_layer, $layer->data_transform_in);
                $layer->data_transform_out = Tools::getValue('data_transform_out_'.$id_layer, $layer->data_transform_out);
                $layer->data_type = Tools::getValue('data_type_'.$id_layer, $layer->data_type);
                $layer->data_html = Tools::getValue('data_html_'.$id_layer, $layer->data_html);
                $layer->desktop->data_style = Tools::getValue('data_style_'.$id_layer);
                $layer->mobile->data_style = Tools::getValue('data_mstyle_'.$id_layer);
                $layer->mobile2->data_style = Tools::getValue('data_m2style_'.$id_layer);
                $layer->tablet->data_style = Tools::getValue('data_tstyle_'.$id_layer);
                $layer->desktop->data_font_weight = Tools::getValue('data_font_weight_'.$id_layer);
                $layer->mobile->data_font_weight = Tools::getValue('data_mfont_weight_'.$id_layer);
                $layer->mobile2->data_font_weight = Tools::getValue('data_m2font_weight_'.$id_layer);
                $layer->tablet->data_font_weight = Tools::getValue('data_tfont_weight_'.$id_layer);
                $layer->data_color = Tools::getValue('data_color_'.$id_layer, $layer->data_color);
                $layer->data_video = Tools::getValue('data_video_'.$id_layer, $layer->data_video);
                $layer->data_video_controls = Tools::getValue('data_video_controls_'.$id_layer, $layer->data_video_controls);
                $layer->data_video_muted = Tools::getValue('data_video_muted_'.$id_layer, $layer->data_video_muted);
                $layer->data_video_autoplay = Tools::getValue('data_video_autoplay_'.$id_layer, $layer->data_video_autoplay);
                $layer->data_video_loop = Tools::getValue('data_video_loop_'.$id_layer, $layer->data_video_loop);
                $layer->data_video_bg = Tools::getValue('data_video_bg_'.$id_layer, 0);

                $layer->data_order = Tools::getValue('data_order', $layer->data_order);
                $layer->data_status = Tools::getValue('data_status_'.$id_layer, $layer->data_status);
                $layer->update();
            }
            $this->redirectAdmin('4', '&editSlide&id_slide='.$id_slide);
        } elseif (Tools::isSubmit('copySlide')) {
            $slide = new gdzSlideObject((int)Tools::getValue('id_slide'));
            $slide_dup = $slide->duplicateSlide();
            $slide_dup->title = $slide_dup->title.'- (Copy)';
            $slide_dup->update();
            $this->redirectAdmin(3, '&editSlider&id_slider='.$slide->id_slider);
        }

        if (count($errs)<1) {
            if (!Tools::getValue('id_slide')) {
                $slide = new gdzSlideObject();
                $slide->title =Tools::getValue('title_slide', $slide->title);
                $slide->id_slider = Tools::getValue('id_slider');
                $slide->class_suffix =Tools::getValue('class_slide', $slide->class_suffix);
                $slide->bg_type =Tools::getValue('bg_type', $slide->bg_type);
                $slide->bg_image = $new_name;
                $slide->bg_color =Tools::getValue('bg_color', $slide->bg_color);
                $slide->slide_link =Tools::getValue('slide_link', $slide->slide_link);
                $slide->status =Tools::getValue('status_slide', $slide->status);
                $slide->order = (int)Tools::getValue('order_slide', $slide->order);
                $slide->add();
                $this->redirectAdmin(3, '&editSlider&id_slider='.Tools::getValue('id_slider'));
            } else {
                $slide = new gdzSlideObject((int)Tools::getValue('id_slide'));
                $slide->title =Tools::getValue('title_slide', $slide->title);
                $slide->id_slider = Tools::getValue('id_slider', $slide->id_slider);
                $slide->class_suffix =Tools::getValue('class_slide', $slide->class_suffix);
                $slide->bg_type =Tools::getValue('bg_type', $slide->bg_type);
                $slide->bg_image = $new_name;
                $slide->bg_color =Tools::getValue('bg_color', $slide->bg_color);
                $slide->slide_link =Tools::getValue('slide_link', $slide->slide_link);
                $slide->status =Tools::getValue('status_slide', $slide->status);
                $slide->order = (int)Tools::getValue('order_slide', $slide->order);
                $slide->update();
                $this->redirectAdmin(4, '&editSlide&id_slide='.$slide->id);
            }
        } else {//if not errors
            $this->_html .= $this->displayError($errs);
            $this->_html .= $this->renderFormSlide();
            if (Tools::isSubmit('id_slide')) {
                $this->_html.= $this->renderListLayer();
            }
        }
    }


    public function videoType($url)
    {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }
    public function renderListLayer()
    {
        $this->context->controller->addJS(($this->_path).'views/js/back_script.js', 'all');
        $this->context->controller->addJqueryUI('ui.sortable');
        $this->context->controller->addJS($this->_path.'views/js/layermanager.js', 'all');
        $this->context->controller->addCSS($this->_path.'views/css/front_style.css', 'all');
        $this->context->controller->addCSS($this->_path.'views/css/animate.css', 'all');
        $transitions =array(
            0 => array('id' => 'none', 'name' => 'none'),
            1 => array('id' => 'fade', 'name' => 'Fade'),
            2 => array('id' => 'left', 'name' => 'Left'),
            3 => array('id' => 'right', 'name' => 'Right'),
            4 => array('id' => 'top', 'name' => 'Top'),
            5 => array('id' => 'bottom', 'name' => 'Bottom'),
            6 => array('id' => 'topLeft', 'name' => 'Top Left'),
            7 => array('id' => 'bottomLeft', 'name' => 'Bottom Left'),
            8 => array('id' => 'topRight', 'name' => 'Top Right'),
            9 => array('id' => 'bottomRight', 'name' => 'Bottom Right'),
            );
        $eases=array(
            0 => array('id' => 'linear', 'name' => 'linear'),
            1 => array('id' => 'swing', 'name' => 'swing'),
            2 => array('id' => 'easeInQuad', 'name' => 'easeInQuad'),
            3 => array('id' => 'easeOutQuad', 'name' => 'easeOutQuad'),
            4 => array('id' => 'easeInOutQuad', 'name' => 'easeInOutQuad'),
            5 => array('id' => 'easeInCubic', 'name' => 'easeInCubic'),
            6 => array('id' => 'easeOutCubic', 'name' => 'easeOutCubic'),
            7 => array('id' => 'easeInOutCubic', 'name' => 'easeInOutCubic'),
            8 => array('id' => 'easeInQuart', 'name' => 'easeInQuart'),
            9 => array('id' => 'easeOutQuart', 'name' => 'easeOutQuart'),
            10 => array('id' => 'easeInOutQuart', 'name' => 'easeInOutQuart'),
            11 => array('id' => 'easeInQuint', 'name' => 'easeInQuint'),
            12 => array('id' => 'easeOutQuint', 'name' => 'easeOutQuint'),
            13 => array('id' => 'easeInOutQuint', 'name' => 'easeInOutQuint'),
            14 => array('id' => 'easeInExpo', 'name' => 'easeInExpo'),
            15 => array('id' => 'easeOutExpo', 'name' => 'easeOutExpo'),
            16 => array('id' => 'easeInOutExpo', 'name' => 'easeInOutExpo'),
            17 => array('id' => 'easeInSine', 'name' => 'easeInSine'),
            18 => array('id' => 'easeOutSine', 'name' => 'easeOutSine'),
            19 => array('id' => 'easeInOutSine', 'name' => 'easeInOutSine'),
            20 => array('id' => 'easeInCirc', 'name' => 'easeInCirc'),
            21 => array('id' => 'easeOutCirc', 'name' => 'easeOutCirc'),
            22 => array('id' => 'easeInOutCirc', 'name' => 'easeInOutCirc'),
            23 => array('id' => 'easeInElastic', 'name' => 'easeInElastic'),
            24 => array('id' => 'easeOutElastic', 'name' => 'easeOutElastic'),
            25 => array('id' => 'easeInOutElastic', 'name' => 'easeInOutElastic'),
            26 => array('id' => 'easeInBack', 'name' => 'easeInBack'),
            27 => array('id' => 'easeOutBack', 'name' => 'easeOutBack'),
            28 => array('id' => 'easeInOutBack', 'name' => 'easeInOutBack'),
            23 => array('id' => 'easeInBounce', 'name' => 'easeInBounce'),
            24 => array('id' => 'easeOutBounce', 'name' => 'easeOutBounce'),
            25 => array('id' => 'easeInOutBounce', 'name' => 'easeInOutBounce'),
            );
        $transforms = array(
            0 => array('id' => 'bounce'),
            1 => array('id' => 'flash'),
            2 => array('id' => 'pulse'),
            3 => array('id' => 'rubberBand'),
            4 => array('id' => 'shake'),
            5 => array('id' => 'swing'),
            6 => array('id' => 'tada'),
            7 => array('id' => 'wobble'),
            8 => array('id' => 'jello'),
            9 => array('id' => 'bounceIn'),
            10 => array('id' => 'bounceInDown'),
            11 => array('id' => 'bounceInLeft'),
            12 => array('id' => 'bounceInRight'),
            13 => array('id' => 'bounceInUp'),
            14 => array('id' => 'bounceOut'),
            15 => array('id' => 'bounceOutDown'),
            16 => array('id' => 'bounceOutLeft'),
            17 => array('id' => 'bounceOutRight'),
            18 => array('id' => 'bounceOutUp'),
            19 => array('id' => 'fadeIn'),
            20 => array('id' => 'fadeInDown'),
            21 => array('id' => 'fadeInDownBig'),
            22 => array('id' => 'fadeInLeft'),
            23 => array('id' => 'fadeInLeftBig'),
            24 => array('id' => 'fadeInRight'),
            25 => array('id' => 'fadeInRightBig'),
            26 => array('id' => 'fadeInUp'),
            27 => array('id' => 'fadeInUpBig'),
            28 => array('id' => 'fadeOut'),
            29 => array('id' => 'fadeOutDown'),
            30 => array('id' => 'fadeOutDownBig'),
            31 => array('id' => 'fadeOutLeft'),
            32 => array('id' => 'fadeOutLeftBig'),
            33 => array('id' => 'fadeOutRight'),
            34 => array('id' => 'fadeOutRightBig'),
            35 => array('id' => 'fadeOutUp'),
            36 => array('id' => 'fadeOutUpBig'),
            37 => array('id' => 'flip'),
            38 => array('id' => 'flipInX'),
            39 => array('id' => 'flipInY'),
            40 => array('id' => 'flipOutX'),
            41 => array('id' => 'flipOutY'),
            42 => array('id' => 'lightSpeedIn'),
            43 => array('id' => 'lightSpeedOut'),
            44 => array('id' => 'rotateIn'),
            45 => array('id' => 'rotateInDownLeft'),
            46 => array('id' => 'rotateInDownRight'),
            47 => array('id' => 'rotateInUpLeft'),
            48 => array('id' => 'rotateInUpRight'),
            49 => array('id' => 'rotateOut'),
            50 => array('id' => 'rotateOutDownLeft'),
            51 => array('id' => 'rotateOutDownRight'),
            52 => array('id' => 'rotateOutUpLeft'),
            53 => array('id' => 'rotateOutUpRight'),
            54 => array('id' => 'slideInUp'),
            55 => array('id' => 'slideInDown'),
            56 => array('id' => 'slideInLeft'),
            57 => array('id' => 'slideInRight'),
            58 => array('id' => 'slideOutUp'),
            59 => array('id' => 'slideOutDown'),
            60 => array('id' => 'slideOutLeft'),
            61 => array('id' => 'slideOutRight'),
            62 => array('id' => 'zoomIn'),
            63 => array('id' => 'zoomInDown'),
            64 => array('id' => 'zoomInLeft'),
            65 => array('id' => 'zoomInRight'),
            66 => array('id' => 'zoomInUp'),
            67 => array('id' => 'zoomOut'),
            68 => array('id' => 'zoomOutDown'),
            69 => array('id' => 'zoomOutLeft'),
            70 => array('id' => 'zoomOutRight'),
            71 => array('id' => 'zoomOutUp'),
            72 => array('id' => 'hinge'),
            73 => array('id' => 'jackInTheBox'),
            74 => array('id' => 'rollIn'),
            75 => array('id' => 'rollOut')
        );
        $images = $this->getLayerImages();
        $slide = new gdzSlideObject((int)Tools::getValue('id_slide'));
        $slide->layers = $slide->getLayers();
        $slider = new gdzSliderObject((int)$slide->id_slider);
        $slider->slides = $slider->getSlides();
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
        if (isset($force_ssl) && $force_ssl) {
            $root_url = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            $root_url = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        $this->smarty->assign(
            array(
                'currentSlide' => $slide,
                'images' => $images,
                'transitions' => $transitions,
                'eases' => $eases,
                'slider' => $slider,
                'link' => $this->context->link,
                'root_url' => $root_url,
                'transforms' => $transforms,
                )
        );
        return $this->display(__FILE__, 'listlayers.tpl');
    }

    public function renderFormSlide()
    {
        $this->context->controller->addJS(($this->_path).'views/js/slideform.js', 'all');
        $slider = new gdzSliderObject();
        $sliders = $slider->getList();

        $fields_form = array(
            'form' => array(
                'tabs'=> array(
                    'general'=> $this->l('General Config'),
                    'bg' => $this->l('Background Config')
                    ),
                'legend' => array(
                    'title' => $this->l('Slide Seting'),
                    'icon' => 'icon-cogs'
                    ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'name' => 'title_slide',
                        'label' => $this->l('Title slide'),
                        'hint' => $this->l('Title of slide not show front end'),
                        'required' => true,
                        'class' => 'fixed-width-xl',
                        'tab' => 'general',
                        ),
                    array(
                        'type' => 'select',
                        'name' => 'id_slider',
                        'label' => $this->l('Slider'),
                        'options' => array(
                            'query' => $sliders,
                            'id' => 'id',
                            'name' => 'title'
                            ),
                        'tab' => 'general',
                        ),
                    array(
                        'type' => 'text',
                        'name' => 'class_slide',
                        'label' => $this->l('Class suffix'),
                        'required' => true,
                        'class' => 'fixed-width-xl',
                        'tab' => 'general',
                        ),
                    array(
                        'type' => 'text',
                        'name' => 'slide_link',
                        'label' => $this->l('Slide Link'),
                        'hint' => $this->l('Link for Slide, when click to slide on frontend it will redirect to this link'),
                        'required' => true,
                        'class' => 'fixed-width-xl',
                        'tab' => 'general',
                        ),
                    array(
                        'type' => 'switch',
                        'name' => 'status_slide',
                        'label' => $this->l('Active'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                                )
                            ),
                        'tab' => 'general',
                        ),
                    array(
                        'type' => 'switch',
                        'name' => 'bg_type',
                        'label' => $this->l('Background type'),
                        'desc' => $this->l('yes: image - no: color'),
                        'tab' => 'bg',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Image')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Color')
                                )
                            )
                        ),
                    array(
                        'type' => 'img',
                        'name' => 'bg_image',
                        'label' => 'Image',
                        'form_group_class' => 'bg_img',
                        'pdesc' => $this->l('Choose an image for background'),
                        'link' => $this->context->link->getAdminLink('AdminJms_sliderlayer', true),
                        'tab' => 'bg',
                        ),
                    array(
                        'type' => 'color',
                        'name' => 'bg_color',

                        'label' => $this->l('Color'),
                        'form_group_class' => 'bg_color',
                        'tab' => 'bg'
                        ),
                    ),
                'submit' => array(
                    'title' => $this->l('Save')
                    ),

                )
            );
        if (Tools::isSubmit('id_slide')) {
            $slide = new gdzSlideObject((int)Tools::getValue('id_slide'));
            $fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'id_slide');
            $fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'old_image', 'tab' => 'bg');
            $fields_form['form']['old_image'] = $slide->bg_image;
        }

        $fields_form['form']['buttons'][] = array('href' => $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editSlider&id_slider='.Tools::getValue('id_slider', (isset($slide)?$slide->id_slider:0)),'title' => 'Back to Slides List','icon' => 'process-icon-back');

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->fields_value['display_show_header'] = true;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitSlide';
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG')?Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG'):0;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $base_url = '';
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
        if (isset($force_ssl) && $force_ssl) {
            $base_url = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            $base_url = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        $helper->tpl_vars = array(
            'base_url' => $base_url,
            'fields_value' => $this->addFieldsSlide(),
            'language' => array(
                'id_lang' => $lang->id,
                'iso_code' => $lang->iso_code
                ),
            'languages' => $this->context->controller->getLanguages(),
            'id_lang' => $this->context->language->id,
            'image_baseurl' => $this->_path.'views/img/slides/'
            );

        return $helper->generateForm(array($fields_form));
    }
    public function addFieldsSlide()
    {
        $fields=array();
        if (Tools::isSubmit('id_slide')) {
            $slide = new gdzSlideObject((int)Tools::getValue('id_slide'));
            $fields['old_image'] = $slide->bg_image;
            $fields['bg_color'] = Tools::getValue('bg_color', $slide->bg_color);
            $fields['slide_link'] = Tools::getValue('slide_link', $slide->slide_link);
        } else {
            $slide = new gdzSlideObject();
        }
        $fields['id_slider'] = Tools::getValue('id_slider', $slide->id_slider);
        $fields['title_slide'] = Tools::getValue('title_slide', $slide->title);
        $fields['class_slide'] = Tools::getValue('class_slide', $slide->class_suffix);
        $fields['bg_type'] = Tools::getValue('bg_type', $slide->bg_type);
        $fields['bg_image'] = Tools::getValue('bg_image', $slide->bg_image);
        $fields['bg_color'] = Tools::getValue('bg_color', $slide->bg_color);
        $fields['slide_link'] = Tools::getValue('slide_link', $slide->slide_link);
        $fields['status_slide'] = Tools::getValue('status_slide', $slide->status);
        $fields['order'] = (int)Tools::getValue('order', $slide->order);
        $fields['id_slide'] = Tools::getValue('id_slide', Tools::getValue('id_slide'));

        return $fields;
    }

    public function changeStatusSlide($id_slide)
    {
        $slide = new gdzSlideObject((int)$id_slide);
        if ($slide->status == 0) {
            $slide->status = 1;
        } else {
            $slide->status = 0;
        }
        $slide->update();
        return $slide->id_slider;
    }

    public function deleteSlide($id_slide)
    {
        $slide = new gdzSlideObject($id_slide);
        $slide->delete();
        return $slide->id_slider;
    }

    public function getLayerImages()
    {
        $dir = _PS_MODULE_DIR_.'gdz_slider/views/img/layers/';
        //get all image files with a .jpg extension.
        $files = glob($dir.'*.{jpg,png,gif,jpeg,bmp}', GLOB_BRACE);
        $images = array();
        $i = 0;
        foreach ($files as $img) {
            $images[$i]['id'] = Tools::substr($img, Tools::strlen($dir), Tools::strlen($img) - Tools::strlen($dir));
            $i++;
        }
        return $images;
    }
    public function getSlideImages()
    {
        $dir = _PS_MODULE_DIR_.'gdz_slider/views/img/slides/';
        //get all image files with a .jpg extension.
        $files = glob($dir.'*.{jpg,png,gif,jpeg,bmp}', GLOB_BRACE);
        $images = array();
        $i = 0;
        foreach ($files as $img) {
            $images[$i]['id'] = Tools::substr($img, Tools::strlen($dir), Tools::strlen($img) - Tools::strlen($dir));
            $i++;
        }
        return $images;
    }

    public function redirectAdmin($msg, $page)
    {
        return Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf='.$msg.$page.'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
    }

    public function hookHeader()
    {
        $this->context->controller->addCSS(($this->_path).'views/css/fractionslider.css', 'all');
        $this->context->controller->addCSS(($this->_path).'views/css/animate.css', 'all');
        $this->context->controller->addCSS(($this->_path).'views/css/front_style.css', 'all');
        $this->context->controller->addJS(($this->_path).'views/js/jquery.fractionslider.js', 'all');
    }

    public function hookDisplayHome()
    {
        return $this->showSliders(__FUNCTION__);
    }
    public function hookDisplayWrapperTop()
    {
        return $this->showSliders(__FUNCTION__);
    }
    public function hookDisplayWrapperBottom()
    {
        return $this->showSliders(__FUNCTION__);
    }
    public function hookDisplayLeftColumn()
    {
        return $this->showSliders(__FUNCTION__);
    }
    public function hookDisplayRightColumn()
    {
        return $this->showSliders(__FUNCTION__);
    }
    public function hookDisplayBeforeBodyClosingTag()
    {
        return $this->display(__FILE__, 'script.tpl');
    }
    private function showSliders($hook)
    {
        $hook = lcfirst(Tools::substr($hook, 4));
        $sliderObj = new gdzSliderObject();
        $sliders = $sliderObj->getList(true, $hook, $this->context->language->id);
        if (!count($sliders)) {
            return '';
        }
        foreach ($sliders as $slider) {
            $slider->slides = $slider->getSlides(true);
            foreach ($slider->slides as $slide) {
                $slide->layers = $slide->getLayers();
            }
        }
        $root_url = Tools::getHttpHost(true).__PS_BASE_URI__;
        $this->smarty->assign(array(
            'sliders' => $sliders,
            'root_url' => $root_url,
            ));

        return $this->display(__FILE__, 'gdz_slider.tpl');
    }
}
