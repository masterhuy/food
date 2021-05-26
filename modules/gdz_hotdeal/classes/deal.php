<?php
/**
* 2007-2016 PrestaShop
*
* Godzilla HotDeal
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2016 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

/**
*
*/
class Deal extends ObjectModel
{

	public $id_product;
	public $deal_time;
	public $ordering;
	public $active;

	public static $definition = array(
			'table' 	=> 'gdz_hotdeal_items',
			'primary'   => 'id_deal',
			'fields' => array(
				 'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt'),
				 'deal_time' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat', 'copy_post' => false),
				 'active'   =>	array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
				 'ordering' =>	array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true)
			)
		);

	function __construct($id_deal = null, $id_lang = null, $id_shop = null)
	{
		parent::__construct($id_deal, $id_lang, $id_shop);
	}


	public function add($autodate = true, $null_values = false)
	{
		$res = true;
		$context = Context::getContext();
		$id_shop = $context->shop->id;
		$res = parent::add($autodate, $null_values);
		$res &= Db::getInstance()->execute('
			INSERT INTO `'._DB_PREFIX_.'gdz_hotdeal` (`id_deal`,`id_shop` )
			VALUES('.(int)$this->id.','.(int)$id_shop.')'
		);
		return $res;
	}


	public function delete()
	{
		$res = true;
		$res &= $this->reOrderPositions();
		$res &= Db::getInstance()->execute('
			DELETE FROM `'._DB_PREFIX_.'gdz_hotdeal`
			WHERE `id_deal` = '.(int)$this->id
		);
		$res &= parent::delete();
		return $res;
	}

	public function reOrderPositions()
	{
		$id_deal = $this->id;
		$context = Context::getContext();
		$id_shop = $context->shop->id;

		$max = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT MAX(hss.`ordering`) as ordering
			FROM `'._DB_PREFIX_.'gdz_hotdeal_items` hss, `'._DB_PREFIX_.'gdz_hotdeal` hs
			WHERE hss.`id_deal` = hs.`id_deal` AND hs.`id_shop` = '.(int)$id_shop
		);
		if ((int)$max == (int)$id_deal)
			return true;
		$rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT hss.`ordering` as ordering, hss.`id_deal` as id_deal
			FROM `'._DB_PREFIX_.'gdz_hotdeal_items` hss
			LEFT JOIN `'._DB_PREFIX_.'gdz_hotdeal` hs ON (hss.`id_deal` = hs.`id_deal`)
			WHERE hs.`id_shop` = '.(int)$id_shop.' AND hss.`ordering` > '.(int)$this->ordering
		);
		foreach ($rows as $row)
		{
			$current_slide = new Deal($row['id_deal']);
			--$current_slide->ordering;
			$current_slide->update();
			unset($current_slide);
		}
		return true;
	}



}
