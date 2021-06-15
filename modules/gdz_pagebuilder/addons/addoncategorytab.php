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

use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;

class gdzAddonCategoryTab extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'categorytab';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Category Tab';
        $this->addondesc = 'Show Products as Category Tabs';
        $this->type = 'Shop Addons';
        $this->ordering = 83;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'categories',
                'name' => 'ctcategories',
                'label' => $this->l('Categories'),
                'lang' => '0',
                'desc' => 'Select Categories to Show',
                'default' => "2",
                'usecheckbox' => '1'
            ),
            array(
                'type' => 'select',
                'name' => 'order_by',
                'label' => $this->l('Order By'),
                'lang' => '0',
                'desc' => 'Order By Column',
                'options' => array('position', 'id_product', 'date_add', 'date_upd', 'name', 'manufacturer_name', 'price'),
                'default' => 'position'
            ),
            array(
                'type' => 'select',
                'name' => 'order_way',
                'label' => $this->l('Order Way'),
                'lang' => '0',
                'desc' => 'Order Way Or Order Direction',
                'options' => array('DESC','ASC'),
                'default' => 'DESC'
            ),
            array(
                'type' => 'align',
                'name' => 'tab_align',
                'lang' => '0',
                'label' => $this->l('Tab Align'),
                'default' => 'left'
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
    public function getCategoryTab($fields)
    {
        $context = $this->context;
        $id_lang = $this->context->language->id;
        $category_ids = explode(",", $fields[0]->value);
        $order_by = $fields[1]->value;
        $order_way = $fields[2]->value;
        $total_config = (int)$fields[5]->value;
        $rows = (int)$fields[8]->value;
        $cols = $fields[9]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $categories = array();
        $view_type = $fields[4]->value;
        $k = 0;
        foreach ($category_ids as $id_category) {
            $category = new Category($id_category, $id_lang);
            $categories[$k]['id_category'] = $id_category;
            $categories[$k]['name'] = $category->name;
            $result = array();
            $result = $category->getProducts($id_lang, 0, $total_config, $order_by, $order_way);
            $assembler = new ProductAssembler($context);
            $presenterFactory = new ProductPresenterFactory($context);
            $presentationSettings = $presenterFactory->getPresentationSettings();
            $presenter = new ProductListingPresenter(
                new ImageRetriever(
                    $context->link
                ),
                $context->link,
                new PriceFormatter(),
                new ProductColorsRetriever(),
                $context->getTranslator()
            );

            $_products = [];
            if ($result == null) {
                return;
            }
            foreach ($result as $rawProduct) {
                $_products[] = $presenter->present(
                    $presentationSettings,
                    $assembler->assembleProduct($rawProduct),
                    $context->language
                );
            }
            if($view_type == 'carousel')
                $categories[$k]['products'] = gdzProductHelper::sliceProducts($_products, $rows, $cols_arr[0], $total_config);
            else
                $categories[$k]['products'] = $_products;
            $k++;
        }
        return $categories;
    }
    public function returnValue($addon)
    {
        if (Tools::strlen($addon->fields[0]->value) == 0) {
            return "Please select categories for tab!";
        }
        $view_type = $addon->fields[4]->value;
        if($view_type == 'carousel')
            $cols = $addon->fields[9]->value;
        else
            $cols = $addon->fields[7]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $_categories = $this->getCategoryTab($addon->fields);
        if(!isset($_categories) || count($_categories) == 0) return;
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'categories' => $_categories,
                'tab_align'   => $addon->fields[3]->value,
                'cols'  => $cols,
                'cols_md'   => $cols_arr[0],
                'cols_sm'   => $cols_arr[1],
                'cols_xs'   => $cols_arr[2],
                'navigation' => $addon->fields[10]->value,
                'pagination' => $addon->fields[11]->value,
                'autoplay' => $addon->fields[12]->value,
                'rewind' => $addon->fields[13]->value,
                'slidebypage' => $addon->fields[14]->value,
                'gutter' => $addon->fields[6]->value,
                'view_type' => $view_type
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
