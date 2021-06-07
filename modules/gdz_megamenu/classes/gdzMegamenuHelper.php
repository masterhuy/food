<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla MegaMenu
*
*  @author    Godzilla<joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/
include_once(_PS_MODULE_DIR_.'gdz_blog/gdz_blog.php');
include_once(_PS_MODULE_DIR_.'gdz_blog/classes/gdzblogHelper.php');
class gdzMegamenuHelper
{
    public $treearr = array();
    public $menu = '';
    public $children = array();
    public $_items = array();
    public $gens = array();
    public function tree($parent, $ident, $tree, $current_id = 0)
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $sql = 'SELECT a.*,b.`name` FROM '._DB_PREFIX_.'gdz_megamenu_items AS a ';
        $sql .= 'INNER JOIN '._DB_PREFIX_.'gdz_megamenu_items_lang AS b ON a.`mitem_id` = b.`mitem_id` ';
        $sql .= 'WHERE a.`parent_id` ='.(int)$parent.' AND b.`id_lang` ='.$id_lang;
        if ($current_id != 0) {
            $sql .= ' AND a.`mitem_id` != '.$current_id;
        }
        $sql .= ' ORDER BY `ordering`';
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        foreach ($rows as $v) {
            $v['name'] = $ident.'.&nbsp;&nbsp;<sup>L</sup>&nbsp;'.$v['name'];
            $v['name'] = str_replace('.&nbsp;&nbsp;<sup>L</sup>&nbsp;', '.&nbsp;&nbsp;&nbsp;&nbsp;', $v['name']);
            $x = strrpos($v['name'], '.&nbsp;&nbsp;&nbsp;&nbsp;');
            $v['name'] = substr_replace($v['name'], '.&nbsp;&nbsp;<sup>L</sup>&nbsp;', $x, 7);
            $this->treearr[] = $v;
            $this->tree($v['mitem_id'], $ident.'.&nbsp;&nbsp;<sup>L</sup>&nbsp;', $tree, $current_id);
        }
    }
    public function getListTree($menus)
    {
        $tree = array();
        foreach ($menus as $v) {
            $ident = '';
            $this->treearr[] = $v;
            $this->delptree($v['mitem_id'], $ident, $tree);
        }
        $tree = array_slice($this->treearr, 0);
        return $tree;
    }
    public function delptree($parent, $level, $tree, $status = '')
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $sql = 'SELECT a.*,b.`name`,b.`menulink` FROM '._DB_PREFIX_.'gdz_megamenu_items AS a ';
        $sql .= 'INNER JOIN '._DB_PREFIX_.'gdz_megamenu_items_lang AS b ON a.`mitem_id` = b.`mitem_id` ';
        $sql .= 'WHERE a.`parent_id` ='.$parent.' AND b.`id_lang` ='.$id_lang;
        if ($status != '') {
            $sql .= ' AND a.`active` = '.$status;
        }
        $sql .= ' ORDER BY `ordering`';
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        foreach ($rows as $v) {
            $v['level'] = $level + 1;
            $this->treearr[] = $v;
            $this->delptree($v['mitem_id'], $level + 1, $tree, $status);
        }
    }
    public function getMenuTree($menus, $status = '')
    {
        $tree = array();
        foreach ($menus as $v) {
            $level = 0;
            $v['level'] = 0;
            $this->treearr[] = $v;
            $this->delptree($v['mitem_id'], $level, $tree, $status);
        }
        $tree = array_slice($this->treearr, 0);
        return $tree;
    }
    public function getMenus()
    {
        $context = Context::getContext();
        $id_shop = $context->shop->id;
        $id_lang = $context->language->id;

        $sql = 'SELECT menu_id,name
            FROM '._DB_PREFIX_.'gdz_megamenu AS m WHERE `id_shop` = '.$id_shop;
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        return $rows;
    }
    public function getSelectedMenu($menu_id = 0)
    {
        $context = Context::getContext();
        $id_shop = $context->shop->id;
        $id_lang = $context->language->id;
        //echo $menu_id; exit;
        if((int)$menu_id == 0) {
            $sql = 'SELECT *
                FROM '._DB_PREFIX_.'gdz_megamenu AS m WHERE `id_shop` = '.$id_shop.' ORDER BY menu_id DESC';
        } else {
            $sql = 'SELECT *
              FROM '._DB_PREFIX_.'gdz_megamenu AS m WHERE `id_shop` = '.$id_shop.' AND `menu_id` = '.$menu_id.' ORDER BY menu_id DESC';
        }
        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
        return $row;
    }
    public function getParentList($menu_id, $mitem_id = 0)
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $sql = 'SELECT *';
        $sql .= '   FROM '._DB_PREFIX_.'gdz_megamenu_items AS a';
        $sql .= '   INNER JOIN '._DB_PREFIX_.'gdz_megamenu_items_lang AS b ';
        $sql .= '   ON a.mitem_id = b.mitem_id  ';
        $sql .= '   WHERE parent_id = 0 AND a.mitem_id != '.$mitem_id.' AND (a.menu_id = '.(int)$menu_id.')';
        $sql .= '   AND b.id_lang = '.(int)$id_lang;
        $sql .= ' ORDER BY a.ordering';
        //echo $sql; exit;
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        $tree = array();
        $this->treearr[] = array('mitem_id' => 0, 'name' => '--SELECT PARENT--');
        foreach ($rows as $v) {
            $ident = '';
            $this->treearr[] = $v;
            $this->tree($v['mitem_id'], $ident, $tree, $mitem_id);
        }
        $tree = array_slice($this->treearr, 0);
        return $tree;
    }
    public static function orderUpIcon($i = null, $condition = true, $link = null)
    {
        if ($condition) {
            $html = '<a title = "Move Up" onclick = "changeOrder(\'cb'.$i.'\',\'orderup\',\''.$link.'\')" class = "jgrid"><span class = "state uparrow"></span></a>';
        } else {
            $html = '&#160;';
        }
        return $html;
    }
    public static function orderDownIcon($i = null, $condition = true, $link = null)
    {
        if ($condition) {
            $html = '<a title = "Move Down" onclick = "changeOrder(\'cb'.$i.'\',\'orderdown\',\''.$link.'\')" class = "jgrid"><span class = "state downarrow"></span></a>';
        } else {
            $html = '&#160;';
        }
        return $html;
    }

    public static function reorder($mitem_id, $direction)
    {
        $sql = 'SELECT ordering FROM '._DB_PREFIX_.'gdz_megamenu ';
        $sql .= 'WHERE mitem_id =  $mitem_id ORDER BY ordering ASC ';
        $ordering = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);

        $sql = 'UPDATE '._DB_PREFIX_.'gdz_megamenu ';
        if ($direction == 'orderdown') {
            $new_ordering = $ordering + 1;

        } else {
            if ($ordering >= 1) {
                $new_ordering = $ordering - 1;
            } else {
                $new_ordering = 0;
            }
        }

        $sql .= ' SET ordering = '.$new_ordering;
        $sql .= ' WHERE mitem_id = '.$mitem_id;

        $res = Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
        return $res;
    }

    public function getCMSPages()
    {
        $id_shop = (int)Context::getContext()->shop->id;
        $id_lang = (int)Context::getContext()->language->id;

        $sql = 'SELECT c.`id_cms`, cl.`meta_title`, cl.`link_rewrite`
            FROM `'._DB_PREFIX_.'cms` c
            INNER JOIN `'._DB_PREFIX_.'cms_shop` cs
            ON (c.`id_cms` = cs.`id_cms`)
            INNER JOIN `'._DB_PREFIX_.'cms_lang` cl
            ON (c.`id_cms` = cl.`id_cms`)
            WHERE cs.`id_shop` = '.(int)$id_shop.'
            AND cl.`id_lang` = '.(int)$id_lang.'
            AND c.`active` = 1
            ORDER BY `position`';

        return Db::getInstance()->executeS($sql);
    }
    public function getModules()
    {
        $this->context = Context::getContext();
        $id_shop = $this->context->shop->id;

        return Db::getInstance()->ExecuteS('
        SELECT m.*
        FROM `'._DB_PREFIX_.'module` m
        JOIN `'._DB_PREFIX_.'module_shop` ms ON (m.`id_module` = ms.`id_module` AND ms.`id_shop` = '.(int)($id_shop).')
        ');
    }
    public function getManufacturers()
    {
        $id_lang = (int)Context::getContext()->language->id;
        $manufacturers = Manufacturer::getManufacturers(false, $id_lang);
        return $manufacturers;
    }
    public function getSuppliers()
    {
        $id_lang = (int)Context::getContext()->language->id;
        $suppliers = Supplier::getSuppliers(false, $id_lang);
        return $suppliers;
    }
    public static function checkModuleCallable($id_module)
    {
        if (!($moduleInstance = Module::getInstanceByID($id_module))) {
            return false;
        }
        $hooks = array();
        $hookAssign = array('rightcolumn','leftcolumn','home','top','footer');
        foreach ($hookAssign as $hook) {
            $retro_hook_name = Hook::getRetroHookName($hook);
            if (is_callable(array($moduleInstance, 'hook'.$hook)) || is_callable(array($moduleInstance, 'hook'.$retro_hook_name))) {
                $hooks[] = $retro_hook_name;
            }
        }
        $results = self::getHookByArrName($hooks);
        return $results;

    }
    public static function getHookByArrName($arrName)
    {
        $result = Db::getInstance()->ExecuteS('
        SELECT `id_hook`, `name`
        FROM `'._DB_PREFIX_.'hook`
        WHERE `name` IN (\''.implode("','", $arrName).'\')');
        return $result;
    }

    public function getGdzBlogPost()
    {
        $id_lang = (int)Context::getContext()->language->id;

        $sql = 'SELECT pl.`title`, p.`post_id`
            FROM `'._DB_PREFIX_.'gdz_blog_posts` p
            INNER JOIN `'._DB_PREFIX_.'gdz_blog_posts_lang` pl
            ON (p.`post_id` = pl.`post_id`)
            WHERE pl.`id_lang` = '.(int)$id_lang.'
            AND p.`active` = 1
            ORDER BY p.`post_id` DESC';
        return Db::getInstance()->executeS($sql);
    }
    public function getGdzBlogCategory()
    {
        $id_lang = (int)Context::getContext()->language->id;

        $sql = 'SELECT cl.`title`, c.`category_id`
            FROM `'._DB_PREFIX_.'gdz_blog_categories` c
            INNER JOIN `'._DB_PREFIX_.'gdz_blog_categories_lang` cl
            ON (c.`category_id` = cl.`category_id`)
            WHERE cl.`id_lang` = '.(int)$id_lang.'
            AND c.`active` = 1
            ORDER BY c.`category_id` DESC';
        return Db::getInstance()->executeS($sql);
    }
    public function getGdzPagebuilderPage()
    {
        $id_lang = (int)Context::getContext()->language->id;
        $id_shop = (int)Context::getContext()->shop->id;
        $query = "SELECT pbpl.title, pbp.id_page
                  FROM "._DB_PREFIX_."gdz_pagebuilder_pages pbp
                  INNER JOIN "._DB_PREFIX_."gdz_pagebuilder_pages_lang pbpl ON pbp.id_page = pbpl.id_page
                  INNER JOIN "._DB_PREFIX_."gdz_pagebuilder pb ON pbp.id_page = pb.id_page
                  WHERE pbpl.id_lang = '".$id_lang."' AND pb.id_shop = '".$id_shop."' AND pbp.active = 1
                  ORDER BY pbp.ordering" ;
        return Db::getInstance()->executeS($query);
    }
    public static function getUrl()
    {
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';

        if (isset($force_ssl) && $force_ssl) {
            return $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            return _PS_BASE_URL_.__PS_BASE_URI__;
        }
    }
    public function returnMenu($menu_id) {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $sql = 'SELECT *
                FROM '._DB_PREFIX_.'gdz_megamenu_items AS a
                INNER JOIN '._DB_PREFIX_.'gdz_megamenu_items_lang AS b
                ON a.`mitem_id` = b.`mitem_id`
                WHERE a.`active` = 1 AND `parent_id` = 0 AND (a.`menu_id` = '.(int)$menu_id.')
                AND b.`id_lang` = '.(int)$id_lang.
                ' ORDER BY a.`ordering`';
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        $items = $this->getMenuTree($rows, '1');
        foreach ($items as &$item) {
          switch ($item['type'])
          {
              case 'product':
                  $product = new Product((int)$item['value'], true, (int)$id_lang);
                  $item['link'] = $product->getLink();
                  break;
              case 'category':
                  $category = new Category((int)$item['value'], (int)$id_lang);
                  $item['link'] = $category->getLink();

                  break;
              case 'link':
                  $item['link'] = $item['menulink'];
                  break;
              case 'cms':
                  $id_cms = $item['value'];
                  $cms = CMS::getLinks((int)$id_lang, array($id_cms));
                  if(isset($cms[0]['link']))
                    $item['link'] = $cms[0]['link'];
                  else
                    $item['link'] = '#';
                  break;
              case 'manufacturer':
                  $manufacturer = new Manufacturer((int)$item['value'], (int)$id_lang);
                  if (!is_null($manufacturer->id)) {
                      if ((int)Configuration::get('PS_REWRITING_SETTINGS')) {
                          $manufacturer->link_rewrite = Tools::link_rewrite($manufacturer->name, false);
                      } else {
                          $manufacturer->link_rewrite = 0;
                      }
                      $link = new Link;
                      $item['link'] = $link->getManufacturerLink((int)$item['value'], $manufacturer->link_rewrite);
                  }
                  break;
              case 'supplier':
                  $supplier = new Supplier((int)$item['value'], (int)$id_lang);
                  if (!is_null($supplier->id)) {
                      $link = new Link;
                      $item['link'] = $link->getSupplierLink((int)$item['value'], $supplier->link_rewrite);
                  }
                  break;
              case 'module':
                  $item['link'] = '';
                  $_arr = explode('-', $item['value']);
                  $item['content'] = $this->MNexec($_arr[0], array(), $_arr[1]);
                  break;
              case 'seperator':
                  $item['link'] = '#';
                  break;
              case 'html':
                  $item['link'] = '';
                  $item['content'] = $item['html_content'];
                  break;
              case 'gdz_blog-latest':
                  $_link = gdz_blog::getPageLink('gdz_blog-latest', array());
                  $item['link'] = $_link;
                  break;
              case 'gdz_blog-categories':
                  $_link = gdz_blog::getPageLink('gdz_blog-categories', array());
                  $item['link'] = $_link;
                  break;
              case 'gdz_blog-singlepost':
                  $_post = gdz_blogHelper::getPostByID($item['value']);
                  $_category = gdz_blogHelper::getCategory($_post['category_id']);
                  $_link = gdz_blog::getPageLink('gdz_blog-post', array('post_id' => $item['value'], 'category_slug' => $_category['alias'], 'slug' => $_post['alias']));
                  $item['link'] = $_link;
                  break;
              case 'gdz_blog-category':
                  $_category = gdz_blogHelper::getCategory($item['value']);
                  $_link = gdz_blog::getPageLink('gdz_blog-category', array('category_id' => $item['value'], 'slug' => $_category['alias']));
                  $item['link'] = $_link;
                  break;
              case 'gdz_blog-tag':
                  $_link = gdz_blog::getPageLink('gdz_blog-tag', array('tag' => $item['value']));
                  $item['link'] = $_link;
                  break;
              case 'gdz_blog-archive':
                  $_link = gdz_blog::getPageLink('gdz_blog-archive', array('archive' => $item['value']));
                  $item['link'] = $_link;
                  break;
              case 'godzilla-page':
                  include_once(_PS_MODULE_DIR_.'gdz_pagebuilder/gdz_pagebuilder.php');
                  $_page = GdzPageBuilderHelper::getPage($item['value']);
                  $_link = gdz_pagebuilder::getPageLink('gdz_pagebuilder-page', array('id_page' => $_page['id_page'], 'slug' => $_page['alias']));
                  $item['link'] = $_link;
                  break;
              case 'theme-logo':
                  $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
                  $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://': 'http://';

                  if (isset($force_ssl) && $force_ssl) {
                      $item['link'] = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
                  } else {
                      $item['link'] = _PS_BASE_URL_.__PS_BASE_URI__;
                  }
                break;
              }
            $parent = isset($this->children[$item['parent_id']]) ? $this->children[$item['parent_id']] : array();
            $parent[] = $item;
            $this->children[$item['parent_id']] = $parent;

            $this->_items[$item['mitem_id']] = $item;
        }

      foreach ($items as &$item) {
          $item['dropdown'] = 0;
          if ((isset($this->children[$item['mitem_id']]))) {
              $item['dropdown'] = 1;
          }
          $item['title'] = htmlspecialchars($item['name'], ENT_COMPAT, 'UTF-8', false);
          $this->_items[(int)$item['mitem_id']] = $item;
      }
      $this->menu = '';
      $this->beginmenu();
      $this->nav($menu_id);
      $this->endmenu();
      return $this->menu;
    }
    public function beginmenu()
    {
        $this->menu .= '<div class="gdz-megamenu navbar"><ul class="nav level0">';
    }

    public function endmenu()
    {
        $this->menu .= '</ul></div>';
    }

    public function nav($menu_id)
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $sql = 'SELECT a.`mitem_id`
                FROM '._DB_PREFIX_.'gdz_megamenu_items AS a
                INNER JOIN '._DB_PREFIX_.'gdz_megamenu_items_lang AS b
                ON a.`mitem_id` = b.`mitem_id`
                WHERE a.`active` = 1 AND `parent_id` = 0 AND (a.`menu_id` = '.(int)$menu_id.')
                AND b.`id_lang` = '.(int)$id_lang.
                ' ORDER BY a.`ordering`';
        $items = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        foreach ($items as $item) {
            $this->genItem($item['mitem_id']);
        }
    }

    public function genItem($itemid)
    {
        $item = $this->_items[$itemid];
        $this->context = Context::getContext();
        $lvl     = $this->_items[$itemid]['level'];
        $params = isset($item['params']) ? $item['params'] : array();
        if ($params) {
            $setting = (array)Tools::jsonDecode($params);
        }
        if (!in_array($itemid, $this->gens)) {
            $class = 'class="menu-item';
            $data = ' data-id="'.$itemid.'" data-level="'.$lvl.'"';
            if (isset($this->children[$itemid])) {
                $class .= ' mega';
            }
            if (isset($setting['group'])) {
                $class .= ' group';
                $data .= ' data-group="'.$setting['group'].'"';
            }
			      if (isset($setting['sub']->fullwidth) && ((int)$setting['sub']->fullwidth==1)) {
                $class .= ' item-fullwidth';
                $data .= ' data-fullwidth="1"';
            }
            if (isset($setting['title']) && ((int)$setting['title']==0)) {
                $data .= ' data-title="0"';
            } else {
                $data .= ' data-title="1"';
            }
            if (isset($setting['class'])) {
                $class .= ' '.$setting['class'];
                $data .= ' data-class="'.$setting['class'].'"';
            }
            if (isset($setting['align'])) {
                $class .= ' menu-align-'.$setting['align'];
                $data .= ' data-align="'.$setting['align'].'"';
            }
            if (isset($setting['icon'])) {
                $data .= ' data-icon="'.$setting['icon'].'"';
            }
            $this->menu .= '<li '.$class.'"'.$data.'>';
            if($item['type'] == 'theme-logo') {
                $logo = $this->context->link->getMediaLink(_PS_IMG_.Configuration::get('PS_LOGO'));
                $this->menu .= '<a href="'.$item['link'].'" target="'.$item['target'].'" title="'.Configuration::get('PS_SHOP_NAME').'">';
                $this->menu .= '<img class="logo img-responsive" src="'.$logo.'" alt="'.Configuration::get('PS_SHOP_NAME').'" />';
                $this->menu .='</a>';
            }
            if ((!isset($setting['title']) || ((int)$setting['title']==1)) && $item['type'] != 'theme-logo') {
                $this->menu .= '<a href="'.(isset($item['link']) ? $item['link'] :'').'" target="'.$item['target'].'">';
                if (isset($setting['icon'])) {
                    $this->menu .= '<i class="'.$setting['icon'].'"></i>';
                }
                $this->menu .=  "<span>".$item['name']."</span>";
                if (($item['level'] == 0) && isset($this->children[$itemid])) {
                    $this->menu .= '<em class="caret"></em>';
                }
                $this->menu .= '</a>';
            }

            if ($item['type'] == 'module' || $item['type'] == 'html') {
                $this->menu .= '<div class="mod-content">'.$item['content'].'</div>';
            }
            if (isset($this->children[$itemid])) {
                $this->beginDropdown($itemid);
                $this->mega($itemid);
                $this->endDropdown();
            }
            $this->menu .= '</li>';
        }
        $this->gens[] = $itemid;
    }
    public function beginDropdown($itemid)
    {
        $params = isset($this->_items[$itemid]['params']) ? $this->_items[$itemid]['params'] : array();
        if ($params) {
            $params_arr = (array)Tools::jsonDecode($params);
            if (isset($params_arr['sub'])) {
                $setting = $params_arr['sub'];
            }
        }
        $extra_class = '';
        $extra_data = '';
        $extra_style = '';
        if (isset($setting->class) && $setting->class) {
            $extra_class .= ' '.$setting->class;
            $extra_data .= ' data-class="'.$setting->class.'"';
        }
        if (isset($setting->fullwidth) && (int)$setting->fullwidth) {
            $extra_class .= ' fullwidth';
            $extra_data .= ' data-fullwidth="1"';
        }
        if (isset($setting->width) && (int)$setting->width) {
            $extra_style = ' style="width:'.$setting->width.'px"';
            $extra_data .= ' data-width="'.$setting->width.'"';
        }
        $this->menu .= '<div class="nav-child dropdown-menu mega-dropdown-menu'.$extra_class.'"'.$extra_data.$extra_style.'><div class="mega-dropdown-inner">';
    }
    public function endDropdown()
    {
        $this->menu .= '</div></div>';
    }
    public function beginRow()
    {
        $this->menu .= '<div class="row">';
    }
    public function endRow()
    {
        $this->menu .= '</div>';
    }

    public function mega($itemid)
    {

        $item = $this->_items[$itemid];
        $params = isset($item['params']) ? $item['params'] : array();
        $setting = (array)Tools::jsonDecode($params);
        if (isset($setting['sub'])) {
            $rows = $setting['sub']->row;
            $i = 0;
            foreach ($rows as $row) {
                $row_show = 0;
                foreach ($row as $col) {
                    $col_show = 0;
                    foreach ($col->items as $_item) {
                        if (isset($this->_items[$_item->item]['parent_id']) && (int)$this->_items[$_item->item]['parent_id'] == $itemid) {
                            $col_show++;
                        }
                    }
                    $col->col_show = $col_show;
                    $row_show += $col_show;
                }
                $rows[$i]['row_show'] = $row_show;
                $i++;
            }
            foreach ($rows as $row) {
                if ((int)$row['row_show'] == 0) {
                    continue;
                }
                $this->beginRow();
                foreach ($row as $col) {
                    $width = isset($col->width) ? $col->width : 12;
                    $col_class = isset($col->class) ? $col->class : '';
                    if (!isset($col->col_show) || (((int)$col->col_show) == 0)) {
                        continue;
                    }
                    $this->beginCol($width, $col_class);
                    foreach ($col->items as $_item) {
                        if (isset($this->_items[$_item->item]['parent_id']) && (int)$this->_items[$_item->item]['parent_id'] == $itemid) {
                            $this->genItem($_item->item);
                        }
                    }
                    $this->endCol();
                }
                $this->endRow();
            }
        }
        $items = isset($this->children[$itemid]) ? $this->children[$itemid] : array();
        $rest_itemids = array();
        foreach ($items as $_item) {
            if (!in_array($_item['mitem_id'], $this->gens)) {
                $rest_itemids[] = $_item['mitem_id'];
            }
        }
        if (count($rest_itemids) > 0) {
            $this->beginRow();
            $this->beginCol(12);
            foreach ($rest_itemids as $_itemid) {
                $this->genItem($_itemid);
            }
            $this->endCol();
            $this->endRow();
        }
    }

    public function beginCol($width = 12, $class = '')
    {
        $exclass = '';
        $data = ' data-width="'.$width.'"';
        if ($class) {
            $exclass .= ' '.$class;
            $data .= ' data-class="'.$class.'"';
        }
        $this->menu .= '<div class="mega-col-nav col-sm-'.$width.$exclass.'"'.$data.'><div class="mega-inner"><ul class="mega-nav">';
    }

    public function endCol()
    {
        $this->menu .= '</ul>';
        $this->menu .= '</div></div>';
    }
}
