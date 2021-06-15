<?php

if (!defined('_PS_VERSION_'))
	exit;

class gdz_reelsDetailsModuleFrontController extends ModuleFrontController
{
	public function initContent()
	{
		parent::initContent();

		$this->context->smarty->assign(array(
			'gdz_reels_name' => Configuration::get('MOD_gdz_reels_NAME'),
			'gdz_reels_color' => Configuration::get('MOD_gdz_reels_COLOR'),
		));

		$this->setTemplate('details.tpl');
	}
}

?>
