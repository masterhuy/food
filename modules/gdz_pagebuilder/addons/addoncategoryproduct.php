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
class gdzAddonCategoryProduct extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'categoryproduct';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Category Product';
        $this->addondesc = 'Show Category Products';
        $this->type = 'Shop Addons';
        $this->ordering = 82;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'categories',
                'name' => 'category',
                'label' => $this->l('Category'),
                'lang' => '0',
                'desc' => 'Select Category to Show',
                'default' => '2',
                'usecheckbox' => '0'
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
                'type' => 'checkbox2',
                'name' => 'showcategoryname',
                'label' => $this->l('Show Category Name'),
                'lang' => '0',
                'desc' => 'Show Category Name',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'showviewall',
                'label' => $this->l('Show View All'),
                'lang' => '0',
                'desc' => 'Show View All Link',
                'default' => 0
            ),
            array(
                'type' => 'text',
                'name' => 'viewall_text',
                'label' => $this->l('View All Text'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as view all text.',
                'default' => 'View all',
                'condition' => array(
                    'showviewall' => '==1'
                ),
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
                'default' => 10,
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
    public function getCategory($fields)
    {
        $context = $this->context;
        $id_category = $fields[0]->value;
        $order_by = $fields[1]->value;
        $order_way = $fields[2]->value;
        $total_config = (int)$fields[7]->value;
        $rows = (int)$fields[11]->value;
        $cols = $fields[10]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        if(!isset($id_category) || $id_category == 0) return;
        $category = array();
        $_category = new Category($id_category, (int)Context::getContext()->language->id);
        $category['id_category'] = $id_category;
        $category['name'] = $_category->name;
        $result = array();
        $result = $_category->getProducts((int)Context::getContext()->language->id, 0, $total_config, $order_by, $order_way);

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

        foreach ($result as $rawProduct) {
            $_products[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $context->language
            );
        }
        if($fields[6]->value == 'carousel')
          $category['products'] = gdzProductHelper::sliceProducts($_products, $rows, $cols_arr[0], $total_config);
        else
          $category['products'] = $_products;
        return $category;
    }
    public function returnValue($addon)
    {
		    $id_lang = $this->context->language->id;
        $view_type = $addon->fields[6]->value;
        if($view_type == 'carousel')
            $cols = $addon->fields[10]->value;
        else
            $cols = $addon->fields[9]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $category = $this->getCategory($addon->fields);
		    $addon_tpl_dir = $this->loadTplDir();
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'category' => $category,
                'cols'  => $cols,
                'cols_md'   => $cols_arr[0],
        				'cols_sm'   => $cols_arr[1],
        				'cols_xs'   => $cols_arr[2],
                'navigation' => $addon->fields[12]->value,
                'pagination' => $addon->fields[13]->value,
                'autoplay' => $addon->fields[14]->value,
                'rewind' => $addon->fields[15]->value,
                'slidebypage' => $addon->fields[16]->value,
                'gutter' => $addon->fields[8]->value,
                'showcategoryname' => $addon->fields[3]->value,
                'showviewall' => $addon->fields[4]->value,
                'viewall_text' => $addon->fields[5]->value->$id_lang,
                'view_type' => $view_type,
				        'addon_tpl_dir' => $addon_tpl_dir
            )
        );
		    $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
