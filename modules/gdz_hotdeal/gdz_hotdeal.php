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
if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_.'gdz_hotdeal/classes/deal.php');

use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
class gdz_hotdeal extends Module {

    private $_html = '';
    public function __construct() {
        $this->name = 'gdz_hotdeal';
        $this->tab = 'content_hotdeals';
        $this->version = '4.0.0';
        $this->author = 'Godzilla';
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->ps_versions_compliancy = array('min' => '1.6.1.0', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();
        $this->displayName = $this->l('Godzilla HotDeal');
        $this->description = $this->l('Deal for Prestashop Product.');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }



    public function getcontent() {

        $this->_html .= $this->headerHTML();
        /* Validate & process */
        if (Tools::isSubmit('submitDeal') || Tools::isSubmit('delete_id_deal') || Tools::isSubmit('submitDeal_setting') || Tools::isSubmit('changeStatus')){

           if($this->_postValidation()) {
                $this->_postProcess();
                $this->_html .= $this->renderForm();
                $this->_html .= $this->renderList();

            } else {
                $this->_html .= $this->renderaddForm();
            }

        } elseif (Tools::isSubmit('addDeal')) {
            $this->_html = $this->renderaddForm();
        } elseif(Tools::isSubmit('id_deal')) {
            $this->_html .=$this->renderaddForm();
        } else {
            $this->_html .= $this->renderForm();
            $this->_html .= $this->renderList();
        }
        return $this->_html;
    }


    public function _postValidation()
    {
        $errors = array();

        if(Tools :: isSubmit('submitDeal')) {
            if(Tools::strlen(Tools::getValue('id_product')) == '')
            $errors[] = $this->l('The product not null.');
             if(Tools::strlen(Tools::getValue('deal_time')) == '')
            $errors[] = $this->l('The deals time not null.');
        } else if (Tools::isSubmit('delete_id_deal') && (!Validate::isInt(Tools::getValue('delete_id_deal')) || !$this->dealExist((int)Tools::getValue('delete_id_deal')))) {
            $errors[] = $this->l('Invalid Deal ID');
        } else if (Tools::isSubmit('id_deal') && (!Validate::isInt(Tools::getValue('id_deal')) || !$this->dealExist((int)Tools::getValue('id_deal')))) {
            $errors[] = $this->l('Invalid Deal ID');
        };
        if(count($errors)) {
                $this->_html .= $this->displayError(implode('<br />', $errors));
                return false;
        }
        return true;
    }
    public function _postProcess()
    {


        $errors = array();

          /* Processes Slider */
        if (Tools::isSubmit('submitDeal_setting')) {

            $res = Configuration::updateValue('GDZ_HOTDEAL_PRODUCT_SHOW', (int)(Tools::getValue('GDZ_HOTDEAL_PRODUCT_SHOW')));
            $res &= Configuration::updateValue('GDZ_HOTDEAL_SPEED', (int)(Tools::getValue('GDZ_HOTDEAL_SPEED')));
            $res &= Configuration::updateValue('GDZ_HOTDEAL_AUTO_PLAY', (int)(Tools::getValue('GDZ_HOTDEAL_AUTO_PLAY')));
            $res &= Configuration::updateValue('GDZ_HOTDEAL_NAVIGATION', (int)(Tools::getValue('GDZ_HOTDEAL_NAVIGATION')));
            $res &= Configuration::updateValue('GDZ_HOTDEAL_PAGINATION', (int)(Tools::getValue('GDZ_HOTDEAL_PAGINATION')));
            $res &= Configuration::updateValue('GDZ_HOTDEAL_REWINDNAV', (int)(Tools::getValue('GDZ_HOTDEAL_REWINDNAV')));
            $res &= Configuration::updateValue('GDZ_HOTDEAL_SCROLLPERPAGE', (int)(Tools::getValue('GDZ_HOTDEAL_SCROLLPERPAGE')));
            $res &= Configuration::updateValue('GDZ_HOTDEAL_VIEWALLPRODUCT', (int)(Tools::getValue('GDZ_HOTDEAL_VIEWALLPRODUCT')));
            if (!$res)
                $errors[] = $this->displayError($this->l('The configuration could not be updated.'));
            else
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=6&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        } elseif(Tools::isSubmit('submitDeal')) {
            /* Sets ID if needed */
            if(Tools::getValue('id_deal') && $this->dealExist(Tools::getValue('id_deal'))) {
                $deal = new Deal((int)Tools::getValue('id_deal'));
                if (!Validate::isLoadedObject($deal)) {
                    $this->_html .= $this->displayError($this->l('Invalid id_deal'));
                    return;
                }
            } else
                $deal = new Deal();
           /* Sets ordering */
            $deal->id_product = (int)Tools::getValue('id_product');
            $deal->ordering = (int)Tools::getValue('ordering');
            $deal->deal_time = Tools::getValue('deal_time');
            /* Sets active */
            $deal->active = (int)Tools::getValue('active');
            /* Processes if no errors  */

            if(!$errors) {
                /* Add */
                if(!Tools::getValue('id_deal')) {
                    if(!$deal->add())
                        $errors[] = $this->displayError($this->l('The deal could not be added.'));
                } elseif(!$deal->update())
                    $errors[] = $this->displayError($this->l('The deal could not be updated.'));
            }
        } elseif(Tools::isSubmit('changeStatus') && Tools::isSubmit('id_deal')) {
            $deal = new Deal((int)Tools::getValue('id_deal'));
            if ($deal->active == 0)
                $deal->active = 1;
            else
                $deal->active = 0;
            $res = $deal->update();
            $this->_html .= ($res ? $this->displayConfirmation($this->l('Configuration updated')) : $this->displayError($this->l('The configuration could not be updated.')));

        } elseif (Tools::isSubmit('delete_id_deal')) {
            $deal = new Deal((int)Tools::getValue('delete_id_deal'));
            $res = $deal->delete();
            if(!$res)
                $this->_html .= $this->displayError('Could not delete');
            else
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=1&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        }

        /* Display errors if needed */
        if (count($errors))
            $this->_html .= $this->displayError(implode('<br />', $errors));
        elseif (Tools::isSubmit('submitDeal') && Tools::getValue('id_deal'))
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        elseif (Tools::isSubmit('submitDeal'))
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=3&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);

    }

