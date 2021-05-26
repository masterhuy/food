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
include_once(_PS_MODULE_DIR_.'gdz_blog/classes/gdzComment.php');
class gdz_blogPostModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;
    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();
        $this->context->controller->addCSS($this->module->getPathUri().'views/css/style.css', 'all');
        $this->context->controller->addJS($this->module->getPathUri().'views/js/jquery.validate.min.js', 'all');
        $post_id    = (int)Tools::getValue('post_id');
        $gdz_blog_setting = gdz_blogHelper::getSettingFieldsValues();
        $module_instance = new gdz_blog();
        gdz_blogHelper::updateViews($post_id);
        $post       = $this->getPost($post_id);
        $cerrors = array ();
        $msg = (int)Tools::getValue('msg', 0);
        if (Tools::getValue('action') == 'submitComment') {
            $comment = new gdzComment();
            $comment->title = $post['title'];
            $comment->post_id = $post_id;
            $comment->customer_name = Tools::getValue('customer_name');
            $comment->email = Tools::getValue('email');
            $comment->comment = Tools::getValue('comment');
            $comment->customer_site = Tools::getValue('customer_site');
            $comment->time_add = date('Y-m-d H:i:s');
            if ((int)$gdz_blog_setting['GDZBLOG_AUTO_APPROVE_COMMENT']) {
                $comment->status = 1;
            } else {
                $comment->status = -2;
            }
            $lasttime = $this->getLatCommentTime($comment->email);
            $res = false;
            if (strtotime($lasttime) + (int)$gdz_blog_setting['GDZBLOG_COMMENT_DELAY'] < time()) {
                $res = $comment->add();
                if (!$res) {
                    $cerrors[] = $module_instance->l('The comment could not be added.');
                } else {
                    Tools::redirect('index.php?fc=module&module=gdz_blog&controller=post&msg=1&post_id='.$post_id."#comments");
                }
            } else {
                $cerrors[] = $module_instance->l('Please wait before posting another comment').' '.$gdz_blog_setting['GDZBLOG_COMMENT_DELAY'].' '.$module_instance->l('seconds before posting a new comment');
            }
        }
        $comments = $this->getComments($post_id);
        $category = gdz_blogHelper::getCategory($post['category_id']);
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
        $use_https = false;
        if (isset($force_ssl) && $force_ssl) {
            $use_https = true;
        }
        $this->context->controller->addCSS($this->module->getPathUri().'css/style.css', 'all');
        $this->context->smarty->assign(array('meta_title' => $post['title']));
        $page_layout = Configuration::get('GDZBLOG_PAGE_SIDEBAR') ? Configuration::get('GDZBLOG_PAGE_SIDEBAR') : 'left';
        $this->context->smarty->assign(array(
            'post' => $post,
            'current_category' => $category,
            'msg' => $msg,
            'comments' => $comments,
            'customer' => (array)$this->context->customer,
            'gdz_blog_setting' => $gdz_blog_setting,
            'cerrors' => $cerrors,
            'link' => $this->context->link,
            'image_baseurl' => $this->module->getPathUri().'views/img/',
            'module_dir' => _PS_MODULE_DIR_.'gdz_blog/views/templates/front/',
      			'use_https' => $use_https,
            'page_layout' => $page_layout
        ));
        $this->setTemplate('module:gdz_blog/views/templates/front/post.tpl');
    }
    public function getBreadcrumbLinks()
    {
        $post_id = (int)Tools::getValue('post_id');
        $post = $this->getPost($post_id);
        $category_slug = Tools::getValue('category_slug');
        $category   = gdz_blogHelper::getCategoryByAlias($category_slug);
        $catparams = array(
            'category_id' => $category['category_id'],
            'slug' => $category_slug
        );
        $_catlink = gdz_blog::getPageLink('gdz_blog-category', $catparams);
        $postparams = array(
            'post_id' => $post['post_id'],
            'category_slug' => $category_slug,
            'slug' => $post['alias']
        );
        $_postlink = gdz_blog::getPageLink('gdz_blog-post', $postparams);
        $breadcrumb = parent::getBreadcrumbLinks();
        $breadcrumb['links'][] = array('title' => $category['title'], 'url' => $_catlink );
        $breadcrumb['links'][] = array('title' => $post['title'], 'url' => $_postlink );
        return $breadcrumb;
    }
    public function getLatCommentTime($email)
    {
        $sql = '
                SELECT pc.`time_add`
                FROM `'._DB_PREFIX_.'gdz_blog_posts_comments` pc
                WHERE pc.`email` = \''.$email.'\'
                ORDER BY pc.`time_add` DESC';
        $result = Db::getInstance()->getValue($sql);
        return $result;
    }
    public function getPost($post_id)
    {
        $this->context = Context::getContext();
        $id_lang = $this->context->language->id;
        $sql = '
            SELECT hss.`post_id`, hssl.`image`,hss.`link_video`,hss.`category_id`, hss.`ordering`, hss.`active`, hssl.`title`, hss.`created`, hss.`modified`, hss.`views`,
            hssl.`alias`, hssl.`fulltext`, hssl.`introtext`, hssl.`meta_desc`, hssl.`meta_key`, hssl.`key_ref`, hss.`category_id`, hscl.`title` as category_name, hscl.`alias` as category_alias
            FROM '._DB_PREFIX_.'gdz_blog_posts hss
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_posts_lang hssl ON (hss.post_id = hssl.post_id)
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_categories hsc ON (hsc.category_id = hss.category_id)
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_categories_lang hscl ON (hscl.category_id = hss.category_id)
            WHERE hssl.id_lang = '.(int)$id_lang.
            ' AND hss.`post_id` = '.$post_id.'
            ORDER BY hss.ordering';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }

    public function getComments($post_id)
    {
        $sql = '
        SELECT * FROM `'._DB_PREFIX_.'gdz_blog_posts_comments`
        WHERE `post_id` ='.$post_id.' AND `status` = 1
        ORDER BY `time_add` ASC
        ';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }
}
