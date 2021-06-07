<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Flashsale
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

require_once(_PS_ROOT_DIR_.'/modules/gdz_flashsale/gdz_flashsale.php');
class gdzFlashsaleModuleFrontController extends ModuleFrontController
{

	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{

		parent::initContent();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		$items = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT hs.`item_id` as id_item,hss.`product_id`, hss.`ordering`, hss.`active`
			FROM '._DB_PREFIX_.'gdz_flashsale hs
			LEFT JOIN '._DB_PREFIX_.'gdz_flashsale_items hss ON (hs.item_id = hss.item_id)
			WHERE id_shop = '.(int)$id_shop.
			' AND hss.`active` = 1 ORDER BY hss.ordering'
		);
		$products = array();
		foreach ($items as $key => $item)
		{
			$sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, 	product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
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
				WHERE p.`id_product` = '.$item['product_id'].' AND product_shop.`id_shop` = '.(int)$id_shop.'
					 AND product_shop.`active` = 1'
					.' GROUP BY product_shop.id_product';
			$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
			//print_r($sql); exit;
			$products[] = Product::getProductProperties($id_lang, $row);
		}
		$this->context->smarty->assign(array(
			'products' => gdz_flashsale::returnSearch($products),
			'items_show' => Configuration::get('GDZ_FLASHSALE_ITEMS_SHOW'),
			'items' => Configuration::get('GDZ_FLASHSALE_TOTAL'),
			'auto' => Configuration::get('GDZ_FLASHSALE_AUTO'),
			'expiretime' => Configuration::get('GDZ_FLASHSALE_EXPIRETIME')
		));
		$this->setTemplate('module:gdz_flashsale/views/templates/front/flashsales.tpl');
	}
}
