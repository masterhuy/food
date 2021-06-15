<?php
/**
* 2007-2020 PrestaShop
*
Godzilla PageBuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzHelper.php');
class gdzAddonBase extends Module
{
    public $name = _GDZ_PB_NAME_;
    public $modulename = _GDZ_PB_NAME_;
    public $id_shop = 0;
    public $inputs = array();
    public $root_url = '';
    public $plh_img = '';

    public function __construct()
    {
        $this->modulename = _GDZ_PB_NAME_;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
        $this->plh_img = Context::getContext()->shop->physical_uri.'modules/'.$this->name.'/views/img/placeholder.png';
    }
    public function getInputs()
    {
    }
    public function genAddonListHeader()
    {
        if (!Module::isInstalled($this->modulename)) {
            $html = '<a class="addon-title disabled" data-type="html" title="You need install '.$this->modulename.' module to use this addon.">';
        } elseif(defined('_GDZ_PB_PROADDONS_') && in_array($this->addonname, _GDZ_PB_PROADDONS_)) {
            $html = '<a class="addon-title disabled" data-type="html" title="You need upgrade to Advanced Package to use this addon.">';
        } else {
            $html = '<a class="addon-title" data-type="html">';
        }
        $html .= '<i class="gdz-icon-'.$this->addonname.'"></i>
                    <span class="element-title">'.$this->addontitle.'</span>
                    <span class="element-description">'.$this->addondesc.'</span>
                </a>
                <div class="addon-box addon" data-addon="'.$this->addonname.'" data-active="1">
                    <i class="addon-icon gdz-icon-'.$this->addonname.'"></i><span class="addon-title">'.$this->addontitle.'</span>
                    <div class="addon-tools">
                        <a class="active-addon"><i class="icon-check"></i></a>
                        <a class="edit-addon"><i class="icon-edit"></i></a>
                        <a class="duplicate-addon"><i class="icon-copy"></i></a>
                        <a class="remove-addon"><i class="icon-trash"></i></a>
                    </div>';
        return  $html;
    }
    public function genAddonListFields()
    {
        $root_url = gdzPageBuilderHelper::getRootUrl();
        $languages = Language::getLanguages(false);
        $this->plh_img = Context::getContext()->shop->physical_uri.'modules/'.$this->name.'/views/img/placeholder.png';
        //print_r($this->plh_img); exit;
        if(Tools::getValue('id_lang')) {
            $defaultFormLanguage = Tools::getValue('id_lang');
        } else {
            $defaultFormLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
        }
        $fields = $this->getInputs();
        $html = '';
        if ($this->modulename != _GDZ_PB_NAME_) {
            $html .= '<p class="alert alert-info">To use this addon you need go to : <strong>Modules >> '.$this->modulename.'</strong> to Manager Data.</p>';
        }
        if(!isset($fields)) return;
        foreach ($fields as $field) {
            $html .= '<div class="form-group '.(($field['type']=="tab") ? 'group-tab ' : '').((isset($field['open']) && $field['open']=="1") ? 'tab-open ' : '').(($field['type']=="screen-range" || $field['type']=="screen-select") ? 'screen-range ' : '').(isset($field['condition']) ? 'condition-setting hide-setting':'').'"'.(isset($field['condition']) ? ' data-condition="'.str_replace('"', '&quot;', json_encode($field['condition'])).'"' :'').'>';
            $html .= '<label>'.$field['label'].'</label>';
            if ($field['lang'] == '1') {
                $html .= '<div class="addon-input" data-type="'.$field['type'].'" data-attrname="'.$field['name'].'" data-multilang="1">';
                foreach ($languages as $language) {
                    $id_lang = (int)$language['id_lang'];
                    if (count($languages) > 0) {
                        $html .= '<div class="translatable-field lang-'.$id_lang.'"';
                        if ($id_lang != $defaultFormLanguage) {
                            $html .= 'style="display:none;"';
                        }
                        $html .= '>';
                        $html .= '<div class="col-lg-11">';
                    }
                    if ($field['type'] == 'text') {
                        $html .= '<input name="'.$field['name'].'" data-field="'.$field['name'].'" type="text"';
                        if (isset($field['default'])) {
                            $html .= ' value="'.$field['default'].'"';
                        }
                    } elseif ($field['type'] == 'textarea' || $field['type'] == 'editor') {
                        $html .= '<textarea data-field="'.$field['name'].'" ';
                    } elseif ($field['type'] == 'checkbox') {
                        $html .= '<input type="checkbox" ';
                    } elseif ($field['type'] == 'number') {
                        $html .= '<input type="number" ';
                        if (isset($field['default'])) {
                            $html .= ' value="'.$field['default'].'"';
                        }
                    }
                    $html .= 'class="lang-input addon-'.$field['name'];
                    if ($field['type'] == 'editor') {
                        $html .= ' gdz-editor autoload_rte';
                    }
                    if (in_array($field['type'], array('text','color','select','select2','image','range'))) {
                        $html .= ' form-control';
                    }
                    $html .= '" data-type="'.$field['type'].'" data-attrname="'.$field['name'].'" data-lang="'.$id_lang.'" data-multilang="1"';
                    if (isset($field['rows']) && (int)$field['rows'] > 0) {
                        $html .= ' rows="'.$field['rows'].'"';
                    }
                    if (isset($field['rows']) && (int)$field['cols'] > 0) {
                        $html .= ' cols="'.$field['cols'].'"';
                    }
                    if ($field['type'] == 'textarea' || $field['type'] == 'editor') {
                        $html .= '>';
                        if (isset($field['default'])) {
                            $html .= $field['default'];
                        }
                        $html .= '</textarea>';
                    } elseif ($field['type'] == 'text' || $field['type'] == 'checkbox' || $field['type'] == 'number') {
                        $html .= ' />';
                    }
                    if (count($languages) > 0) {
                        $html .= '</div>
                                <div class="col-lg-1">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.$language['iso_code'].'<span class="caret"></span></button><ul class="dropdown-menu">';
                        foreach ($languages as $language) {
                            $id_lang2 = (int)$language['id_lang'];
                            $html .= '<li><a href="javascript:hideOtherLanguage('.$id_lang2.');" tabindex="-1">'.$language['name'].'</a></li>';
                        }
                        $html .= '</ul></div>';
                    }
                    $html .= '</div>';
                }
                $html .= '</div>';
            } else {
                $tag_att = 'class="addon-input addon-'.$field['name'];
                if ($field['type'] == 'editor') {
                    $tag_att .= ' gdz-editor autoload_rte';
                }
                if ($field['type'] == 'image') {
                    $tag_att .= ' media-value input-media';
                }
                if ($field['type'] == 'images' || $field['type'] == 'accordion' || $field['type'] == 'testimonial' || $field['type'] == 'social') {
                    $tag_att .= ' repeat-input';
                }
                if ($field['type'] == 'categories') {
                    $tag_att .= ' addon-categories';
                }
                if ($field['type'] == 'checkbox2') {
                    $tag_att .= ' gdz-switch';
                }
                if (in_array($field['type'], array('text','color','select','select2','image','range'))) {
                    $tag_att .= ' form-control';
                }
                $tag_att .= '" data-type="'.$field['type'].'" data-attrname="'.$field['name'].'" data-multilang="0"';
                if (isset($field['rows']) && (int)$field['rows'] > 0) {
                    $tag_att .= ' rows="'.$field['rows'].'"';
                }
                if (isset($field['cols']) && (int)$field['cols'] > 0) {
                    $tag_att .= ' cols="'.$field['cols'].'"';
                }
                if ($field['type'] == 'text') {
                    $html .= '<input name="'.$field['name'].'" data-field="'.$field['name'].'" type="text" '.$tag_att;
                    if (isset($field['default'])) {
                        $html .= ' value="'.$field['default'].'"';
                    }
                } elseif ($field['type'] == 'textarea' || $field['type'] == 'editor') {
                    $html .= '<textarea data-field="'.$field['name'].'" '.$tag_att;
                } elseif ($field['type'] == 'checkbox') {
                    $html .= '<input type="checkbox" '.$tag_att;
                } elseif ($field['type'] == 'checkbox2') {
                    $html .= '<div class="pagebuilder-checkbox"><input name="'.$field['name'].'" data-field="'.$field['name'].'" value="1" type="checkbox" '.$tag_att;
                    if (isset($field['default']) && $field['default'] == '1') {
                        $html .= 'checked="checked"';
                    }
                } elseif ($field['type'] == 'switch') {
                    $html .= '<select data-field="'.$field['name'].'" name="'.$field['name'].'" '.$tag_att.'>';
                    $html .= '<option value="1"';
                    if (isset($field['default']) && $field['default'] == '1') {
                        $html .= 'selected="selected"';
                    }
                    $html .= '>Yes</option>';
                    $html .= '<option value="0"';
                    if (isset($field['default']) && $field['default'] == '0') {
                        $html .= 'selected="selected"';
                    }
                    $html .= '>No</option>';
                    $html .= '</select>';
                } elseif ($field['type'] == 'select') {
                    $html .= '<select data-field="'.$field['name'].'" name="'.$field['name'].'" '.$tag_att.'>';
                    if($field['name'] == 'modulename') {
                      //print_r($field['options']); exit;
                    }
                    foreach ($field['options'] as $option) {
                        $html .= '<option value="'.$option.'"';
                        if (isset($field['default']) && $field['default'] == $option) {
                            $html .= 'selected="selected"';
                        }
                        $html .= '>'.$option.'</option>';
                    }
                    $html .= '</select>';
                } elseif ($field['type'] == 'select2') {
                      $html .= '<select data-field="'.$field['name'].'" name="'.$field['name'].'" '.$tag_att.'>';
                      foreach ($field['options'] as $option) {
                          $html .= '<option value="'.$option[$field['options_name'][0]].'"';
                          if (isset($field['default']) && $field['default'] == $option[$field['options_name'][0]]) {
                              $html .= 'selected="selected"';
                          }
                          $html .= '>'.$option[$field['options_name'][1]].'</option>';
                      }
                    $html .= '</select>';
                } elseif ($field['type'] == 'categories') {
                    $category = Tools::getValue('category', Category::getRootCategory()->id);
                    $categories = new HelperTreeCategories($field['name']."-".rand(1, 1e6));
                    if (version_compare(_PS_VERSION_, '1.6.1', '>=') === true) {
                        $categories->setUseSearch(0)
                        ->setInputName($field['name'])
                        ->setFullTree(true)
                        ->setRootCategory($category)
                        ->setChildrenOnly(false)
                        ->setNoJS(false);
                    } else {
                        $categories->setRootCategory($category);
                    }
                    if ($field['usecheckbox'] == '1') {
                        $categories->setUseCheckBox(true);

                    } else {
                        $categories->setUseCheckBox(false);
                    }
                    if (isset($field['default'])) {
                        //$categories->setSelectedCategories(explode(",", $field['default']));
                    }
                    $html .= '<div '.$tag_att.' data-field="'.$field['name'].'" data-usecheckbox="'.$field['usecheckbox'].'">';
                    $html .= $categories->render();
                    $html .= '</div>';
                } elseif ($field['type'] == 'color') {
                    $html .= '<div class="input-group colorpicker-component color-picker-component">
                        <input type="text" '.$tag_att.' name="'.$field['name'].'" data-field="'.$field['name'].'" />
                        <span class="input-group-addon"><i></i></span>
                    </div>';
                } elseif ($field['type'] == 'align') {
                      $html .= '<div class="input-group input-align">
                          <ul>
                              <li class="align-left'.((isset($field['default']) && $field['default'] == 'left') ? ' active' : '').'" data-align="left"><i class="fa fa-align-left"></i></li>
                              <li class="align-center'.((isset($field['default']) && $field['default'] == 'center') ? ' active' : '').'" data-align="center"><i class="fa fa-align-center"></i></li>
                              <li class="align-right'.((isset($field['default']) && $field['default'] == 'right') ? ' active' : '').'" data-align="right"><i class="fa fa-align-right"></i></li>';
                        if(isset($field['justify']) && $field['justify'] == 1)
                              $html .= '<li class="align-justify'.((isset($field['default']) && $field['default'] == 'justify') ? ' active' : '').'" data-align="justify"><i class="fa fa-align-justify"></i></li>';
                          $html .= '</ul>
                          <input type="hidden" '.$tag_att.' name="'.$field['name'].'" data-field="'.$field['name'].'" />
                      </div>';
                } elseif ($field['type'] == 'image') {
                    $html .= '<div class="media-upload" type="image" data-url="'.$this->context->link->getAdminLink('AdminGdzpagebuilderMedia').'">
                        <div class="media-image-preview media-preview" style="background-image: url('.$this->plh_img.');"></div><div class="media-image-delete">Delete</div>
                        <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                    </div>
                    <input name="'.$field['name'].'" type="text" '.$tag_att.' data-field="'.$field['name'].'" value="'.((isset($field['default']) && $field['default']) ? $field['default']:'').'" />';
                } elseif ($field['type'] == 'images') {
                    $html .= '<div type="images" '.$tag_att.' data-field="'.$field['name'].'">
                    <div class="form-group hidden">
                        <div class="item-tools">
                            <div class="item-row-handle-sortable">
                                <i class="fa fa-ellipsis-v"></i>
                            </div>
                            <div class="item-row-title">Image Alt</div>
                            <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                            <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                        </div>
                        <div class="item-row-fields">
                            <div class="media-upload" data-url="'.$this->context->link->getAdminLink('AdminGdzpagebuilderMedia').'">
                                <div class="media-image-preview media-preview" style="background-image: url('.$this->plh_img.');"></div><div class="media-image-delete">Delete</div>
                                <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                            </div>
                            <input data-root="'.$root_url.'" name="image" type="text" class="media-value input-media" value="'.$this->plh_img.'" />
                            <label>Image Alt</label>
                            <input type="text" class="repeat-item-title form-control" name="alt" value="Image Alt" />
                            <label>Image Link</label>
                            <input type="text" name="link" class="form-control" />
                        </div>
                    </div>
                    <div class="items-container"></div>
                    <button class="add-item btn btn-default">Add Item</button>
                    </div>';
                } elseif ($field['type'] == 'accordion') {
                    $html .= '<div type="accordion" '.$tag_att.' data-field="'.$field['name'].'">
                    <div class="form-group hidden">
                        <div class="item-tools">
                            <div class="item-row-handle-sortable">
                                <i class="fa fa-ellipsis-v"></i>
                            </div>
                            <div class="item-row-title">Item Title</div>
                            <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                            <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                        </div>
                        <div class="item-row-fields">
                            <label>Title</label>
                            <input type="text" class="repeat-item-title form-control" name="title" value="Item Title" />
                            <label>Content</label>
                            <textarea name="content">I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</textarea>
                        </div>
                    </div>
                    <div class="items-container"></div>
                    <button class="add-item btn btn-default">Add Item</button>
                    </div>';
                } elseif ($field['type'] == 'social') {
                    $html .= '<div type="social" '.$tag_att.' data-field="'.$field['name'].'">
                    <div class="form-group hidden">
                        <div class="item-tools">
                            <div class="item-row-handle-sortable">
                                <i class="fa fa-ellipsis-v"></i>
                            </div>
                            <div class="item-row-title">Icon Class</div>
                            <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                            <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                        </div>
                        <div class="item-row-fields">
                            <label>Icon Class</label>
                            <input type="text" class="repeat-item-title form-control" name="icon_class" value="fa fa-facebook" />
                            <label>Link</label>
                            <input type="text" name="link" class="form-control" value="#" />
                        </div>
                    </div>
                    <div class="items-container"></div>
                    <button class="add-item btn btn-default">Add Item</button>
                    </div>';
                } elseif ($field['type'] == 'testimonial') {
                    $html .= '<div type="testimonial" '.$tag_att.' data-field="'.$field['name'].'">
                    <div class="form-group hidden">
                        <div class="item-tools">
                            <div class="item-row-handle-sortable">
                                <i class="fa fa-ellipsis-v"></i>
                            </div>
                            <div class="item-row-title">Author Name</div>
                            <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                            <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                        </div>
                        <div class="item-row-fields">
                            <div class="media-upload" data-url="'.$this->context->link->getAdminLink('AdminGdzpagebuilderMedia').'">
                                <div class="media-image-preview media-preview" style="background-image: url('.$this->plh_img.');"></div><div class="media-image-delete">Delete</div>
                                <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                            </div>
                            <input data-root="'.$root_url.'" name="image" type="text" class="media-value input-media class="form-control"" value="'.$this->plh_img.'" />
                            <label>Author</label>
                            <input type="text" class="repeat-item-title form-control" name="author" value="John Doe" />
                            <label>Position</label>
                            <input type="text" name="position" class="form-control" value="Company CEO" />
                            <label>Rating</label>
                            <input type="number" name="rating" class="form-control" value="5" min="1" max="5" />
                            <label>Comment</label>
                            <textarea name="comment">I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</textarea>
                        </div>
                    </div>
                    <div class="items-container"></div>
                    <button class="add-item btn btn-default">Add Item</button>
                    </div>';
                } elseif ($field['type'] == 'number') {
                    $html .= '<input type="number" '.$tag_att;
                    if (isset($field['default'])) {
                        $html .= ' value="'.$field['default'].'"';
                    }
                } elseif ($field['type'] == 'range') {
                    $html .= '<div class="pb-range-input">';
                    $html .= '<input type="range" class="pb-range" min="'.$field['min'].'" max="'.$field['max'].'" />';
                    $html .= '<input type="number" '.$tag_att .'data-field="'.$field['name'].'"';
                    if (isset($field['default'])) {
                        $html .= ' value="'.$field['default'].'"';
                    }
                    $html .= ' /></div>';
                } elseif ($field['type'] == 'screen-range') {
                    $default_arr = explode("-", $field['default']);
                    $html .= '<ul class="pb-device-tabs pb-device-md">
                    <li class="screen-md"><i class="icon-desktop icon-md"></i></li>
                    <li class="screen-sm"><i class="icon-tablet icon-sm"></i></li>
                    <li class="screen-xs"><i class="icon-mobile icon-xs"></i></li>
                    </ul>
                    <div class="pb-screen-inputs pb-device-md">';
                    $html .= '<div class="pb-range-input md">';
                    $html .= '<input type="range" class="pb-range" min="'.$field['min'].'" max="'.$field['max'].'" />';
                    $html .= '<input type="number" class="form-control" ';
                    if (isset($default_arr[0])) {
                        $html .= ' value="'.$default_arr[0].'"';
                    }
                    $html .= ' /></div>';
                    $html .= '<div class="pb-range-input sm">';
                    $html .= '<input type="range" class="pb-range" min="'.$field['min'].'" max="'.$field['max'].'" />';
                    $html .= '<input type="number" class="form-control" ';
                    if (isset($default_arr[1])) {
                        $html .= ' value="'.$default_arr[1].'"';
                    }
                    $html .= ' /></div>';
                    $html .= '<div class="pb-range-input xs">';
                    $html .= '<input type="range" class="pb-range" min="'.$field['min'].'" max="'.$field['max'].'" />';
                    $html .= '<input type="number" class="form-control" ';
                    if (isset($default_arr[2])) {
                        $html .= ' value="'.$default_arr[2].'"';
                    }
                    $html .= ' /></div>';
                    $html .= '</div>';
                    $html .= '<input name="'.$field['name'].'" data-field="'.$field['name'].'" type="hidden"'.$tag_att.' value="'.$field['default'].'" />';
                } elseif ($field['type'] == 'screen-select') {
                    $default_arr = explode("-", $field['default']);
                    $html .= '<ul class="pb-device-tabs pb-device-md">
                    <li class="screen-md"><i class="icon-desktop icon-md"></i></li>
                    <li class="screen-sm"><i class="icon-tablet icon-sm"></i></li>
                    <li class="screen-xs"><i class="icon-mobile icon-xs"></i></li>
                    </ul>
                    <div class="pb-screen-inputs pb-device-md">';
                    $html .= '<div class="pb-range-input md">';
                    $html .= '<select name="md_select">';
                    $html .= '<option value="1"'.((isset($default_arr[0]) && (int)$default_arr[0] == 1) ? ' selected="selected"' : '').'>1</option>';
                    $html .= '<option value="2"'.((isset($default_arr[0]) && (int)$default_arr[0] == 2) ? ' selected="selected"' : '').'>2</option>';
                    $html .= '<option value="3"'.((isset($default_arr[0]) && (int)$default_arr[0] == 3) ? ' selected="selected"' : '').'>3</option>';
                    $html .= '<option value="4"'.((isset($default_arr[0]) && (int)$default_arr[0] == 4) ? ' selected="selected"' : '').'>4</option>';
                    $html .= '<option value="6"'.((isset($default_arr[0]) && (int)$default_arr[0] == 6) ? ' selected="selected"' : '').'>6</option>';
                    $html .= '</select></div>';
                    $html .= '<div class="pb-range-input sm">';
                    $html .= '<select name="sm_select">';
                    $html .= '<option value="1"'.((isset($default_arr[1]) && (int)$default_arr[1] == 1) ? ' selected="selected"' : '').'>1</option>';
                    $html .= '<option value="2"'.((isset($default_arr[1]) && (int)$default_arr[1] == 2) ? ' selected="selected"' : '').'>2</option>';
                    $html .= '<option value="3"'.((isset($default_arr[1]) && (int)$default_arr[1] == 3) ? ' selected="selected"' : '').'>3</option>';
                    $html .= '<option value="4"'.((isset($default_arr[1]) && (int)$default_arr[1] == 4) ? ' selected="selected"' : '').'>4</option>';
                    $html .= '<option value="6"'.((isset($default_arr[1]) && (int)$default_arr[1] == 6) ? ' selected="selected"' : '').'>6</option>';
                    $html .= '</select></div>';
                    $html .= '<div class="pb-range-input xs">';
                    $html .= '<select name="xs_select">';
                    $html .= '<option value="1"'.((isset($default_arr[2]) && (int)$default_arr[2] == 1) ? ' selected="selected"' : '').'>1</option>';
                    $html .= '<option value="2"'.((isset($default_arr[2]) && (int)$default_arr[2] == 2) ? ' selected="selected"' : '').'>2</option>';
                    $html .= '</select></div></div>';
                    $html .= '<input name="'.$field['name'].'" data-field="'.$field['name'].'" type="hidden"'.$tag_att.' value="'.$field['default'].'" />';
                }
                if ($field['type'] == 'textarea' || $field['type'] == 'editor') {
                    $html .= '>';
                    if (isset($field['default'])) {
                        $html .= $field['default'];
                    }
                    $html .= '</textarea>';
                } elseif ($field['type'] == 'text' || $field['type'] == 'checkbox' || $field['type'] == 'number') {
                    $html .= ' />';
                } elseif($field['type'] == 'checkbox2') {
                    $html .= ' /></div>';
                } elseif($field['type'] == 'screen-grid') {
                    $values = explode("-", $field['default']);
                    $tpl = $this->context->smarty->createTemplate(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/ui/{$field['type']}.tpl");
                    $tpl->assign(array(
                        'values' => $values,
                        'field' => $field,
                    ));
                    $html.= $tpl->fetch();
                }
            }
            if (isset($field['desc']) && $field['desc']) {
                $html .= '<p class="help-block">'.$field['desc'].'</p>';
            }
            $html .= '</div>';
        }
        return $html;
    }

    public function genAddonList()
    {
        $html = $this->genAddonListHeader();
        $html .= '<div class="item-inner">';
        $html .= $this->genAddonListFields();
        $html .= '</div>';
        return  $html;
    }
    public function genEditorAddonList()
    {
        $addon_class = 'addon-widget';
        if (!Module::isInstalled($this->modulename) || (defined('_GDZ_PB_PROADDONS_') && in_array($this->addonname, _GDZ_PB_PROADDONS_)))
          $addon_class .= ' disabled';
        $html = '<div class="'.$addon_class.'" data-addon="'.$this->addonname.'">';
        if (!Module::isInstalled($this->modulename)) {
            $html .= '<span class="hover-text">Install '.$this->modulename.' module to use this addon</span><a class="addon-title disabled" data-type="html">';
        } else {
            $html .= '<a class="addon-title" data-type="html">';
        }
        $html .= '<i class="gdz-icon-'.$this->addonname.'" draggable="false"></i>
                    <span class="element-title">'.$this->addontitle.'</span>
                    <span class="element-description">'.$this->addondesc.'</span>
                </a></div>';
        return  $html;
    }
    public function getTemplate()
    {
        if (is_file(_PS_MODULE_DIR_ ._GDZ_PB_NAME_."/views/templates/hook/template/addon{$this->addonname}.tpl")) {
            return $this->context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/template/addon{$this->addonname}.tpl");
        }
        return '';
    }
    public function genAddonLayout($addon)
    {
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
        $languages = Language::getLanguages(false);
        $this->plh_img = Context::getContext()->shop->physical_uri.'modules/'._GDZ_PB_NAME_.'/views/img/placeholder.png';
        $defaultFormLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
        $html = '<div id="'.(isset($addon->id)?$addon->id:'').'" class="addon-box" data-addon="'.$addon->settings->addon.'" data-active="'.(isset($addon->settings->active) ? $addon->settings->active : '1').'">
                    <i class="addon-icon gdz-icon-'.$addon->settings->addon.'"></i>
                    <span class="addon-title">'.$this->addontitle.'</span>
                    <div class="addon-tools">
                        <a class="active-addon"><i class="icon-'.((isset($addon->settings->active) && $addon->settings->active == '0') ? 'remove' : 'check').'"></i></a>
                        <a class="edit-addon"><i class="icon-edit"></i></a>
                        <a class="duplicate-addon"><i class="icon-copy"></i></a>
                        <a class="remove-addon"><i class="icon-trash"></i></a>
                    </div>
                    <div class="item-inner">';
        if ($this->modulename != _GDZ_PB_NAME_) {
            $html .= '<p class="alert alert-info">To use this addon you need go to : <strong>Modules >> '.$this->modulename.'</strong> to Manager Data.</p>';
        }
        foreach ($addon->fields as $findex => $field) {
            $_desc = $this->getFieldAttrByName($field->name, 'desc');
            $_condition = $this->getFieldAttrByName($field->name, 'condition');
            $_tab_open = $this->getFieldAttrByName($field->name, 'open');
            $screen_class = ($field->type=="screen-range" || $field->type=="screen-select") ? 'screen-range ' : '';
            $condition_class = isset($_condition) ? 'condition-setting hide-setting':'';
            $html .= '<div class="form-group '.$_tab_open.$screen_class.$condition_class.'"'.(isset($_condition) ? ' data-condition="'.str_replace('"', '&quot;', json_encode($_condition)).'"':'').'>';
                        $html .= '<label>'.$field->label.'</label>';
            if ($field->multilang == '1') {
                $html .= '<div class="addon-input" data-type="'.$field->type.'" data-attrname="'.$field->name.'" data-multilang="1">';
                foreach ($languages as $language) {
                    $id_lang = (int)$language['id_lang'];
                    if (count($languages) > 0) {
                        $html .= '<div class="translatable-field lang-'.$id_lang.'"';
                        if ($id_lang != $defaultFormLanguage) {
                            $html .= 'style="display:none;"';
                        }
                        $html .= '>';
                        $html .= '<div class="col-lg-11">';
                    }
                    $tag_att = 'class="lang-input addon-'.$field->name;
                    if ($field->type == 'editor') {
                        $tag_att .= ' gdz-editor';
                    }
                    if (in_array($field->type, array('text','color','select','select2','image','range'))) {
                        $tag_att .= ' form-control';
                    }
                    $tag_att .= '" data-type="'.$field->type.'" data-attrname="'.$field->name.'" data-lang="'.$id_lang.'" data-multilang="1"';
                    if (isset($field->rows) && (int)$field->rows > 0) {
                        $tag_att .= ' rows="'.$field->rows.'"';
                    }
                    if (isset($field->cols) && (int)$field->cols > 0) {
                        $tag_att .= ' cols="'.$field->cols.'"';
                    }
                    if ($field->type == 'text') {
                        if (isset($field->value->$id_lang)) {
                            $html .= '<input type="text" value="'.gdzPageBuilderHelper::decodeHTML($field->value->$id_lang).'" '.$tag_att;
                        } else {
                            $html .= '<input type="text" value="" '.$tag_att;
                        }
                    } elseif ($field->type == 'textarea' || $field->type == 'editor') {
                        $html .= '<textarea '.$tag_att;
                    } elseif ($field->type == 'checkbox') {
                        $html .= '<input type="checkbox" '.$tag_att;
                    } elseif ($field->type == 'number') {
                        if (isset($field->value->$id_lang)) {
                            $html .= '<input type="number" value="'.$field->value->$id_lang.'" '.$tag_att;
                        } else {
                            $html .= '<input type="number" value="" '.$tag_att;
                        }
                    }
                    if ($field->type == 'textarea' || $field->type == 'editor') {
                        if (isset($field->value->$id_lang)) {
                            $html .= '>'.htmlentities(gdzPageBuilderHelper::decodeHTML($field->value->$id_lang)).'</textarea>';
                        } else {
                            $html .= '></textarea>';
                        }
                    } elseif ($field->type == 'text' || $field->type == 'checkbox' || $field->type == 'number') {
                        $html .= ' />';
                    }
                    if (count($languages) > 0) {
                        $html .= '</div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.$language['iso_code'].'<span class="caret"></span></button><ul class="dropdown-menu">';
                        foreach ($languages as $language) {
                            $id_lang2 = (int)$language['id_lang'];
                            $html .= '<li><a href="javascript:hideOtherLanguage('.$id_lang2.');" tabindex="-1">'.$language['name'].'</a></li>';
                        }
                        $html .= '</ul></div>';
                    }
                    $html .= '</div>';
                }
                $html .= '</div>';
            } else {
                $tag_att = 'class="addon-input addon-'.$field->name;
                if ($field->type == 'editor') {
                    $tag_att .= ' gdz-editor';
                }
                if ($field->type == 'image') {
                    $tag_att .= ' media-value input-media';
                }
                if ($field->type == 'images' || $field->type == 'accordion' || $field->type == 'testimonial' || $field->type == 'social') {
                    $tag_att .= ' repeat-input';
                }
                if ($field->type == 'categories') {
                    $tag_att .= ' addon-categories';
                }
                if ($field->type == 'checkbox2') {
                    $tag_att .= ' gdz-switch';
                }
                if (in_array($field->type, array('text','color','select','select2','image','range'))) {
                    $tag_att .= ' form-control';
                }
                $tag_att .= '" data-type="'.$field->type.'" data-attrname="'.$field->name.'" data-multilang="0"';
                if (isset($field->rows) && (int)$field->rows > 0) {
                    $tag_att .= ' rows="'.$field->rows.'"';
                }
                if (isset($field->cols) && (int)$field->cols > 0) {
                    $tag_att .= ' cols="'.$field->cols.'"';
                }
                if ($field->type == 'text') {
                    $html .= '<input type="text" name="'.$field->name.'" value="'.gdzPageBuilderHelper::decodeHTML($field->value).'" '.$tag_att;
                } elseif ($field->type == 'textarea' || $field->type == 'editor') {
                    $html .= '<textarea '.$tag_att;
                } elseif ($field->type == 'checkbox') {
                    $html .= '<input type="checkbox" '.$tag_att;
                } elseif ($field->type == 'checkbox2') {
                    $html .= '<div class="pagebuilder-checkbox"><input name="'.$field->name.'" data-field="'.$field->name.'" value="1" type="checkbox" '.$tag_att;
                    if ($field->value == '1') {
                        $html .= 'checked="checked"';
                    }
                } elseif ($field->type == 'switch') {
                    $html .= '<select name="'.$field->name.'" '.$tag_att.'>';
                    $html .= '<option value="1"';
                    if ($field->value == '1') {
                        $html .= ' selected="selected"';
                    }
                    $html .= '>Yes</option>';
                    $html .= '<option value="0"';
                    if ($field->value == '0') {
                        $html .= 'selected="selected"';
                    }
                    $html .= '>No</option>';
                    $html .= '</select>';
                } elseif ($field->type == 'select') {
                    //$_options = $this->getFieldAttr($findex, 'options');
                    $_options = $this->getFieldAttrByName($field->name, 'options');
                    //print_r($_options); exit;
                    $html .= '<select name="'.$field->name.'" '.$tag_att.'>';
                    foreach ($_options as $_option) {
                        $html .= '<option value="'.$_option.'"';
                        if ($field->value == $_option) {
                            $html .= 'selected="selected"';
                        }
                        $html .= '>'.$_option.'</option>';
                    }
                    $html .= '</select>';
                } elseif ($field->type == 'select2') {
                    //$_options = $this->getFieldAttr($findex, 'options');
                    $_options = $this->getFieldAttrByName($field->name, 'options');
                    //$_options_name = $this->getFieldAttr($findex, 'options_name');
                    $_options_name = $this->getFieldAttrByName($field->name, 'options_name');
                    $html .= '<select data-field="'.$field->name.'" name="'.$field->name.'" '.$tag_att.'>';
                    foreach ($_options as $_option) {
                        $html .= '<option value="'.$_option[$_options_name[0]].'"';
                        if ($field->value == $_option[$_options_name[0]]) {
                            $html .= 'selected="selected"';
                        }
                        $html .= '>'.$_option[$_options_name[1]].'</option>';
                    }
                    $html .= '</select>';
                } elseif ($field->type == 'categories') {
                    //$_usecheckbox = $this->getFieldAttr($findex, 'usecheckbox');
                    $_usecheckbox = $this->getFieldAttrByName($field->name, 'usecheckbox');
                    $category = Tools::getValue('category', Category::getRootCategory()->id);
                    $categories = new HelperTreeCategories($field->name."-".rand(1, 1e6));
                    if (version_compare(_PS_VERSION_, '1.6.1', '>=') === true) {
                         $categories->setUseSearch(0)
                        ->setInputName($field->name)
                        ->setFullTree(true)
                        ->setRootCategory($category)
                        ->setChildrenOnly(false)
                        ->setNoJS(true);
                    } else {
                        $categories->setRootCategory($category);
                    }
                    if ($_usecheckbox == '1') {
                        $categories->setUseCheckBox(true);

                    } else {
                        $categories->setUseCheckBox(false);
                    }
                    if ($field->value) {
                        $categories->setSelectedCategories(explode(",", $field->value));
                    }
                    $html .= '<div '.$tag_att.' data-field="'.$field->name.'" data-usecheckbox="'.$_usecheckbox.'">';
                    $html .= $categories->render();
                    $html .= '</div>';
                } elseif ($field->type == 'color') {
                    $html .= '<div class="input-group colorpicker-component color-picker-component">
                        <input type="text" '.$tag_att.' value="'.$field->value.'" name="'.$field->name.'" data-field="'.$field->name.'" />
                        <span class="input-group-addon"><i></i></span>
                    </div>';
                } elseif ($field->type == 'align') {
                    $_justify = $this->getFieldAttrByName($field->name, 'justify');
                    $html .= '<div class="input-group input-align">
                        <ul>
                            <li class="align-left'.(($field->value == 'left') ? ' active' : '').'" data-align="left"><i class="fa fa-align-left"></i></li>
                            <li class="align-center'.(($field->value == 'center') ? ' active' : '').'" data-align="center"><i class="fa fa-align-center"></i></li>
                            <li class="align-right'.(($field->value == 'right') ? ' active' : '').'" data-align="right"><i class="fa fa-align-right"></i></li>';
                    if(isset($_justify) && $_justify == 1)
                        $html .= '<li class="align-justify'.(($field->value == 'justify') ? ' active' : '').'" data-align="justify"><i class="fa fa-align-justify"></i></li>';
                    $html .= '</ul>
                        <input type="hidden" '.$tag_att.' name="'.$field->name.'" data-field="'.$field->name.'" value="'.$field->value.'" />
                    </div>';
                } elseif ($field->type == 'image') {
                    $html .= '<div class="media-upload" type="image" data-url="'.$this->context->link->getAdminLink('AdminGdzpagebuilderMedia').'">
                        <div class="media-image-preview media-preview" style="background-image: url('.$this->plh_img.');"></div><div class="media-image-delete">Delete</div>
                        <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                    </div>
                    <input name="'.$field->name.'" type="text" '.$tag_att.' value="'.$field->value.'" data-field="'.$field->name.'" />';
                } elseif ($field->type == 'images') {
                  $html .= '<div type="images" '.$tag_att.' data-field="'.$field->name.'">
                              <div class="form-group hidden">
                                  <div class="item-tools">
                                      <div class="item-row-handle-sortable">
                                          <i class="fa fa-ellipsis-v"></i>
                                      </div>
                                      <div class="item-row-title">Image Alt</div>
                                      <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                                      <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                                  </div>
                                  <div class="item-row-fields">
                                      <div class="media-upload" data-url="'.$this->context->link->getAdminLink('AdminGdzpagebuilderMedia').'">
                                          <div class="media-image-preview media-preview" style="background-image: url('.$this->plh_img.');"></div><div class="media-image-delete">Delete</div>
                                          <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                                      </div>
                                      <input data-root="'.$this->root_url.'" name="image" type="text" class="media-value input-media" value="'.$this->plh_img.'" />
                                      <label>Image Alt</label>
                                      <input type="text" class="repeat-item-title form-control" name="alt" value="Image Alt" />
                                      <label>Image Link</label>
                                      <input type="text" name="link" class="form-control" />
                                  </div>
                              </div>';
                              $html .= '<div class="items-container">';
                              if($field->value) {
                                  foreach ($field->value as $item) {
                                        $html .= '<div class="form-group">
                                                    <div class="item-tools">
                                                        <div class="item-row-handle-sortable">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </div>
                                                        <div class="item-row-title">'.$item->alt.'</div>
                                                        <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                                                        <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                                                    </div>
                                                    <div class="item-row-fields">
                                                      <div class="media-upload" data-url="'.$this->context->link->getAdminLink('AdminGdzpagebuilderMedia').'">
                                                          <div class="media-image-preview media-preview" style="background-image: url('.$this->root_url.$item->image.')"></div><div class="media-image-delete">Delete</div>
                                                          <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                                                      </div>';
                                                      $html .= '<input data-root="'.$this->root_url.'" name="image" type="text" class="media-value input-media" value="'.$item->image.'" />
                                                      <label>Image Alt</label>
                                                      <input type="text" name="alt" class="repeat-item-title form-control" value="'.$item->alt.'" />
                                                      <label>Image Link</label>
                                                      <input type="text" name="link" class="form-control" value="'.$item->link.'" />';
                                        $html .= '</div></div>';
                                  }
                              }
                              $html .= '</div>
                              <button class="add-item btn btn-default">Add Item</button></div>';
                } elseif ($field->type == 'accordion') {
                    $html .= '<div type="accordion" '.$tag_att.' data-field="'.$field->name.'">
                              <div class="form-group hidden">
                                  <div class="item-tools">
                                      <div class="item-row-handle-sortable">
                                          <i class="fa fa-ellipsis-v"></i>
                                      </div>
                                      <div class="item-row-title">Item Title</div>
                                      <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                                      <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                                  </div>
                                  <div class="item-row-fields">
                                      <label>Title</label>
                                      <input type="text" class="repeat-item-title form-control" name="title" value="Item Title" />
                                      <label>Content</label>
                                      <textarea name="content">I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</textarea>
                                  </div>
                              </div>';
                              $html .= '<div class="items-container">';
                              if($field->value) {
                                  foreach ($field->value as $item) {
                                        $html .= '<div class="form-group">
                                                    <div class="item-tools">
                                                        <div class="item-row-handle-sortable">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </div>
                                                        <div class="item-row-title">'.$item->title.'</div>
                                                        <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                                                        <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                                                    </div>
                                                    <div class="item-row-fields">
                                                      <label>Item Title</label>
                                                      <input type="text" name="title" class="repeat-item-title form-control" value="'.$item->title.'" />
                                                      <label>Content</label>
                                                      <textarea name="content">'.$item->content.'</textarea>';
                                        $html .= '</div></div>';
                                  }
                              }
                              $html .= '</div>
                              <button class="add-item btn btn-default">Add Item</button></div>';
                } elseif ($field->type == 'social') {
                    $html .= '<div type="social" '.$tag_att.' data-field="'.$field->name.'">
                            <div class="form-group hidden">
                                <div class="item-tools">
                                    <div class="item-row-handle-sortable">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </div>
                                    <div class="item-row-title">Social Class</div>
                                    <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                                    <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                                </div>
                                <div class="item-row-fields">
                                    <label>Icon Class</label>
                                    <input type="text" class="repeat-item-title form-control" name="icon_class" value="fa fa-facebook" />
                                    <label>link</label>
                                    <input type="text" name="link" class="form-control" value="#" />
                                </div>
                            </div>';
                            $html .= '<div class="items-container">';
                            if($field->value) {
                                foreach ($field->value as $key => $item) {
                                      $html .= '<div class="form-group">
                                                  <div class="item-tools">
                                                      <div class="item-row-handle-sortable">
                                                          <i class="fa fa-ellipsis-v"></i>
                                                      </div>
                                                      <div class="item-row-title">'.$item->icon_class.'</div>
                                                      <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                                                      <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                                                  </div>
                                                  <div class="item-row-fields">
                                                    <label>Icon Class</label>
                                                    <input type="text" name="icon_class" class="repeat-item-title form-control" value="'.$item->icon_class.'" />
                                                    <label>link</label>
                                                    <input type="text" name="link" class="form-control" value="'.$item->link.'" />';
                                      $html .= '</div></div>';
                                }
                            }
                            $html .= '</div>
                            <button class="add-item btn btn-default">Add Item</button></div>';
                } elseif ($field->type == 'testimonial') {
                    $html .= '<div type="testimonial" '.$tag_att.' data-field="'.$field->name.'">
                              <div class="form-group hidden">
                                  <div class="item-tools">
                                      <div class="item-row-handle-sortable">
                                          <i class="fa fa-ellipsis-v"></i>
                                      </div>
                                      <div class="item-row-title">Author Name</div>
                                      <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                                      <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                                  </div>
                                  <div class="item-row-fields">
                                      <div class="media-upload" data-url="'.$this->context->link->getAdminLink('AdminGdzpagebuilderMedia').'">
                                          <div class="media-image-preview media-preview" style="background-image: url('.$this->plh_img.');"></div><div class="media-image-delete">Delete</div>
                                          <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                                      </div>
                                      <input data-root="'.$this->root_url.'" name="image" type="text" class="media-value input-media" value="'.$this->plh_img.'" />
                                      <label>Author</label>
                                      <input type="text" class="repeat-item-title form-control" name="author" value="John Doe" />
                                      <label>Position</label>
                                      <input type="text" name="position" class="form-control" value="Company CEO" />
                                      <label>Rating</label>
                                      <input type="number" name="rating" class="form-control" value="5" min="1" max="5" />
                                      <label>Comment</label>
                                      <textarea name="comment">I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</textarea>
                                  </div>
                              </div>';
                              $html .= '<div class="items-container">';
                              if($field->value) {
                                  foreach ($field->value as $key => $item) {
                                        $html .= '<div class="form-group">
                                                    <div class="item-tools">
                                                        <div class="item-row-handle-sortable">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </div>
                                                        <div class="item-row-title">'.$item->author.'</div>
                                                        <div class="item-row-duplicate"><i class="fa fa-copy"></i></div>
                                                        <div class="item-row-remove remove-media"><i class="fa fa-times"></i></div>
                                                    </div>
                                                    <div class="item-row-fields">
                                                      <div class="media-upload" data-url="'.$this->context->link->getAdminLink('AdminGdzpagebuilderMedia').'">
                                                          <div class="media-image-preview media-preview" style="background-image: url('.$this->root_url.$item->image.')"></div><div class="media-image-delete">Delete</div>
                                                          <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                                                      </div>';
                                                      $html .= '<input data-root="'.$this->root_url.'" name="image" type="text" class="media-value input-media" value="'.$item->image.'" />
                                                      <label>Author</label>
                                                      <input type="text" class="repeat-item-title form-control" name="author" value="'.$item->author.'" />
                                                      <label>Position</label>
                                                      <input type="text" name="position" class="form-control" value="'.$item->position.'" />
                                                      <label>Rating</label>
                                                      <input type="number" name="rating" class="form-control" value="'.$item->rating.'" min="1" max="5" />
                                                      <label>Comment</label>
                                                      <textarea name="comment">'.$item->comment.'</textarea>';
                                        $html .= '</div></div>';
                                  }
                              }
                              $html .= '</div>
                              <button class="add-item btn btn-default">Add Item</button></div>';
                } elseif ($field->type == 'number') {
                    $html .= '<input type="number" value="'.$field->value.'" '.$tag_att;
                }elseif ($field->type == 'range') {
                    $_min = $this->getFieldAttrByName($field->name, 'min');
                    $_max = $this->getFieldAttrByName($field->name, 'max');
                    $html .= '<div class="pb-range-input">';
                    $html .= '<input type="range" class="pb-range" min="'.$_min.'" max="'.$_max.'" />';
                    $html .= '<input type="number" '.$tag_att .' min="'.$_min.'" max="'.$_max.'" value="'.$field->value.'"';
                    $html .= ' /></div>';
                } elseif($field->type == 'screen-range') {
                    if($field->value) {
                      $value_arr = explode("-", $field->value);
                    } else {
                      $value_arr = array('');
                    }
                    $_min = $this->getFieldAttrByName($field->name, 'min');
                    $_max = $this->getFieldAttrByName($field->name, 'max');
                    $html .= '<ul class="pb-device-tabs pb-device-md">
                    <li class="screen-md"><i class="icon-desktop icon-md"></i></li>
                    <li class="screen-sm"><i class="icon-tablet icon-sm"></i></li>
                    <li class="screen-xs"><i class="icon-mobile icon-xs"></i></li>
                    </ul>
                    <div class="pb-screen-inputs pb-device-md">';
                    $html .= '<div class="pb-range-input md">';
                    $html .= '<input type="range" class="pb-range" min="'.$_min.'" max="'.$_max.'" />';
                    $html .= '<input type="number" class="form-control" ';
                    if (isset($value_arr[0])) {
                        $html .= ' value="'.$value_arr[0].'"';
                    }
                    $html .= ' /></div>';
                    $html .= '<div class="pb-range-input sm">';
                    $html .= '<input type="range" class="pb-range" min="'.$_min.'" max="'.$_max.'" />';
                    $html .= '<input type="number" class="form-control" ';
                    if (isset($value_arr[1])) {
                        $html .= ' value="'.$value_arr[1].'"';
                    }
                    $html .= ' /></div>';
                    $html .= '<div class="pb-range-input xs">';
                    $html .= '<input type="range" class="pb-range" min="'.$_min.'" max="'.$_max.'" />';
                    $html .= '<input type="number" class="form-control" ';
                    if (isset($value_arr[2])) {
                        $html .= ' value="'.$value_arr[2].'"';
                    }
                    $html .= ' /></div>';
                    $html .= '</div>';
                    $html .= '<input name="'.$field->name.'" data-field="'.$field->name.'" type="hidden"'.$tag_att.' value="'.$field->value.'" />';
                } elseif($field->type == 'screen-select') {
                    if($field->value) {
                      $value_arr = explode("-", $field->value);
                    } else {
                      $value_arr = array('');
                    }
                    $html .= '<ul class="pb-device-tabs pb-device-md">
                    <li class="screen-md"><i class="icon-desktop icon-md"></i></li>
                    <li class="screen-sm"><i class="icon-tablet icon-sm"></i></li>
                    <li class="screen-xs"><i class="icon-mobile icon-xs"></i></li>
                    </ul>
                    <div class="pb-screen-inputs pb-device-md">';
                    $html .= '<div class="pb-range-input md">';
                    $html .= '<select name="md_select">';
                    $html .= '<option value="1"'.((isset($value_arr[0]) && (int)$value_arr[0] == 1) ? ' selected="selected"' : '').'>1</option>';
                    $html .= '<option value="2"'.((isset($value_arr[0]) && (int)$value_arr[0] == 2) ? ' selected="selected"' : '').'>2</option>';
                    $html .= '<option value="3"'.((isset($value_arr[0]) && (int)$value_arr[0] == 3) ? ' selected="selected"' : '').'>3</option>';
                    $html .= '<option value="4"'.((isset($value_arr[0]) && (int)$value_arr[0] == 4) ? ' selected="selected"' : '').'>4</option>';
                    $html .= '<option value="6"'.((isset($value_arr[0]) && (int)$value_arr[0] == 6) ? ' selected="selected"' : '').'>6</option>';
                    $html .= '</select></div>';
                    $html .= '<div class="pb-range-input sm">';
                    $html .= '<select name="sm_select">';
                    $html .= '<option value="1"'.((isset($value_arr[1]) && (int)$value_arr[1] == 1) ? ' selected="selected"' : '').'>1</option>';
                    $html .= '<option value="2"'.((isset($value_arr[1]) && (int)$value_arr[1] == 2) ? ' selected="selected"' : '').'>2</option>';
                    $html .= '<option value="3"'.((isset($value_arr[1]) && (int)$value_arr[1] == 3) ? ' selected="selected"' : '').'>3</option>';
                    $html .= '<option value="4"'.((isset($value_arr[1]) && (int)$value_arr[1] == 4) ? ' selected="selected"' : '').'>4</option>';
                    $html .= '<option value="6"'.((isset($value_arr[1]) && (int)$value_arr[1] == 6) ? ' selected="selected"' : '').'>6</option>';
                    $html .= '</select></div>';
                    $html .= '<div class="pb-range-input xs">';
                    $html .= '<select name="md_select">';
                    $html .= '<option value="1"'.((isset($value_arr[2]) && (int)$value_arr[2] == 1) ? ' selected="selected"' : '').'>1</option>';
                    $html .= '<option value="2"'.((isset($value_arr[2]) && (int)$value_arr[2] == 2) ? ' selected="selected"' : '').'>2</option>';
                    $html .= '</select></div></div>';
                    $html .= '<input name="'.$field->name.'" data-field="'.$field->name.'" type="hidden"'.$tag_att.' value="'.$field->value.'" />';
                }
                if ($field->type == 'textarea' || $field->type == 'editor') {
                    $html .= '>'.htmlentities(gdzPageBuilderHelper::decodeHTML($field->value)).'</textarea>';
                } elseif ($field->type == 'text' || $field->type == 'checkbox' || $field->type == 'number') {
                    $html .= ' />';
                } elseif($field->type == 'checkbox2') {
                    $html .= ' /></div>';
                }
            }
            if ($_desc) {
                $html .= '<p class="help-block">'.$_desc.'</p>';
            }
            $html .= '</div>';
        }
        $html .= '</div></div>';
        return  $html;
    }
    public function loadTplDir()
    {
        $tpl_dir = _PS_MODULE_DIR_._GDZ_PB_NAME_.'/views/templates/hook/';
        if (file_exists(_PS_THEME_DIR_.'modules/'._GDZ_PB_NAME_.'/views/templates/hook/')) {
            $tpl_dir = _PS_THEME_DIR_.'modules/'._GDZ_PB_NAME_.'/views/templates/hook/';
        }
        return $tpl_dir;
    }
    public function loadTplPath()
    {
        $template = 'addon'.$this->addonname.'.tpl';
        if ($this->overwrite_tpl && Tools::file_exists_cache(_PS_THEME_DIR_.'modules/'._GDZ_PB_NAME_.'/views/templates/hook/'.$this->overwrite_tpl.'.tpl')) {
            return _PS_THEME_DIR_.'modules/'._GDZ_PB_NAME_.'/views/templates/hook/'.$this->overwrite_tpl.'.tpl';
        } elseif ($this->overwrite_tpl && Tools::file_exists_cache(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/views/templates/hook/'.$this->overwrite_tpl.'.tpl')) {
            return _PS_MODULE_DIR_._GDZ_PB_NAME_.'/views/templates/hook/'.$this->overwrite_tpl.'.tpl';
        } elseif (Tools::file_exists_cache(_PS_THEME_DIR_.'modules/'._GDZ_PB_NAME_.'/views/templates/hook/'.$template)) {
            return _PS_THEME_DIR_.'modules/'._GDZ_PB_NAME_.'/views/templates/hook/'.$template;
        } elseif (Tools::file_exists_cache(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/views/templates/hook/'.$template)) {
            return _PS_MODULE_DIR_._GDZ_PB_NAME_.'/views/templates/hook/'.$template;
        } else {
            return '';
        }
    }
    public function getFieldAttr($findex, $attrname)
    {
        $fields = $this->getInputs();
        if (isset($fields[$findex][$attrname])) {
            return $fields[$findex][$attrname];
        } else {
            return null;
        }
    }
    public function getFieldAttrByName($fname, $attrname)
    {
        $fields = $this->getInputs();
        for($i = 0; $i < count($fields); $i++) {
            if($fields[$i]['name'] == $fname && isset($fields[$i][$attrname]))
              return $fields[$i][$attrname];
        }
        return null;
    }
    public function getDesc($findex)
    {
        $fields = $this->getInputs();
        if (isset($fields[$findex]['desc'])) {
            return $fields[$findex]['desc'];
        } else {
            return "";
        }
    }
    public function genConfiguration()
    {
        $html = '<div class="item-inner use-editor-js">';
        $html .= $this->genAddonListFields();
        $html .= '</div>';
        return $html;
    }
    public function defaultValue() {
        $default = $this->getInputs();
        if(!isset($default)) return;
        foreach ($default as $key => $input) {
            $default[$key]['multilang'] = isset($input['lang'])?$input['lang']:0;
            if ((int)$input['lang']) {
                $default[$key]['value'] = array();
                $languages = Language::getLanguages(false);
                foreach ($languages as $language) {
                    $default[$key]['value'][$language['id_lang']] = isset($input['default'])?$input['default']:'';
                }
            } else {
                $default[$key]['value'] = isset($input['default'])?$input['default']:'';
            }
        }
        return $default;
    }
}
