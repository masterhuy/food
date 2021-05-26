<?php

if (!defined('_PS_VERSION_')) {
    exit;
}


class gdzSocialForm
{
    public $module;

    public function __construct()
    {
        $this->module = Module::getInstanceByName('gdz_themesetting');
    }
    public function getSocialForm()
    {
      $_fieldsets = array();
      $_fieldsets[] = $this->getSocialLinkForm();
      return $_fieldsets;
    }
    public function getSocialLinkForm()
    {
        return array(
          'form' => array(
              'legend' => array(
                  'title' => $this->module->l('Social Network', 'SocialForm'),
                  'icon' => 'icon-cogs',
                  'id' => 'gdz-social',
                  'heading_icon' => 'people'
              ),
              'input' => array(
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Facebook', 'SocialForm'),
                          'desc' => $this->module->l('Facebook Link', 'SocialForm'),
                          'name' => 'social_facebook',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Twitter', 'SocialForm'),
                          'desc' => $this->module->l('Twitter Link', 'SocialForm'),
                          'name' => 'social_twitter',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Google Plus', 'SocialForm'),
                          'desc' => $this->module->l('Google Plus Link', 'SocialForm'),
                          'name' => 'social_gplus',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Instagram', 'SocialForm'),
                          'desc' => $this->module->l('Instagram Link', 'SocialForm'),
                          'name' => 'social_instagram',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Pinterest', 'SocialForm'),
                          'desc' => $this->module->l('Pinterest Link', 'SocialForm'),
                          'name' => 'social_pinterest',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Youtube', 'SocialForm'),
                          'desc' => $this->module->l('Youtube Link', 'SocialForm'),
                          'name' => 'social_youtube',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('Vimeo', 'SocialForm'),
                          'desc' => $this->module->l('Vimeo Link', 'SocialForm'),
                          'name' => 'social_vimeo',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                      array(
                          'type' => 'text',
                          'label' => $this->module->l('LinkedIn', 'SocialForm'),
                          'desc' => $this->module->l('LinkedIn Link', 'SocialForm'),
                          'name' => 'social_linkedin',
                          'size' => 30,
                          'min' => 0,
                          'class' => 'fixed-width-xxl'
                      ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'SocialForm'),
                ),
            ),
        );
    }
}
