<?php
/**
* 2007-2014 PrestaShop
*
* Jms Brand logos
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2014 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('gdz_flashsale.php');

$context = Context::getContext();
$slides = array();
if (Tools::getValue('action') == 'updateItemsOrdering' && Tools::getValue('slides'))
{
	$slides = Tools::getValue('slides');

	foreach ($slides as $position => $id_slide)
	{
		$res = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'gdz_flashsale_items` SET `ordering` = '.(int)$position.'
			WHERE `item_id` = '.(int)$id_slide
		);
	}
}
