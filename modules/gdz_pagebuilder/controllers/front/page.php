<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Pagebuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

class gdz_pagebuilderPageModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;
    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();
        $id_page    = (int)Tools::getValue('id_page');
        $_page = gdzPageBuilderHelper::getPage($id_page);
        if ($_page['css_file']) {
            $this->registerStylesheet('gdzpb-home-css', '/assets/css/'.$_page['css_file'], ['media' => 'all', 'priority' => 1000]);
        }
        if ($_page['js_file']) {
            $this->context->controller->registerJavascript('gdzpb-home-js', '/assets/js/'.$_page['js_file'], ['position' => 'bottom', 'priority' => 200]);
        }
        $params = $_page['params'];
        $page_result = gdzPageBuilderHelper::genRows($params);
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
        $this->context->smarty->assign(array(
            'gdz_pagebuilder_page' => $_page,
            'pagebuilder_css' => $page_result['css'],
            'rows' => $page_result['rows'],
            'root_url' => $this->root_url
        ));
        $this->setTemplate('module:'._GDZ_PB_NAME_.'/views/templates/front/page.tpl');
    }
    public function getBreadcrumbLinks()
    {
        $id_page    = (int)Tools::getValue('id_page');
        $_page = gdzPageBuilderHelper::getPage($id_page);
        if(!isset($_page)) return;
        $pageparams = array(
            'id_page' => $_page['id_page'],
            'slug' => $_page['alias']
        );
        $_pagelink = gdz_pagebuilder::getPageLink('gdz_pagebuilder-page', $pageparams, $this->context->language->id);
        $breadcrumb = parent::getBreadcrumbLinks();
        $breadcrumb['links'][] = array('title' => $_page['title'], 'url' => $_pagelink );
        return $breadcrumb;
    }
}
