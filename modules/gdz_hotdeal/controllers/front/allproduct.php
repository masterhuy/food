<?php
/**
 * 2007-2020 PrestaShop
 *
 * Godzilla HotDeal
 *
 *  @author    Godzilla <joommasters@gmail.com>
 *  @copyright 2007-2020 Godzilla
 *  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *  @Website: https://www.godzillabuilder.com
 */

/**
 * @since 1.5.0
 */
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;

class Gdz_HotDealAllProductModuleFrontController extends ModuleFrontController
{
    public $ssl                 = true;
    public $display_column_left = false;

    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {

        parent::initContent();

        $products = $this->getDealToShow();
        $this->context->controller->addCSS($this->module->getPathUri() . 'css/style.css', 'all');
        $this->context->controller->addCSS($this->module->getPathUri() . 'css/style.css', 'all');
        $this->context->smarty->assign(array(
            'products' => $products,
        ));
        $this->setTemplate('module:gdz_hotdeal/views/templates/front/allproduct.tpl');

    }

    public function getDealToShow()
    {
        $this->context = Context::getContext();
        $id_shop       = $this->context->shop->id;
        $id_lang       = $this->context->language->id;

        $deals = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT hs.`id_deal` as id_deal,
                hss.`active`,hss.`ordering`,hss.`id_product`,hss.`deal_time`
                FROM ' . _DB_PREFIX_ . 'gdz_hotdeal hs
                LEFT JOIN ' . _DB_PREFIX_ . 'gdz_hotdeal_items hss ON (hs.id_deal = hss.id_deal)
                WHERE id_shop = ' . (int) $id_shop . '
                ORDER BY hs.id_deal'
        );

        $products    = array();
        $total_deals = count($deals);
        for ($i = 0; $i < $total_deals; $i++) {
            $sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
                    pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
                    il.`legend`, m.`name` AS manufacturer_name,
                    DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
                    INTERVAL ' . (Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . '
                        DAY)) > 0 AS new, product_shop.price AS orderprice
                FROM `' . _DB_PREFIX_ . 'product` p
                ' . Shop::addSqlAssociation('product', 'p') . '
                LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa
                ON (p.`id_product` = pa.`id_product`)
                ' . Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1') . '
                ' . Product::sqlStock('p', 'product_attribute_shop', false, $this->context->shop) . '
                LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl
                    ON (p.`id_product` = pl.`id_product`
                    AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl') . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'image` i
                    ON (i.`id_product` = p.`id_product`)' .
            Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1') . '
                LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il
                    ON (image_shop.`id_image` = il.`id_image`
                    AND il.`id_lang` = ' . (int) $id_lang . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m
                    ON m.`id_manufacturer` = p.`id_manufacturer`
                WHERE p.`id_product` = ' . $deals[$i]['id_product'] . ' AND product_shop.`id_shop` = ' . (int) $id_shop . '
                     AND product_shop.`active` = 1'
                . ' GROUP BY product_shop.id_product';
            $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);

            $products[]  = Product::getProductProperties($id_lang, $row);
            $product_img = array();
            foreach ($products as $k => $product) {
                $pr                        = new Product($product['id_product']);
                $product_img               = $pr->getImages($id_lang);
                $products[$k]['images']    = $product_img;
                $products[$k]['sold']      = gdzPageBuilderHelper::getNbOfSales($product['id_product']);
                $products[$k]['id_deal']   = $deals[$k]['id_deal'];
                $products[$k]['deal_time'] = $deals[$k]['deal_time'];

            }
        }

        $assembler = new ProductAssembler($this->context);

        $presenterFactory     = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter            = new ProductListingPresenter(
            new ImageRetriever(
                $this->context->link
            ),
            $this->context->link,
            new PriceFormatter(),
            new ProductColorsRetriever(),
            $this->context->getTranslator()
        );

        $products_for_template = [];
        if (!isset($products) || count($products) == 0) {
            return;
        }

        foreach ($products as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $this->context->language
            );
        }
        return $products_for_template;
    }

}
