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

if (!defined('_PS_VERSION_')) {
    exit;
}

include_once(dirname(__FILE__).'/classes/WishList.php');
class gdz_wishlist extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'gdz_wishlist';
        $this->tab = 'front_office_features';
        $this->version = '1.1.0';
        $this->author = 'Godzilla';
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Godzilla WishList');
        $this->description = $this->l('Advance Wishlist for Prestashop');
		    $this->default_wishlist_name = $this->l('My wishlist');
    }


    public function install()
    {
		    require_once( dirname(__FILE__).'/install/install.php' );
    		if (!parent::install() ||
    			!$this->registerHook('rightColumn') ||
    			!$this->registerHook('productActions') ||
    			!$this->registerHook('cart') ||
    			!$this->registerHook('customerAccount') ||
    			!$this->registerHook('header') ||
    			!$this->registerHook('adminCustomers') ||
    			!$this->registerHook('displayProductListFunctionalButtons') ||
    			!$this->registerHook('top'))
			       return false;
		    $this->registerHook('displayMyAccountBlock');
		    return true;
	  }

    public function uninstall()
    {
    		Db::getInstance()->execute(
    			'DROP TABLE IF EXISTS
    			`'._DB_PREFIX_.'gdz_wishlist`,
    			`'._DB_PREFIX_.'gdz_wishlist_email`,
    			`'._DB_PREFIX_.'gdz_wishlist_product`,
    			`'._DB_PREFIX_.'gdz_wishlist_product_cart`'
    		);
        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */

	  public function getContent()
	  {
    		$this->html = null;
    		if (Tools::isSubmit('viewgdz_wishlist') && $id = Tools::getValue('id_product'))
    			Tools::redirect($this->context->link->getProductLink($id));

    		$this->html .= $this->renderJS();
    		$this->html .= $this->renderForm();
    		if (Tools::getValue('id_customer') && Tools::getValue('id_wishlist'))
    			$this->html .= $this->renderList((int)Tools::getValue('id_wishlist'));

    		return $this->html;
	 }
	public function renderForm()
	{
		$customers = array();
		foreach (WishList::getCustomers() as $c)
		{
				$customers[$c['id_customer']]['id_customer'] = $c['id_customer'];
				$customers[$c['id_customer']]['name'] = $c['firstname'].' '.$c['lastname'];
		}

		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Listing'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'select',
						'label' => $this->l('Customers :'),
						'name' => 'id_customer',
						'options' => array(
							'default' => array('value' => 0, 'label' => $this->l('Choose customer')),
							'query' => $customers,
							'id' => 'id_customer',
							'name' => 'name'
						),
					)
				),
			),
		);

		if ($id_customer = Tools::getValue('id_customer'))
		{
			$wishlists = WishList::getByIdCustomer($id_customer);
			$fields_form['form']['input'][] = array(
				'type' => 'select',
				'label' => $this->l('Wishlist :'),
				'name' => 'id_wishlist',
				'options' => array(
					'default' => array('value' => 0, 'label' => $this->l('Choose wishlist')),
					'query' => $wishlists,
					'id' => 'id_wishlist',
					'name' => 'name'
				),
			);
		}

		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;

		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitModule';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name
			.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		return $helper->generateForm(array($fields_form));
	}

	public function getConfigFieldsValues()
	{
		return array(
			'id_customer' => Tools::getValue('id_customer'),
			'id_wishlist' => Tools::getValue('id_wishlist'),
		);
	}

	public function renderJS()
	{
  		return "<script>
  			$(document).ready(function () { $('#id_customer, #id_wishlist').change( function () { $('#module_form').submit();}); });
  		</script>";
	}


	public function renderList($id_wishlist)
	{
  		$wishlist = new WishList($id_wishlist);
  		$products = WishList::getProductByIdCustomer($id_wishlist, $wishlist->id_customer, $this->context->language->id);

  		foreach ($products as $key => $val)
  		{
  			$image = Image::getCover($val['id_product']);
  			$products[$key]['image'] = $this->context->link->getImageLink($val['link_rewrite'], $image['id_image'], ImageType::getFormatedName('small'));

  		}

  		$fields_list = array(
  			'image' => array(
  				'title' => $this->trans('Image', array(), 'Admin.Global'),
  				'type' => 'image',
  			),
  			'name' => array(
  				'title' => $this->trans('Product', array(), 'Admin.Global'),
  				'type' => 'text',
  			),
  			'attributes_small' => array(
  				'title' => $this->trans('Combination', array(), 'Admin.Global'),
  				'type' => 'text',
  			),
  			'quantity' => array(
  				'title' => $this->trans('Quantity', array(), 'Admin.Global'),
  				'type' => 'text',
  			),
  			'priority' => array(
  				'title' => $this->trans('Priority', array(), 'Admin.Global'),
  				'type' => 'priority',
  				'values' => array($this->l('High'), $this->l('Medium'), $this->l('Low')),
  			),
  		);

  		$helper = new HelperList();
  		$helper->shopLinkType = '';
  		$helper->simple_header = true;
  		$helper->no_link = true;
  		$helper->actions = array('view');
  		$helper->show_toolbar = false;
  		$helper->module = $this;
  		$helper->identifier = 'id_product';
  		$helper->title = $this->l('Product list');
  		$helper->table = $this->name;
  		$helper->token = Tools::getAdminTokenLite('AdminModules');
  		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
  		$helper->tpl_vars = array('priority' => array($this->l('High'), $this->l('Medium'), $this->l('Low')));

  		return $helper->generateList($products, $fields_list);
  	}

    public function hookHeader()
    {
        $link = new Link();
        Media::AddJsDef(array('login_required' => $this->l('You must be logged in to manage your wishlist.'), 'added_to_wishlist' => $this->l('The product was successfully added to your wishlist.'), 'mywishlist_url' => $link->getModuleLink('gdz_wishlist', 'mywishlist', array(), true)));
		    $this->context->controller->addJS(($this->_path).'views/js/ajax-wishlist.js');
    }
	  public function hookTop($params)
	  {
  		if ($this->context->customer->isLogged()) {
      			$wishlists = Wishlist::getByIdCustomer($this->context->customer->id);
      			if (empty($this->context->cookie->id_wishlist) === true ||
      				WishList::exists($this->context->cookie->id_wishlist, $this->context->customer->id) === false)
      			{
      				if (!count($wishlists))
      					$id_wishlist = false;
      				else
      				{
      					$id_wishlist = (int)$wishlists[0]['id_wishlist'];
      					$this->context->cookie->id_wishlist = (int)$id_wishlist;
      				}
      			}
      			else
      				$id_wishlist = $this->context->cookie->id_wishlist;

      			$this->smarty->assign(
      				array(
      					'id_wishlist' => $id_wishlist,
      					'isLogged' => true,
      					'wishlist_products' => ($id_wishlist == false ? false : WishList::getProductByIdCustomer($id_wishlist,
      						$this->context->customer->id, $this->context->language->id, null, true)),
      					'wishlists' => $wishlists,
      					'ptoken' => Tools::getToken(false)
      				)
      			);
  		} else {
  			   $this->smarty->assign(array(
  						'wishlist_products' => false,
  						'wishlists' => false,
  						'isLogged' => false
  					));
      }
  		return $this->display(__FILE__, 'gdz_wishlist_top.tpl');
	}
	public function hookCustomerAccount($params)
	{
		  return $this->display(__FILE__, 'my-account.tpl');
	}
	public function hookDisplayMyAccountBlock($params)
	{
		  return $this->hookCustomerAccount($params);
	}
}
