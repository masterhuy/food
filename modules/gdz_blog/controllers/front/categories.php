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
class gdz_blogCategoriesModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;

    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {

        parent::initContent();
        $categories     = $this->getCategories();
        $gdz_blog_setting = gdz_blogHelper::getSettingFieldsValues();
        for ($i = 0; $i < count($categories); $i++) {
            $categories[$i]['introtext'] = gdz_blogHelper::genIntrotext($categories[$i]['description'], 120);
        }
        $this->context->controller->addCSS($this->module->getPathUri().'views/css/style.css', 'all');
        $page_layout = Configuration::get('GDZBLOG_PAGE_SIDEBAR') ? Configuration::get('GDZBLOG_PAGE_SIDEBAR') : 'left';
        $this->context->smarty->assign(array(
            'categories' => $categories,
            'gdz_blog_setting' => $gdz_blog_setting,
            'image_baseurl' => $this->module->getPathUri().'views/img/',
            'this_path' => $this->module->getPathUri(),
            'page_layout' => $page_layout
        ));
        $this->setTemplate('module:gdz_blog/views/templates/front/categories.tpl');
    }
    public function getBreadcrumbLinks()
    {
        $_link = gdz_blog::getPageLink('gdz_blog-categories', array());
        $breadcrumb = parent::getBreadcrumbLinks();
        $breadcrumb['links'][] = array('title' => 'categories', 'url' => $_link );
        return $breadcrumb;
    }
    public function getCategories()
    {
        $this->context = Context::getContext();
        $id_lang = $this->context->language->id;
        $sql = '
            SELECT *
            FROM '._DB_PREFIX_.'gdz_blog_categories hss
            LEFT JOIN '._DB_PREFIX_.'gdz_blog_categories_lang hssl ON (hssl.`category_id` = hss.`category_id`)
            WHERE hss.`active` = 1 AND hss.`parent` = 0 AND hssl.`id_lang` = '.(int)$id_lang.
            ' GROUP BY hss.`category_id`
            ORDER BY hss.`ordering`';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }
}
