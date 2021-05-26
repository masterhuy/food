<?php
/**
* 2007-2020 PrestaShop
*
* Prestashop Recently Bought
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;

define("FEATURED", 0);
define("LATEST_PRODUCTS", 1);
define("ORDERS", 2);
define("PRODUCTS", 3);
define("CATEGORIES", 4);
define("BESTSALE", 5);
define("ONSALE", 6);
class gdzRBHelper
{
    public $context;
    public function __construct()
    {
        $this->context = Context::getContext();
        $this->name = 'gdz_recentlybought';
        $this->cache = _PS_MODULE_DIR_.'/'.$this->name.'/product.cache';
    }

    public function getProducts($ajax = false)
    {
        $use_cache = Configuration::get('GRB_USE_CACHE');
        $lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $frametime = Configuration::get('GRB_FRAME_TIME');
        $address_list   = Configuration::get('GRB_ADDRESS_LIST_'.Context::getContext()->language->id);
        $address_list = str_replace("\r", '', $address_list);
        $address_list = explode("\n", $address_list);
        if ($use_cache) {
            $timestamp = time();
            clearstatcache();
            if (file_exists($this->cache) && ($timestamp-filemtime($this->cache))/60 < 30) {
                $products = $this->readCache();
                if ($ajax && count($products) > 0) {
                    return array($products[rand(0, count($products)-1)]);
                }
                return $products;
            }
        }
        $products = array();
        switch (Configuration::get('GRB_GET_PRODUCT_TYPE')) {
            case FEATURED:
                $results = $this->getFeaturedProducts();
                break;
            case LATEST_PRODUCTS:
                $results = Product::getNewProducts($lang);
                break;
            case ORDERS:
                $status = Tools::jsonDecode(Configuration::get('GRB_ORDER_STATUS'));
                $ordertime = Configuration::get('GRB_ORDER_TIME');
                $unit = Configuration::get('GRB_ORDER_TIME_UNIT');
                $time = strtotime("-" . $ordertime . " " . $unit);
                $results = $this->getProductsFromOrders($status, $time);
                break;
            case PRODUCTS:
                $ids = Tools::jsonDecode(Configuration::get('GRB_SELECT_PRODUCT'));
                $results = $this->getProductsByIds($ids);
                break;
            case CATEGORIES:
                $ids = Tools::jsonDecode(Configuration::get('GRB_SELECT_CATEGORY'));
                $results = $this->getProductsByCategoryIds($ids);
                break;
            case BESTSALE:
                $results = ProductSale::getBestSales($lang);
                break;
            case ONSALE:
                $results = $this->getOnSales($lang);
                break;

            default:
                $results = null;
                break;
        }
        // dump($results);
        if ($results != null) {
            foreach ($results as $product) {
                if (Image::hasImages($this->context->language->id, $product['id_product'])) {
                    $image_link = $this->context->link->getImageLink(
                        $product['link_rewrite'],
                        $product['id_image'],
                        null
                    );
                } else {
   				 if (Configuration::get('JRB_GET_PRODUCT_TYPE') == ORDERS){
   					 if ($product['id_image_2'] && Image::hasImages($this->context->language->id, $product['id_product'])) {
   					 $image_link = $this->context->link->getImageLink(
   						 $product['link_rewrite'],
   						 $product['id_image_2'],
   						 null
   					 );
   					 }
   				 } else {
                	$image_link = str_replace('\\', '/', _PS_BASE_URL_.__PS_BASE_URI__.'modules/'.
                	$this->name.'/views/img/noimage.jpg');
   				 }
            	}
                $products[] = array(
                    'title' => $product['name'],
                    'product_link' => $this->context->link->getProductLink(
                        $product['id_product'],
                        $product['link_rewrite'],
                        null,
                        null,
                        null,
                        null,
                        isset($product['id_product_attribute'])? $product['id_product_attribute']: 0
                    ),
                    'image_link' => $image_link,
                    'address' => $address_list[rand(0, count($address_list) - 1)],
                    'time' => $this->calTimeAgo($frametime),
                );
            }
            unset($results);
        }
        if ($use_cache && count($products) > 0) {
            $this->writeCache($products);
        }
        if ($ajax && count($products) > 0) {
            return array($products[rand(0, count($products)-1)]);
        }
        return $products;
    }
    private function writeCache($products)
    {
        $file = fopen($this->cache, "w");

        foreach ($products as $product) {
            fputcsv($file, $product);
        }
        fclose($file);
    }
    private function readCache()
    {
        $file = fopen($this->cache, 'r');
        $products = array();
        $key = array('title', 'product_link', 'image_link', 'address', 'time');
        while (($product = fgetcsv($file)) !== false) {
            $products[] = array_combine($key, $product);
        }
        fclose($file);
        return $products;
    }
    private function calTimeAgo($frametime)
    {
        $time_ago = rand(10, $frametime*60);
        if ($time_ago < 60) {
            return $this->tran("A fews seconds");
        }
        $time_ago = floor($time_ago/60);
        if ($time_ago < 60) {
            return $time_ago." ".$this->tran(($time_ago>1)?"minutes":"minute");
        }
        $time_ago = floor($time_ago/60);
        if ($time_ago < 24) {
            return $time_ago." ".$this->tran(($time_ago>1)?"hours":"hour");
        }
        $time_ago = floor($time_ago/24);
        if ($time_ago < 7) {
            return $time_ago." ".$this->tran(($time_ago>1)?"days":"day");
        } else {
            return $this->tran('more than a week');
        }
    }
    private function getOnSales()
    {
        $sql = new DbQuery();
        $sql->select('p.id_product, pl.link_rewrite, pl.name, i.id_image, pa.id_product_attribute');
        $sql->from('product', 'p');
        $sql->leftJoin('product_lang', 'pl', 'pl.id_product = p.id_product');
        $sql->leftJoin('image', 'i', 'i.id_product = p.id_product AND i.cover = 1');
        $sql->leftJoin('product_attribute', 'pa', 'p.id_product = pa.id_product AND pa.default_on = 1');
        $sql->leftJoin('shop', 's', 'pl.id_shop = s.id_shop');
        $sql->where("p.on_sale = 1 AND p.active = 1");
        $sql->where("pl.id_lang = ".(int)$this->context->language->id);
        $sql->where('s.active = 1');
        $sql->where(str_replace(' AND ', '', Shop::addSqlRestriction(false, 's')));
        $res = Db::getInstance()->executeS($sql);
        // dump($sql->__toString());
        return $res;
    }
    private function getFeaturedProducts()
    {
        $category = new Category($this->context->shop->getCategory());
        $searchProvider = new CategoryProductSearchProvider(
            $this->context->getTranslator(),
            $category
        );
        $context = new ProductSearchContext($this->context);
        $query = new ProductSearchQuery();
        $result = $searchProvider->runQuery($context, $query);
        return $result->getProducts();
    }
    private function getProductsFromOrders($orderstatus, $time)
    {
        if (!count($orderstatus)) {
            return null;
        }
        $status = '('.implode(',', $orderstatus).')';
        $status = pSQL($status);
        $time = pSQL($time);
        $sql = new DbQuery();
        $sql->select('p.id_product, i.id_image AS id_image_2, od.product_name AS name');
        $sql->select('pai.id_image, od.product_attribute_id AS id_product_attribute');
        $sql->from('orders', 'o');
        $sql->leftJoin('order_detail', 'od', 'od.id_order = o.id_order');
        $sql->leftJoin('product', 'p', 'p.id_product = od.product_id');
        $sql->leftJoin('product_lang', 'pl', 'pl.id_product = p.id_product');
        $sql->leftJoin('product_attribute_image', 'pai', 'od.product_attribute_id = pai.id_product_attribute');
        $sql->leftJoin('image', 'i', 'i.id_product = p.id_product AND i.cover = 1');
        $sql->leftJoin('shop', 's', 'o.id_shop = s.id_shop');
        $sql->where("o.current_state IN $status");
        $sql->where("UNIX_TIMESTAMP(o.date_upd) >= $time");
        $sql->where("pl.id_lang = ".(int)$this->context->language->id);
        $sql->where('s.active = 1');
        $sql->where(str_replace(' AND ', '', Shop::addSqlRestriction(false, 's')));
        $sql->groupBy('p.id_product, pai.id_image, id_product_attribute');
        $sql->orderBy('o.date_add');
        $sql->limit(50);
        $res = Db::getInstance()->executeS($sql);
        // dump($sql->__toString());
        return $res;
    }
    private function getProductsByIds($ids)
    {
        if (!count($ids)) {
            return null;
        }
        $idgroup = '('.implode(',', $ids).')';
        $idgroup = pSQL($idgroup);
        $sql = new DbQuery();
        $sql->select('p.id_product, pl.link_rewrite, pl.name, i.id_image, pa.id_product_attribute');
        $sql->from('product', 'p');
        $sql->leftJoin('product_lang', 'pl', 'pl.id_product = p.id_product');
        $sql->leftJoin('image', 'i', 'i.id_product = p.id_product AND i.cover = 1');
        $sql->leftJoin('product_attribute', 'pa', 'p.id_product = pa.id_product AND pa.default_on = 1');
        $sql->leftJoin('shop', 's', 'pl.id_shop = s.id_shop');
        $sql->where("p.id_product IN $idgroup");
        $sql->where("pl.id_lang = ".(int)$this->context->language->id);
        $sql->where('s.active = 1');
        $sql->where(str_replace(' AND ', '', Shop::addSqlRestriction(false, 's')));
        $res = Db::getInstance()->executeS($sql);
        // dump($sql->__toString());
        return $res;
    }
    private function getProductsByCategoryIds($ids)
    {
        if (!count($ids)) {
            return null;
        }
        $idgroup = '('.implode(',', $ids).')';
        $idgroup = pSQL($idgroup);
        $sql = new DbQuery();
        $sql->select('p.id_product, pl.link_rewrite, pl.name, i.id_image, pa.id_product_attribute');
        $sql->from('product', 'p');
        $sql->leftJoin('product_lang', 'pl', 'pl.id_product = p.id_product');
        $sql->leftJoin('image', 'i', 'i.id_product = p.id_product AND i.cover = 1');
        $sql->leftJoin('category_product', 'cp', 'cp.id_product = p.id_product');
        $sql->leftJoin('product_attribute', 'pa', 'p.id_product = pa.id_product AND pa.default_on = 1');
        $sql->leftJoin('shop', 's', 'pl.id_shop = s.id_shop');
        $sql->where("cp.id_category IN $idgroup");
        $sql->where("pl.id_lang = ".(int)$this->context->language->id);
        $sql->where('s.active = 1');
        $sql->where('p.active = 1');
        $sql->where(str_replace(' AND ', '', Shop::addSqlRestriction(false, 's')));
        // dump($sql->__toString());
        $res = Db::getInstance()->executeS($sql);
        return $res;
    }

    private function tran($string)
    {

        if (($translation = $this->context->getTranslator()->trans($string)) !== $string) {
            return $translation;
        }

        return Translate::getModuleTranslation($this->name, $string, $this->name);
    }
}