    public function getProductSale($search_key ='') {
        $req = "SELECT hs.`name`, hs.`id_product`
        FROM `"._DB_PREFIX_."product_lang` hs
        INNER JOIN `"._DB_PREFIX_."specific_price` hss
        ON (hs.`id_product` = hss.`id_product`)
        WHERE hs.`name` LIKE '%$search_key%'";
        //echo $req; exit;
         return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($req);
    }


    public function install() {
       if (parent::install() && $this->registerHook('header') && $this->registerHook('actionShopDataDuplication')) {
            $res = Configuration::updateValue('GDZ_HOTDEAL_PRODUCT_SHOW', '2');
            $res &= Configuration::updateValue('GDZ_HOTDEAL_SPEED', '700');
            $res &= Configuration::updateValue('GDZ_HOTDEAL_AUTO_PLAY', '1');
            $res &= Configuration::updateValue('GDZ_HOTDEAL_NAVIGATION', '1');
            $res &= Configuration::updateValue('GDZ_HOTDEAL_PAGINATION', '1');
            $res &= Configuration::updateValue('GDZ_HOTDEAL_REWINDNAV', '1');
            $res &= Configuration::updateValue('GDZ_HOTDEAL_SCROLLPERPAGE', '1');
             $res &= Configuration::updateValue('GDZ_HOTDEAL_VIEWALLPRODUCT', '1');
            $res &= $this->createTables();

              if ($res)
                 $this->installSamples();
            return $res;
        }
       return false;
    }


    public function uninstall() {
        if (parent::uninstall()) {
            $res = true;
            $res &= $this->deleteTables();
            $res &= Configuration::deleteByName('GDZ_HOTDEAL_PRODUCT_SHOW');
            $res &= Configuration::deleteByName('GDZ_HOTDEAL_SPEED');
            $res &= Configuration::deleteByName('GDZ_HOTDEAL_AUTO_PLAY');
            $res &= Configuration::deleteByName('GDZ_HOTDEAL_NAVIGATION');
            $res &= Configuration::deleteByName('GDZ_HOTDEAL_PAGINATION');
            $res &= Configuration::deleteByName('GDZ_HOTDEAL_REWINDNAV');
            $res &= Configuration::deleteByName('GDZ_HOTDEAL_SCROLLPERPAGE');
            $res &= Configuration::deleteByName('GDZ_HOTDEAL_VIEWALLPRODUCT');

            return $res;
        }
        return false;
    }

