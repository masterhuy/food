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

class gdzAddonProductFilter extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'productfilter';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Product Filter';
        $this->addondesc = 'Featured/New/Topseller/On-Sale/Special Products';
        $this->type = 'Shop Addons';
        $this->ordering = 80;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'select',
                'name' => 'producttype',
                'label' => $this->l('Product Type'),
                'lang' => '0',
                'desc' => 'Choose Product Type to Show',
                'options' => array('featured', 'topseller', 'new', 'onsale','special'),
                'default' => 'featured'
            ),
            array(
                'type' => 'categories',
                'name' => 'pccategories',
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
    public function getProducts($fields)
    {
        $producttype = $fields[0]->value;
        $total_config = $fields[3]->value;
        $rows = $fields[7]->value;
        $view_type = $fields[2]->value;
        if($view_type == 'carousel')
            $cols = $fields[6]->value;
        else
            $cols = $fields[5]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $category_ids = array();
        if ($fields[1]->value) {
            $category_ids = explode(',', $fields[1]->value);
        }
        //print_r($total_config); exit;
        $_products = array();
        if ($producttype == 'onsale') {
            $_products = gdzProductHelper::getonSaleProducts($category_ids, $total_config);
        } elseif ($producttype == 'topseller') {
            $_products = gdzProductHelper::getTopSellerProducts($category_ids, $total_config);
        } elseif ($producttype == 'new') {
            $_products = gdzProductHelper::getNewProducts($category_ids, $total_config);
        } elseif ($producttype == 'special') {
            $_products = gdzProductHelper::getSpecialProducts($total_config);
        } else {
            $_products = gdzProductHelper::getFeaturedProducts($category_ids, $total_config);
        }
        if(!isset($_products)) return;
        if($view_type == 'carousel')
            return gdzProductHelper::sliceProducts($_products, $rows, $cols_arr[0], $total_config);
        else
            return $_products;
    }

    public function returnValue($addon)
    {
        $this->context = Context::getContext();
    		$fields = $addon->fields;
        $view_type = $addon->fields[2]->value;
        if($view_type == 'carousel')
            $cols = $addon->fields[6]->value;
        else
            $cols = $addon->fields[5]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
    		$addon_tpl_dir = $this->loadTplDir();
    		$products = $this->getProducts($fields);
        if(!isset($products)) return;
        $this->context->smarty->assign(
      			array(
      				'link' => $this->context->link,
      				'products_slides' => $products,
      				'producttype' => $fields[0]->value,
      				'cols'  => $cols,
      				'cols_md'   => $cols_arr[0],
      				'cols_sm'   => $cols_arr[1],
      				'cols_xs'   => $cols_arr[2],
      				'navigation' => $fields[8]->value,
      				'pagination' => $fields[9]->value,
      				'autoplay' => $fields[10]->value,
      				'rewind' => $fields[11]->value,
      				'slidebypage' => $fields[12]->value,
              'gutter'   => $addon->fields[4]->value,
              'view_type' => $view_type,
      				'addon_tpl_dir' => $addon_tpl_dir
      			)
  		  );
		    $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
