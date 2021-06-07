<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class gdzFooterForm
{
    public $module;

    public function __construct()
    {
        $this->module = Module::getInstanceByName('gdz_themesetting');
    }
    public function getFooterForm()
    {
      $_fieldsets = array();
      $_fieldsets[] = $this->getFooterTabForm();
      $_fieldsets[] = $this->getFooterLayoutForm();
      $_fieldsets[] = $this->getFooterStyleForm();
      $_fieldsets[] = $this->getFooterTopForm();
      $_fieldsets[] = $this->getFooterCopyrightForm();
      return $_fieldsets;
    }
    public function getFooterTabForm()
    {
        return array(
            'form' => array(
                'childForms' => array(
                    'gdz-footer-layout'  => $this->module->l('Footer Layout', 'FooterForm'),
                    'gdz-footer-setting'  => $this->module->l('Footer Style', 'FooterForm'),
                    'gdz-footer-top'  => $this->module->l('Footer Top', 'FooterForm'),
                    'gdz-footer-copyright'  => $this->module->l('Copyright', 'FooterForm'),
                ),
                'legend' => array(
                    'title' => $this->module->l('Footer', 'FooterForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-footer-tab',
                    'heading_icon' => 'dvr'
                ),
            ),
        );
    }
    public function getFooterLayoutForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Layout', 'FooterForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-footer-layout'
                ),
                'input' => array(
                    array(
                        'type' => 'image-select',
                        'label' => $this->module->l('Footer Layout', 'FooterForm'),
                        'name' => 'footer_layout',
                        'direction' => 'vertical',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 1,
                                    'name' => $this->module->l('Layout 1', 'FooterForm'),
                                    'img' => 'footers/1.jpg'
                                ),
                                array(
                                    'id_option' => 2,
                                    'name' => $this->module->l('Layout 2', 'FooterForm'),
                                    'img' => 'footers/2.jpg'
                                ),
                                array(
                                    'id_option' => 3,
                                    'name' => $this->module->l('Layout 3', 'FooterForm'),
                                    'img' => 'footers/3.jpg'
                                ),
                                array(
                                    'id_option' => 4,
                                    'name' => $this->module->l('Layout 4', 'FooterForm'),
                                    'img' => 'footers/4.jpg'
                                ),
                                array(
                                    'id_option' => 5,
                                    'name' => $this->module->l('Layout 5', 'FooterForm'),
                                    'img' => 'footers/5.jpg'
                                ),
                                array(
                                    'id_option' => 6,
                                    'name' => $this->module->l('Layout 6', 'FooterForm'),
                                    'img' => 'footers/6.jpg'
                                ),
                                array(
                                    'id_option' => 7,
                                    'name' => $this->module->l('Layout 7', 'FooterForm'),
                                    'img' => 'footers/7.jpg'
                                ),
                                array(
                                    'id_option' => 8,
                                    'name' => $this->module->l('Layout 8', 'FooterForm'),
                                    'img' => 'footers/8.jpg'
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'FooterForm'),
                ),
            ),
        );
    }
    public function getFooterStyleForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Footer Setting', 'FooterForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-footer-setting'
                ),
                'input' => array(
                  array(
                      'type' => 'switch-label',
                      'label' => $this->module->l('Footer Width Layout', 'GeneralForm'),
                      'name' => 'footer_width',
                      'values'    => array(
                          array('id'    => 'active_on','value' => 1,'label' => $this->module->l('Boxed', 'HeaderForm')),
                          array('id'    => 'active_off','value' => 0,'label' => $this->module->l('FullWidth', 'HeaderForm'))
                      ),
                      'width' => '260'
                  ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Container Max Width', 'GeneralForm'),
                        'desc' => $this->module->l('Footer\'s container max width. You must provide px or percent suffix. Example: 1200px or 90%', 'HeaderForm'),
                        'name' => 'footer_container_width',
                        'size' => 30,
                        'min' => 0,
                        'class' => 'fixed-width-xxl',
                    ),
                    array(
                        'type' => 'text-group',
                        'label' => $this->module->l('Margin'),
                        'name' => 'footer_margin',
                        'desc' => $this->module->l('leave blank if you dont want to set'),
                        'suffix' => 'px',
                        'size' => 5
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Custom Css Class', 'FooterForm'),
                        'desc' => $this->module->l('Use this field to add a class name and then refer to it in your css file.', 'FooterForm'),
                        'name' => 'footer_class',
                        'size' => 30,
                        'min' => 0,
                        'class' => 'fixed-width-xxl'
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Background Type', 'FooterForm'),
                        'name' => 'footer_bg',
                        'options' => array(
                            'query' => array(
                              array(
                                  'id_option' => '',
                                  'name' => $this->module->l('None', 'FooterForm'),
                              ),
                                array(
                                    'id_option' => 'image',
                                    'name' => $this->module->l('Image', 'FooterForm'),
                                ),
                                array(
                                    'id_option' => 'color',
                                    'name' => $this->module->l('Color', 'FooterForm'),
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Background Color', 'FooterForm'),
                        'name' => 'footer_bg_color',
                        'desc' => $this->module->l('Choose background color for Footer.', 'FooterForm'),
                        'class' => 'bg-color-group',
                        'condition' => array(
                            'footer_bg' => '==color'
                        ),
                    ),
                    array(
                        'type' => 'background-img',
                        'label' => $this->module->l('Background Image', 'FooterForm'),
                        'name' => 'footer_bg_image',
                        'condition' => array(
                            'footer_bg' => '==image'
                        ),
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('Footer HTML', 'FooterForm'),
                        'name' => 'footer_html',
                        'autoload_rte' => true,
                        'lang' => true
                    ),
                    array(
                        'type' => 'title_separator',
                        'label' => $this->module->l('Footer Main', 'FooterForm'),
                        'size' => 30,
                        'border_top' => false
                    ),
                    array(
                        'type' => 'text-group',
                        'label' => $this->module->l('Padding'),
                        'name' => 'footer_padding',
                        'desc' => $this->module->l('leave blank if you dont want to set'),
                        'suffix' => 'px',
                        'size' => 5
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Text Color', 'FooterForm'),
                        'name' => 'footer_text_color'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Block Title Color', 'FooterForm'),
                        'name' => 'footer_block_title_color'
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Block Title Style', 'FooterForm'),
                        'name' => 'footer_block_title_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Block Collapse On Mobile', 'GeneralForm'),
                        'name' => 'footer_block_collapse',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'GeneralForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'GeneralForm')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'FooterForm'),
                ),
            ),
        );
    }
    public function getFooterTopForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Footer Top', 'FooterForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-footer-top'
                ),
                'input' => array(
                    array(
                        'type' => 'text-group',
                        'label' => $this->module->l('Padding'),
                        'name' => 'footer_top_padding',
                        'desc' => $this->module->l('leave blank if you dont want to set'),
                        'suffix' => 'px',
                        'size' => 5
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Custom Css Class', 'FooterForm'),
                        'desc' => $this->module->l('Use this field to add a class name and then refer to it in your css file.', 'FooterForm'),
                        'name' => 'footer_top_class',
                        'size' => 30,
                        'min' => 0,
                        'class' => 'fixed-width-xxl'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Background Color', 'FooterForm'),
                        'name' => 'footer_top_bg_color',
                        'class' => 'bg-color-group'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Text Color', 'FooterForm'),
                        'name' => 'footer_top_text_color',
                        'class' => 'bg-color-group'
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'FooterForm'),
                ),
            ),
        );
    }
    public function getFooterCopyrightForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Footer Setting', 'FooterForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-footer-copyright'
                ),
                'input' => array(
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('Copyright Content', 'FooterForm'),
                        'name' => 'footer_copyright_content',
                        'autoload_rte' => true,
                        'lang' => true
                    ),
                    array(
                        'type' => 'text-group',
                        'label' => $this->module->l('Padding'),
                        'name' => 'footer_copyright_padding',
                        'desc' => $this->module->l('leave blank if you dont want to set'),
                        'suffix' => 'px',
                        'size' => 5
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Custom Css Class', 'FooterForm'),
                        'desc' => $this->module->l('Use this field to add a class name and then refer to it in your css file.', 'FooterForm'),
                        'name' => 'footer_copyright_class',
                        'size' => 30,
                        'min' => 0,
                        'class' => 'fixed-width-xxl'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Background Color', 'FooterForm'),
                        'name' => 'footer_copyright_bg_color',
                        'class' => 'bg-color-group'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Text Color', 'FooterForm'),
                        'name' => 'footer_copyright_text_color',
                        'class' => 'bg-color-group'
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Text Style', 'FooterForm'),
                        'name' => 'footer_copyright_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'file-dialog',
                        'label' => $this->module->l('Payment Image', 'FooterForm'),
                        'name' =>  'footer_payment_image',
                        'size' => 30
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'FooterForm'),
                ),
            ),
        );
    }
}