    public function installSamples() {
            if ($this->context->cart == null)
                $this->context->cart = new Cart();
            if ($this->context->customer == null)
                $this->context->customer = new Customer();
            $products = Product::getPricesDrop((int)$this->context->language->id, 0, (int)Configuration::get('GDZ_HOTDEAL_PRODUCT_SHOW'));
            $d =strtotime("+1 Months");
             date("Y-m-d h:i:s", $d);


             for($i = 1 ; $i<8 ; ++$i)
             {
                $deal = new Deal();
                $deal->ordering = $i;
                $deal->active = 1;
                $deal->deal_time = date("Y-m-d h:i:s", $d);
                $deal->id_product = $products[0]['id_product'];
                $deal->add();
             }

    }
    public function createTables() {
        $res = true;
        $res &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'gdz_hotdeal` (
              `id_deal` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `id_shop` int(10) unsigned NOT NULL DEFAULT \'0\',

              PRIMARY KEY (`id_deal`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
        ');
        $res &= (bool)Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'gdz_hotdeal_items` (
                `id_deal` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_product` int(50) NOT NULL,
                `deal_time` datetime NOT NULL,
                `ordering` int(10) unsigned NOT NULL DEFAULT \'0\',
                `active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',

                PRIMARY KEY (`id_deal`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
        ');

        return $res ;
    }


    /**
     * deletes tables
     */
    protected function deleteTables() {
        $deals = $this->getDeals();
        foreach ($deals as $deal)
        {
            $to_del = new Deal($deal['id_deal']);
            $to_del->delete();
        }
        Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_hotdeal`;');
        Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'gdz_hotdeal_items`;');

        return true;
    }

     public function getDeals($active = null) {
        $this->context = Context::getContext();
        $id_shop = $this->context->shop->id;

        $deals = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT hs.`id_deal` as id_deal,
                hss.`active`,hss.`ordering`,hss.`id_product`,hss.`deal_time`

                FROM '._DB_PREFIX_.'gdz_hotdeal hs
                LEFT JOIN '._DB_PREFIX_.'gdz_hotdeal_items hss ON (hs.id_deal = hss.id_deal)

                WHERE id_shop = '.(int)$id_shop.'
                ORDER BY hss.ordering'
            );
        $total_hotdeals = count($deals);

        for($i = 0; $i < $total_hotdeals; $i++)
        {
            $row = $this->getProductName($deals[$i]['id_product']);
            $deals[$i]['product_name'] = $row['name'];
        }
        return $deals;

    }


    public function getDealToShow() {
        $this->context = Context::getContext();
        $id_shop = $this->context->shop->id;
        $id_lang = $this->context->language->id;

          $deals = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT hs.`id_deal` as id_deal,
                hss.`active`,hss.`ordering`,hss.`id_product`,hss.`deal_time`
                FROM '._DB_PREFIX_.'gdz_hotdeal hs
                LEFT JOIN '._DB_PREFIX_.'gdz_hotdeal_items hss ON (hs.id_deal = hss.id_deal)
                WHERE id_shop = '.(int)$id_shop.'
                ORDER BY hs.id_deal'
            );

        $products = array();
        $total_deals = count($deals);
        for ($i = 0; $i < $total_deals; $i++)
        {
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

            $products[] = Product::getProductProperties($id_lang, $row);
        }
        return $products;
    }

