<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Wishlist
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

/* SSL Management */
$useSSL = true;

require_once(dirname(__FILE__).'/../../config/config.inc.php');
require_once(dirname(__FILE__).'/../../init.php');
require_once(dirname(__FILE__).'/classes/WishList.php');
require_once(dirname(__FILE__).'/gdz_wishlist.php');
$context = Context::getContext();
if ($context->customer->isLogged())
{
	$action = Tools::getValue('action');
	$id_wishlist = (int)Tools::getValue('id_wishlist');
	$id_product = (int)Tools::getValue('id_product');
	$id_product_attribute = (int)Tools::getValue('id_product_attribute');
	$quantity = (int)Tools::getValue('quantity');
	$priority = Tools::getValue('priority');
	$wishlist = new WishList((int)($id_wishlist));
	$refresh = ((Tools::getValue('refresh') == 'true') ? 1 : 0);
	if (empty($id_wishlist) === false)
	{
		if (!strcmp($action, 'update'))
		{
			WishList::updateProduct($id_wishlist, $id_product, $id_product_attribute, $priority, $quantity);
		}
		else
		{
			if (!strcmp($action, 'delete'))
				WishList::removeProduct($id_wishlist, (int)$context->customer->id, $id_product, $id_product_attribute);

			$products = WishList::getProductByIdCustomer($id_wishlist, $context->customer->id, $context->language->id);
			$bought = WishList::getBoughtProduct($id_wishlist);

			for ($i = 0; $i < sizeof($products); ++$i)
			{
				$obj = new Product((int)($products[$i]['id_product']), false, $context->language->id);
				if (!Validate::isLoadedObject($obj))
					continue;
				else
				{
					if ($products[$i]['id_product_attribute'] != 0)
					{
						$combination_imgs = $obj->getCombinationImages($context->language->id);
						if (isset($combination_imgs[$products[$i]['id_product_attribute']][0]))
							$products[$i]['cover'] = $obj->id.'-'.$combination_imgs[$products[$i]['id_product_attribute']][0]['id_image'];
						else
						{
							$cover = Product::getCover($obj->id);
							$products[$i]['cover'] = $obj->id.'-'.$cover['id_image'];
						}
					}
					else
					{
						$images = $obj->getImages($context->language->id);
						foreach ($images AS $k => $image)
							if ($image['cover'])
							{
								$products[$i]['cover'] = $obj->id.'-'.$image['id_image'];
								break;
							}
					}
					if (!isset($products[$i]['cover']))
						$products[$i]['cover'] = $context->language->iso_code.'-default';
				}
				$products[$i]['bought'] = false;
				for ($j = 0, $k = 0; $j < sizeof($bought); ++$j)
				{
					if ($bought[$j]['id_product'] == $products[$i]['id_product'] AND
						$bought[$j]['id_product_attribute'] == $products[$i]['id_product_attribute'])
						$products[$i]['bought'][$k++] = $bought[$j];
				}
			}

			$productBoughts = array();
			//print_r($products); exit;
			foreach ($products as $product)
				if (is_array($product['bought']) && sizeof($product['bought']))
					$productBoughts[] = $product;
			$context->smarty->assign(array(
					'products' => $products,
					'productsBoughts' => $productBoughts,
					'id_wishlist' => $id_wishlist,
					'refresh' => $refresh,
					'token_wish' => $wishlist->token,
					'link' => $context->link,
					'wishlists' => WishList::getByIdCustomer($cookie->id_customer)
				));

			// Instance of module class for translations
			$module = new gdz_wishlist();

			if (Tools::file_exists_cache(_PS_THEME_DIR_.'modules/gdz_wishlist/views/templates/front/managewishlist.tpl'))
				$context->smarty->display(_PS_THEME_DIR_.'modules/gdz_wishlist/views/templates/front/managewishlist.tpl');
			elseif (Tools::file_exists_cache(dirname(__FILE__).'/views/templates/front/managewishlist.tpl'))
				$context->smarty->display(dirname(__FILE__).'/views/templates/front/managewishlist.tpl');
			elseif (Tools::file_exists_cache(dirname(__FILE__).'/managewishlist.tpl'))
				$context->smarty->display(dirname(__FILE__).'/managewishlist.tpl');
			else
				echo $module->l('No template found', 'managewishlist');
		}
	}
}
