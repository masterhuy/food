<?php
/**
* 2007-2020 PrestaShop
*
Godzilla PageBuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonbase.php');
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/productHelper.php');
if (Module::isInstalled('gdz_blog')) {
    include_once(_PS_MODULE_DIR_.'gdz_blog/classes/gdzblogHelper.php');
    include_once(_PS_MODULE_DIR_.'gdz_blog/gdz_blog.php');
}
class gdzAddonBlog extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'blog';
        $this->modulename = 'gdz_blog';
        $this->addontitle = 'Blog';
        $this->addondesc = 'Show Blog Posts On Page';
        $this->type = 'Addons';
        $this->ordering = 13;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
    }
    public function getCategorySelect($parent = 0, $lvl = 0)
    {
        $lvl ++;
        $str = '';
        for ($i = 1; $i <= $lvl; $i++) {
            $str .= '- ';
        }
        $this->context = Context::getContext();
        $id_lang = $this->context->language->id;
        $sql = '
            SELECT hss.`category_id` as category_id,hssl.`title`
            FROM '._DB_PREFIX_.'gdz_blog_categories hss
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_categories_lang hssl ON (hss.`category_id` = hssl.`category_id`)
            WHERE hssl.`id_lang` = '.(int)$id_lang.
            ' AND hss.`parent` = '.$parent.'
            ORDER BY hss.`category_id` ASC';
        $items = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (count($items)) {
            while ($element = current($items)) {
                $items[key($items)]['lvl'] = $lvl;
                $items[key($items)]['title'] = $str.$items[key($items)]['title'];
                $this->catselect[] = $items[key($items)];
                $this->getCategorySelect($element['category_id'], $lvl);
                next($items);
            }
        }
        return $items;
    }
    public function getInputs()
    {
        if (!Module::isInstalled('gdz_blog')) return;
        $categories = $this->getCategorySelect(0, 0);
        $inputs = array(
            array(
                'type' => 'select',
                'name' => 'post_source',
                'label' => $this->l('Post Source'),
                'lang' => '0',
                'desc' => 'Icon or Image Type from select list.',
                'options' => array('latest', 'category'),
                'default' => 'latest'
            ),
            array(
                'type' => 'select2',
                'name' => 'category',
                'label' => $this->l('Category'),
                'lang' => '0',
                'desc' => 'Select Category to show.',
                'options' => $categories,
                'options_name' => array('category_id','title'),
                'condition' => array(
                    'post_source' => '==category'
                ),
            ),
            array(
                'type' => 'select',
                'name' => 'order_by',
                'label' => $this->l('Order By'),
                'lang' => '0',
                'desc' => 'Order By Column',
                'options' => array('ordering', 'post_id', 'created', 'modified', 'views'),
                'default' => 'ordering',
                'condition' => array(
                    'post_source' => '==category'
                ),
            ),
            array(
                'type' => 'select',
                'name' => 'order_way',
                'label' => $this->l('Order Way'),
                'lang' => '0',
                'desc' => 'Order Way Or Order Direction',
                'options' => array('DESC','ASC'),
                'default' => 'DESC',
                'condition' => array(
                    'post_source' => '==category'
                ),
            ),
            array(
                'type' => 'tab',
                'name' => 'view_setting',
                'label' => $this->l('View Setting'),
                'lang' => '0',
                'open' => 0
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_category',
                'label' => $this->l('Show Category'),
                'lang' => '0',
                'desc' => 'Show/Hide Category Link',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_introtext',
                'label' => $this->l('Show Introtext'),
                'lang' => '0',
                'desc' => 'Show/Hide Intro Text',
                'default' => '1'
            ),
            array(
                'type' => 'text',
                'name' => 'introtext_limit',
                'label' => $this->l('Introtext Character Limit'),
                'lang' => '0',
                'desc' => 'Number of Character limit for Introtext',
                'default' => 120,
                'condition' => array(
                    'show_introtext' => '==1'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_readmore',
                'label' => $this->l('Show Readmore'),
                'lang' => '0',
                'desc' => 'Show/Hide Readmore Button',
                'default' => '1'
            ),
            array(
                'type' => 'text',
                'name' => 'readmore_text',
                'label' => $this->l('Readmore Text'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as readmore text.',
                'default' => 'Read more ...',
                'condition' => array(
                    'show_readmore' => '==1'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_time',
                'label' => $this->l('Show Time'),
                'lang' => '0',
                'desc' => 'Show/Hide Created Time',
                'default' => '1'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_ncomments',
                'label' => $this->l('Show Comment Number'),
                'lang' => '0',
                'desc' => 'Show/Hide Number of Comments',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_nviews',
                'label' => $this->l('Show View Number'),
                'lang' => '0',
                'desc' => 'Show/Hide Number of Views',
                'default' => '1'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'show_media',
                'label' => $this->l('Show Media'),
                'lang' => '0',
                'desc' => 'Show Post Image/Video',
                'default' => '1'
            ),
            array(
                'type' => 'tab',
                'name' => 'carousel_setting',
                'label' => $this->l('Carousel Setting'),
                'lang' => '0',
                'open' => 0
            ),
            array(
                'type' => 'range',
                'name' => 'items_total',
                'label' => $this->l('Total Items'),
                'min'  => 1,
                'max'  => 50,
                'lang' => '0',
                'desc' => 'Total Number Items',
                'default' => 10
            ),
            array(
                'type' => 'range',
                'name' => 'gutter',
                'label' => $this->l('Gutter Width (px)'),
                'min'  => 0,
                'max'  => 100,
                'lang' => '0',
                'desc' => 'Gutter between item Width',
                'default' => 30
            ),
            array(
                'type' => 'range',
                'name' => 'rows',
                'label' => $this->l('Number of Rows'),
                'min'  => 1,
                'max'  => 8,
                'lang' => '0',
                'desc' => 'Number of Rows (Or Number of Posts per Column)',
                'default' => 1
            ),
            array(
                'type' => 'screen-range',
                'name' => 'cols',
                'label' => $this->l('Posts per Line'),
                'min'  => 1,
                'max'  => 8,
                'lang' => '0',
                'desc' => 'Number of Posts per Line',
                'default' => '4-3-2'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'navigation',
                'label' => $this->l('Show Navigation'),
                'lang' => '0',
                'desc' => 'Enable/Disable Navigation',
                'default' => '1'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'pagination',
                'label' => $this->l('Show Pagination'),
                'lang' => '0',
                'desc' => 'Enable/Disable Pagination',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'autoplay',
                'label' => $this->l('Auto Play'),
                'lang' => '0',
                'desc' => 'Enable/Disable Auto Play',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'rewind',
                'label' => $this->l('ReWind Navigation'),
                'lang' => '0',
                'desc' => 'Enable/Disable ReWind Navigation',
                'default' => '1'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'slidebypage',
                'label' => $this->l('Slide By Page'),
                'lang' => '0',
                'desc' => 'Enable/Disable Slide By Page',
                'default' => '0'
            ),
            array(
                'type' => 'text',
                'name' => 'overwrite_tpl',
                'label' => $this->l('Overwrite Tpl File'),
                'lang' => '0',
                'desc' => 'Use When you want overwrite template file'
            )
        );
        return $inputs;
    }
    public function getPost($fields) {
        $id_lang = $this->context->language->id;
        $post_source = $fields[0]->value;
        $total_config = (int)$fields[13]->value;
        $rows = (int)$fields[15]->value;
        $cols = $fields[16]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $query = 'SELECT p.`post_id`,p.`link_video`, pl.`image`,p.`category_id`, p.`ordering`, p.`active`, pl.`title`, p.`created`, p.`modified`, p.`views`,
            pl.`alias`, pl.`fulltext`, pl.`introtext`,pl.`meta_desc`, pl.`meta_key`, pl.`key_ref`, cl.`title` AS category_name, cl.`alias` AS category_alias
            FROM '._DB_PREFIX_.'gdz_blog_posts p
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_posts_lang pl ON (p.post_id = pl.post_id)
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_categories_lang cl ON (cl.category_id = p.category_id)
            WHERE p.active = 1 AND pl.id_lang = '.(int)$id_lang.' AND cl.id_lang = '.(int)$id_lang;
        if($post_source == 'latest') {
            $order_by = ' ORDER BY p.created DESC';
        } elseif($fields[2]->value) {
            $order_by = ' ORDER BY p.'.$fields[2]->value .' '.$fields[3]->value;
            $_where = ' AND p.category_id = '.$fields[1]->value;
            $query .= $_where;
        }

        $query .= ' GROUP BY p.post_id';
        $query .= $order_by;
        $query .= ' LIMIT 0,'.$total_config;
        $r_posts = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
        if(!isset($r_posts) || count($r_posts) == 0) return;
        for ($i = 0; $i < count($r_posts); $i++) {
            $r_posts[$i]['introtext'] = gdz_blogHelper::genIntrotext($r_posts[$i]['introtext'], $fields[6]->value);
            $r_posts[$i]['comment_count'] = gdz_blogHelper::getCommentCount($r_posts[$i]['post_id']);
            $params = array('post_id' => $r_posts[$i]['post_id'], 'category_slug' => $r_posts[$i]['category_alias'], 'slug' => $r_posts[$i]['alias']);
            $catparams = array('category_id' => $r_posts[$i]['category_id'], 'slug' => $r_posts[$i]['category_alias']);
            $r_posts[$i]['postlink'] = gdz_blog::getPageLink('gdz_blog-post', $params);
            $r_posts[$i]['catlink'] = gdz_blog::getPageLink('gdz_blog-category', $catparams);
        }
        $_posts = gdzProductHelper::sliceProducts($r_posts, $rows, $cols_arr[0], $total_config);
        return $_posts;
    }
    public function returnValue($addon)
    {
        $id_lang = $this->context->language->id;
        $cols = $addon->fields[16]->value;
        $cols_arr = array();
        if($cols)
            $cols_arr = explode("-", $cols);
        $posts = $this->getPost($addon->fields);
        if(!isset($posts) || count($posts) == 0) return;
        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'posts' => $posts,
                'cols'  => $cols,
                'cols_md'   => $cols_arr[0],
                'cols_sm'   => $cols_arr[1],
                'cols_xs'   => $cols_arr[2],
                'navigation' => $addon->fields[17]->value,
                'pagination' => $addon->fields[18]->value,
                'autoplay' => $addon->fields[19]->value,
                'rewind' => $addon->fields[20]->value,
                'slidebypage' => $addon->fields[21]->value,
                'show_category' => $addon->fields[4]->value,
                'show_introtext' => $addon->fields[5]->value,
                'show_readmore' => $addon->fields[7]->value,
                'readmore_text' => $addon->fields[8]->value->$id_lang,
                'show_time' => $addon->fields[9]->value,
                'show_ncomments' => $addon->fields[10]->value,
                'show_nviews' => $addon->fields[11]->value,
                'show_media' => $addon->fields[12]->value,
                'gutter' => $addon->fields[14]->value,
                'image_url' => $this->root_url.'modules/'.$this->modulename.'/views/img/',
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
