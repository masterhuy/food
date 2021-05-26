<?php

if (!defined('_PS_VERSION_')) {
    exit;
}


class gdzImportExportForm
{
    public $module;

    public function __construct()
    {
        $this->module = Module::getInstanceByName('gdz_themesetting');
    }
    public function getImportExportForm()
    {
      $_fieldsets = array();
      $_fieldsets[] = $this->getImportExportMainForm();
      return $_fieldsets;
    }
    public function getImportExportMainForm()
    {
        return array(
          'form' => array(
              'legend' => array(
                  'title' => $this->module->l('Import/Export', 'ImportExportForm'),
                  'icon' => 'icon-cogs',
                  'id' => 'gdz-import-export',
                  'heading_icon' => 'import_export'
              ),
              'input' => array(
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Import', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'import',
                          'label' => $this->module->l('Import', 'ImportExportForm'),
                          'name' => 'setting_import',
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'title_separator',
                          'label' => $this->module->l('Export', 'GeneralForm'),
                          'size' => 30,
                          'border_top' => false
                      ),
                      array(
                          'type' => 'export',
                          'label' => $this->module->l('Export', 'ImportExportForm'),
                          'name' => 'setting_export',
                          'class' => 'fixed-width-xxl'
                      )
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'ImportExportForm'),
                ),
            ),
        );
    }
}
