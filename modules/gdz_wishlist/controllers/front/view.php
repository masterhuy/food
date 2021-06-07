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

class GdzWishListViewModuleFrontController extends ModuleFrontController
{

	public function __construct()
	{
		parent::__construct();
		$this->context = Context::getContext();
		include_once($this->module->getLocalPath().'classes/WishList.php');
		include_once($this->module->getLocalPath().'gdz_wishlist.php');
	}

	public function initContent()
	{
		parent::initContent();
		$token = Tools::getValue('token');

		$module = new gdz_wishlist();

		if ($token)
		{
			$wishlist = WishList::getByToken($token);

			WishList::refreshWishList($wishlist['id_wishlist']);
			$products = WishList::getProductByIdCustomer((int)$wishlist['id_wishlist'], (int)$wishlist['id_customer'], $this->context->language->id, null, true);

			$nb_products = count($products);
			$priority_names = array(0=> $module->l('High'), 1=>$module->l('Medium'), 2=>$module->l('Low'));

			for ($i = 0; $i < $nb_products; ++$i)
			{
				$obj = new Product((int)$products[$i]['id_product'], true, $this->context->language->id);
				if (!Validate::isLoadedObject($obj))
					continue;
				else
				{
					$products[$i]['priority_name'] = $priority_names[$products[$i]['priority']];
					$quantity = Product::getQuantity((int)$products[$i]['id_product'], $products[$i]['id_product_attribute']);
					$products[$i]['attribute_quantity'] = $quantity;
					$products[$i]['product_quantity'] = $quantity;
					$products[$i]['allow_oosp'] = $obj->isAvailableWhenOutOfStock((int)$obj->out_of_stock);
					if ($products[$i]['id_product_attribute'] != 0)
					{
						$combination_imgs = $obj->getCombinationImages($this->context->language->id);
						if (isset($combination_imgs[$products[$i]['id_product_attribute']][0]))
							$products[$i]['cover'] = $obj->id.'-'.$combination_imgs[$products[$i]['id_product_attribute']][0]['id_image'];
						else
						{
							$cover = Product::getCover($obj->id);
							$products[$i]['cover'] = $obj->id.'-'.$cover['id_image'];
						}
					} else
					{
						$images = $obj->getImages($this->context->language->id);
						foreach ($images as $image)
							if ($image['cover'])
							{
								$products[$i]['cover'] = $obj->id.'-'.$image['id_image'];
								break;
							}
					}
					if (!isset($products[$i]['cover']))
						$products[$i]['cover'] = $this->context->language->iso_code.'-default';
				}
				$products[$i]['bought'] = false;

			}

			WishList::incCounter((int)$wishlist['id_wishlist']);
			$ajax = Configuration::get('PS_BLOCK_CART_AJAX');

			$wishlists = WishList::getByIdCustomer((int)$wishlist['id_customer']);

			foreach ($wishlists as $key => $item)
			{
				if ($item['id_wishlist'] == $wishlist['id_wishlist'])
				{
					unset($wishlists[$key]);
					break;
				}
			}

			$this->context->smarty->assign(
				array(
					'current_wishlist' => $wishlist,
					'token' => $token,
					'ajax' => ((isset($ajax) && (int)$ajax == 1) ? '1' : '0'),
					'wishlists' => $wishlists,
					'products' => $products
				)
			);
		}
		$this->setTemplate('module:gdz_wishlist/views/templates/front/view.tpl');
	}
}
