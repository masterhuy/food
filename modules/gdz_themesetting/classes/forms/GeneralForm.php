<?php

if (!defined('_PS_VERSION_')) {
    exit;
}


class gdzGeneralForm
{
    public $module;

    public function __construct()
    {
        $this->module = Module::getInstanceByName('gdz_themesetting');
    }
    public function getGeneralForm()
    {
        $_fieldsets = array();
        $_fieldsets[] = $this->getGeneralTabForm();
        $_fieldsets[] = $this->getGeneralLayoutForm();
        $_fieldsets[] = $this->getGeneralTypoForm();
        $_fieldsets[] = $this->getGeneralLogoForm();
        $_fieldsets[] = $this->getGeneralButtonForm();
        $_fieldsets[] = $this->getProductBoxForm();
        $_fieldsets[] = $this->getQuickViewForm();
        $_fieldsets[] = $this->getBreadcrumbForm();
        $_fieldsets[] = $this->getIconForm();
        $_fieldsets[] = $this->getCarouselForm();
        return $_fieldsets;
    }
    public function getGeneralTabForm()
    {
        return array(
            'form' => array(
                'childForms' => array(
                    'gdz-general-layout'  => $this->module->l('Layout', 'GeneralForm'),
                    'gdz-general-typo'  => $this->module->l('Typography', 'GeneralForm'),
                    'gdz-general-logo'  => $this->module->l('Logo', 'GeneralForm'),
                    'gdz-general-button'  => $this->module->l('Button', 'GeneralForm'),
                    'gdz-product-box'  => $this->module->l('Product Box', 'GeneralForm'),
                    'gdz-quick-view'  => $this->module->l('Quick View', 'GeneralForm'),
                    'gdz-breadcrumb'  => $this->module->l('Breadcrumb', 'GeneralForm'),
                    'gdz-general-icons'  => $this->module->l('Icons', 'GeneralForm'),
                    'gdz-carousel'  => $this->module->l('Carousel', 'GeneralForm'),
                ),
                'legend' => array(
                    'title' => $this->module->l('General', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-general-tab',
                    'heading_icon' => 'settings'
                ),
            ),
        );
    }
    public function getGeneralLayoutForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Layout', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-general-layout'
                ),
                'input' => array(
                      array(
                          'type' => 'switch-label',
                          'label' => $this->module->l('Body Width Layout', 'GeneralForm'),
                          'name' => 'body_width',
                          'values'    => array(
                              array('id'    => 'active_on','value' => 1,'label' => $this->module->l('Boxed', 'GeneralForm')),
                              array('id'    => 'active_off','value' => 0,'label' => $this->module->l('Wide', 'GeneralForm'))
                          ),
                          'width' => '260'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Container Max Width', 'GeneralForm'),
                          'desc' => $this->module->l('Body\'s container max width. You must provide px or percent suffix. Example: 1200px or 90%', 'GeneralForm'),
                          'name' => 'body_container_width',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl',
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Background Setting', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Background Type', 'GeneralForm'),
                          'name' => 'body_bg',
                          'options' => array(
                              'query' => array(
                                array(
                                    'id_option' => '',
                                    'name' => $this->module->l('None', 'GeneralForm'),
                                ),
                                  array(
                                      'id_option' => 'image',
                                      'name' => $this->module->l('Image', 'GeneralForm'),
                                  ),
                                  array(
                                      'id_option' => 'color',
                                      'name' => $this->module->l('Color', 'GeneralForm'),
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'GeneralForm'),
                          'name' => 'body_bg_color',
                          'desc' => $this->module->l('Choose background color for Body.', 'GeneralForm'),
                          'condition' => array(
                              'body_bg' => '==color'
                          ),
                      ),
                      array(
                          'type' => 'background-img',
                          'label' => $this->module->l('Background Image', 'GeneralForm'),
                          'name' => 'body_bg_image',
                          'condition' => array(
                              'body_bg' => '==image'
                          ),
                      )
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }
    public function getGeneralTypoForm()
    {
        $path = _PS_MODULE_DIR_."/gdz_themesetting/views/fonts/google/fonts.json";
        $request = file_get_contents( $path );
        $fonts = json_decode( $request, true );
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Typography', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-general-typo'
                ),
                'input' => array(
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Google Font', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'googlefont',
                          'label' => $this->module->l('Google Fonts', 'GeneralForm'),
                          'name' => 'body_font_google',
                          'fonts' => $fonts,
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Icon Font', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'switch',
                          'label' => $this->module->l('Awesome Icon Fonts', 'GeneralForm'),
                          'name' => 'awesome_font',
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
                      array(
                          'type' => 'switch-label',
                          'label' => $this->module->l('Load From', 'GeneralForm'),
                          'name' => 'awesome_from',
                          'values'    => array(
                              array('id'    => 'active_on','value' => 1,'label' => $this->module->l('From CDN', 'GeneralForm')),
                              array('id'    => 'active_off','value' => 0,'label' => $this->module->l('From Url', 'GeneralForm'))
                          ),
                          'width' => '260',
                          'condition' => array(
                              'awesome_font' => '==1'
                          ),
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Awesome Url', 'GeneralForm'),
                          'name' => 'awesome_font_url',
                          'class' => 'fixed-width-xxl',
                          'condition' => array(
                              'awesome_font' => '==1',
                              'awesome_from' => '==0'
                          ),
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Custom Font', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'fontcssurl',
                          'label' => $this->module->l('Css File', 'GeneralForm'),
                          'desc' => $this->module->l('Enter font css url, each url per one line', 'GeneralForm'),
                          'name' => 'body_fontcssurl'
                      ),
                      array(
                          'type' => 'fontfileurl',
                          'label' => $this->module->l('Font File Url', 'GeneralForm'),
                          'desc' => $this->module->l('Enter font file url, each url per one line', 'GeneralForm'),
                          'name' => 'body_fontfileurl'
                      ),
                      array(
                          'type' => 'number',
                          'label' => $this->module->l('Font size', 'GeneralForm'),
                          'name' => 'body_fontsize',
                          'class' => 'fixed-width-xxl',
                          'min' => 6,
                          'size' => 30,
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Text Color', 'GeneralForm'),
                          'name' => 'body_text_color',
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Color', 'GeneralForm'),
                          'name' => 'body_link_color',
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Hover Color', 'GeneralForm'),
                          'name' => 'body_link_hover_color',
                      ),
                      array(
                          'type' => 'number',
                          'label' => $this->module->l('Line Height', 'GeneralForm'),
                          'name' => 'body_lineheight',
                          'class' => 'fixed-width-xxl',
                          'min' => 0.5,
                          'step' => 0.1,
                          'size' => 30,
                          'suffix' => 'rem'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Heading Color', 'GeneralForm'),
                          'name' => 'heading_text_color',
                          'desc' => $this->module->l('Choose color for Heading.', 'GeneralForm'),
                      ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }
    public function getGeneralLogoForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Logo Setting', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-general-logo'
                ),
                'input' => array(
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Logo Source', 'GeneralForm'),
                          'name' => 'logo_source',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'default',
                                      'name' => $this->module->l('Default of Prestashop Theme', 'GeneralForm'),
                                  ),
                                  array(
                                      'id_option' => 'image',
                                      'name' => $this->module->l('Image', 'GeneralForm'),
                                  ),
                                  array(
                                      'id_option' => 'text',
                                      'name' => $this->module->l('Text', 'GeneralForm'),
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'file-dialog',
                          'label' => $this->module->l('Logo Image', 'GeneralForm'),
                          'name' => 'logo_image',
                          'condition' => array(
                              'logo_source' => '==image'
                          ),
                      ),
                      array(
                          'type' => 'textarea',
                          'label' => $this->module->l('Logo Text', 'GeneralForm'),
                          'name' => 'logo_text',
                          'condition' => array(
                              'logo_source' => '==text'
                          ),
                          'class' => 'fixed-width-xxl',
                          'autoload_rte' => false,
                          'lang' => true
                      ),
                      array(
                          'type' => 'fontstyle',
                          'label' => $this->module->l('Text Style', 'GeneralForm'),
                          'name' => 'logo_text_font',
                          'condition' => array(
                              'logo_source' => '==text'
                          ),
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Text Color', 'GeneralForm'),
                          'name' => 'logo_text_color',
                          'condition' => array(
                              'logo_source' => '==text'
                          ),
                      ),
                      array(
                          'type' => 'number',
                          'label' => $this->module->l('Letter Spacing', 'GeneralForm'),
                          'name' => 'logo_text_letterspacing',
                          'condition' => array(
                              'logo_source' => '==text'
                          ),
                          'class' => 'fixed-width-xl',
                          'min' => 0,
                          'step' => 0.05,
                          'max' => 5,
                          'size' => 30,
                          'suffix' => 'em'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Border Radius'),
                          'name' => 'logo_text_border_radius',
                          'condition' => array(
                              'logo_source' => '==text'
                          ),
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'fieldtype' => 'border-radius',
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'border',
                          'label' => $this->module->l('Border', 'GeneralForm'),
                          'name' => 'logo_text_border',
                          'condition' => array(
                              'logo_source' => '==text'
                          ),
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Logo Text Padding'),
                          'name' => 'logo_text_padding',
                          'condition' => array(
                              'logo_source' => '==text'
                          ),
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }
    public function getGeneralButtonForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Button', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-general-button'
                ),
                'input' => array(
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Text Color', 'GeneralForm'),
                          'name' => 'button_text_color',
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'GeneralForm'),
                          'name' => 'button_bg_color',
                      ),
                      array(
                          'type' => 'fontstyle',
                          'label' => $this->module->l('Text Style', 'GeneralForm'),
                          'name' => 'button_text_font',
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'number',
                          'label' => $this->module->l('Letter Spacing', 'GeneralForm'),
                          'name' => 'button_text_letterspacing',
                          'class' => 'fixed-width-xxl',
                          'min' => 0,
                          'step' => 0.05,
                          'max' => 5,
                          'size' => 30,
                          'suffix' => 'em'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Button Padding'),
                          'name' => 'button_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Border Radius'),
                          'name' => 'button_border_radius',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'fieldtype' => 'border-radius',
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'border',
                          'label' => $this->module->l('Border', 'GeneralForm'),
                          'name' => 'button_border',
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Button Hover', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Text Hover Color', 'GeneralForm'),
                          'name' => 'button_hover_text_color',
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Hover Color', 'GeneralForm'),
                          'name' => 'button_hover_bg_color',
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Border Hover Color', 'GeneralForm'),
                          'name' => 'button_hover_border_color',
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Active Button - Primary, Confirm, Action Highlight Button', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Text Color', 'GeneralForm'),
                          'name' => 'button_active_text_color',
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'GeneralForm'),
                          'name' => 'button_active_bg_color',
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Border Color', 'GeneralForm'),
                          'name' => 'button_active_border_color',
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Small Button', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Button Padding'),
                          'name' => 'button_small_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'fontstyle',
                          'label' => $this->module->l('Text Style', 'GeneralForm'),
                          'name' => 'button_small_text_font',
                          'suffix' => 'px'
                      ),

                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }

    public function getProductBoxForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Product Box Setting', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-product-box'
                ),
                'input' => array(
                    array(
                        'type' => 'image-select',
                        'label' => $this->module->l('Product Box Type', 'GeneralForm'),
                        'name' => 'productbox_type',
                        'direction' => 'horizonal',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'product-1',
                                    'name' => $this->module->l('Box 1', 'GeneralForm'),
                                    'img' => 'productbox/box-1.jpg'
                                ),
                                array(
                                    'id_option' => 'product-2',
                                    'name' => $this->module->l('Box 2', 'GeneralForm'),
                                    'img' => 'productbox/box-2.jpg'
                                ),
                                array(
                                    'id_option' => 'product-3',
                                    'name' => $this->module->l('Box 3', 'GeneralForm'),
                                    'img' => 'productbox/box-3.jpg'
                                ),
                                array(
                                    'id_option' => 'product-4',
                                    'name' => $this->module->l('Box 4', 'GeneralForm'),
                                    'img' => 'productbox/box-4.jpg'
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Add to Cart', 'GeneralForm'),
                        'name' => 'productbox_addtocart',
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
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Quick View', 'GeneralForm'),
                        'name' => 'productbox_quickview',
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
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Wishlist', 'GeneralForm'),
                        'name' => 'productbox_wishlist',
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
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Price', 'GeneralForm'),
                        'name' => 'productbox_price',
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
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Category', 'GeneralForm'),
                        'name' => 'productbox_category',
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
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Variant', 'GeneralForm'),
                        'name' => 'productbox_variant',
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
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Image Hover', 'GeneralForm'),
                        'name' => 'productbox_hover',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'blur',
                                    'name' => $this->module->l('Blur Image', 'GeneralForm'),
                                ),
                                array(
                                    'id_option' => 'swap-image',
                                    'name' => $this->module->l('Swap Image', 'GeneralForm'),
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Product Title', 'GeneralForm'),
                        'name' => 'productbox_title_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Product Title Color', 'GeneralForm'),
                        'name' => 'productbox_title_color'
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Price Text', 'GeneralForm'),
                        'name' => 'productbox_price_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Price Text Color', 'GeneralForm'),
                        'name' => 'productbox_price_color'
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }

    public function getQuickViewForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Quick View Setting', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-quick-view'
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Social Sharing', 'GeneralForm'),
                        'name' => 'quickview_sharing',
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
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Product Title', 'GeneralForm'),
                        'name' => 'quickview_title_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Product Title Color', 'GeneralForm'),
                        'name' => 'quickview_title_color'
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Price Text', 'GeneralForm'),
                        'name' => 'quickview_price_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Price Text Color', 'GeneralForm'),
                        'name' => 'quickview_price_color'
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }
    public function getBreadcrumbForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Breadcrumb Setting', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-breadcrumb'
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Breadcrumb', 'GeneralForm'),
                        'name' => 'breadcrumb',
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
                    array(
                        'type' => 'switch-label',
                        'label' => $this->module->l('Width', 'GeneralForm'),
                        'name' => 'breadcrumb_width',
                        'values'    => array(
                            array('id'    => 'active_on','value' => 1,'label' => $this->module->l('Boxed', 'GeneralForm')),
                            array('id'    => 'active_off','value' => 0,'label' => $this->module->l('FullWidth', 'GeneralForm'))
                        ),
                        'width' => '260'
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Align', 'GeneralForm'),
                        'name' => 'breadcrumb_align',
                        'options' => array(
                            'query' => array(
                              array(
                                  'id_option' => 'left',
                                  'name' => $this->module->l('Left', 'GeneralForm')
                              ),
                                array(
                                    'id_option' => 'center',
                                    'name' => $this->module->l('Center', 'GeneralForm')
                                ),
                                array(
                                    'id_option' => 'right',
                                    'name' => $this->module->l('Right', 'GeneralForm'),
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'text-group',
                        'label' => $this->module->l('Padding'),
                        'name' => 'breadcrumb_padding',
                        'desc' => $this->module->l('leave blank if you dont want to set'),
                        'suffix' => 'px',
                        'size' => 5
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Text Style', 'GeneralForm'),
                        'name' => 'breadcrumb_text_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Text Color', 'GeneralForm'),
                        'name' => 'breadcrumb_text_color'
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Seperator Type', 'GeneralForm'),
                        'name' => 'breadcrumb_seperator',
                        'options' => array(
                            'query' => array(
                              array(
                                  'id_option' => '',
                                  'name' => '/',
                              ),
                                array(
                                    'id_option' => 'arrow',
                                    'name' => '>',
                                ),
                                array(
                                    'id_option' => 'dash',
                                    'name' => $this->module->l('-', 'GeneralForm'),
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Background Type', 'GeneralForm'),
                        'name' => 'breadcrumb_bg',
                        'options' => array(
                            'query' => array(
                              array(
                                  'id_option' => '',
                                  'name' => $this->module->l('None', 'GeneralForm'),
                              ),
                                array(
                                    'id_option' => 'image',
                                    'name' => $this->module->l('Image', 'GeneralForm'),
                                ),
                                array(
                                    'id_option' => 'color',
                                    'name' => $this->module->l('Color', 'GeneralForm'),
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Background Color', 'GeneralForm'),
                        'name' => 'breadcrumb_bg_color',
                        'desc' => $this->module->l('Choose background color for breadcrumb.', 'GeneralForm'),
                        'condition' => array(
                            'breadcrumb_bg' => '==color'
                        ),
                    ),
                    array(
                        'type' => 'background-img',
                        'label' => $this->module->l('Background Image', 'GeneralForm'),
                        'name' => 'breadcrumb_bg_image',
                        'condition' => array(
                            'breadcrumb_bg' => '==image'
                        ),
                    )
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }

    public function getBlockTitleForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Block Title Setting', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-blocktitle'
                ),
                'input' => array(
                  array(
                      'type' => 'image-select',
                      'label' => $this->module->l('Block Title Layout', 'GeneralForm'),
                      'name' => 'blocktitle_layout',
                      'direction' => 'vertical',
                      'options' => array(
                          'query' => array(
                              array(
                                  'id_option' => 1,
                                  'name' => $this->module->l('Layout 1', 'GeneralForm'),
                                  'img' => 'blocktitle/1.jpg'
                              ),
                              array(
                                  'id_option' => 2,
                                  'name' => $this->module->l('Layout 2', 'GeneralForm'),
                                  'img' => 'blocktitle/2.jpg'
                              ),
                              array(
                                  'id_option' => 3,
                                  'name' => $this->module->l('Layout 3', 'GeneralForm'),
                                  'img' => 'blocktitle/3.jpg'
                              ),
                              array(
                                  'id_option' => 4,
                                  'name' => $this->module->l('Layout 4', 'GeneralForm'),
                                  'img' => 'blocktitle/4.jpg'
                              ),
                              array(
                                  'id_option' => 5,
                                  'name' => $this->module->l('Layout 5', 'GeneralForm'),
                                  'img' => 'blocktitle/5.jpg'
                              ),
                              array(
                                  'id_option' => 6,
                                  'name' => $this->module->l('Layout 6', 'GeneralForm'),
                                  'img' => 'blocktitle/6.jpg'
                              ),
                          ),
                          'id' => 'id_option',
                          'name' => 'name',
                      ),
                  ),
                  array(
                      'type' => 'title_separator',
                      'label' => $this->module->l('Block Title Style', 'GeneralForm'),
                      'size' => 30,
                      'border_top' => false
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Block Margin'),
                      'name' => 'blocktitle_margin',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'switch',
                      'label' => $this->module->l('Show Block Title', 'GeneralForm'),
                      'name' => 'blocktitle_title',
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
                  array(
                      'type' => 'fontstyle',
                      'label' => $this->module->l('Title Style', 'GeneralForm'),
                      'name' => 'blocktitle_title_font',
                      'condition' => array(
                          'blocktitle_title' => '==1'
                      ),
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Title Color', 'GeneralForm'),
                      'name' => 'blocktitle_title_color',
                      'condition' => array(
                          'blocktitle_title' => '==1'
                      ),
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Block Title Padding'),
                      'name' => 'blocktitle_title_padding',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'switch',
                      'label' => $this->module->l('Show Block Description', 'GeneralForm'),
                      'name' => 'blocktitle_desc',
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
                  array(
                      'type' => 'fontstyle',
                      'label' => $this->module->l('Block Description Style', 'GeneralForm'),
                      'name' => 'blocktitle_desc_font',
                      'condition' => array(
                          'blocktitle_desc' => '==1'
                      ),
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Block Description Color', 'GeneralForm'),
                      'name' => 'blocktitle_desc_color',
                      'condition' => array(
                          'blocktitle_desc' => '==1'
                      )
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Block Description Padding'),
                      'name' => 'blocktitle_desc_padding',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'number',
                      'label' => $this->module->l('Seperator Height', 'GeneralForm'),
                      'name' => 'blocktitle_seperator_height',
                      'class' => 'fixed-width-xxl',
                      'min' => 1,
                      'step' => 1,
                      'max' => 10,
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Seperator Line Color', 'GeneralForm'),
                      'name' => 'blocktitle_seperator_color'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Seperator Highlight Color', 'GeneralForm'),
                      'name' => 'blocktitle_seperator_hl_color'
                  )
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }
    public function getBlockTabForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Block Tab Setting', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-blocktab'
                ),
                'input' => array(
                  array(
                      'type' => 'image-select',
                      'label' => $this->module->l('Tab Layout', 'GeneralForm'),
                      'name' => 'blocktab_layout',
                      'direction' => 'vertical',
                      'options' => array(
                          'query' => array(
                              array(
                                  'id_option' => 1,
                                  'name' => $this->module->l('Layout 1', 'GeneralForm'),
                                  'img' => 'blocktitle/tab-1.jpg'
                              ),
                              array(
                                  'id_option' => 2,
                                  'name' => $this->module->l('Layout 2', 'GeneralForm'),
                                  'img' => 'blocktitle/tab-2.jpg'
                              ),
                              array(
                                  'id_option' => 3,
                                  'name' => $this->module->l('Layout 3', 'GeneralForm'),
                                  'img' => 'blocktitle/tab-3.jpg'
                              ),
                              array(
                                  'id_option' => 4,
                                  'name' => $this->module->l('Layout 4', 'GeneralForm'),
                                  'img' => 'blocktitle/tab-4.jpg'
                              )
                          ),
                          'id' => 'id_option',
                          'name' => 'name',
                      ),
                  ),
                  array(
                      'type' => 'title_separator',
                      'label' => $this->module->l('Block Tab Style', 'GeneralForm'),
                      'size' => 30,
                      'border_top' => false
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Block Margin'),
                      'name' => 'blocktab_margin',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'switch',
                      'label' => $this->module->l('Show Block Title', 'GeneralForm'),
                      'name' => 'blocktab_title',
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
                  array(
                      'type' => 'fontstyle',
                      'label' => $this->module->l('Title Style', 'GeneralForm'),
                      'name' => 'blocktab_title_font',
                      'condition' => array(
                          'blocktab_title' => '==1'
                      ),
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Title Color', 'GeneralForm'),
                      'name' => 'blocktab_title_color',
                      'condition' => array(
                          'blocktab_title' => '==1'
                      ),
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Block Title Padding'),
                      'name' => 'blocktab_title_padding',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'switch',
                      'label' => $this->module->l('Show Block Description', 'GeneralForm'),
                      'name' => 'blocktab_desc',
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
                  array(
                      'type' => 'fontstyle',
                      'label' => $this->module->l('Block Description Style', 'GeneralForm'),
                      'name' => 'blocktab_desc_font',
                      'condition' => array(
                          'blocktab_desc' => '==1'
                      ),
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Block Description Color', 'GeneralForm'),
                      'name' => 'blocktab_desc_color',
                      'condition' => array(
                          'blocktab_desc' => '==1'
                      )
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Block Description Padding'),
                      'name' => 'blocktab_desc_padding',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'fontstyle',
                      'label' => $this->module->l('Tab Item Style', 'GeneralForm'),
                      'name' => 'blocktab_item_font',
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Tab Item Color', 'GeneralForm'),
                      'name' => 'blocktab_item_color',
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Tab Item Active Color', 'GeneralForm'),
                      'name' => 'blocktab_item_active_color'
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Tab Item Padding'),
                      'name' => 'blocktab_item_padding',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Tab Item Margin'),
                      'name' => 'blocktab_item_margin',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'number',
                      'label' => $this->module->l('Seperator Height', 'GeneralForm'),
                      'name' => 'blocktab_seperator_height',
                      'class' => 'fixed-width-xxl',
                      'min' => 1,
                      'step' => 1,
                      'max' => 10,
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Seperator Line Color', 'GeneralForm'),
                      'name' => 'blocktab_seperator_color'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Seperator Highlight Color', 'GeneralForm'),
                      'name' => 'blocktab_seperator_hl_color'
                  ),
                  array(
                      'type' => 'title_separator',
                      'label' => $this->module->l('Tab Layout', 'GeneralForm'),
                      'size' => 30,
                      'border_top' => false
                  ),

                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }
    public function getCarouselForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Carousel Setting', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-carousel'
                ),
                'input' => array(
                  array(
                      'type' => 'switch',
                      'label' => $this->module->l('Image LazyLoad', 'GeneralForm'),
                      'name' => 'carousel_lazyload',
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
                  array(
                      'type' => 'title_separator',
                      'label' => $this->module->l('Navigation Setting', 'GeneralForm'),
                      'size' => 30,
                      'border_top' => false
                  ),
                  array(
                      'type' => 'image-select',
                      'label' => $this->module->l('Navigation Style', 'GeneralForm'),
                      'name' => 'carousel_nav_type',
                      'direction' => 'horizonal',
                      'options' => array(
                          'query' => array(
                              array(
                                  'id_option' => 1,
                                  'name' => $this->module->l('Style 1', 'GeneralForm'),
                                  'img' => 'carousel/nav-1.jpg'
                              ),
                              array(
                                  'id_option' => 2,
                                  'name' => $this->module->l('Style 2', 'GeneralForm'),
                                  'img' => 'carousel/nav-2.jpg'
                              )
                          ),
                          'id' => 'id_option',
                          'name' => 'name',
                      ),
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Margin'),
                      'name' => 'carousel_nav_margin',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'border',
                      'label' => $this->module->l('Arrow Border', 'GeneralForm'),
                      'name' => 'carousel_nav_border',
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Arrow Color', 'GeneralForm'),
                      'name' => 'carousel_nav_arrow_color'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Arrow Hover Color', 'GeneralForm'),
                      'name' => 'carousel_nav_arrow_hover_color'
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Background Hover Color', 'GeneralForm'),
                      'name' => 'carousel_nav_bg_hover_color'
                  ),
                  array(
                      'type' => 'select',
                      'label' => $this->module->l('Navigation Show', 'GeneralForm'),
                      'name' => 'carousel_nav_show',
                      'options' => array(
                          'query' => array(
                              array(
                                  'id_option' => '',
                                  'name' => $this->module->l('Always Show', 'GeneralForm'),
                              ),
                              array(
                                  'id_option' => 'swh',
                                  'name' => $this->module->l('Show when hover', 'GeneralForm'),
                              ),
                          ),
                          'id' => 'id_option',
                          'name' => 'name',
                      ),
                  ),
                  array(
                      'type' => 'title_separator',
                      'label' => $this->module->l('Pagination', 'GeneralForm'),
                      'size' => 30,
                      'border_top' => false
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Margin'),
                      'name' => 'carousel_pag_margin',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'border',
                      'label' => $this->module->l('Dot Border', 'GeneralForm'),
                      'name' => 'carousel_pag_dot_border',
                      'suffix' => 'px'
                  ),
                  array(
                      'type' => 'text-group',
                      'label' => $this->module->l('Dot Margin'),
                      'name' => 'carousel_pag_dot_margin',
                      'desc' => $this->module->l('leave blank if you dont want to set'),
                      'suffix' => 'px',
                      'size' => 5
                  ),
                  array(
                      'type' => 'color',
                      'label' => $this->module->l('Active Dot Color', 'GeneralForm'),
                      'name' => 'carousel_pag_dot_active_color'
                  ),
                  array(
                      'type' => 'select',
                      'label' => $this->module->l('Pagination Show', 'GeneralForm'),
                      'name' => 'carousel_pag_show',
                      'options' => array(
                          'query' => array(
                              array(
                                  'id_option' => '',
                                  'name' => $this->module->l('Always Show', 'GeneralForm'),
                              ),
                              array(
                                  'id_option' => 'swh',
                                  'name' => $this->module->l('Show when hover', 'GeneralForm'),
                              ),
                          ),
                          'id' => 'id_option',
                          'name' => 'name',
                      ),
                  ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }
    public function getIconForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Icons', 'GeneralForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-general-icons'
                ),
                'input' => array(
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Icon Thickness', 'GeneralForm'),
                          'name' => 'icon_thickness',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => '_light',
                                      'name' => $this->module->l('Light', 'GeneralForm'),
                                  ),
                                  array(
                                      'id_option' => '_medium',
                                      'name' => $this->module->l('Medium', 'GeneralForm'),
                                  ),
                                  array(
                                      'id_option' => '_bold',
                                      'name' => $this->module->l('Bold', 'GeneralForm'),
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Cart Icon', 'GeneralForm'),
                          'name' => 'cart_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-cart-1_light',
                                      'name' => $this->module->l('Cart 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-2_light',
                                      'name' => $this->module->l('Cart 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-3_light',
                                      'name' => $this->module->l('Cart 3', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-4_light',
                                      'name' => $this->module->l('Cart 4', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-5_light',
                                      'name' => $this->module->l('Cart 5', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-6_light',
                                      'name' => $this->module->l('Cart 6', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-7_light',
                                      'name' => $this->module->l('Cart 7', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-8_light',
                                      'name' => $this->module->l('Cart 8', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-9_light',
                                      'name' => $this->module->l('Cart 9', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-10_light',
                                      'name' => $this->module->l('Cart 10', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-11_light',
                                      'name' => $this->module->l('Cart 11', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-12_light',
                                      'name' => $this->module->l('Cart 12', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-13_light',
                                      'name' => $this->module->l('Cart 13', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-14_light',
                                      'name' => $this->module->l('Cart 14', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-15_light',
                                      'name' => $this->module->l('Cart 15', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-16',
                                      'name' => $this->module->l('Cart 16', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-17',
                                      'name' => $this->module->l('Cart 17', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-18',
                                      'name' => $this->module->l('Cart 18', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-cart-19',
                                      'name' => $this->module->l('Cart 19', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Search Icon', 'GeneralForm'),
                          'name' => 'search_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-search-1_light',
                                      'name' => $this->module->l('Search 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-2_light',
                                      'name' => $this->module->l('Search 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-3_light',
                                      'name' => $this->module->l('Search 3', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-4_light',
                                      'name' => $this->module->l('Search 4', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-5_light',
                                      'name' => $this->module->l('Search 5', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-6_light',
                                      'name' => $this->module->l('Search 6', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-7_light',
                                      'name' => $this->module->l('Search 7', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-8_light',
                                      'name' => $this->module->l('Search 8', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-9_light',
                                      'name' => $this->module->l('Search 9', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-search-10_light',
                                      'name' => $this->module->l('Search 10', 'GeneralForm')
                                  ),
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Wishlist Icon', 'GeneralForm'),
                          'name' => 'wishlist_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-1_light',
                                      'name' => $this->module->l('Wishlist 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-2_light',
                                      'name' => $this->module->l('Wishlist 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-3_light',
                                      'name' => $this->module->l('Wishlist 3', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-4_light',
                                      'name' => $this->module->l('Wishlist 4', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-5_light',
                                      'name' => $this->module->l('Wishlist 5', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-6_light',
                                      'name' => $this->module->l('Wishlist 6', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-7_light',
                                      'name' => $this->module->l('Wishlist 7', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-8_light',
                                      'name' => $this->module->l('Wishlist 8', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-9_light',
                                      'name' => $this->module->l('Wishlist 9', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-10_light',
                                      'name' => $this->module->l('Wishlist 10', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-11_light',
                                      'name' => $this->module->l('Wishlist 11', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-wishlist-12_light',
                                      'name' => $this->module->l('Wishlist 12', 'GeneralForm')
                                  ),
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('User Icon', 'GeneralForm'),
                          'name' => 'customersignin_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-user-1_light',
                                      'name' => $this->module->l('User 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-2_light',
                                      'name' => $this->module->l('User 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-3_light',
                                      'name' => $this->module->l('User 3', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-4_light',
                                      'name' => $this->module->l('User 4', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-5_light',
                                      'name' => $this->module->l('User 5', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-6_light',
                                      'name' => $this->module->l('User 6', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-7_light',
                                      'name' => $this->module->l('User 7', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-8_light',
                                      'name' => $this->module->l('User 8', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-9_light',
                                      'name' => $this->module->l('User 9', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-10_medium',
                                      'name' => $this->module->l('User 10', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-11',
                                      'name' => $this->module->l('User 11', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-12',
                                      'name' => $this->module->l('User 12', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-user-13',
                                      'name' => $this->module->l('User 14', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Close Icon', 'GeneralForm'),
                          'name' => 'close_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-close-1_light',
                                      'name' => $this->module->l('Close 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-close-2_light',
                                      'name' => $this->module->l('Close 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Delete Icon', 'GeneralForm'),
                          'name' => 'delete_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-delete-1_light',
                                      'name' => $this->module->l('Delete 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-delete-2_light',
                                      'name' => $this->module->l('Delete 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Grid Icon', 'GeneralForm'),
                          'name' => 'grid_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-grid-1_light',
                                      'name' => $this->module->l('Grid 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-grid-2_light',
                                      'name' => $this->module->l('Grid 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-grid-3_light',
                                      'name' => $this->module->l('Grid 3', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-grid-4_light',
                                      'name' => $this->module->l('Grid 4', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('List Icon', 'GeneralForm'),
                          'name' => 'list_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-list-1_light',
                                      'name' => $this->module->l('Grid 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-list-2_light',
                                      'name' => $this->module->l('Grid 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-list-3_light',
                                      'name' => $this->module->l('Grid 3', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Menu Icon', 'GeneralForm'),
                          'name' => 'menu_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-menu-1_light',
                                      'name' => $this->module->l('Menu 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-menu-2_light',
                                      'name' => $this->module->l('Menu 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-menu-3_light',
                                      'name' => $this->module->l('Menu 3', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('More Icon', 'GeneralForm'),
                          'name' => 'more_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-more-1_light',
                                      'name' => $this->module->l('More 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-more-2_light',
                                      'name' => $this->module->l('Menu Rounded', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Less Icon', 'GeneralForm'),
                          'name' => 'less_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-less-1_light',
                                      'name' => $this->module->l('Less 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-less-2_light',
                                      'name' => $this->module->l('Less Rounded', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Left Icon', 'GeneralForm'),
                          'name' => 'left_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-left-1_light',
                                      'name' => $this->module->l('Left 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-left-2_light',
                                      'name' => $this->module->l('Left 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-left-3_light',
                                      'name' => $this->module->l('Left 3', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-left-4_light',
                                      'name' => $this->module->l('Left 4', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-left-5_light',
                                      'name' => $this->module->l('Left 5', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Right Icon', 'GeneralForm'),
                          'name' => 'right_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-right-1_light',
                                      'name' => $this->module->l('Right 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-right-2_light',
                                      'name' => $this->module->l('Right 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-right-3_light',
                                      'name' => $this->module->l('Right 3', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-right-4_light',
                                      'name' => $this->module->l('Right 4', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-right-5_light',
                                      'name' => $this->module->l('Right 5', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Send Icon', 'GeneralForm'),
                          'name' => 'send_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-send-1_light',
                                      'name' => $this->module->l('Send 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-send-2_light',
                                      'name' => $this->module->l('Send 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-send-3_light',
                                      'name' => $this->module->l('Send 3', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Preview Icon', 'GeneralForm'),
                          'name' => 'preview_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-preview-1_light',
                                      'name' => $this->module->l('Preview 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-preview-2_light',
                                      'name' => $this->module->l('Preview 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Calendar Icon', 'GeneralForm'),
                          'name' => 'calendar_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-calendar-1_light',
                                      'name' => $this->module->l('Calendar 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-calendar-2_light',
                                      'name' => $this->module->l('Calendar 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Comment Icon', 'GeneralForm'),
                          'name' => 'comment_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-comment-1_light',
                                      'name' => $this->module->l('Comment 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-comment-2_light',
                                      'name' => $this->module->l('Comment 2', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-comment-3_light',
                                      'name' => $this->module->l('Comment 3', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Facebook Icon', 'GeneralForm'),
                          'name' => 'facebook_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-facebook-1_light',
                                      'name' => $this->module->l('Facebook 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-facebook-2',
                                      'name' => $this->module->l('Facebook 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Twitter Icon', 'GeneralForm'),
                          'name' => 'twitter_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-twitter-1_light',
                                      'name' => $this->module->l('Twitter 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-twitter-2',
                                      'name' => $this->module->l('Twitter 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Youtube Icon', 'GeneralForm'),
                          'name' => 'youtube_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-youtube-1_light',
                                      'name' => $this->module->l('Youtube 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-youtube-2',
                                      'name' => $this->module->l('Youtube 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Whatsapp Icon', 'GeneralForm'),
                          'name' => 'whatsapp_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-whatsapp-1_light',
                                      'name' => $this->module->l('Whatsapp 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-whatsapp-2',
                                      'name' => $this->module->l('Whatsapp 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Instagram Icon', 'GeneralForm'),
                          'name' => 'instagram_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-instagram-1_light',
                                      'name' => $this->module->l('Instagram 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-instagram-2',
                                      'name' => $this->module->l('Instagram 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Skype Icon', 'GeneralForm'),
                          'name' => 'skype_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-skype-1_light',
                                      'name' => $this->module->l('Skype 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-skype-2',
                                      'name' => $this->module->l('Skype 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Linkedin Icon', 'GeneralForm'),
                          'name' => 'linkedin_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-linkedin-1_light',
                                      'name' => $this->module->l('Linkedin 1', 'GeneralForm')
                                  ),
                                  array(
                                      'id_option' => 'gdz-icon-linkedin-2',
                                      'name' => $this->module->l('Linkedin 2', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'icon-select',
                          'label' => $this->module->l('Pinterest Icon', 'GeneralForm'),
                          'name' => 'pinterest_icon',
                          'options' => array(
                              'query' => array(
                                  array(
                                      'id_option' => 'gdz-icon-pinterest-1_light',
                                      'name' => $this->module->l('Pinterest 1', 'GeneralForm')
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'GeneralForm'),
                ),
            ),
        );
    }
}
