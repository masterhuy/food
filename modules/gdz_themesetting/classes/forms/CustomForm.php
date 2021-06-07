<?php

if (!defined('_PS_VERSION_')) {
    exit;
}


class gdzCustomForm
{
    public $module;

    public function __construct()
    {
        $this->module = Module::getInstanceByName('gdz_themesetting');
    }
    public function getCustomForm()
    {
      $_fieldsets = array();
      $_fieldsets[] = $this->getCustomTabForm();
      //$_fieldsets[] = $this->getCustomCssForm();
      $_fieldsets[] = $this->getCustomCodeForm();
      $_fieldsets[] = $this->getCustomEditCssForm();
      return $_fieldsets;
    }
    public function getCustomTabForm()
    {
        return array(
            'form' => array(
                'childForms' => array(
                    'gdz-custom-code'  => $this->module->l('Custom Javscript/Css', 'CustomForm'),
                    'gdz-edit-css'  => $this->module->l('Edit Css File', 'CustomForm')
                ),
                'legend' => array(
                    'title' => $this->module->l('Custom', 'CustomForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-custom-tab',
                    'heading_icon' => 'dvr'
                ),
            ),
        );
    }
    public function getCustomCodeForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Custom Js', 'CustomForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-custom-code'
                ),
                'input' => array(
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('Custom Javascript', 'CustomForm'),
                        'name' => 'custom_js',
                        'cols' => 10,
                        'rows' => 10,
                        'desc' => $this->module->l('Code without <script></script> tag', 'CustomForm'),
                        'class' => 'auto_height'
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('Custom Css', 'CustomForm'),
                        'name' => 'custom_css',
                        'cols' => 10,
                        'rows' => 10,
                        'desc' => $this->module->l('Code without <style></style> tag', 'CustomForm'),
                        'class' => 'auto_height'
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'CustomForm'),
                ),
            ),
        );
    }
    public function getCustomEditCssForm()
    {
        return array(
            'form' => array(
                'child' => true,
                'legend' => array(
                    'title' => $this->module->l('Custom Js', 'CustomForm'),
                    'icon' => 'icon-cogs',
                    'id' => 'gdz-edit-css'
                ),
                'input' => array(
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('Edit Custom.css File', 'CustomForm'),
                        'name' => 'edit_css',
                        'cols' => 10,
                        'rows' => 10,
                        'desc' => $this->module->l('file custom.css', 'CustomForm'),
                        'class' => 'auto_height'
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'CustomForm'),
                ),
            ),
        );
    }
}
