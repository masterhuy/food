<?php
/**
* 2007-2020 PrestaShop
*
Godzilla PageBuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonbase.php');
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/productHelper.php');
class gdzAddonProductTab extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'producttab';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Product Tab';
        $this->addondesc = 'Show Products as Tabs (Featured/Sale/Latest/Top Seller/...)';
        $this->type = 'Shop Addons';
        $this->ordering = 81;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'checkbox2',
                'name' => 'show_featured',
                'label' => $this->l('Show Featured Tab'),
                'lang' => '0',
                'desc' => 'Show/Hide Featured Product Tab',
                'default' => 1
            ),
            array(
                'type' => 'text',
                'name' => 'featured_text',
                'label' => $this->l('Featured Tab Text'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as featured tab text.',
                'default' => 'Featured',
                'condition' => array(
                    'show_featured' => '==1'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_new',
                'label' => $this->l('Show New Tab'),
                'lang' => '0',
                'desc' => 'Show/Hide New Product Tab',
                'default' => '1'
            ),
            array(
                'type' => 'text',
                'name' => 'new_text',
                'label' => $this->l('New Tab Text'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as new tab text.',
                'default' => 'Latest',
                'condition' => array(
                    'show_new' => '==1'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_topseller',
                'label' => $this->l('Show TopSeller Tab'),
                'lang' => '0',
                'desc' => 'Show/Hide TopSeller Product Tab',
                'default' => '1'
            ),
            array(
                'type' => 'text',
                'name' => 'topseller_text',
                'label' => $this->l('Topseller Tab Text'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as top-seller tab text.',
                'default' => 'Top-Seller',
                'condition' => array(
                    'show_topseller' => '==1'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_onsale',
                'label' => $this->l('Show OnSale Product Tab'),
                'lang' => '0',
                'desc' => 'Show/Hide OnSale Product Tab',
                'default' => '0'
            ),
            array(
                'type' => 'text',
                'name' => 'onsale_text',
                'label' => $this->l('OnSale Tab Text'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as onsale tab text.',
                'default' => 'On Sale',
                'condition' => array(
                    'show_onsale' => '==1'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_special',
                'label' => $this->l('Show Special Product Tab'),
                'lang' => '0',
                'desc' => 'Show/Hide Special Product Tab',
                'default' => '0'
            ),
            array(
                'type' => 'text',
                'name' => 'special_text',
                'label' => $this->l('Special Tab Text'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as special tab text.',
                'default' => 'Special',
                'condition' => array(
                    'show_special' => '==1'
                ),
            ),
            array(
                'type' => 'align',
                'name' => 'tab_align',
                'lang' => '0',
                'label' => $this->l('Tab Align'),
                'default' => 'left'
            ),
            array(
                'type' => 'categories',
                'name' => 'ptcategories',
                'label' => $this->l('Category'),
                'lang' => '0',
                'desc' => 'Select categories, it will get products in those category else if not select any category it will get in all category.',
                'default' => '',
                'usecheckbox' => '1'
            ),
            array(
                'type' => 'select',
                'name' => 'view_type',
                'label' => $this->l('View'),
                'lang' => '0',
                'desc' => 'View Type',
                'options' => array('grid', 'carousel'),
                'default' => 'grid'
            ),
            array(
                'type' => 'range',
                'name' => 'items_total',
                'label' => $this->l('Total Items'),
                'min'  => 1,
                'max'  => 50,
                'lang' => '0',
                'desc' => 'Total Number Items',
                'default' => 10
            ),
            array(
                'type' => 'range',
                'name' => 'gutter',
                'label' => $this->l('Gutter Width (px)'),
                'min'  => 0,
                'max'  => 100,
                'lang' => '0',
                'desc' => 'Gutter between item Width',
                'default' => 30
            ),
            array(
                'type' => 'screen-select',
                'name' => 'grid_class',
                'label' => $this->l('Products per Line'),
                'lang' => '0',
                'desc' => 'Number of items per line',
                'default' => '4-3-2',
                'condition' => array(
                    'view_type' => '==grid'
                )
            ),
            array(
                'type' => 'tab',
                'name' => 'carousel_setting',
                'label' => $this->l('Carousel Setting'),
                'lang' => '0',
                'open' => 0,
                'condition' => array(
                    'view_type' => '==carousel'
                )
            ),
            array(
                'type' => 'range',
                'name' => 'rows',
                'label' => $this->l('Number of Rows'),
                'min'  => 1,
                'max'  => 8,
                'lang' => '0',
                'desc' => 'Number of Rows (Or Number of Products per Column)',
                'default' => 2,
                'condition' => array(
                    'view_type' => '==carousel'
                )
            ),
            array(
                'type' => 'screen-range',
                'name' => 'cols',
                'label' => $this->l('Products per Line'),
                'min'  => 1,
                'max'  => 8,
                'lang' => '0',
                'desc' => 'Number of Products per Line',
                'default' => '4-3-2',
                'condition' => array(
                    'view_type' => '==carousel'
                )
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'navigation',
                'label' => $this->l('Show Navigation'),
                'lang' => '0',
                'desc' => 'Enable/Disable Navigation',
                'default' => '1',
                'condition' => array(
                    'view_type' => '==carousel'
                )
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'pagination',
                'label' => $this->l('Show Pagination'),
                'lang' => '0',
                'desc' => 'Enable/Disable Pagination',
                'default' => '0',
                'condition' => array(
                    'view_type' => '==carousel'
                )
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'autoplay',
                'label' => $this->l('Auto Play'),
                'lang' => '0',
                'desc' => 'Enable/Disable Auto Play',
                'default' => '0',
                'condition' => array(
                    'view_type' => '==carousel'
                )
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'rewind',
                'label' => $this->l('ReWind Navigation'),
                'lang' => '0',
                'desc' => 'Enable/Disable ReWind Navigation',
                'default' => '1',
                'condition' => array(
                    'view_type' => '==carousel'
                )
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'slidebypage',
                'label' => $this->l('Slide By Page'),
                'lang' => '0',
                'desc' => 'Enable/Disable Slide By Page',
                'default' => '0',
                'condition' => array(
                    'view_type' => '==carousel'
                )
            ),
            array(
                'type' => 'text',
                'name' => 'overwrite_tpl',
                'label' => $this->l('Overwrite Tpl File'),
                'lang' => '0',
                'desc' => 'Use When you want overwrite template file'
            )
        );
        return $inputs;
    }
    public function getProductTab($fields) {
        $this->context = Context::getContext();
        $id_lang = $this->context->language->id;
        $producttabs = array();
        $producttabs['show_featured'] = $fields[0]->value;
        $producttabs['featured_text'] = $fields[1]->value->$id_lang;
        $producttabs['show_new'] = $fields[2]->value;
        $producttabs['new_text'] = $fields[3]->value->$id_lang;
        $producttabs['show_topseller'] = $fields[4]->value;
        $producttabs['topseller_text'] = $fields[5]->value->$id_lang;
        $producttabs['show_onsale'] = $fields[6]->value;
        $producttabs['onsale_text'] = $fields[7]->value->$id_lang;
        $producttabs['show_special'] = $fields[8]->value;
        $producttabs['special_text'] = $fields[9]->value->$id_lang;
        $total_config = (int)$fields[13]->value;
        $rows = (int)$fields[16]->value;
        $cols = $fields[17]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $category_ids = array();
        if ($fields[11]->value) {
            $category_ids = explode(',', $fields[11]->value);
        }
        $view_type = $fields[12]->value;
        $_products = array();
        $producttabs['featured_products'] = array();
        if ($producttabs['show_featured'] == '1') {
            $_products = gdzProductHelper::getFeaturedProducts($category_ids, $total_config);
            if($view_type == 'carousel')
                $producttabs['featured_products'] = gdzProductHelper::sliceProducts($_products, $rows, $cols_arr[0], $total_config);
            else
                $producttabs['featured_products'] = $_products;
        }
        $producttabs['new_products'] = array();
        if ($producttabs['show_new'] == '1') {
            $_products = gdzProductHelper::getNewProducts($category_ids, $total_config);
            if($view_type == 'carousel')
                $producttabs['new_products'] = gdzProductHelper::sliceProducts($_products, $rows, $cols_arr[0], $total_config);
            else
                $producttabs['new_products'] = $_products;
        }
        $producttabs['topseller_products'] = array();
        if ($producttabs['show_topseller'] == '1') {
            $_products = gdzProductHelper::getTopSellerProducts($category_ids, $total_config);
            if($view_type == 'carousel')
                $producttabs['topseller_products'] = gdzProductHelper::sliceProducts($_products, $rows, $cols_arr[0], $total_config);
            else
                $producttabs['topseller_products'] = $_products;
        }
        $producttabs['onsale_products'] = array();
        if ($producttabs['show_onsale'] == '1') {
            $_products = gdzProductHelper::getonSaleProducts($category_ids, $total_config);
            if($view_type == 'carousel')
                $producttabs['onsale_products'] = gdzProductHelper::sliceProducts($_products, $rows, $cols_arr[0], $total_config);
            else
                $producttabs['onsale_products'] = $_products;
        }
        $producttabs['special_products'] = array();
        if ($producttabs['show_special'] == '1') {
            $_products = gdzProductHelper::getSpecialProducts($total_config);
            if($view_type == 'carousel')
                $producttabs['special_products'] = gdzProductHelper::sliceProducts($_products, $rows, $cols_arr[0], $total_config);
            else
                $producttabs['special_products'] = $_products;
        }
        return $producttabs;
    }
    public function returnValue($addon)
    {
        $this->context = Context::getContext();
        $_producttabs = $this->getProductTab($addon->fields);
        if(!isset($_producttabs) || count($_producttabs) == 0) return;
        $view_type = $addon->fields[12]->value;
        if($view_type == 'carousel')
            $cols = $addon->fields[17]->value;
        else
            $cols = $addon->fields[15]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'producttabs' => $_producttabs,
                'tab_align'   => $addon->fields[10]->value,
                'cols'  => $cols,
                'cols_md'   => $cols_arr[0],
                'cols_sm'   => $cols_arr[1],
                'cols_xs'   => $cols_arr[2],
                'navigation' => $addon->fields[18]->value,
                'pagination' => $addon->fields[19]->value,
                'autoplay' => $addon->fields[20]->value,
                'rewind' => $addon->fields[21]->value,
                'slidebypage' => $addon->fields[22]->value,
                'gutter' => $addon->fields[14]->value,
                'view_type' => $view_type
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
