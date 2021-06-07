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

include_once(_PS_MODULE_DIR_.'gdz_blog/classes/gdzblogHelper.php');
class gdz_blogLatestModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;

    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {

        parent::initContent();
        $posts  = $this->getPosts();
        $gdz_blog_setting = gdz_blogHelper::getSettingFieldsValues();
        for ($i = 0; $i < count($posts); $i++) {
            $posts[$i]['introtext'] = gdz_blogHelper::genIntrotext($posts[$i]['introtext'], $gdz_blog_setting['GDZBLOG_INTROTEXT_LIMIT']);
            $posts[$i]['comment_count'] = gdz_blogHelper::getCommentCount($posts[$i]['post_id']);
        }
        $this->context->controller->addCSS($this->module->getPathUri().'views/css/style.css', 'all');
        $this->context->smarty->assign(array('meta_title' => 'Blog'));
        $page_layout = Configuration::get('GDZBLOG_PAGE_SIDEBAR') ? Configuration::get('GDZBLOG_PAGE_SIDEBAR') : 'left';
        $this->context->smarty->assign(array(
            'posts' => $posts,
            'gdz_blog_setting' => $gdz_blog_setting,
            'image_baseurl' => $this->module->getPathUri().'views/img/',
            'page_layout' => $page_layout
        ));

        $this->setTemplate('module:gdz_blog/views/templates/front/latest.tpl');
    }
    public function getBreadcrumbLinks()
    {
        $_link = gdz_blog::getPageLink('gdz_blog-latest', array());
        $breadcrumb = parent::getBreadcrumbLinks();
        $breadcrumb['links'][] = array('title' => 'blog', 'url' => $_link );
        return $breadcrumb;
    }

    public function getPosts()
    {
        $this->context = Context::getContext();
        $id_lang = $this->context->language->id;
        $sql = '
            SELECT hss.`post_id`,hss.`link_video`, hssl.`image`,hss.`category_id`, hss.`ordering`, hss.`active`, hssl.`title`, hss.`created`, hss.`modified`, hss.`views`,
            hssl.`alias`, hssl.`fulltext`, hssl.`introtext`,hssl.`meta_desc`, hssl.`meta_key`, hssl.`key_ref`, catsl.`title` AS category_name, catsl.`alias` AS category_alias
            FROM '._DB_PREFIX_.'gdz_blog_posts hss
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_posts_lang hssl ON (hss.`post_id` = hssl.`post_id`)
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_categories_lang catsl ON (catsl.`category_id` = hss.`category_id`)
            WHERE hss.`active` = 1 AND hssl.`id_lang` = '.(int)$id_lang.' AND catsl.`id_lang` = '.(int)$id_lang.
            ' GROUP BY hss.`post_id`
            ORDER BY hss.`created` DESC';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }
}
