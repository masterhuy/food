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

class gdzAddonHotdeal extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'hotdeal';
        $this->modulename = 'gdz_hotdeal';
        $this->addontitle = 'Hot Deals';
        $this->addondesc = 'Show Hot Deals';
        $this->type = 'Shop Addons';
        $this->ordering = 88;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        if (!Module::isInstalled('gdz_hotdeal')) return;
        $inputs = array(
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
    public function getDeals($fields) {
        $this->context = Context::getContext();
        $id_shop = $this->context->shop->id;
        $id_lang = $this->context->language->id;
        $deals = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT hd.`id_deal` as id_deal,hdi.`active`,hdi.`ordering`,hdi.`id_product`,hdi.`deal_time` FROM '._DB_PREFIX_.'gdz_hotdeal hd LEFT JOIN '._DB_PREFIX_.'gdz_hotdeal_items hdi ON (hd.`id_deal` = hdi.`id_deal`) WHERE `id_shop` = '.(int)$id_shop.' AND hdi.`active` = 1 ORDER BY hd.`id_deal` LIMIT 0,'.$fields[2]->value);
        $products = array();
        $total_deals = count($deals);
        for ($i = 0; $i < $total_deals; $i++) {
            $sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
                    pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
                    il.`legend`, m.`name` AS manufacturer_name,
                    DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
                    INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
                        DAY)) > 0 AS new, product_shop.price AS orderprice
                FROM `'._DB_PREFIX_.'product` p
                '.Shop::addSqlAssociation('product', 'p').'
                LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
                ON (p.`id_product` = pa.`id_product`)
                '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
                '.Product::sqlStock('p', 'product_attribute_shop', false, $this->context->shop).'
                LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                    ON (p.`id_product` = pl.`id_product`
                    AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
                LEFT JOIN `'._DB_PREFIX_.'image` i
                    ON (i.`id_product` = p.`id_product`)'.
                                Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
                LEFT JOIN `'._DB_PREFIX_.'image_lang` il
                    ON (image_shop.`id_image` = il.`id_image`
                    AND il.`id_lang` = '.(int)$id_lang.')
                LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
                    ON m.`id_manufacturer` = p.`id_manufacturer`
                WHERE p.`id_product` = '.$deals[$i]['id_product'].' AND product_shop.`id_shop` = '.(int)$id_shop.'
                     AND product_shop.`active` = 1'
                    .' GROUP BY product_shop.id_product';
            $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
            if (isset($row['id_product'])) {
                $products[] = Product::getProductProperties($id_lang, $row);
            }
            $product_img = array();
            foreach ($products as $k => $product) {
                $pr = new Product($product['id_product']);
                $product_img = $pr->getImages($id_lang);
                $products[$k]['images']=$product_img;
                $products[$k]['sold'] = gdzPageBuilderHelper::getNbOfSales($product['id_product']);
                $products[$k]['id_deal'] = $deals[$k]['id_deal'];
                $products[$k]['deal_time'] = $deals[$k]['deal_time'];

            }
        }
        if (count($products) == 0) {
            return "Please go to modules >> hotdeal to add product!";
        }
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
        if(!isset($products) || count($products) == 0) return;
        foreach ($products as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $this->context->language
            );
        }
        return $products_for_template;
    }
    public function returnValue($addon)
    {
        $this->context = Context::getContext();
        $id_lang = $this->context->language->id;
        $products_for_template = $this->getDeals($addon->fields);
        $cols = $addon->fields[4]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'products' => $products_for_template,
                'cols'  => $cols,
                'cols_md'   => $cols_arr[0],
        				'cols_sm'   => $cols_arr[1],
        				'cols_xs'   => $cols_arr[2],
                'navigation' => $addon->fields[5]->value,
                'pagination' => $addon->fields[6]->value,
                'autoplay' => $addon->fields[7]->value,
                'rewind' => $addon->fields[8]->value,
                'slidebypage' => $addon->fields[9]->value,
                'gutter' => $addon->fields[3]->value,
                'showviewall' => $addon->fields[0]->value,
                'viewall_text' => $addon->fields[1]->value->$id_lang
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
