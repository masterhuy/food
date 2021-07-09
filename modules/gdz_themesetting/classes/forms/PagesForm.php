<?php

if (!defined('_PS_VERSION_')) {
    exit;
}


class gdzPagesForm
{
    public $module;

    public function __construct()
    {
        $this->module = Module::getInstanceByName('gdz_themesetting');
    }
    public function getPagesForm()
    {
      $_fieldsets = array();
      $_fieldsets[] = $this->getPagesTabForm();
      $_fieldsets[] = $this->getShopPageForm();
      $_fieldsets[] = $this->getProductPageForm();
      $_fieldsets[] = $this->getContactPageForm();
      $_fieldsets[] = $this->getLoginPageForm();
      return $_fieldsets;
    }
    public function getPagesTabForm()
    {
        return array(
            'form' => array(
                'childForms' => array(
                    'gdz-shop-page'  => $this->module->l('Shop Page', 'PagesForm'),
                    'gdz-product-page'  => $this->module->l('Product Page', 'PagesForm'),
                    'gdz-login-page'  => $this->module->l('Login Page', 'PagesForm'),
                    'gdz-contact-page'  => $this->module->l('Contact Page', 'PagesForm'),

                ),
                'legend' => array(
                    'title' => $this->module->l('Pages Setting', 'PagesForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-pages-tab',
                    'heading_icon' => 'description'
                ),
            ),
        );
    }
    public function getShopPageForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Shop Page', 'PagesForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-shop-page'
                ),
                'input' => array(
                    array(
                        'type' => 'switch-label',
                        'label' => $this->module->l('Width', 'PagesForm'),
                        'name' => 'shop_width',
                        'values'    => array(
                            array('id'    => 'active_on','value' => 1,'label' => $this->module->l('Container', 'PagesForm')),
                            array('id'    => 'active_off','value' => 0,'label' => $this->module->l('FullWidth', 'PagesForm'))
                        ),
                        'width' => '260'
                    ),
                    array(
                        'type' => 'image-select',
                        'label' => $this->module->l('Page Layout', 'PagesForm'),
                        'name' => 'shop_layout',
                        'direction' => 'horizonal',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'left-sidebar',
                                    'name' => $this->module->l('Left Sidebar', 'PagesForm'),
                                    'img' => 'shop/left-sidebar.jpg'
                                ),
                                array(
                                    'id_option' => 'right-sidebar',
                                    'name' => $this->module->l('Right Sidebar', 'PagesForm'),
                                    'img' => 'shop/right-sidebar.jpg'
                                ),
                                array(
                                    'id_option' => 'no-sidebar',
                                    'name' => $this->module->l('No Sidebar', 'PagesForm'),
                                    'img' => 'shop/no-sidebar.jpg'
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Product List', 'PagesForm'),
                        'name' => 'shop_list',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'grid',
                                    'name' => $this->module->l('Grid', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => 'list',
                                    'name' => $this->module->l('List', 'PagesForm'),
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'image-select',
                        'label' => $this->module->l('Grid Column', 'PagesForm'),
                        'name' => 'shop_grid_column',
                        'direction' => 'horizonal',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 2,
                                    'name' => $this->module->l('2 Columns', 'PagesForm'),
                                    'img' => 'shop/2-columns.jpg'
                                ),
                                array(
                                    'id_option' => 3,
                                    'name' => $this->module->l('3 Columns', 'PagesForm'),
                                    'img' => 'shop/3-columns.jpg'
                                ),
                                array(
                                    'id_option' => 4,
                                    'name' => $this->module->l('4 Columns', 'PagesForm'),
                                    'img' => 'shop/4-columns.jpg'
                                ),
                                array(
                                    'id_option' => 5,
                                    'name' => $this->module->l('5 Columns', 'PagesForm'),
                                    'img' => 'shop/5-columns.jpg'
                                ),
                                array(
                                    'id_option' => 6,
                                    'name' => $this->module->l('6 Columns', 'PagesForm'),
                                    'img' => 'shop/6-columns.jpg'
                                ),
                                array(
                                    'id_option' => '1-2-1-2',
                                    'name' => $this->module->l('1-2-1-2', 'PagesForm'),
                                    'img' => 'shop/1-2-1-2.jpg'
                                ),
                                array(
                                    'id_option' => '2-1-2-1',
                                    'name' => $this->module->l('2-1-2-1', 'PagesForm'),
                                    'img' => 'shop/2-1-2-1.jpg'
                                ),
                                array(
                                    'id_option' => '1-3-1-3',
                                    'name' => $this->module->l('1-3-1-3', 'PagesForm'),
                                    'img' => 'shop/1-3-1-3.jpg'
                                ),
                                array(
                                    'id_option' => '3-1-3-1',
                                    'name' => $this->module->l('3-1-3-1', 'PagesForm'),
                                    'img' => 'shop/3-1-3-1.jpg'
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                        'condition' => array(
                            'shop_list' => '==grid'
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Switch List', 'PagesForm'),
                        'name' => 'shop_switchlist',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'PagesForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'PagesForm')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Sort By', 'PagesForm'),
                        'name' => 'shop_sortby',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'PagesForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'PagesForm')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Active Filter', 'PagesForm'),
                        'name' => 'shop_activefilter',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'PagesForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'PagesForm')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Category Banner', 'PagesForm'),
                        'name' => 'shop_cat_banner',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'PagesForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'PagesForm')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Category Description', 'PagesForm'),
                        'name' => 'shop_cat_desc',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'PagesForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'PagesForm')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'PagesForm'),
                ),
            ),
        );
    }
    public function getProductPageForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Product Page', 'PagesForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-product-page'
                ),
                'input' => array(
                    array(
                        'type' => 'title_separator',
                        'label' => $this->module->l('Layout', 'PagesForm'),
                        'size' => 30,
                        'border_top' => false
                    ),
                    array(
                        'type' => 'switch-label',
                        'label' => $this->module->l('Width', 'PagesForm'),
                        'name' => 'product_page_width',
                        'values'    => array(
                            array('id'    => 'active_on','value' => 1,'label' => $this->module->l('Container', 'PagesForm')),
                            array('id'    => 'active_off','value' => 0,'label' => $this->module->l('FullWidth', 'PagesForm'))
                        ),
                        'width' => '260'
                    ),
                    array(
                        'type' => 'image-select',
                        'label' => $this->module->l('Product Page Layout', 'PagesForm'),
                        'name' => 'product_page_layout',
                        'direction' => 'horizonal',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'left-sidebar',
                                    'name' => $this->module->l('Left Sidebar', 'PagesForm'),
                                    'img' => 'product/left-sidebar.jpg'
                                ),
                                array(
                                    'id_option' => 'right-sidebar',
                                    'name' => $this->module->l('Right Sidebar', 'PagesForm'),
                                    'img' => 'product/right-sidebar.jpg'
                                ),
                                array(
                                    'id_option' => 'no-sidebar',
                                    'name' => $this->module->l('No Sidebar', 'PagesForm'),
                                    'img' => 'product/no-sidebar.jpg'
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'image-select',
                        'label' => $this->module->l('Product Content Layout', 'PagesForm'),
                        'name' => 'product_content_layout',
                        'direction' => 'horizonal',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'thumbs-bottom',
                                    'name' => $this->module->l('Thumbs at Bottom', 'PagesForm'),
                                    'img' => 'product/no-sidebar.jpg'
                                ),
                                array(
                                    'id_option' => 'thumbs-left',
                                    'name' => $this->module->l('Thumbs at Left', 'PagesForm'),
                                    'img' => 'product/thumbs-left.jpg'
                                ),
                                array(
                                    'id_option' => 'thumbs-right',
                                    'name' => $this->module->l('Thumbs at Right', 'PagesForm'),
                                    'img' => 'product/thumbs-right.jpg'
                                ),
                                array(
                                    'id_option' => 'thumbs-gallery',
                                    'name' => $this->module->l('Gallery', 'PagesForm'),
                                    'img' => 'product/gallery.jpg'
                                ),
                                array(
                                    'id_option' => '3-columns',
                                    'name' => $this->module->l('3 Columns', 'PagesForm'),
                                    'img' => 'product/3-columns.jpg'
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                        'condition' => array(
                            'shop_list' => '==grid'
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Thumbs Show', 'PagesForm'),
                        'name' => 'product_thumbs_show',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '3',
                                    'name' => $this->module->l('3', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => '4',
                                    'name' => $this->module->l('4', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => '5',
                                    'name' => $this->module->l('5', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => '6',
                                    'name' => $this->module->l('6', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => '7',
                                    'name' => $this->module->l('7', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => '8',
                                    'name' => $this->module->l('8', 'PagesForm'),
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Image Zoom', 'PagesForm'),
                        'name' => 'product_image_zoom',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'default',
                                    'name' => $this->module->l('Default', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => 'elevatezoom',
                                    'name' => $this->module->l('elevateZoom', 'PagesForm'),
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'title_separator',
                        'label' => $this->module->l('Text Style', 'PagesForm'),
                        'size' => 30,
                        'border_top' => false
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Product Title', 'PagesForm'),
                        'name' => 'product_page_title_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Product Title Color', 'PagesForm'),
                        'name' => 'product_page_title_color'
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Price Text', 'PagesForm'),
                        'name' => 'product_page_price_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Price Text Color', 'PagesForm'),
                        'name' => 'product_page_price_color'
                    ),
                    array(
                        'type' => 'title_separator',
                        'label' => $this->module->l('Content', 'PagesForm'),
                        'size' => 30,
                        'border_top' => false
                    ),                    
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show Related Products', 'PagesForm'),
                        'name' => 'product_page_accessories',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'PagesForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'PagesForm')
                            )
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Show More Information as', 'PagesForm'),
                        'name' => 'product_page_moreinfos_type',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'accordion',
                                    'name' => $this->module->l('Accordion', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => 'tab',
                                    'name' => $this->module->l('Tab', 'PagesForm'),
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Tab Title Align', 'PagesForm'),
                        'name' => 'product_page_tab_align',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'left',
                                    'name' => $this->module->l('Left', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => 'center',
                                    'name' => $this->module->l('Center', 'PagesForm'),
                                ),
                                array(
                                    'id_option' => 'right',
                                    'name' => $this->module->l('Right', 'PagesForm'),
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'PagesForm'),
                ),
            ),
        );
    }
    public function getContactPageForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Contact Page', 'PagesForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-contact-page'
                ),
                'input' => array(
                    array(
                        'type' => 'switch-label',
                        'label' => $this->module->l('Width', 'PagesForm'),
                        'name' => 'contact_page_width',
                        'values'    => array(
                            array('id'    => 'active_on','value' => 1,'label' => $this->module->l('Container', 'PagesForm')),
                            array('id'    => 'active_off','value' => 0,'label' => $this->module->l('FullWidth', 'PagesForm'))
                        ),
                        'width' => '260'
                    ),
                    array(
                        'type' => 'image-select',
                        'label' => $this->module->l('Contact Page Layout', 'PagesForm'),
                        'name' => 'contact_page_layout',
                        'direction' => 'horizonal',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'layout-1',
                                    'name' => $this->module->l('Layout 1', 'PagesForm'),
                                    'img' => 'contact/layout-1.jpg'
                                ),
                                array(
                                    'id_option' => 'layout-2',
                                    'name' => $this->module->l('Layout 2', 'PagesForm'),
                                    'img' => 'contact/layout-2.jpg'
                                ),
                                array(
                                    'id_option' => 'layout-3',
                                    'name' => $this->module->l('Layout 3', 'PagesForm'),
                                    'img' => 'contact/layout-3.jpg'
                                ),
                                array(
                                    'id_option' => 'layout-4',
                                    'name' => $this->module->l('Layout 4', 'PagesForm'),
                                    'img' => 'contact/layout-4.jpg'
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'title_separator',
                        'label' => $this->module->l('Text Style', 'PagesForm'),
                        'size' => 30,
                        'border_top' => false
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('Map Code', 'PagesForm'),
                        'desc' => $this->module->l('Find location on google map then enter url to here', 'PagesForm'),
                        'name' => 'contact_page_map_src',
                        'cols' => 30,
                        'rows' => 5
                    ),
                    array(
                        'type' => 'file-dialog',
                        'label' => $this->module->l('Contact Image', 'PagesForm'),
                        'name' => 'contact_page_image',
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Title Style', 'PagesForm'),
                        'name' => 'contact_page_title_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Title Color', 'PagesForm'),
                        'name' => 'contact_page_title_color'
                    ),
                    array(
                        'type' => 'border',
                        'label' => $this->module->l('Box Border', 'PagesForm'),
                        'name' => 'contact_page_box_border',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'text-group',
                        'label' => $this->module->l('Box Padding'),
                        'name' => 'contact_page_box_padding',
                        'desc' => $this->module->l('leave blank if you dont want to set'),
                        'suffix' => 'px',
                        'size' => 5
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'PagesForm'),
                ),
            ),
        );
    }
    public function getLoginPageForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Login Page', 'PagesForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-login-page'
                ),
                'input' => array(
                    array(
                        'type' => 'switch-label',
                        'label' => $this->module->l('Width', 'PagesForm'),
                        'name' => 'login_page_width',
                        'values'    => array(
                            array('id'    => 'active_on','value' => 1,'label' => $this->module->l('Container', 'PagesForm')),
                            array('id'    => 'active_off','value' => 0,'label' => $this->module->l('FullWidth', 'PagesForm'))
                        ),
                        'width' => '260'
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Header Hidden', 'PagesForm'),
                        'name' => 'login_page_hide_header',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'PagesForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'PagesForm')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Footer Hidden', 'PagesForm'),
                        'name' => 'login_page_hide_footer',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' =>$this->module->l('Yes', 'PagesForm')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'PagesForm')
                            )
                        ),
                    ),
                    array(
                        'type' => 'image-select',
                        'label' => $this->module->l('Login Page Layout', 'PagesForm'),
                        'name' => 'login_page_layout',
                        'direction' => 'horizonal',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'layout-1',
                                    'name' => $this->module->l('Layout 1', 'PagesForm'),
                                    'img' => 'login/layout-1.jpg'
                                ),
                                array(
                                    'id_option' => 'layout-2',
                                    'name' => $this->module->l('Layout 2', 'PagesForm'),
                                    'img' => 'login/layout-2.jpg'
                                ),
                                array(
                                    'id_option' => 'layout-3',
                                    'name' => $this->module->l('Layout 3', 'PagesForm'),
                                    'img' => 'login/layout-3.jpg'
                                ),
                                array(
                                    'id_option' => 'layout-4',
                                    'name' => $this->module->l('Layout 4', 'PagesForm'),
                                    'img' => 'login/layout-4.jpg'
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'title_separator',
                        'label' => $this->module->l('Text Style', 'PagesForm'),
                        'size' => 30,
                        'border_top' => false
                    ),
                    array(
                        'type' => 'file-dialog',
                        'label' => $this->module->l('Login Image', 'PagesForm'),
                        'name' => 'login_page_image',
                    ),
                    array(
                        'type' => 'fontstyle',
                        'label' => $this->module->l('Title Style', 'PagesForm'),
                        'name' => 'login_page_title_font',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->module->l('Title Color', 'PagesForm'),
                        'name' => 'login_page_title_color'
                    ),
                    array(
                        'type' => 'border',
                        'label' => $this->module->l('Box Border', 'PagesForm'),
                        'name' => 'login_page_box_border',
                        'suffix' => 'px'
                    ),
                    array(
                        'type' => 'text-group',
                        'label' => $this->module->l('Box Padding'),
                        'name' => 'login_page_box_padding',
                        'desc' => $this->module->l('leave blank if you dont want to set'),
                        'suffix' => 'px',
                        'size' => 5
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('SignUp Content', 'PagesForm'),
                        'name' => 'login_page_signup_content',
                        'autoload_rte' => true,
                        'lang' => true
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'PagesForm'),
                ),
            ),
        );
    }
}
