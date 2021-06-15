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

class gdz_pagebuilderPreviewModuleFrontController extends ModuleFrontController
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
        if(Tools::getValue('id_lang')) {
            $id_lang    = (int)Tools::getValue('id_lang');
        } else {
            $id_lang = (int)(Configuration::get('PS_LANG_DEFAULT'));
        }
        $_page = gdzPageBuilderHelper::getPage($id_page);
        $params = $_page['params'];
        $page_result = gdzPageBuilderHelper::genRows($params);
        $this->context->controller->registerStylesheet('gdzpb-awesome-icon', 'modules/'.$this->module->name.'/lib/awesome/font-awesome.min.css', ['media' => 'all', 'priority' => 1]);
        $this->context->controller->registerStylesheet('gdzpb-awesome-icon', 'modules/'.$this->module->name.'/lib/feather/feather.css', ['media' => 'all', 'priority' => 2]);        
        $this->context->controller->registerStylesheet('modules-gdz_pagebuilder-editor-preview', 'modules/'.$this->module->name.'/views/css/preview.css', ['media' => 'all', 'priority' => 100]);
        if ($_page['css_file']) {
            $this->registerStylesheet('gdzpb-home-css', '/assets/css/'.$_page['css_file'], ['media' => 'all', 'priority' => 1000]);
        }
        if ($_page['js_file']) {
            $this->context->controller->registerJavascript('gdzpb-home-js', '/assets/js/'.$_page['js_file'], ['position' => 'bottom', 'priority' => 200]);
        }
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
        $addons = gdzPageBuilderHelper::getAddonsList();
        $addonslist = array();
        $addonstemplate = array();
        $addondefaults = array();
        $i = 0;
        foreach ($addons as $addon) {
          $addonfile = 'addon'.$addon.'.php';
          $addonclass = 'gdzAddon'.Tools::ucfirst($addon);
          if (file_exists(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile)) {
              require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/'.$addonfile);
          }
          $addon_instance = new $addonclass();
          $addonslist[] = $addon_instance->genEditorAddonList();
          $addonstemplate[$i]['name'] = $addon;
          $addonstemplate[$i]['tpl'] = $addon_instance->getTemplate();
          $addondefaults[$addon] = $addon_instance->defaultValue();
          $i++;
        }

        $this->context->smarty->assign(array(
            'gdz_pagebuilder_page' => $_page,
            'pagebuilder_css' => $page_result['css'],
            'rows' => $page_result['rows'],
            'root_url' => $this->root_url,
            'addonstemplate' => $addonstemplate,
        ));
        $this->setTemplate('module:gdz_pagebuilder/views/templates/admin/preview.tpl');
    }
}
