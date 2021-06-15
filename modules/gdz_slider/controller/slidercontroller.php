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

include_once(_PS_MODULE_DIR_.'gdz_slider/classes/gdzSliderObject.php');
class Slider
{
    private $module;
    public function __construct($module)
    {
        $this->module = $module;
        $this->file = $module->getLocalPath().$module->name.'.php';
        $this->context = Context::getContext();
    }
    public function renderList()
    {
        $slider = new gdzSliderObject();
        $this->sliders = $slider->getList();
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
        if (isset($force_ssl) && $force_ssl) {
            $root_url = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            $root_url = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        $this->context->smarty->assign(
            array(
                'sliders'=>$this->sliders,
                'link' => $this->context->link,
                'root_url' => $root_url
            )
        );
        return $this->module->display($this->file, 'listslider.tpl');
    }
    public function changeStatusSlider($id)
    {
        $slider = new gdzSliderObject($id);
        $slider->toggleStatus();
    }
    public function renderForm($edit = false)
    {
        if ($edit) {
            $submit = $this->module->l('Update');
        } else {
            $submit = $this->module->l('Add');
        }
        $slide_transitions =array(
            0 => array('id' => 'none', 'name' => 'none'),
            1 => array('id' => 'fade', 'name' => 'Fade'),
            2 => array('id' => 'slideLeft', 'name' => 'Left'),
            3 => array('id' => 'slideRight', 'name' => 'Right'),
            4 => array('id' => 'slideTop', 'name' => 'Top'),
            5 => array('id' => 'slideBottom', 'name' => 'Bottom'),
            6 => array('id' => 'scrollLeft', 'name' => 'Scroll Left'),
            7 => array('id' => 'scrollRight', 'name' => 'Scroll Right'),
            8 => array('id' => 'scrollTop', 'name' => 'Scroll Top'),
            9 => array('id' => 'scrollBottom', 'name' => 'Scroll Bottom'),
            );
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
        $languages = array();
        $languages[0]['id_lang'] = 0;
        $languages[0]['name'] = 'All';
        $syslanguages = Language::getLanguages(false);
        $languages = array_merge($languages, $syslanguages);
        $fields_form=array(
            'form' => array(
                'legend' => array(
                    'title' => $this->module->l('Settings'),
                    'icon' => 'icon-cogs'
                    ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'name' => 'title',
                        'hint' => $this->module->l('The title of the slider, example: Slider 1'),
                        'col' => 5,
                        'label' => $this->module->l('Title'),
                        'required' => true,

                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'select',
                        'name' => 'lang_slide',
                        'label' => $this->module->l('Language'),
                        'options' => array(
                            'query' => $languages,
                            'id' => 'id_lang',
                            'name' => 'name'
                            ),
                        'tab' => 'general',
                    ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'JMS_SLIDER_DELAY',
                        'hint' => $this->module->l('It work after ms (1s = 1000ms)'),
                        'class' => 'fixed-width-xl',
                        'suffix' => 'ms',
                        'label' => $this->module->l('Start after'),
                        'required' => true,

                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'JMS_SLIDER_X',
                        'hint' => $this->module->l('Position of slide to width'),
                        'class' => 'fixed-width-xl',
                        'suffix' => 'px',
                        'label' => $this->module->l('Position X'),
                        'required' => true,

                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'JMS_SLIDER_Y',
                        'hint' => $this->module->l('Position of slide to height'),
                        'class' => 'fixed-width-xl',
                        'suffix' => 'px',
                        'label' => $this->module->l('Position Y'),
                        'required' => true,

                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'select',
                        'name' => 'JMS_SLIDER_TRANS',
                        'hint' => $this->module->l('Transition all slide'),
                        'label' => $this->module->l('Transition All'),
                        'options' => array(
                            'query' => $slide_transitions,
                            'id' => 'id',
                            'name' => 'name'
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'select',
                        'name' => 'JMS_SLIDER_TRANS_IN',
                        'label' => $this->module->l('Transition In'),
                        'hint' => $this->module->l('Transition in for slide'),
                        'options' => array(
                            'query' => $transitions,
                            'id' => 'id',
                            'name' => 'name'
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'select',
                        'name' => 'JMS_SLIDER_TRANS_OUT',
                        'hint' => $this->module->l('Transition out for slide'),
                        'label' => $this->module->l('Transition Out'),
                        'options' => array(
                            'query' => $transitions,
                            'id' => 'id',
                            'name' => 'name'
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'select',
                        'name' => 'JMS_SLIDER_EASE_IN',
                        'hint' => $this->module->l('Ease int for slide'),
                        'label' => $this->module->l('Ease In'),
                        'options' => array(
                            'query' => $eases,
                            'id' => 'id',
                            'name' => 'name'
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'select',
                        'name' => 'JMS_SLIDER_EASE_OUT',
                        'hint' => $this->module->l('Ease out for slide'),
                        'label' => $this->module->l('Ease Out'),
                        'options' => array(
                            'query' => $eases,
                            'id' => 'id',
                            'name' => 'name'
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'JMS_SLIDER_SPEED_IN',
                        'hint' => $this->module->l('Time speed transition'),
                        'label' => $this->module->l('Speed In'),
                        'suffix' => 'ms',
                        'class' => 'fixed-width-xl',
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'JMS_SLIDER_SPEED_OUT',
                        'hint' => $this->module->l('Time speed transition'),
                        'label' => $this->module->l('Speed Out'),
                        'suffix' => 'ms',
                        'disabled' => true,
                        'class' => 'fixed-width-xl',
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'JMS_SLIDER_DURATION',
                        'hint' => $this->module->l('Time show slide'),
                        'class' => 'fixed-width-xl',
                        'label' => 'Duration',
                        'suffix' => 'ms',
                        'required' => true,
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'switch',
                        'name' => 'JMS_SLIDER_BG_ANIMATE',
                        'label' => $this->module->l('Background Animate'),
                        'values' =>array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No')
                                )
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'select',
                        'name' => 'JMS_SLIDER_BG_EASE',
                        'label' => $this->module->l('Background ease'),
                        'options' => array(
                            'query' => $eases,
                            'id' => 'id',
                            'name' => 'name'
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'switch',
                        'name' => 'JMS_SLIDER_END_ANIMATE',
                        'label' => $this->module->l('End animate slide'),
                        'hint' => $this->module->l('If yes, slide and layers will end at the time and no animate'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No')
                                )
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'switch',
                        'name' => 'JMS_SLIDER_FULL_WIDTH',
                        'label' => $this->module->l('Fullwidth slide'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No')
                                )
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'switch',
                        'name' => 'JMS_SLIDER_RESPONSIVE',
                        'label' => $this->module->l('Responsive'),
                        'values' =>array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No')
                                )
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'JMS_SLIDER_WIDTH',
                        'hint' => $this->module->l('Max width'),
                        'class' => 'fixed-width-xl',
                        'label' => 'Max width slide',
                        'suffix' => 'px',
                        'required' => true,
                        'tab' => 'general',
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'JMS_SLIDER_HEIGHT',
                        'hint' => $this->module->l('Max height'),
                        'class' => 'fixed-width-xl',
                        'label' => 'Max height slide',
                        'suffix' => 'px',
                        'required' => true,
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'mobile_height',
                        'hint' => $this->module->l('Mobile 2 height'),
                        'class' => 'fixed-width-xl',
                        'label' => 'Mobile 2 height',
                        'suffix' => 'px',
                        'required' => true,
                    ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'mobile2_height',
                        'hint' => $this->module->l('Mobile height'),
                        'class' => 'fixed-width-xl',
                        'label' => 'Mobile height',
                        'suffix' => 'px',
                        'required' => true,
                    ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'text',
                        'name' => 'tablet_height',
                        'hint' => $this->module->l('Tablet height'),
                        'class' => 'fixed-width-xl',
                        'label' => 'Tablet height',
                        'suffix' => 'px',
                        'required' => true,
                    ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'switch',
                        'name' => 'JMS_SLIDER_AUTO_CHANGE',
                        'label' => $this->module->l('Auto change slide'),
                        'values' =>array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No')
                                )
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'switch',
                        'name' => 'JMS_SLIDER_PAUSE_HOVER',
                        'label' => $this->module->l('Pause hover'),
                        'values' =>array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No')
                                )
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'switch',
                        'name' => 'JMS_SLIDER_SHOW_PAGES',
                        'label' => $this->module->l('Show pagers'),
                        'values' =>array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No')
                                )
                            ),
                        ),
                    array(
                        'form_group_class' => 'col-lg-6',
                        'type' => 'switch',
                        'name' => 'JMS_SLIDER_SHOW_CONTROLS',
                        'label' => $this->module->l('Show controls'),
                        'values' =>array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes')
                                ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No')
                                )
                            ),
                        ),
                    array(
                        'type' => 'html',
                        'name' => 'noname',
                        'html_content' => '<div style="clear: both;"></div>',
                    ),

                ),
                'submit' => array(
                    'title' => $this->module->l($submit)
                    )
                )
            );

        $fields_form['form']['buttons'][] = array('href' => $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->module->name.'&tab_module='.$this->module->tab.'&module_name='.$this->module->name.'&token='.Tools::getAdminTokenLite('AdminModules'),'title' => 'Back to Slider List','icon' => 'process-icon-back');
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG')?Configuration::get('PS_BO_ALLOW_EMPLYEE_FORM_LANG'):0;
        $helper->module = $this->module;
        $helper->submit_action = 'submitSlider';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        if ($edit) {
            $params = '&editSlider&id_slider='.Tools::getValue('id_slider');
        } else {
            $params = '&addSlider';
        }
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->module->name.'&tab_module='.$this->module->tab.'&module_name='.$this->module->name.$params;
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
            'fields_value' => $this->getFieldsConfig($edit),
            'language' => array(
                'id_lang' => $lang->id,
                'iso_code' => $lang->iso_code
                ),
            'languages' => $this->context->controller->getLanguages(),
            'id_lang' => $this->context->language->id,
            );
        return $helper->generateForm(array($fields_form));
    }
    private function getFieldsConfig($edit)
    {
        if ($edit) {
            $slider = new gdzSliderObject((int)Tools::getValue('id_slider'));
        } else {
            $slider = new gdzSliderObject();
        }
        $fields = array(
            'title' => Tools::getValue('title', $slider->title),
            'JMS_SLIDER_DELAY' => Tools::getValue('JMS_SLIDER_DELAY', $slider->delay),
            'JMS_SLIDER_X' => Tools::getValue('JMS_SLIDER_X', $slider->x),
            'JMS_SLIDER_Y' => Tools::getValue('JMS_SLIDER_Y', $slider->y),
            'JMS_SLIDER_TRANS' => Tools::getValue('JMS_SLIDER_TRANS', $slider->trans),
            'JMS_SLIDER_TRANS_IN' => Tools::getValue('JMS_SLIDER_TRANS_IN', $slider->trans_in),
            'JMS_SLIDER_TRANS_OUT' => Tools::getValue('JMS_SLIDER_TRANS_OUT', $slider->trans_out),
            'JMS_SLIDER_EASE_IN' => Tools::getValue('JMS_SLIDER_EASE_IN', $slider->ease_in),
            'JMS_SLIDER_EASE_OUT' => Tools::getValue('JMS_SLIDER_EASE_OUT', $slider->ease_out),
            'JMS_SLIDER_SPEED_IN' => Tools::getValue('JMS_SLIDER_SPEED_IN', $slider->speed_in),
            'JMS_SLIDER_SPEED_OUT' => Tools::getValue('JMS_SLIDER_SPEED_OUT', $slider->speed_out),
            'JMS_SLIDER_DURATION' => Tools::getValue('JMS_SLIDER_DURATION', $slider->duration),
            'JMS_SLIDER_BG_ANIMATE' => Tools::getValue('JMS_SLIDER_BG_ANIMATE', $slider->bg_animation),
            'JMS_SLIDER_BG_EASE' => Tools::getValue('JMS_SLIDER_BG_EASE', $slider->bg_ease),
            'JMS_SLIDER_END_ANIMATE' => Tools::getValue('JMS_SLIDER_END_ANIMATE', $slider->end_animate),
            'JMS_SLIDER_FULL_WIDTH' => Tools::getValue('JMS_SLIDER_FULL_WIDTH', $slider->full_width),
            'JMS_SLIDER_RESPONSIVE' => Tools::getValue('JMS_SLIDER_RESPONSIVE', $slider->responsive),
            'JMS_SLIDER_WIDTH' => Tools::getValue('JMS_SLIDER_WIDTH', $slider->max_width),
            'JMS_SLIDER_HEIGHT' => Tools::getValue('JMS_SLIDER_HEIGHT', $slider->max_height),
            'mobile_height' => Tools::getValue('mobile_height', $slider->mobile_height),
            'mobile2_height' => Tools::getValue('mobile2_height', $slider->mobile2_height),
            'tablet_height' => Tools::getValue('tablet_height', $slider->tablet_height),
            'JMS_SLIDER_AUTO_CHANGE' => Tools::getValue('JMS_SLIDER_AUTO_CHANGE', $slider->auto_change),
            'JMS_SLIDER_PAUSE_HOVER' => Tools::getValue('JMS_SLIDER_PAUSE_HOVER', $slider->pause_hover),
            'JMS_SLIDER_SHOW_PAGES' => Tools::getValue('JMS_SLIDER_SHOW_PAGES', $slider->show_pager),
            'JMS_SLIDER_SHOW_CONTROLS' => Tools::getValue('JMS_SLIDER_SHOW_CONTROLS', $slider->show_control),
            'lang_slide' => Tools::getValue('lang_slide', $slider->lang)

        );
        return $fields;
    }
    public function validateConfigs()
    {
        $title = Tools::getValue('title');
        $delay = Tools::getValue('JMS_SLIDER_DELAY');
        $x = Tools::getValue('JMS_SLIDER_X');
        $y = Tools::getValue('JMS_SLIDER_Y');
        $speed_in = Tools::getValue('JMS_SLIDER_SPEED_IN');
        $speed_out = Tools::getValue('JMS_SLIDER_SPEED_OUT');
        $duration = Tools::getValue('JMS_SLIDER_DURATION');
        $width = Tools::getValue('JMS_SLIDER_WIDTH');
        $height = Tools::getValue('JMS_SLIDER_HEIGHT');
        $mheight = Tools::getValue('mobile_height');
        $m2height = Tools::getValue('mobile2_height');
        $theight = Tools::getValue('tablet_height');

        if (Tools::strlen($delay)==0 || Tools::strlen($x)==0 || Tools::strlen($y)==0 || Tools::strlen($duration)==0 ||
        Tools::strlen($speed_in)==0 || Tools::strlen($width)==0 || Tools::strlen($height)==0 || Tools::isEmpty($title) || Tools::isEmpty($mheight) || Tools::isEmpty($m2height) || Tools::isEmpty($theight)) {
            $this->_errors[] = $this->module->l('Please not to empty fields!');
        }

        if (!Validate::isInt($delay) || !Validate::isInt($x) || !Validate::isInt($y) || !Validate::isInt($speed_in)
            || !Validate::isInt($speed_out)  || !Validate::isInt($duration) || !Validate::isInt($width) || !Validate::isInt($height) || !Validate::isInt($mheight) || !Validate::isInt($m2height) || !Validate::isInt($theight)) {
            $this->_errors[] = $this->module->l('Check value in fields not is type string');
        }

        if (count($this->_errors)<1) {
            return true;
        } else {
            return $this->module->displayError($this->_errors);
        }
    }
    public function saveSlider($edit = false)
    {
        if ($edit) {
            $slider = new gdzSliderObject((int)Tools::getValue('id_slider'));
        } else {
            $slider = new gdzSliderObject();
        }
        $slider->title = Tools::getValue('title');
        $slider->delay = Tools::getValue('JMS_SLIDER_DELAY');
        $slider->x = Tools::getValue('JMS_SLIDER_X');
        $slider->y = Tools::getValue('JMS_SLIDER_Y');
        $slider->trans = Tools::getValue('JMS_SLIDER_TRANS');
        $slider->trans_in = Tools::getValue('JMS_SLIDER_TRANS_IN');
        $slider->trans_out = Tools::getValue('JMS_SLIDER_TRANS_OUT');
        $slider->ease_in = Tools::getValue('JMS_SLIDER_EASE_IN');
        $slider->ease_out = Tools::getValue('JMS_SLIDER_EASE_OUT');
        $slider->speed_in = Tools::getValue('JMS_SLIDER_SPEED_IN');
        $slider->speed_out = Tools::getValue('JMS_SLIDER_SPEED_OUT');
        $slider->duration = Tools::getValue('JMS_SLIDER_DURATION');
        $slider->bg_animation = Tools::getValue('JMS_SLIDER_BG_ANIMATE');
        $slider->bg_ease = Tools::getValue('JMS_SLIDER_BG_EASE');
        $slider->end_animate = Tools::getValue('JMS_SLIDER_END_ANIMATE');
        $slider->full_width = Tools::getValue('JMS_SLIDER_FULL_WIDTH');
        $slider->responsive = Tools::getValue('JMS_SLIDER_RESPONSIVE');
        $slider->max_width = Tools::getValue('JMS_SLIDER_WIDTH');
        $slider->max_height = Tools::getValue('JMS_SLIDER_HEIGHT');
        $slider->mobile_height = Tools::getValue('mobile_height');
        $slider->mobile2_height = Tools::getValue('mobile2_height');
        $slider->tablet_height = Tools::getValue('tablet_height');
        $slider->auto_change = Tools::getValue('JMS_SLIDER_AUTO_CHANGE');
        $slider->pause_hover = Tools::getValue('JMS_SLIDER_PAUSE_HOVER');
        $slider->show_pager = Tools::getValue('JMS_SLIDER_SHOW_PAGES');
        $slider->show_control = Tools::getValue('JMS_SLIDER_SHOW_CONTROLS');
        $slider->lang = Tools::getValue('lang_slide');
        if ($edit) {
            return $slider->update();
        }
        return $slider->add();
    }
    public function renderSlidesList()
    {
        $slider = new gdzSliderObject(Tools::getValue('id_slider'));
        $slides = $slider->getSlides();
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
        if (isset($force_ssl) && $force_ssl) {
            $root_url = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            $root_url = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        $this->context->smarty->assign(
            array(
                'slider' => $slider,
                'slides'=>$slides,
                'link' => $this->context->link,
                'root_url' => $root_url,
                'img_dir' => $root_url.'/modules/gdz_slider/views/img/',
            )
        );
        return $this->module->display($this->file, 'listslide.tpl');
    }
    public function deleteSlider($id)
    {
        $slider = new gdzSliderObject($id);
        $slider->delete();
    }
    public function renderSliderChoice()
    {
        $hooks = self::getHooks();
        $displays = self::getDisplays();
        $sliders = self::getUnhookSliders();
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
        if (isset($force_ssl) && $force_ssl) {
            $root_url = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            $root_url = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        $this->context->smarty->assign(
            array(
                'root_url' => $root_url,
                'sliders' => $sliders,
                'displays' => $displays,
                'hooks' => $hooks
            )
        );
        return $this->module->display($this->file, 'sliderchoice.tpl');
    }

    public static function getDisplays()
    {
        $sql = new DbQuery();
        $sql->select('s.id_slider, s.title, CONCAT(\'[\',GROUP_CONCAT(CONCAT(\'{"id_hook":"\', h.id_hook, \'", "name":"\',h.name,\'"}\')), \']\') AS position');
        $sql->from('gdz_slider_slider', 's');
        $sql->innerJoin('gdz_slider_slider_hook', 'sh', 's.id_slider = sh.id_slider');
        $sql->innerJoin('gdz_slider_hook', 'h', 'sh.id_hook = h.id_hook');
        $sql->groupBy('s.id_slider');
        return Db::getInstance()->executeS($sql);
    }
    public static function getHooks()
    {
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('gdz_slider_hook');
        return Db::getInstance()->executeS($sql);
    }
    public static function getUnhookSliders()
    {
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('gdz_slider_slider');
        $sql->where('id_slider NOT IN (SELECT DISTINCT id_slider FROM '._DB_PREFIX_.'gdz_slider_slider_hook)');
        $rs = Db::getInstance()->executeS($sql);
        return ObjectModel::hydrateCollection('gdzSliderObject', $rs);
    }
}
