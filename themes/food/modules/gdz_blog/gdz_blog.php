<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Blog
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class gdz_blog extends Module
{
    public function __construct()
    {
        $this->name = 'gdz_blog';
        $this->tab = 'front_office_features';
        $this->version = '4.0.0';
        $this->controllers = array('latest', 'categories', 'category', 'post', 'tag', 'archive');
        $this->author = 'Godzilla';
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Godzilla Blog');
        $this->description = $this->l('Advanced Blog Module For Prestashop.');
        $this->gens = array();
    }

    public function install()
    {
        $res = true;
        if (parent::install() && $this->registerHook('moduleRoutes')) {
            $res &= Configuration::updateValue('GDZBLOG_PAGE_SIDEBAR', 'left');
            $res &= Configuration::updateValue('GDZBLOG_INTROTEXT_LIMIT', 300);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_CATEGORY', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_VIEWS', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_COMMENTS', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_MEDIA', 1);
            $res &= Configuration::updateValue('GDZBLOG_IMAGE_WIDTH', 1000);
            $res &= Configuration::updateValue('GDZBLOG_IMAGE_HEIGHT', 1000);
            $res &= Configuration::updateValue('GDZBLOG_IMAGE_THUMB_WIDTH', 300);
            $res &= Configuration::updateValue('GDZBLOG_IMAGE_THUMB_HEIGHT', 300);
            $res &= Configuration::updateValue('GDZBLOG_COMMENT_ENABLE', 1);
            $res &= Configuration::updateValue('GDZBLOG_FACEBOOK_COMMENT', 0);
            $res &= Configuration::updateValue('GDZBLOG_ALLOW_GUEST_COMMENT', 1);
            $res &= Configuration::updateValue('GDZBLOG_COMMENT_DELAY', 120);
            $res &= Configuration::updateValue('GDZBLOG_AUTO_APPROVE_COMMENT', 0);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_SOCIAL_SHARING', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_FACEBOOK', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_TWITTER', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_GOOGLEPLUS', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_LINKEDIN', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_PINTEREST', 1);
            $res &= Configuration::updateValue('GDZBLOG_SHOW_EMAIL', 1);
      			$res &= Configuration::updateValue('GBW_SB_ITEM_SHOW', 6);
      			$res &= Configuration::updateValue('GBW_SB_SHOW_POPULAR', 1);
      			$res &= Configuration::updateValue('GBW_SB_SHOW_RECENT', 1);
      			$res &= Configuration::updateValue('GBW_SB_SHOW_LATESTCOMMENT', 1);
      			$res &= Configuration::updateValue('GBW_SB_COMMENT_LIMIT', 50);
      			$res &= Configuration::updateValue('GBW_SB_SHOW_CATEGORYMENU', 1);
      			$res &= Configuration::updateValue('GBW_SB_SHOW_ARCHIVES', 1);

            $tab_parent_id = (int)Tab::getIdFromClassName('GODZILLA');
            if($tab_parent_id <= 0) {
                $tab = new Tab();
                $tab->id_parent = 0;
                $tab->active = 1;
                $tab->class_name = "GODZILLA";
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'GODZILLA';
                }
                if(!$tab->add()) return false;
            }
            if(((int)Tab::getIdFromClassName('GODZILLA') > 0) && ((int)Tab::getIdFromClassName('AdminGdzblogDashboard') <= 0)) {
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzblogDashboard";
                $tab->position = 2;
                $tab->icon = 'comment';
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Godzilla Blog';
                }
                $tab->id_parent = (int)Tab::getIdFromClassName('GODZILLA');
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                $tab_parent_id = (int)Tab::getIdFromClassName('AdminGdzblogDashboard');
                //add post menu
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzblogPost";
                $tab->position = 0;
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Posts';
                }
                $tab->id_parent = $tab_parent_id;
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                //add categories menu
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzblogCategories";
                $tab->position = 1;
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Categories';
                }
                $tab->id_parent = $tab_parent_id;
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                //add categories menu
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzblogComment";
                $tab->position = 2;
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Comments';
                }
                $tab->id_parent = $tab_parent_id;
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                //add setting menu
                $tab = new Tab();
                $tab->active = 1;
                $tab->class_name = "AdminGdzblogSetting";
                $tab->position = 3;
                $tab->name = array();
                foreach (Language::getLanguages(true) as $lang) {
                    $tab->name[$lang['id_lang']] = 'Setting';
                }
                $tab->id_parent = $tab_parent_id;
                $tab->module = $this->name;
                if(!$tab->add()) return false;
                $this->addMeta('module-gdz_blog-latest', 'Gdzblog', 'gdz_blog');
                $this->addMeta('module-gdz_blog-category', 'Gdzblog Category', 'gdz_blog-category');
                $this->addMeta('module-gdz_blog-post', 'Gdzblog Post', 'gdz_blog-post');
                $this->addMeta('module-gdz_blog-tag', 'Gdzblog Tag', 'gdz_blog-tag');
                $this->addMeta('module-gdz_blog-archive', 'Gdzblog Archive', 'gdz_blog-archive');
                $this->addMeta('module-gdz_blog-categories', 'Gdzblog Categories', 'gdz_blog-categories');

            }
            include(dirname(__FILE__).'/install/install.php');
            $install_demo = new gdzInstall();
            $install_demo->createTable();
            $install_demo->installSamples();
            return $res;
        }
        return false;
    }
    public function uninstall()
    {
        /* Deletes Module */
        if (parent::uninstall()) {
            $res = true;
            $sql = array();
            include(dirname(__FILE__).'/install/uninstall.php');
            foreach ($sql as $s) {
                Db::getInstance()->execute($s);
            }
            $res &= Configuration::deleteByName('GDZBLOG_PAGE_SIDEBAR');
            $res &= Configuration::deleteByName('GDZBLOG_INTROTEXT_LIMIT');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_CATEGORY');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_VIEWS');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_COMMENTS');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_MEDIA');
            $res &= Configuration::deleteByName('GDZBLOG_IMAGE_WIDTH');
            $res &= Configuration::deleteByName('GDZBLOG_IMAGE_HEIGHT');
            $res &= Configuration::deleteByName('GDZBLOG_IMAGE_THUMB_WIDTH');
            $res &= Configuration::deleteByName('GDZBLOG_IMAGE_THUMB_HEIGHT');
            $res &= Configuration::deleteByName('GDZBLOG_COMMENT_ENABLE');
            $res &= Configuration::deleteByName('GDZBLOG_FACEBOOK_COMMENT');
            $res &= Configuration::deleteByName('GDZBLOG_ALLOW_GUEST_COMMENT');
            $res &= Configuration::deleteByName('GDZBLOG_COMMENT_DELAY');
            $res &= Configuration::deleteByName('GDZBLOG_AUTO_APPROVE_COMMENT');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_SOCIAL_SHARING');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_FACEBOOK');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_TWITTER');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_GOOGLEPLUS');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_LINKEDIN');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_PINTEREST');
            $res &= Configuration::deleteByName('GDZBLOG_SHOW_EMAIL');

            $id_tab = (int)Tab::getIdFromClassName('AdminGdzblogDashboard');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzblogPost');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzblogCategories');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzblogComment');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();
            $id_tab = (int)Tab::getIdFromClassName('AdminGdzblogSetting');
            $tab = new Tab($id_tab);
            $res &= $tab->delete();

            return $res;
        }
        return false;
    }

    private function addMeta($page, $title, $url_rewrite, $desc = '', $keywords = '')
    {
        $result = Db::getInstance()->getValue('SELECT * FROM '._DB_PREFIX_.'meta WHERE page="'.pSQL($page).'"');
        if ((int)$result > 0) {
            return true;
        }
        $_meta = new MetaCore();
        $_meta->page = $page;
        $_meta->configurable = 1;
        $langs = Language::getLanguages(false);
        foreach ($langs as $l) {
            $_meta->title[$l['id_lang']] = $title;
            $_meta->description[$l['id_lang']] = $desc;
            $_meta->keywords[$l['id_lang']] = $keywords;
            $_meta->url_rewrite[$l['id_lang']] = $url_rewrite;
        }
        return $_meta->add();
    }

    public static function getgdz_blogUrl()
    {
        $ssl_enable = Configuration::get('PS_SSL_ENABLED');
        $id_shop = (int)Context::getContext()->shop->id;
        //$rewrite_set = 1;
        $relative_protocol = false;
        $ssl = null;
        static $force_ssl = null;
        if ($ssl === null) {
            if ($force_ssl === null) {
                $force_ssl = (Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE'));
            }
            $ssl = $force_ssl;
        }
        if (1 && $id_shop !== null) {
            $shop = new Shop($id_shop);
        } else {
            $shop = Context::getContext()->shop;
        }
        if (!$relative_protocol) {
            $base = '//'.($ssl && $ssl_enable ? $shop->domain_ssl : $shop->domain);
        } else {
            $base = (($ssl && $ssl_enable) ? 'https://'.$shop->domain_ssl : 'http://'.$shop->domain);
        }
        return $base.$shop->getBaseURI();
    }

    public static function getPageLink($rewrite = 'gdz_blog', $params = null, $id_lang = null)
    {
        $url = gdz_blog::getgdz_blogUrl();
        $dispatcher = Dispatcher::getInstance();
        if ($params != null) {
            return $url.$dispatcher->createUrl($rewrite, $id_lang, $params);
        } else {
            return $url.$dispatcher->createUrl($rewrite);
        }
    }
    public function hookModuleRoutes($params)
    {
        $html = '';
        return array(
            'gdz_blog-latest' => array(
                'controller' => 'latest',
                'rule' => 'gdz_blog'.$html,
                'keywords' => array(
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'gdz_blog'
                )
            ),
            'gdz_blog-categories' => array(
                'controller' => 'categories',
                'rule' => 'gdz_blog/categories'.$html,
                'keywords' => array(
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'gdz_blog'
                )
            ),
            'gdz_blog-post' => array(
                'controller' => 'post',
                'rule' => 'gdz_blog/{category_slug}/{post_id}_{slug}'.$html,
                'keywords' => array(
                    'post_id' => array('regexp' => '[\d]+','param' => 'post_id'),
                    'category_slug' => array('regexp' => '[\w]+','param' => 'category_slug'),
                    'slug' =>   array('regexp' => '[_a-zA-Z0-9-\pL]*'),
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'gdz_blog'
                )
            ),
            'gdz_blog-category' => array(
                'controller' => 'category',
                'rule' => 'gdz_blog/{category_id}_{slug}'.$html,
                'keywords' => array(
                    'category_id' => array('regexp' => '[\w]+','param' => 'category_id'),
                    'slug' =>   array('regexp' => '[_a-zA-Z0-9-\pL]*'),
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'gdz_blog'
                )
            ),
            'gdz_blog-archive' => array(
                'controller' => 'archive',
                'rule' => 'gdz_blog/month/{archive}'.$html,
                'keywords' => array(
                    'archive' => array('regexp' => '[_a-zA-Z0-9-\pL]*','param' => 'archive')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'gdz_blog'
                )
            ),
            'gdz_blog-tag' => array(
                'controller' => 'tag',
                'rule' => 'gdz_blog/tag/{tag}'.$html,
                'keywords' => array(
                    'tag' => array('regexp' => '[\w]+','param' => 'tag')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'gdz_blog'
                )
            )
        );
    }
    public function delptree($parent, $level, $tree)
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $sql = 'SELECT a.*,b.`title`, b.`alias` FROM '._DB_PREFIX_.'gdz_blog_categories AS a ';
        $sql .= 'INNER JOIN '._DB_PREFIX_.'gdz_blog_categories_lang AS b ON a.`category_id` = b.`category_id` ';
        $sql .= 'WHERE a.`active` = 1 AND a.`parent` ='.$parent.' AND b.`id_lang` ='.$id_lang;
        $sql .= ' ORDER BY `ordering`';
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        foreach ($rows as $v) {
            $v['level'] = $level + 1;
            $this->treearr[] = $v;
            $this->delptree($v['category_id'], $level + 1, $tree);
        }
    }
    public function getMenuTree($menus)
    {
        $tree = array();
        foreach ($menus as $v) {
            $level = 0;
            $v['level'] = $level;
            $this->treearr[] = $v;
            $this->delptree($v['category_id'], $level, $tree);
        }
        $tree = array_slice($this->treearr, 0);
        return $tree;
    }
    public function genMenu($category)
    {
        if (!in_array($category['category_id'], $this->gens1)) {
            $this->menu .= '<li';
            if ($category['level'] == 0 && isset($this->child[$category['category_id']])) {
                $this->menu .= ' class="haschild"';
            }
            $this->menu .= '>';
            $params = array(
                'category_id' => $category['category_id'],
                'slug' => $category['alias']
            );
            $_link = JmsBlog::getPageLink('gdz_blog-category', $params);
            $this->menu .= '<a href="'.$_link.'">';
            $this->menu .=  $category['title'];
            if ($category['level'] == 0 && isset($this->child[$category['category_id']])) {
                $this->menu .= '<span class="navbar-toggler"><i class="fa fa-plus"></i></span>';
            }
            $this->menu .= '</a>';
            if (isset($this->child[$category['category_id']])) {
                $this->menu .='<ul>';
                $this->genSubs($this->child[$category['category_id']]);
                $this->menu .='</ul>';
            }
            $this->menu .= '</li>';
        }
        $this->gens[] = $category['category_id'];
    }
    public function genSubs($subs)
    {
        foreach ($subs as $sub) {
            $this->genMenu($sub);
        }
    }
    public function genCategoryMenu()
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $sql = '
            SELECT hss.`category_id` as category_id, hssl.`image`, hss.`ordering`, hss.`active`, hssl.`title`, hss.`parent`, hssl.`alias`
            FROM '._DB_PREFIX_.'gdz_blog_categories hss
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_categories_lang hssl ON (hss.`category_id` = hssl.`category_id`)
            WHERE hssl.`id_lang` = '.(int)$id_lang.
            ' AND hss.`parent` = 0
            ORDER BY hss.`category_id` ASC';
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        $categories = $this->getMenuTree($rows);
        foreach ($categories as &$category) {
            $parent = isset($this->child[$category['parent']]) ? $this->child[$category['parent']] : array();
            $parent[] = $category;
            $this->child[$category['parent']] = $parent;
        }
        $this->gens = array();
        foreach ($categories as &$category) {
            $this->genMenu($category);
        }
        return $this->menu;
    }
    public function getConfigFieldsValues()
    {
        return array(
            'GBW_SB_ITEM_SHOW' => Tools::getValue('GBW_SB_ITEM_SHOW', Configuration::get('GBW_SB_ITEM_SHOW')),
            'GBW_SB_SHOW_POPULAR' => Tools::getValue('GBW_SB_SHOW_POPULAR', Configuration::get('GBW_SB_SHOW_POPULAR')),
            'GBW_SB_SHOW_RECENT' => Tools::getValue('GBW_SB_SHOW_RECENT', Configuration::get('GBW_SB_SHOW_RECENT')),
            'GBW_SB_SHOW_LATESTCOMMENT' => Tools::getValue('GBW_SB_SHOW_LATESTCOMMENT', Configuration::get('GBW_SB_SHOW_LATESTCOMMENT')),
            'GBW_SB_COMMENT_LIMIT' => Tools::getValue('GBW_SB_COMMENT_LIMIT', Configuration::get('GBW_SB_COMMENT_LIMIT')),
            'GBW_SB_SHOW_CATEGORYMENU' => Tools::getValue('GBW_SB_SHOW_CATEGORYMENU', Configuration::get('GBW_SB_SHOW_CATEGORYMENU')),
            'GBW_SB_SHOW_ARCHIVES' => Tools::getValue('GBW_SB_SHOW_ARCHIVES', Configuration::get('GBW_SB_SHOW_ARCHIVES')),
        );
    }
    public function hookdisplayLeftColumn($params)
    {
        $widget_setting = $this->getConfigFieldsValues();
        $category_menu = $this->genCategoryMenu();
        $archives = gdzBlogHelper::getArchives();
        $popularpost = gdzBlogHelper::getPopularPost();
        $latestpost = gdzBlogHelper::getLatestPost();
        $latestcomment = gdzBlogHelper::getLatestComment();
        for ($i = 0; $i < count($latestcomment); $i++) {
            $latestcomment[$i]['comment'] = gdzBlogHelper::genIntrotext($latestcomment[$i]['comment'], $widget_setting['GBW_SB_COMMENT_LIMIT']);
        }
        $this->smarty->assign(
            array(
                'category_menu' => $category_menu,
                'archives' => $archives,
                'popularpost' => $popularpost,
                'latestpost' => $latestpost,
                'latestcomment' => $latestcomment,
                'widget_setting' => $widget_setting,
                'image_baseurl' => $this->context->shop->getBaseURL().'modules/gdz_blog/views/img/'
            )
        );
        return $this->display(__FILE__, 'sidebar-widget.tpl');
    }
	   public function hookdisplayRightColumn($params)
    {
        return $this->hookdisplayLeftColumn($params);
    }
}
