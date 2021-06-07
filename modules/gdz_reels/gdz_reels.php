<?php

/*
 * ----------------------------------------------------------------------------
 * "THE BEER-WARE LICENSE" (Revision 42):
 * <jevin9@gmail.com> wrote this module. As long as you retain this notice you
 * can do whatever you want with this stuff. If we meet some day, and you think
 * this stuff is worth it, you can buy me a beer in return. Jevin O. Sewaruth.
 * ----------------------------------------------------------------------------
 */

if (!defined('_PS_VERSION_'))
	exit;
include_once(dirname(__FILE__).'/object/Reel.php');
include_once(dirname(__FILE__).'/lib/instagram.php');
class Gdz_reels extends Module
{
	public function __construct()
	{
		$this->name = 'gdz_reels';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Godzilla';
        $this->bootstrap = true;
        $this->secure_key = Tools::hash($this->name);

		parent::__construct();

		$this->displayName = $this->l('Godzilla Reels');
		$this->description = $this->l('Crea Reels #creativos e integralos en tu eCommerce.');

		$this->confirmUninstall = $this->l('Are you sure you want to uninstall this module?');

		// $this->_checkContent();

		$this->context->smarty->assign('module_name', $this->name);
		$this->db = Db::getInstance();
	}

	public function install()
	{
	    if (Shop::isFeatureActive()) {
	        Shop::setContext(Shop::CONTEXT_ALL);
	    }
		if (!parent::install() ||
			!$this->registerHook('displayHeader') ||
            !$this->registerHook('actionFrontControllerSetMedia') ||
			!$this->registerHook('displayHome') ||
			!$this->_createContent())
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall() ||
			!$this->_deleteContent())
			return false;
		return true;
	}

	public function hookDisplayHeader()
	{
		$this->context->controller->addCSS($this->_path.'view/css/style.css', 'all');
		$this->context->controller->addJS($this->_path.'view/js/script.js', 'all');
	}

	public function hookDisplayHome()
	{
        $reels = gdzReel::getList();
        $reels = array_slice($reels, 0, 1);
        foreach ($reels as $reel) {
            $video = $reel->getVideo();
            if (!$video['success']) {
                return $video['err'];
            }
            $reel->video = $video;
            $reel->getLookBook();
        }
        $id_lang = $this->context->language->id;
		$this->context->smarty->assign(array(
            'reels' => $reels,
            'id_lang' => $id_lang,
            'link' => $this->context->link,
		));

		return $this->display(__FILE__, 'left.tpl');
	}
    private function redirectAdmin($conf, $page, $param = '')
    {
        return Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules').'&conf='.$conf.'&configure='.$this->name.($page?"&page={$page}":'').$param);
    }
    public function saveReel()
    {
        $html = '';
        $idReel = Tools::getValue('id_reel', null);
        $reel = new gdzReel($idReel);
        $reel->name = Tools::getValue('name');
        $reel->url = Tools::getValue('url');
        $reel->video_width = (int)Tools::getValue('video_width');
        $video = $reel->getVideo();
        if ($video['success'] && $video['url']) {
            $reel->video_url = $video['url'];
        } else {
            $html .= $this->displayError($video['err']);
            return $html;
        }
        $reel->autoplay = (bool)Tools::getValue('autoplay');
        $reel->video_position = Tools::getValue('video_position');
        $reel->animate = Tools::getValue('animate');
        $reel->name = $reel->name?$reel->name:$this->l('New reel');
        try {
            $reel->save();
            $reel->getLookBook();
            if (!count($reel->lookbooks)) {
                $reel->addLookBooks();
            }
            $this->redirectAdmin(4, 'reelForm', '&id_reel='.$reel->id);
        } catch (Exception $e) {
            $html .= $this->displayError($e->getMessage());
        }
        return $html;
    }
	public function getContent()
	{
		$html = '';
        $this->context->controller->addCSS($this->_path.'views/css/admin.css', 'all');
        $this->context->controller->addJS($this->_path.'views/js/admin.js', 'all');
        $this->context->controller->addJqueryPlugin('chosen');
		$page = Tools::getValue('page', '');
		switch ($page) {
			case 'reelForm':
                $editMode = Tools::isSubmit('id_reel')?true:false;
				if (Tools::isSubmit('saveReel')) {
                    $html .= $this->saveReel();
				}
                if ($editMode) {
                    $reel = new gdzReel(Tools::getValue('id_reel'));
                    if (!Validate::isLoadedObject($reel)) {
                        $this->redirectAdmin(0, false);
                    }
                    $lookbook = $this->renderLookBookList($reel);
                } else {
                    $reel = new gdzReel();
                    $lookbook = '';
                }
                $html .= $this->renderReelForm($reel, $editMode);
                $html .= $lookbook;
				break;

			default:
				$html .= $this->renderReelList();
				break;
		}
		return $html;
	}

	private function _saveContent()
	{
		$message = '';

		if (Configuration::updateValue('MOD_gdz_reels_NAME', Tools::getValue('MOD_gdz_reels_NAME')) &&
			Configuration::updateValue('MOD_gdz_reels_COLOR', Tools::getValue('MOD_gdz_reels_COLOR')))
			$message = $this->displayConfirmation($this->l('Your settings have been saved'));
		else
			$message = $this->displayError($this->l('There was an error while saving your settings'));

		return $message;
	}

	private function _displayContent($message)
	{
		$this->context->smarty->assign(array(
			'message' => $message,
			'MOD_gdz_reels_NAME' => Configuration::get('MOD_gdz_reels_NAME'),
			'MOD_gdz_reels_COLOR' => Configuration::get('MOD_gdz_reels_COLOR'),
		));
	}

	private function _checkContent()
	{
		if (!Configuration::get('MOD_gdz_reels_NAME') &&
			!Configuration::get('MOD_gdz_reels_COLOR'))
			$this->warning = $this->l('You need to configure this module.');
	}

	private function _createContent()
	{
		$prefix = _DB_PREFIX_;
		$engine = _MYSQL_ENGINE_;
		$sql = array();
		$sql[] = "CREATE TABLE IF NOT EXISTS `{$prefix}gdz_reel` (
		`id_reel` INT NOT NULL AUTO_INCREMENT,
        `autoplay` BOOLEAN NOT NULL DEFAULT 0,
		`name`	VARCHAR(256) NOT NULL,
		`url`	VARCHAR(256) NOT NULL,
        `video_position`   VARCHAR(256) NOT NULL,
        `type`   VARCHAR(256) NOT NULL,
        `animate`   VARCHAR(256) NOT NULL,
        `video_width` INT NOT NULL,
		`id_shop` INT NOT NULL,
		PRIMARY KEY (`id_reel`)
		) ENGINE={$engine} DEFAULT CHARSET=utf8;";

		$sql[] = "CREATE TABLE IF NOT EXISTS `{$prefix}gdz_lookbook` (
		`id_lookbook` INT NOT NULL AUTO_INCREMENT,
		`id_reel` INT NOT NULL,
		PRIMARY KEY (`id_lookbook`)
		) ENGINE={$engine} DEFAULT CHARSET=utf8;";

		$sql[] = "CREATE TABLE IF NOT EXISTS `{$prefix}gdz_lookbook_product` (
		`id_lookbook` INT NOT NULL,
		`id_product` INT NOT NULL,
		`duration` INT NOT NULL DEFAULT 1,
		PRIMARY KEY (`id_lookbook`, `id_product`)
		) ENGINE={$engine} DEFAULT CHARSET=utf8;";
		try {
			foreach ($sql as $s) {
				$this->db->query($s);
			}
		} catch (Exception $e) {
			$this->_errors[] = $e->getMessage();
			return false;
		}
		return true;
	}

	private function _deleteContent()
	{
		$prefix = _DB_PREFIX_;
		$sql = array();
    	$sql[] = "DROP TABLE IF EXISTS `{$prefix}gdz_reel`";
    	$sql[] = "DROP TABLE IF EXISTS `{$prefix}gdz_lookbook`";
    	$sql[] = "DROP TABLE IF EXISTS `{$prefix}gdz_lookbook_product`";
		try {
			foreach ($sql as $s) {
				$this->db->query($s);
			}
		} catch (Exception $e) {
			$this->_errors[] = $e->getMessage();
			return false;
		}
		return true;

	}
    private function renderLookBookList($reel)
    {
        $products = gdzReel::getProductList();
        if (!isset($reel->lookbooks)) {
            $reel->getLookBook();
        }
        $this->smarty->assign(
            array(
                'reel' => $reel,
                'products' => $products,
                'id_lang' => $this->context->language->id,
                'secure_key' => $this->secure_key,
                'link' => $this->context->link,
            )
        );
        return $this->display(__FILE__, 'lookbooks.tpl');
    }
	private function renderReelList()
	{
		$list = gdzReel::getList();
		$this->smarty->assign(
			array(
				'list' => $list,
                'secure_key' => $this->secure_key,
				'link' => $this->context->link,
			)
		);
        return $this->display(__FILE__, 'reel-list.tpl');
	}
	private function renderReelForm($reel, $editMode = false)
	{
        $position = array(
            array(
                'id' => 'left',
                'title' => $this->l('Left'),
            ),
            array(
                'id' => 'right',
                'title' => $this->l('Right'),
            ),
        );
        $animate = array(
            array('id' => 'bounce'),
            array('id' => 'flash'),
            array('id' => 'pulse'),
            array('id' => 'rubberBand'),
            array('id' => 'shake'),
            array('id' => 'swing'),
            array('id' => 'tada'),
            array('id' => 'wobble'),
            array('id' => 'jello'),
            array('id' => 'bounceIn'),
            array('id' => 'bounceInDown'),
            array('id' => 'bounceInLeft'),
            array('id' => 'bounceInRight'),
            array('id' => 'bounceInUp'),
            array('id' => 'fadeIn'),
            array('id' => 'fadeInDown'),
            array('id' => 'fadeInDownBig'),
            array('id' => 'fadeInLeft'),
            array('id' => 'fadeInLeftBig'),
            array('id' => 'fadeInRight'),
            array('id' => 'fadeInRightBig'),
            array('id' => 'fadeInUp'),
            array('id' => 'fadeInUpBig'),
            array('id' => 'flip'),
            array('id' => 'flipInX'),
            array('id' => 'flipInY'),
            array('id' => 'lightSpeedIn'),
            array('id' => 'rotateIn'),
            array('id' => 'rotateInDownLeft'),
            array('id' => 'rotateInDownRight'),
            array('id' => 'rotateInUpLeft'),
            array('id' => 'rotateInUpRight'),
            array('id' => 'slideInUp'),
            array('id' => 'slideInDown'),
            array('id' => 'slideInLeft'),
            array('id' => 'slideInRight'),
            array('id' => 'zoomIn'),
            array('id' => 'zoomInDown'),
            array('id' => 'zoomInLeft'),
            array('id' => 'zoomInRight'),
            array('id' => 'zoomInUp'),
            array('id' => 'hinge'),
            array('id' => 'jackInTheBox'),
            array('id' => 'rollIn'),
        );
        $fields_form = array(
        	'form' => array(
				'legend' => array(
					'title' => $editMode?$this->l('Edit reel'):$this->l('Add Reel'),
				),
				'input' => array(
					array(
						'type' => 'text',
                        'label' => $this->l('Name'),
						'name' => 'name',
						'placeholder' => $this->l('New reel'),
						'class' => 'fixed-width-xl',
					),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Video url'),
                        'desc' => $this->l('support : Instagram video, Youtube, Vimeo, Facebook'),
                        'name' => 'url',
                        'required' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Video width'),
                        'name' => 'video_width',
                        'class' => 'fixed-width-xl',
                        'string_format' => '%d',
                        'suffix' => '%',
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Auto play'),
                        'name' => 'autoplay',
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
                    array(
                        'type' => 'select',
                        'label' => $this->l('Video position'),
                        'name' => 'video_position',
                        'options' => array(
                            'query' => $position,
                            'id' => 'id',
                            'name' => 'title'
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Animate'),
                        'name' => 'animate',
                        'options' => array(
                            'query' => $animate,
                            'id' => 'id',
                            'name' => 'id'
                        ),
                    ),
				),
				'submit' => array(
					'title' => $this->l('Save'),
					'class' => 'btn btn-default pull-right'
				),
        	)
		);
        $fields_form['form']['buttons'][] = array(
            'href' => $this->context->link->getAdminLink('AdminModules').'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name,
            'title' => 'Back',
            'icon' => 'process-icon-back'
        );
		if ($editMode) {
			array_unshift($fields_form['form']['input'],
				array(
					'type' => 'text',
                    'label' => $this->l('Id reel'),
					'name' => 'id_reel',
					'disabled' => true,
					'class' => 'fixed-width-xl',
				)
			);
		}
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG')?Configuration::get('PS_BO_ALLOW_EMPLYEE_FORM_LANG'):0;
        $helper->module = $this;
        $helper->submit_action = 'saveReel';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $params = '&page=reelForm';
        if ($editMode) {
            $params .= '&id_reel='.Tools::getValue('id_reel');
        }
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules').'&configure='.$this->name.$params;
        $base_url = $this->getBaseUrl();
        $helper->tpl_vars = array(
        	'fields_value' => $this->getFieldsConfig($reel),
        	'language' => array(
        		'id_lang' => $lang->id,
        		'iso_code' => $lang->iso_code
        	),
        );
        return $helper->generateForm(array($fields_form));
	}
    private function getFieldsConfig($reel)
    {
        $fields = array(
            'id_reel' => Tools::getValue('id_reel', $reel->id),
            'name' => Tools::getValue('name', $reel->name),
            'url' => Tools::getValue('url', $reel->url),
            'video_width' => Tools::getValue('video_width', $reel->video_width),
            'autoplay' => (bool)Tools::getValue('autoplay', $reel->autoplay),
            'video_position' => Tools::getValue('video_position', $reel->video_position),
            'animate' => Tools::getValue('animate', $reel->animate),
        );
        return $fields;
    }
    public function hookActionFrontControllerSetMedia($params)
    {
        $this->context->controller->registerStylesheet(
            'style',
            'modules/'.$this->name.'/views/css/style.css'
        );
        $this->context->controller->registerJavascript(
            'script',
            'modules/'.$this->name.'/views/js/script.js'
        );
    }
    public function getBaseUrl()
    {
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
        if (isset($force_ssl) && $force_ssl) {
            $base_url = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            $base_url = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        return $base_url;
    }
}

?>