    public function renderAddForm()
    {
       $this->context->controller->addCSS(($this->_path).'views/css/admin_style.css', 'all');

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Deal Information'),
                    'icon' => 'icon-cogs',
                     'autocomplete' => 'off'
                ),
                'input' => array(
                    array(
                        'type' => 'product_search',
                        'label' => $this->l('Product'),
                        'name' => 'title'
                    ),
					array(
						'type' => 'datetime',
						'label' => $this->l('Set Time'),
						'name' => 'deal_time',
						'lang' => true,
					),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Active'),
                        'name' => 'active',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
            ),
        );

        if (Tools::isSubmit('id_deal') && $this->dealExist((int)Tools::getValue('id_deal')))
            $fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'id_deal');

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitDeal';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $language = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->tpl_vars = array(
            'base_url' => $this->context->shop->getBaseURL(),
            'language' => array(
                'id_lang' => $language->id,
                'iso_code' => $language->iso_code
            ),
            'fields_value' => $this->getAddFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        $helper->override_folder = '/';
        return $helper->generateForm(array($fields_form));
    }


     public function renderForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(

                     array(
                        'type' => 'text',
                        'label' => $this->l('Number of Product Show'),
                        'name' => 'GDZ_HOTDEAL_PRODUCT_SHOW',
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Speed'),
                        'name' => 'GDZ_HOTDEAL_SPEED',
                    ),

                    array(
                        'type' => 'switch',
                        'label' => $this->l('Auto Play'),
                        'name' => 'GDZ_HOTDEAL_AUTO_PLAY',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),


                    array(
                        'type' => 'switch',
                        'label' => $this->l('Navigation'),
                        'name' => 'GDZ_HOTDEAL_NAVIGATION',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),

                    array(
                        'type' => 'switch',
                        'label' => $this->l('Pagination'),
                        'name' => 'GDZ_HOTDEAL_PAGINATION',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),


                     array(
                        'type' => 'switch',
                        'label' => $this->l('RewindNav'),
                        'name' => 'GDZ_HOTDEAL_REWINDNAV',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),


                    array(
                        'type' => 'switch',
                        'label' => $this->l('ScrollPerPage'),
                        'name' => 'GDZ_HOTDEAL_SCROLLPERPAGE',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),


                    array(
                        'type' => 'switch',
                        'label' => $this->l('Views all product'),
                        'name' => 'GDZ_HOTDEAL_VIEWALLPRODUCT',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),

                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitDeal_setting';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
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
      return  array(
            'GDZ_HOTDEAL_PRODUCT_SHOW' => Tools::getValue('GDZ_HOTDEAL_PRODUCT_SHOW', Configuration::get('GDZ_HOTDEAL_PRODUCT_SHOW')),
            'GDZ_HOTDEAL_SPEED' => Tools::getValue('GDZ_HOTDEAL_SPEED', Configuration::get('GDZ_HOTDEAL_SPEED')),
            'GDZ_HOTDEAL_AUTO_PLAY' => Tools::getValue('GDZ_HOTDEAL_AUTO_PLAY', Configuration::get('GDZ_HOTDEAL_AUTO_PLAY')),

            'GDZ_HOTDEAL_NAVIGATION' => Tools::getValue('GDZ_HOTDEAL_NAVIGATION', Configuration::get('GDZ_HOTDEAL_NAVIGATION')),
            'GDZ_HOTDEAL_PAGINATION' => Tools::getValue('GDZ_HOTDEAL_PAGINATION', Configuration::get('GDZ_HOTDEAL_PAGINATION')),
            'GDZ_HOTDEAL_REWINDNAV' => Tools::getValue('GDZ_HOTDEAL_REWINDNAV', Configuration::get('GDZ_HOTDEAL_REWINDNAV')),
            'GDZ_HOTDEAL_SCROLLPERPAGE' => Tools::getValue('GDZ_HOTDEAL_SCROLLPERPAGE', Configuration::get('GDZ_HOTDEAL_SCROLLPERPAGE')),
            'GDZ_HOTDEAL_VIEWALLPRODUCT' => Tools::getValue('GDZ_HOTDEAL_VIEWALLPRODUCT', Configuration::get('GDZ_HOTDEAL_VIEWALLPRODUCT')),
        );


    }


    public function dealExist($id_deal)
    {

        $req = 'SELECT hs.`id_deal` as id_deal,
         hss.`id_product`, hss.`deal_time`

        FROM '._DB_PREFIX_.'gdz_hotdeal hs
        LEFT JOIN '._DB_PREFIX_.'gdz_hotdeal_items hss
        ON (hs.id_deal = hss.id_deal)
        WHERE hss.`id_deal` = '.(int)$id_deal.'';

        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

        return ($row);
    }

    public function renderList()
    {
        $deals = $this->getDeals();

        foreach ($deals as $key => $hotdeal)
           $deals[$key]['status'] = $this->displayStatus($hotdeal['id_deal'],$hotdeal['active']) ;
        //print_r($deals); exit;
        $this->context->smarty->assign(
                array(
                        'link' =>$this->context->link,
                        'deals' => $deals
                    )
            );
            return $this->display(__FILE__, 'list.tpl');
    }

    public function headerHTML()
    {
        if (Tools::getValue('controller') != 'AdminModules' && Tools::getValue('configure') != $this->name)
            return;

        $this->context->controller->addJqueryUI('ui.sortable');
        /* Style & js for fieldset 'slides configuration' */
        $html = '<script type="text/javascript">
            $(function() {
                var $mySlides = $("#deals");
                $mySlides.sortable({
                    opacity: 0.6,
                    cursor: "move",
                    update: function() {
                        var order = $(this).sortable("serialize") + "&action=updateHotdealsOrdering";
                        $.post("'.$this->context->shop->physical_uri.$this->context->shop->virtual_uri.'modules/'.$this->name.'/ajax_'.$this->name.'.php?secure_key='.$this->secure_key.'", order);
                        }
                    });
                $mySlides.hover(function() {
                    $(this).css("cursor","move");
                    },
                    function() {
                    $(this).css("cursor","auto");
                });
            });
        </script>';

        return $html;
    }


      public function displayStatus($id_deal, $active)
    {
        $title = ((int)$active == 0 ? $this->l('Disabled') : $this->l('Enabled'));
        $icon = ((int)$active == 0 ? 'icon-remove' : 'icon-check');
        $class = ((int)$active == 0 ? 'btn-danger' : 'btn-success');
        $html = '<a class="btn '.$class.'" href="'.AdminController::$currentIndex.
            '&configure='.$this->name.'
                &token='.Tools::getAdminTokenLite('AdminModules').'
                &changeStatus&id_deal='.(int)$id_deal.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$title.'</a>';

        return $html;
    }



    public function getAddFieldsValues()
    {
        $fields = array();

        if (Tools::isSubmit('id_deal') && $this->dealExist((int)Tools::getValue('id_deal')))
        {
            $deal = new Deal((int)Tools::getValue('id_deal'));
            $row = $this->getProductName($deal->id_product);
            $fields['id_deal'] = (int)Tools::getValue('id_deal', $deal->id);
            $fields['id_product'] = (int)Tools::getValue('id_product', $deal->id_product);
            $fields['product_name'] = $row['name'];
            $fields['deal_time'] = Tools::getValue('deal_time', $deal->deal_time);
        } else
            $deal = new Deal();
            $fields['active'] = Tools::getValue('active', $deal->active);
            $fields['deal_time'] = date("Y-m-d h:i:s");

        return $fields;

    }


    public function getProductName($id_product)
    {
        $id_shop = $this->context->shop->id;
        $id_lang = $this->context->language->id;
        $sql = 'SELECT pl.`name` FROM `'._DB_PREFIX_.'product_lang` pl WHERE id_product = '.$id_product.' AND id_shop = '.$id_shop.' AND id_lang = '.$id_lang;
        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
        return $row;
    }

     public function hookDisplayFooter($params) {
        $deals = $this->getDeals();
        $result = $this->getDealToShow();
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

        $products_for_template = [];

        foreach ($result as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $context->language
            );
        }

        $root_url = _PS_BASE_URL_.__PS_BASE_URI__;
        $this->smarty->assign(array(
            'products' => $products_for_template,
            'hotdeals' => $deals,
            'root_url' => $root_url,
            'items_num' => Configuration::get('GDZ_HOTDEAL_PRODUCT_SHOW'),
            'speed' => Configuration::get('GDZ_HOTDEAL_SPEED'),
            'auto' => Configuration::get('GDZ_HOTDEAL_AUTO_PLAY'),
            'navigation' => Configuration::get('GDZ_HOTDEAL_NAVIGATION'),
            'pagination' => Configuration::get('GDZ_HOTDEAL_PAGINATION'),
            'rewindNav' => Configuration::get('GDZ_HOTDEAL_REWINDNAV'),
            'scrollPerPage' => Configuration::get('GDZ_HOTDEAL_SCROLLPERPAGE'),
            'viewsAll' => Configuration::get('GDZ_HOTDEAL_VIEWALLPRODUCT'),

        ));
        return $this->display(__FILE__, 'deals.tpl');
    }


    public function hookDisplayHome($params) {
        return $this->hookDisplayFooter($params);
    }


    public function hookDisplayBotsl($params)
    {
        return $this->hookDisplayFooter($params);
    }




}
