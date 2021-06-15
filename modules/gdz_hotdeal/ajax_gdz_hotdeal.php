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

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('gdz_hotdeal.php');

$context = Context::getContext();
$deals = array();


if (Tools::getValue('action') == 'updateHotdealsOrdering' && Tools::getValue('slides'))
{
	$deals = Tools::getValue('slides');


	foreach ($deals as $position => $id_deal)
	{
		$res = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'gdz_hotdeal_items` SET `ordering` = '.(int)$position.'
			WHERE `id_deal` = '.(int)$id_deal
		);
	}

}
