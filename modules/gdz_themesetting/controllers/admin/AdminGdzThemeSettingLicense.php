<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Theme Setting
*
*  @author    Godzilla <joommasters@gmail.com>
*  @cyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once _PS_MODULE_DIR_ . 'gdz_themesetting/classes/package.php';
class AdminGdzThemeSettingLicenseController extends ModuleAdminController
{
    private $activeurl = 'https://www.godzillabuilder.com/modules/jmslicense/activekey.php';
    public function __construct()
    {
        $this->name = 'gdzthemesetting';
        $this->bootstrap = true;
        parent::__construct();

    }
    public function initContent()
    {
        if (!$this->viewAccess()) {
            $this->errors[] = Tools::displayError('You do not have permission to view this.');
            return;
        }
        $code = Package::decode();
        if(isset($code[0]) && Tools::getValue('action') != 'reactive') {
            $this->content .= $this->renderActivedForm($code);
        } else {
            $this->content .= $this->renderLicenseForm();
        }
        $this->context->smarty->assign(array(
            'content' => $this->content,
        ));
    }
    public function initPageHeaderToolbar()
    {
        $this->page_header_toolbar_btn['activekey'] = array(
            'href' => $this->activeurl,
            'desc' => $this->l('Active Key', null, null, false),
            'icon' => 'process-icon-save'
        );
        return parent::initPageHeaderToolbar();
    }

    public function postProcess()
    {
        parent::postProcess();
    }
    public function renderActivedForm($code)
    {
        $tpl = $this->createTemplate('activedform.tpl');
        $domain = "$_SERVER[HTTP_HOST]";
        $tpl->assign(array(
            'code'=>$code,
            'domain' => $domain
        ));
        return $tpl->fetch();
    }
    public function renderLicenseForm()
    {
          $this->fields_form = array(
              'legend' => array(
                      'title' => $this->l('Godzilla License'),
                      'icon' => 'icon-cogs'
                  ),
                  'input' => array(
                      array(
                          'type' => 'html',
                          'label' => $this->l(''),
                          'name' => 'intro_html',
                          'html_content' => "In order to receive all benefits of Godzilla, you need to activate your copy of the module.<br /> By activating Godzilla license you will unlock premium options - <strong>direct plugin updates</strong>, access to <strong>advance setting</strong> and <strong>official support</strong>."
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->l('Enter License'),
                          'name' => 'license_key',
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'html',
                          'label' => $this->l(''),
                          'name' => 'buy_html',
                          'html_content' => "Don't have direct license yet? <a target=\"_blank\" href=\"https://prestawwork.com\">Purchase Godzilla license.</a>"
                      ),

                  ),

          );
          $this->fields_form['input'][] = array('type' => 'hidden', 'name' => 'domain');
          $this->fields_form['input'][] = array('type' => 'hidden', 'name' => 'client_url');
          $this->fields_form['input'][] = array('type' => 'hidden', 'name' => 'back_url');
          $this->fields_value = $this->getFieldsValues();
          return adminController::renderForm();
    }

    public function getFieldsValues()
    {
        $fields = array();
        $domain = "$_SERVER[HTTP_HOST]";
        $fields['domain'] = $domain;
        $fields['client_url'] = _PS_BASE_URL_.__PS_BASE_URI__;
        $fields['back_url'] = $this->context->link->getAdminLink('AdminGdzThemeSettingLicense');
        return $fields;
    }
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia();
        $this->addJS(_MODULE_DIR_ . $this->module->name . '/views/js/setting.js');
    }
}
