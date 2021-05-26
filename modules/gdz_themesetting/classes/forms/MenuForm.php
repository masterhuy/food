<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

include_once _PS_MODULE_DIR_ . 'gdz_megamenu/classes/gdzMegamenuHelper.php';
class gdzMenuForm
{
    public $module;
    public $menus;
    public function __construct()
    {
        $this->module = Module::getInstanceByName('gdz_themesetting');
        $this->menus = gdzMegamenuHelper::getMenus();
    }
    public function getMenuForm()
    {
      $_fieldsets = array();
      $_fieldsets[] = $this->getMenuTabForm();
      $_fieldsets[] = $this->getHorMenuForm();
      $_fieldsets[] = $this->getVerMenuForm();
      $_fieldsets[] = $this->getMobiMenuForm();
      return $_fieldsets;
    }
    public function getMenuTabForm()
    {
        return array(
            'form' => array(
                'childForms' => array(
                    'gdz-menu-hor'  => $this->module->l('Horizonal Menu', 'MenuForm'),
                    'gdz-menu-ver'  => $this->module->l('Vertical Menu', 'MenuForm'),
                    'gdz-menu-mobi'  => $this->module->l('Mobile Menu', 'MenuForm')
                ),
                'legend' => array(
                    'title' => $this->module->l('Menu', 'MenuForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-menu-tab',
                    'heading_icon' => 'menu'
                ),
            ),
        );
    }
    public function getHorMenuForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Horizonal Menu', 'MenuForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-menu-hor'
                ),
                'input' => array(
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Select Menu', 'MenuForm'),
                          'name' => 'hormenu_id',
                          'options' => array('query' => $this->menus,'id' => 'menu_id','name' => 'name'),
                      ),
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Menu Align', 'MenuForm'),
                          'name' => 'hormenu_align',
                          'options' => array(
                              'query' => array(
                                array(
                                    'id_option' => 'left',
                                    'name' => $this->module->l('Left', 'MenuForm'),
                                ),
                                  array(
                                      'id_option' => 'center',
                                      'name' => $this->module->l('Center', 'MenuForm'),
                                  ),
                                  array(
                                      'id_option' => 'right',
                                      'name' => $this->module->l('Right', 'MenuForm'),
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Margin'),
                          'name' => 'hormenu_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Padding'),
                          'name' => 'hormenu_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Background Type', 'MenuForm'),
                          'name' => 'hormenu_bg',
                          'options' => array(
                              'query' => array(
                                array(
                                    'id_option' => '',
                                    'name' => $this->module->l('None', 'MenuForm'),
                                ),
                                  array(
                                      'id_option' => 'image',
                                      'name' => $this->module->l('Image', 'MenuForm'),
                                  ),
                                  array(
                                      'id_option' => 'color',
                                      'name' => $this->module->l('Color', 'MenuForm'),
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'MenuForm'),
                          'name' => 'hormenu_bg_color',
                          'desc' => $this->module->l('Choose background color for Menu.', 'MenuForm'),
                          'condition' => array(
                              'hormenu_bg' => '==color'
                          ),
                      ),
                      array(
                          'type' => 'background-img',
                          'label' => $this->module->l('Background Image', 'MenuForm'),
                          'name' => 'hormenu_bg_image',
                          'condition' => array(
                              'hormenu_bg' => '==image'
                          ),
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Custom Css Class', 'MenuForm'),
                          'desc' => $this->module->l('Use this field to add a class name and then refer to it in your css file.', 'MenuForm'),
                          'name' => 'hormenu_class',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Menu Item Setting', 'MenuForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'fontstyle',
                          'label' => $this->module->l('Text Style', 'MenuForm'),
                          'name' => 'hormenu_item_font',
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Color', 'MenuForm'),
                          'name' => 'hormenu_link_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Hover Color', 'MenuForm'),
                          'name' => 'hormenu_link_hover_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'MenuForm'),
                          'name' => 'hormenu_item_bg'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Hover', 'MenuForm'),
                          'name' => 'hormenu_item_hover_bg'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Margin'),
                          'name' => 'hormenu_item_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Padding'),
                          'name' => 'hormenu_item_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('SubMenu Setting', 'MenuForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background', 'MenuForm'),
                          'name' => 'hormenu_submenu_bg'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Hover', 'MenuForm'),
                          'name' => 'hormenu_submenu_item_hover_bg'
                      ),
                      array(
                          'type' => 'number',
                          'label' => $this->module->l('Font size', 'MenuForm'),
                          'name' => 'hormenu_submenu_fontsize',
                          'class' => 'fixed-width-xl',
                          'min' => 6,
                          'size' => 30,
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Color', 'MenuForm'),
                          'name' => 'hormenu_submenu_link_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Hover Color', 'MenuForm'),
                          'name' => 'hormenu_submenu_link_hover_color'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Submenu Margin'),
                          'name' => 'hormenu_submenu_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Submenu Padding'),
                          'name' => 'hormenu_submenu_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Margin'),
                          'name' => 'hormenu_submenu_item_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Padding'),
                          'name' => 'hormenu_submenu_item_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),

                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'MenuForm'),
                ),
            ),
        );
    }

    public function getVerMenuForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Vertical Menu', 'MenuForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-menu-ver'
                ),
                'input' => array(
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Select Menu', 'MenuForm'),
                          'name' => 'vermenu_id',
                          'options' => array('query' => $this->menus,'id' => 'menu_id','name' => 'name'),
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Menu Button', 'MenuForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Button Text'),
                          'name' => 'vermenu_button_text',
                          'desc' => 'set button text for vertical menu',
                          'lang' => 1,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Button Width', 'MenuForm'),
                          'desc' => $this->module->l('You must provide px or percent suffix. Example: 200px or 30%', 'MenuForm'),
                          'name' => 'vermenu_button_width',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl',
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Button Background', 'MenuForm'),
                          'name' => 'vermenu_button_bg'
                      ),
                      array(
                          'type' => 'fontstyle',
                          'label' => $this->module->l('Text Style', 'MenuForm'),
                          'name' => 'vermenu_button_text_font',
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Button Text Color', 'MenuForm'),
                          'name' => 'vermenu_button_text_color'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Border Radius'),
                          'name' => 'vermenu_button_border_radius',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'fieldtype' => 'border-radius',
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'border',
                          'label' => $this->module->l('Border', 'MenuForm'),
                          'name' => 'vermenu_button_border',
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Margin'),
                          'name' => 'vermenu_button_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Padding'),
                          'name' => 'vermenu_button_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Menu Setting', 'MenuForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Margin'),
                          'name' => 'vermenu_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Padding'),
                          'name' => 'vermenu_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Background Type', 'MenuForm'),
                          'name' => 'vermenu_bg',
                          'options' => array(
                              'query' => array(
                                array(
                                    'id_option' => '',
                                    'name' => $this->module->l('None', 'MenuForm'),
                                ),
                                  array(
                                      'id_option' => 'image',
                                      'name' => $this->module->l('Image', 'MenuForm'),
                                  ),
                                  array(
                                      'id_option' => 'color',
                                      'name' => $this->module->l('Color', 'MenuForm'),
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'MenuForm'),
                          'name' => 'vermenu_bg_color',
                          'desc' => $this->module->l('Choose background color for Menu.', 'MenuForm'),
                          'condition' => array(
                              'vermenu_bg' => '==color'
                          ),
                      ),
                      array(
                          'type' => 'background-img',
                          'label' => $this->module->l('Background Image', 'MenuForm'),
                          'name' => 'vermenu_bg_image',
                          'condition' => array(
                              'vermenu_bg' => '==image'
                          ),
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Custom Css Class', 'MenuForm'),
                          'desc' => $this->module->l('Use this field to add a class name and then refer to it in your css file.', 'MenuForm'),
                          'name' => 'vermenu_class',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Menu Item Setting', 'MenuForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'fontstyle',
                          'label' => $this->module->l('Text Style', 'MenuForm'),
                          'name' => 'vermenu_item_font',
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Color', 'MenuForm'),
                          'name' => 'vermenu_link_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Hover Color', 'MenuForm'),
                          'name' => 'vermenu_link_hover_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'MenuForm'),
                          'name' => 'vermenu_item_bg'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Hover', 'MenuForm'),
                          'name' => 'vermenu_item_hover_bg'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Margin'),
                          'name' => 'vermenu_item_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Padding'),
                          'name' => 'vermenu_item_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('SubMenu Setting', 'MenuForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background', 'MenuForm'),
                          'name' => 'vermenu_submenu_bg'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Hover', 'MenuForm'),
                          'name' => 'vermenu_submenu_item_hover_bg'
                      ),
                      array(
                          'type' => 'number',
                          'label' => $this->module->l('Font size', 'MenuForm'),
                          'name' => 'vermenu_submenu_fontsize',
                          'class' => 'fixed-width-xl',
                          'min' => 6,
                          'size' => 30,
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Color', 'MenuForm'),
                          'name' => 'vermenu_submenu_link_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Hover Color', 'MenuForm'),
                          'name' => 'vermenu_submenu_link_hover_color'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Submenu Margin'),
                          'name' => 'vermenu_submenu_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Submenu Padding'),
                          'name' => 'vermenu_submenu_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Margin'),
                          'name' => 'vermenu_submenu__item_margin',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Padding'),
                          'name' => 'vermenu_submenu_item_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'MenuForm'),
                ),
            ),
        );
    }
    public function getMobiMenuForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Mobile Menu', 'MenuForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-menu-mobi'
                ),
                'input' => array(
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Select Menu', 'MenuForm'),
                          'name' => 'mobimenu_id',
                          'options' => array('query' => $this->menus,'id' => 'menu_id','name' => 'name'),
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Padding'),
                          'name' => 'mobimenu_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'select',
                          'label' => $this->module->l('Background Type', 'MenuForm'),
                          'name' => 'mobimenu_bg',
                          'options' => array(
                              'query' => array(
                                array(
                                    'id_option' => '',
                                    'name' => $this->module->l('None', 'MenuForm'),
                                ),
                                  array(
                                      'id_option' => 'image',
                                      'name' => $this->module->l('Image', 'MenuForm'),
                                  ),
                                  array(
                                      'id_option' => 'color',
                                      'name' => $this->module->l('Color', 'MenuForm'),
                                  )
                              ),
                              'id' => 'id_option',
                              'name' => 'name',
                          ),
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'MenuForm'),
                          'name' => 'mobimenu_bg_color',
                          'desc' => $this->module->l('Choose background color for Menu.', 'MenuForm'),
                          'condition' => array(
                              'mobimenu_bg' => '==color'
                          ),
                      ),
                      array(
                          'type' => 'background-img',
                          'label' => $this->module->l('Background Image', 'MenuForm'),
                          'name' => 'mobimenu_bg_image',
                          'condition' => array(
                              'mobimenu_bg' => '==image'
                          ),
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Custom Css Class', 'MenuForm'),
                          'desc' => $this->module->l('Use this field to add a class name and then refer to it in your css file.', 'MenuForm'),
                          'name' => 'mobimenu_class',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Menu Item Setting', 'MenuForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'number',
                          'label' => $this->module->l('Font size', 'MenuForm'),
                          'name' => 'mobimenu_item_fontsize',
                          'class' => 'fixed-width-xl',
                          'min' => 6,
                          'size' => 30,
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Color', 'MenuForm'),
                          'name' => 'mobimenu_link_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Hover Color', 'MenuForm'),
                          'name' => 'mobimenu_link_hover_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Color', 'MenuForm'),
                          'name' => 'mobimenu_item_bg'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Hover', 'MenuForm'),
                          'name' => 'mobimenu_item_hover_bg'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Padding'),
                          'name' => 'mobimenu_item_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('SubMenu Setting', 'MenuForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background', 'MenuForm'),
                          'name' => 'mobimenu_submenu_bg'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Background Hover', 'MenuForm'),
                          'name' => 'mobimenu_submenu_item_hover_bg'
                      ),
                      array(
                          'type' => 'number',
                          'label' => $this->module->l('Font size', 'MenuForm'),
                          'name' => 'mobimenu_submenu_fontsize',
                          'class' => 'fixed-width-xl',
                          'min' => 6,
                          'size' => 30,
                          'suffix' => 'px'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Color', 'MenuForm'),
                          'name' => 'mobimenu_submenu_link_color'
                      ),
                      array(
                          'type' => 'color',
                          'label' => $this->module->l('Link Hover Color', 'MenuForm'),
                          'name' => 'mobimenu_submenu_link_hover_color'
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Submenu Padding'),
                          'name' => 'mobimenu_submenu_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                      array(
                          'type' => 'text-group',
                          'label' => $this->module->l('Item Padding'),
                          'name' => 'mobimenu_submenu_item_padding',
                          'desc' => $this->module->l('leave blank if you dont want to set'),
                          'suffix' => 'px',
                          'size' => 5
                      ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'MenuForm'),
                ),
            ),
        );
    }
}
