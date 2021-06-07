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
include_once(_PS_MODULE_DIR_.'gdz_blog/classes/gdzblogHelper.php');
class AdminGdzblogSettingController extends ModuleAdminController
{
    public function __construct()
    {
        $this->name = 'gdz_blog';
        $this->tab = 'front_office_features';
        $this->bootstrap = true;
        $this->root_url = gdz_blogHelper::getUrl();
        $this->lang = true;
        $this->context = Context::getContext();
        $this->secure_key = Tools::encrypt($this->name);
        parent::__construct();
    }

    public function renderList()
    {
        $this->_html = '';
        /* Validate & process */
        if (Tools::isSubmit('submitSetting')) {
            if ($this->_postValidation()) {
                $this->_postProcess();
                $this->_html .= $this->renderSettingForm();
            } else {
                $this->_html .= $this->renderNavigation();
                $this->_html .= $this->renderSettingForm();
            }
        } else {
            $this->_html .= $this->renderSettingForm();
        }
        return $this->_html;
    }

    private function _postValidation()
    {
        $errors = array();

        /* Validation for configuration */
        if (Tools::isSubmit('submitSetting')) {
            if (!Validate::isInt(Tools::getValue('status_id_category'))) {
                $errors[] = $this->l('Invalid Category');
            }
        }

        /* Display errors if needed */
        if (count($errors)) {
            $this->_html .= Tools::displayError(implode('<br />', $errors));
            return false;
        }
        /* Returns if validation is ok */
        return true;
    }
    private function _postProcess()
    {
        if (Tools::isSubmit('submitSetting')) {

            $res = Configuration::updateValue('GDZBLOG_PAGE_SIDEBAR', Tools::getValue('GDZBLOG_PAGE_SIDEBAR'));
            $res &= Configuration::updateValue('GDZBLOG_INTROTEXT_LIMIT', (int)Tools::getValue('GDZBLOG_INTROTEXT_LIMIT'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_CATEGORY', Tools::getValue('GDZBLOG_SHOW_CATEGORY'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_VIEWS', Tools::getValue('GDZBLOG_SHOW_VIEWS'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_COMMENTS', Tools::getValue('GDZBLOG_SHOW_COMMENTS'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_MEDIA', Tools::getValue('GDZBLOG_SHOW_MEDIA'));

            $res &= Configuration::updateValue('GDZBLOG_IMAGE_WIDTH', (int)Tools::getValue('GDZBLOG_IMAGE_WIDTH'));
            $res &= Configuration::updateValue('GDZBLOG_IMAGE_HEIGHT', (int)Tools::getValue('GDZBLOG_IMAGE_HEIGHT'));
            $res &= Configuration::updateValue('GDZBLOG_IMAGE_THUMB_WIDTH', (int)Tools::getValue('GDZBLOG_IMAGE_THUMB_WIDTH'));
            $res &= Configuration::updateValue('GDZBLOG_IMAGE_THUMB_HEIGHT', (int)Tools::getValue('GDZBLOG_IMAGE_THUMB_HEIGHT'));

            $res &= Configuration::updateValue('GDZBLOG_COMMENT_ENABLE', Tools::getValue('GDZBLOG_COMMENT_ENABLE'));
            $res &= Configuration::updateValue('GDZBLOG_ALLOW_GUEST_COMMENT', Tools::getValue('GDZBLOG_ALLOW_GUEST_COMMENT'));
            $res &= Configuration::updateValue('GDZBLOG_FACEBOOK_COMMENT', Tools::getValue('GDZBLOG_FACEBOOK_COMMENT'));
            $res &= Configuration::updateValue('GDZBLOG_COMMENT_DELAY', (int)Tools::getValue('GDZBLOG_COMMENT_DELAY'));
            $res &= Configuration::updateValue('GDZBLOG_AUTO_APPROVE_COMMENT', Tools::getValue('GDZBLOG_AUTO_APPROVE_COMMENT'));

            $res &= Configuration::updateValue('GDZBLOG_SHOW_SOCIAL_SHARING', Tools::getValue('GDZBLOG_SHOW_SOCIAL_SHARING'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_FACEBOOK', Tools::getValue('GDZBLOG_SHOW_FACEBOOK'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_TWITTER', Tools::getValue('GDZBLOG_SHOW_TWITTER'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_GOOGLEPLUS', Tools::getValue('GDZBLOG_SHOW_GOOGLEPLUS'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_LINKEDIN', Tools::getValue('GDZBLOG_SHOW_LINKEDIN'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_PINTEREST', Tools::getValue('GDZBLOG_SHOW_PINTEREST'));
            $res &= Configuration::updateValue('GDZBLOG_SHOW_EMAIL', Tools::getValue('GDZBLOG_SHOW_EMAIL'));

            $res &= Configuration::updateValue('GBW_SB_ITEM_SHOW', (int)Tools::getValue('GBW_SB_ITEM_SHOW'));
            $res &= Configuration::updateValue('GBW_SB_SHOW_POPULAR', (int)Tools::getValue('GBW_SB_SHOW_POPULAR'));
            $res &= Configuration::updateValue('GBW_SB_SHOW_RECENT', (int)Tools::getValue('GBW_SB_SHOW_RECENT'));
            $res &= Configuration::updateValue('GBW_SB_SHOW_LATESTCOMMENT', (int)Tools::getValue('GBW_SB_SHOW_LATESTCOMMENT'));
            $res &= Configuration::updateValue('GBW_SB_COMMENT_LIMIT', (int)Tools::getValue('GBW_SB_COMMENT_LIMIT'));
            $res &= Configuration::updateValue('GBW_SB_SHOW_CATEGORYMENU', (int)Tools::getValue('GBW_SB_SHOW_CATEGORYMENU'));
            $res &= Configuration::updateValue('GBW_SB_SHOW_ARCHIVES', (int)Tools::getValue('GBW_SB_SHOW_ARCHIVES'));
        }

        if (!$res) {
            $this->_html .= Tools::displayError(implode('<br />', $this->l('An error occurred during the save process.')));
        } elseif (Tools::isSubmit('submitSetting')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzblogSetting', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
        }
    }

    public function renderNavigation()
    {
        $html = '<div class="navigation">';
        $html .= '<a class="btn btn-default" href="'.AdminController::$currentIndex.
            '&configure='.$this->name.'
                &token='.Tools::getAdminTokenLite('AdminGdzblogSetting').'" title="Back to Dashboard"><i class="icon-home"></i>Back to Dashboard</a>';
        $html .= '</div>';
        return $html;
    }

    public function renderSettingForm()
    {
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/admin_style.css', 'all');
        $general_fields = array(
            array(
                'type' => 'select',
                'label' => $this->l('Blog Page Sidebar'),
                'name' => 'GDZBLOG_PAGE_SIDEBAR',
                'options' => array(
                    'query' => array(
                      array(
                          'id_option' => 'left',
                          'name' => $this->l('Left'),
                      ),
                        array(
                            'id_option' => 'right',
                            'name' => $this->l('Right'),
                        ),
                        array(
                            'id_option' => 'no',
                            'name' => $this->l('No'),
                        )
                    ),
                    'id' => 'id_option',
                    'name' => 'name',
                ),
                'tab' => 'general'
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Introtext Character Limit'),
                'name' => 'GDZBLOG_INTROTEXT_LIMIT',
                'desc' => $this->l('Number of character of introtext in post list page'),
                'class' => ' fixed-width-xl',
                'tab' => 'general'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Category'),
                'name' => 'GDZBLOG_SHOW_CATEGORY',
                'desc' => $this->l('Show/Hide Category Under Post Title In Post List or Post Detail page.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Show')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('Hide'))
                ),
                'tab' => 'general'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Views'),
                'name' => 'GDZBLOG_SHOW_VIEWS',
                'desc' => $this->l('Show/Hide Views Under Post Title In Post List or Post Detail page.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Show')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('Hide'))
                ),
                'tab' => 'general'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Comments'),
                'name' => 'GDZBLOG_SHOW_COMMENTS',
                'desc' => $this->l('Show/Hide Comments Under Post Title In Post List or Post Detail page.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Show')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('Hide'))
                ),
                'tab' => 'general'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Media'),
                'name' => 'GDZBLOG_SHOW_MEDIA',
                'desc' => $this->l('Show/Hide Image/video on Post List.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Show')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('Hide'))
                ),
                'tab' => 'general'
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Image Width'),
                'name' => 'GDZBLOG_IMAGE_WIDTH',
                'desc' => $this->l('Maximun Image Width'),
                'class' => ' fixed-width-xl',
                'tab' => 'image'
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Image Height'),
                'name' => 'GDZBLOG_IMAGE_HEIGHT',
                'desc' => $this->l('Maximun Image Height'),
                'class' => ' fixed-width-xl',
                'tab' => 'image'
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Thumb Width'),
                'name' => 'GDZBLOG_IMAGE_THUMB_WIDTH',
                'desc' => $this->l('Thumbnail Image Width'),
                'class' => ' fixed-width-xl',
                'tab' => 'image'
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Thumb Height'),
                'name' => 'GDZBLOG_IMAGE_THUMB_HEIGHT',
                'desc' => $this->l('Thumbnail Image Height'),
                'class' => ' fixed-width-xl',
                'tab' => 'image'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Comment Enable'),
                'name' => 'GDZBLOG_COMMENT_ENABLE',
                'desc' => $this->l('Enable/Disable Comment System.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'comment'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Facebook Comment'),
                'name' => 'GDZBLOG_FACEBOOK_COMMENT',
                'desc' => $this->l('If set to Yes, facebook comment will be used intead of default comment.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'comment'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Allow Guest Comments'),
                'name' => 'GDZBLOG_ALLOW_GUEST_COMMENT',
                'desc' => $this->l('If set to Yes, Guest can comment for posts.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'comment'
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Minimum time between 2 comments from the same user'),
                'name' => 'GDZBLOG_COMMENT_DELAY',
                'desc' => $this->l('Minimum time between 2 comments from the same User'),
                'class' => ' fixed-width-xl',
                'suffix' => 'seconds',
                'tab' => 'comment'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Auto Approve Comment'),
                'name' => 'GDZBLOG_AUTO_APPROVE_COMMENT',
                'desc' => $this->l('If set to Yes, comment after submit will auto set to public dont need approve from an employee.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'comment'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Social Sharing Enable'),
                'name' => 'GDZBLOG_SHOW_SOCIAL_SHARING',
                'desc' => $this->l('Social Sharing Enable/Disable in Post Detail Page.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'social'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Facebook Enable'),
                'name' => 'GDZBLOG_SHOW_FACEBOOK',
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'social'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Twitter Enable'),
                'name' => 'GDZBLOG_SHOW_TWITTER',
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'social'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Google Plus Enable'),
                'name' => 'GDZBLOG_SHOW_GOOGLEPLUS',
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'social'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Linkedin Enable'),
                'name' => 'GDZBLOG_SHOW_LINKEDIN',
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'social'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Pinterest Enable'),
                'name' => 'GDZBLOG_SHOW_PINTEREST',
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'social'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Email Enable'),
                'name' => 'GDZBLOG_SHOW_EMAIL',
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('Yes')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('No'))
                ),
                'tab' => 'social'
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Number of items show'),
                'name' => 'GBW_SB_ITEM_SHOW',
                'desc' => $this->l('Number of item(popular, recent post, latest comments) to show.'),
                'class' => 'fixed-width-xl',
                'tab' => 'sidebar'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Popular Post'),
                'name' => 'GBW_SB_SHOW_POPULAR',
                'desc' => $this->l('Show or Hide Popular Post.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('YES')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('NO'))
                ),
                'tab' => 'sidebar'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Recent Post'),
                'name' => 'GBW_SB_SHOW_RECENT',
                'desc' => $this->l('Show or Hide Recent Post.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('YES')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('NO'))
                ),
                'tab' => 'sidebar'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Latest Comment'),
                'name' => 'GBW_SB_SHOW_LATESTCOMMENT',
                'desc' => $this->l('Show or Hide Latest Comment.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('YES')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('NO'))
                ),
                'tab' => 'sidebar'
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Comment character limit'),
                'name' => 'GBW_SB_COMMENT_LIMIT',
                'desc' => $this->l('Maximum number of comment character.'),
                'class' => 'fixed-width-xl',
                'tab' => 'sidebar'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Blog Category Menu'),
                'name' => 'GBW_SB_SHOW_CATEGORYMENU',
                'desc' => $this->l('Show or Hide Category Menu.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('YES')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('NO'))
                ),
                'tab' => 'sidebar'
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Archives'),
                'name' => 'GBW_SB_SHOW_ARCHIVES',
                'desc' => $this->l('Show or Hide Archives.'),
                'values'    => array(
                    array('id'    => 'active_on','value' => 1,'label' => $this->l('YES')),
                    array('id'    => 'active_off','value' => 0,'label' => $this->l('NO'))
                ),
                'tab' => 'sidebar'
            )
        );
        /* RENDER */
        $this->fields_options[0]['form'] = array(
            'tinymce' => true,
            'tabs' => array('general' => 'General', 'image' => 'Image', 'comment' => 'Comment', 'social' => 'Social Sharing', 'sidebar' => 'Sidebar Widget'),
            'legend' => array('title' => '<span class="label label-info">'.$this->l('Godzilla Blog Setting').'</span>','icon' => 'icon-cogs',),
            'input' => $general_fields,
            'submit' => array('title' => $this->l('Save'), 'class' => 'button btn btn-primary'),
        );
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitSetting';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminGdzblogSetting', true).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->tpl_vars = array(
            'base_url' => $this->root_url,
            'fields_value' => gdz_blogHelper::getSettingFieldsValues(),
        );

        $helper->override_folder = '/';
        return $helper->generateForm($this->fields_options);
    }
}
