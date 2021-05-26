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
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;

include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonbase.php');
if (Module::isInstalled('gdz_flashsale')) {
    include_once(_PS_MODULE_DIR_.'gdz_flashsale/gdz_flashsale.php');
}
class gdzAddonFlashSale extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'flashsale';
        $this->modulename = 'gdz_flashsale';
        $this->addontitle = 'Flash Sales';
        $this->addondesc = 'Show Flash Sales';
        $this->type = 'Shop Addons';
        $this->ordering = 89;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getCategories() {
  		$this->context = Context::getContext();
  		$id_lang = $this->context->language->id;

  		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
  			SELECT hs.`category_id`, hss.`title`
  			FROM `'._DB_PREFIX_.'gdz_flashsale_categories` hs
  			LEFT JOIN '._DB_PREFIX_.'gdz_flashsale_categories_lang hss ON (hs.category_id = hss.category_id)
  			WHERE id_lang = '.(int)$id_lang);
  	}
    public function getInputs()
    {
        if (!Module::isInstalled('gdz_flashsale')) return;
        $categories = $this->getCategories();
        $inputs = array(
            array(
                'type' => 'select2',
                'name' => 'category',
                'label' => $this->l('Category'),
                'lang' => '0',
                'desc' => 'Select Category to show.',
                'options' => $categories,
                'options_name' => array('category_id','title')
            ),
            array(
                'type' => 'tab',
                'name' => 'carousel_setting',
                'label' => $this->l('Carousel Setting'),
                'lang' => '0',
                'open' => 0
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
                'type' => 'screen-range',
                'name' => 'cols',
                'label' => $this->l('Products per Line'),
                'min'  => 1,
                'max'  => 8,
                'lang' => '0',
                'desc' => 'Number of Products per Line',
                'default' => '4-3-2'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'navigation',
                'label' => $this->l('Show Navigation'),
                'lang' => '0',
                'desc' => 'Enable/Disable Navigation',
                'default' => '1'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'pagination',
                'label' => $this->l('Show Pagination'),
                'lang' => '0',
                'desc' => 'Enable/Disable Pagination',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'autoplay',
                'label' => $this->l('Auto Play'),
                'lang' => '0',
                'desc' => 'Enable/Disable Auto Play',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'rewind',
                'label' => $this->l('ReWind Navigation'),
                'lang' => '0',
                'desc' => 'Enable/Disable ReWind Navigation',
                'default' => '1'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'slidebypage',
                'label' => $this->l('Slide By Page'),
                'lang' => '0',
                'desc' => 'Enable/Disable Slide By Page',
                'default' => '0'
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
    public function getFlashSales($fields) {
        $this->context = Context::getContext();
        $id_shop = $this->context->shop->id;
        $id_lang = $this->context->language->id;
        $category_id = $fields[0]->value;
        if($category_id) {
            $query = "SELECT fc.`category_id`, fcl.`title`
      			FROM `"._DB_PREFIX_."gdz_flashsale_categories` fc
      			LEFT JOIN "._DB_PREFIX_."gdz_flashsale_categories_lang fcl ON (fc.category_id = fcl.category_id)
      			WHERE id_lang = ".(int)$id_lang." AND fc.category_id = ".$category_id;
            $_category = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
            $query = "SELECT fi.`product_id`
      			FROM `"._DB_PREFIX_."gdz_flashsale_items` fi
      			LEFT JOIN "._DB_PREFIX_."gdz_flashsale f ON (fi.item_id = f.item_id)
      			WHERE id_shop = ".(int)$id_shop." AND fi.category_id = ".$category_id;
            $productids = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
            if(count($productids) == 0) return null;
            $id_arr = array();
            for($i = 0; $i < count($productids); $i++) {
              $id_arr[$i] = $productids[$i]['product_id'];
            }
            $products = array();
            $sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) AS quantity'.(Combination::isFeatureActive() ? ', IFNULL(product_attribute_shop.id_product_attribute, 0) AS id_product_attribute,
                        product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity' : '').', pl.`description`, pl.`description_short`, pl.`available_now`,
                        pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, image_shop.`id_image` id_image,
                        il.`legend` as legend, m.`name` AS manufacturer_name, cl.`name` AS category_default, product_shop.price AS orderprice
                    FROM `'._DB_PREFIX_.'category_product` cp
                    LEFT JOIN `'._DB_PREFIX_.'product` p
                        ON p.`id_product` = cp.`id_product`
                    '.Shop::addSqlAssociation('product', 'p').
                    (Combination::isFeatureActive() ? ' LEFT JOIN `'._DB_PREFIX_.'product_attribute_shop` product_attribute_shop
                    ON (p.`id_product` = product_attribute_shop.`id_product` AND product_attribute_shop.`default_on` = 1 AND product_attribute_shop.id_shop='.(int) $this->context->shop->id.')':'').'
                    '.Product::sqlStock('p', 0).'
                    LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
                        ON (product_shop.`id_category_default` = cl.`id_category`
                        AND cl.`id_lang` = '.(int) $id_lang.Shop::addSqlRestrictionOnLang('cl').')
                    LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                        ON (p.`id_product` = pl.`id_product`
                        AND pl.`id_lang` = '.(int) $id_lang.Shop::addSqlRestrictionOnLang('pl').')
                    LEFT JOIN `'._DB_PREFIX_.'image_shop` image_shop
                        ON (image_shop.`id_product` = p.`id_product` AND image_shop.cover=1 AND image_shop.id_shop='.(int)$this->context->shop->id.')
                    LEFT JOIN `'._DB_PREFIX_.'image_lang` il
                        ON (image_shop.`id_image` = il.`id_image`
                        AND il.`id_lang` = '.(int) $id_lang.')
                    LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
                        ON m.`id_manufacturer` = p.`id_manufacturer`
                    LEFT JOIN `'._DB_PREFIX_.'category_product` cpp
                        ON cpp.`id_product` = p.`id_product`
                    WHERE product_shop.`id_shop` = '.(int) $this->context->shop->id.' AND product_shop.`active` = 1'
                        .' AND p.`id_product` IN ('.implode(",", $id_arr).')';
            $sql .= ' GROUP BY p.`id_product`';
            $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql, true, false);
            $result = Product::getProductsProperties($id_lang, $rows);

            $assembler = new ProductAssembler($this->context);

            $presenterFactory = new ProductPresenterFactory($this->context);
            $presentationSettings = $presenterFactory->getPresentationSettings();
            $presenter = new ProductListingPresenter(
                new ImageRetriever(
                    $this->context->link
                ),
                $this->context->link,
                new PriceFormatter(),
                new ProductColorsRetriever(),
                $this->context->getTranslator()
            );

            $products_for_template = [];

            foreach ($result as $rawProduct) {
                $products_for_template[] = $presenter->present(
                    $presentationSettings,
                    $assembler->assembleProduct($rawProduct),
                    $this->context->language
                );
            }
            return $products_for_template;
        }
        return null;
    }
    public function getFlashCategory($category_id) {
        $this->context = Context::getContext();
        $id_lang = $this->context->language->id;
        if($category_id) {
            $query = "SELECT fc.`category_id`, fcl.`title`
            FROM `"._DB_PREFIX_."gdz_flashsale_categories` fc
            LEFT JOIN "._DB_PREFIX_."gdz_flashsale_categories_lang fcl ON (fc.category_id = fcl.category_id)
            WHERE id_lang = ".(int)$id_lang." AND fc.category_id = ".$category_id;
            $_category = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query);
        }
        return $_category;
    }
    public function returnValue($addon) {
        $this->context = Context::getContext();
        $id_lang = $this->context->language->id;
        $_products = $this->getFlashSales($addon->fields);
        if(!isset($_products) || count($_products) == 0) return;
        $cols = $addon->fields[3]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $expire_time = Configuration::get('GDZ_FLASHSALE_EXPIRETIME');
        $category_id = $addon->fields[0]->value;
        $_category = $this->getFlashCategory($category_id);
        $this->context->smarty->assign(
            array(
                'products' => $_products,
                'expire_time' => $expire_time,
                'flash_category' => $_category,
                'cols'  => $cols,
                'cols_md'   => $cols_arr[0],
        				'cols_sm'   => $cols_arr[1],
        				'cols_xs'   => $cols_arr[2],
                'navigation' => $addon->fields[4]->value,
                'pagination' => $addon->fields[5]->value,
                'autoplay' => $addon->fields[6]->value,
                'rewind' => $addon->fields[7]->value,
                'slidebypage' => $addon->fields[8]->value,
                'gutter' => $addon->fields[2]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
