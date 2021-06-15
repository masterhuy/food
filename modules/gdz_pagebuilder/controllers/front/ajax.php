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
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzPage.php');
require_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzTemplate.php');
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/classes/gdzHelper.php');
class gdz_pagebuilderAjaxModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;
    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();
        $gdz_pagebuilder = Module::getInstanceByName(_GDZ_PB_NAME_);
        if (!Tools::isSubmit('secure_key') || Tools::getValue('secure_key') != $gdz_pagebuilder->secure_key) {
            die(1);
        }
        $configuration = $gdz_pagebuilder->getTemplateVarConfiguration();
        $gdzSetting = gdzPageBuilderHelper::genGdzSetting();
        $action    = Tools::getValue('action');
        $context = Context::getContext();
        if ($action == 'getProduct') {
            include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonproductfilter.php');
            $productfilter = new gdzAddonProductFilter();
            $setting = Tools::getValue('setting');
            $obj = json_decode(json_encode($setting));
            $products = $productfilter->getProducts($obj);
            if(!isset($products) || count($products) == 0) return;
            $view_type = $obj[2]->value;
            if($view_type == 'carousel')
                $cols= $obj[6]->value;
            else
                $cols= $obj[5]->value;
            $cols_arr = array();
            if($cols)
                $cols_arr = explode("-", $cols);
            $context->smarty->assign(
                array(
                    'products_slides' => $products,
                    'gdzSetting' => $gdzSetting,
                    'configuration' => $configuration,
                    'link' => $context->link,
                    'products_slides' => $products,
                    'addon_title' => '',
                    'addon_desc' => '',
                    'producttype' => $obj[0]->value,
                    'cols'  => $cols,
                    'cols_md'   => $cols_arr[0],
                    'cols_sm'   => $cols_arr[1],
                    'cols_xs'   => $cols_arr[2],
                    'navigation' => $obj[8]->value,
                    'pagination' => $obj[9]->value,
                    'autoplay' => $obj[10]->value,
                    'rewind' => $obj[11]->value,
                    'slidebypage' => $obj[12]->value,
                    'gutter' => $obj[4]->value,
                    'view_type' => $view_type
                )
            );
            $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addonproductfilter.tpl");
            echo $html; exit;
        } elseif ($action == 'getCatProducts') {
            include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addoncategoryproduct.php');
            $catproduct = new gdzAddonCategoryProduct();
            $setting = Tools::getValue('setting');
            $obj = json_decode(json_encode($setting));
            $category = $catproduct->getCategory($obj);
            $id_lang = $context->language->id;
            $view_type = $obj[6]->value;
            if($view_type == 'carousel')
                $cols = $obj[10]->value;
            else
                $cols = $obj[9]->value;
            $cols_arr = array();
            if($cols)
                $cols_arr = explode("-", $cols);

            $context->smarty->assign(
                array(
                    'category' => $category ,
                    'gdzSetting' => $gdzSetting,
                    'configuration' => $configuration,
                    'cols_md'   => $cols_arr[0],
                    'cols_sm'   => $cols_arr[1],
                    'cols_xs'   => $cols_arr[2],
                    'navigation' => $obj[12]->value,
                    'pagination' => $obj[13]->value,
                    'autoplay' => $obj[14]->value,
                    'rewind' => $obj[15]->value,
                    'slidebypage' => $obj[16]->value,
                    'gutter' => $obj[8]->value,
                    'showcategoryname' => $obj[3]->value,
                    'showviewall' => $obj[4]->value,
                    'viewall_text' => $obj[5]->value->$id_lang,
                    'view_type' => $view_type,
                )
            );
            $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addoncategoryproduct.tpl");
            echo $html; exit;
        } elseif ($action == 'getProductTab') {
            include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonproducttab.php');
            $producttab = new gdzAddonProductTab();
            $setting = Tools::getValue('setting');
            $obj = json_decode(json_encode($setting));
            $_producttabs = $producttab->getProductTab($obj);
            if(!isset($_producttabs) || count($_producttabs) == 0) return;
            $view_type = $obj[12]->value;
            if($view_type == 'carousel')
                $cols = $obj[17]->value;
            else
                $cols = $obj[15]->value;
            $cols_arr = array();
            if($cols)
                $cols_arr = explode("-", $cols);

            $context->smarty->assign(
                array(
                    'producttabs' => $_producttabs ,
                    'gdzSetting' => $gdzSetting,
                    'configuration' => $configuration,
                    'tab_align'   => $obj[10]->value,
                    'cols_md'   => $cols_arr[0],
                    'cols_sm'   => $cols_arr[1],
                    'cols_xs'   => $cols_arr[2],
                    'navigation' => $obj[18]->value,
                    'pagination' => $obj[19]->value,
                    'autoplay' => $obj[20]->value,
                    'rewind' => $obj[21]->value,
                    'slidebypage' => $obj[22]->value,
                    'gutter' => $obj[14]->value,
                    'view_type' => $view_type
                )
            );
            $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addonproducttab.tpl");
            echo $html; exit;
        } elseif ($action == 'getCategoryTab') {
            include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addoncategorytab.php');
            $categorytab = new gdzAddonCategoryTab();
            $setting = Tools::getValue('setting');
            $obj = json_decode(json_encode($setting));
            $_categories = $categorytab->getCategoryTab($obj);
            if(!isset($_categories) || count($_categories) == 0) return;
            $view_type = $obj[4]->value;
            if($view_type == 'carousel')
                $cols = $obj[9]->value;
            else
                $cols = $obj[7]->value;

            $cols_arr = array();
            if($cols)
                $cols_arr = explode("-", $cols);
            $context->smarty->assign(
                array(
                    'categories' => $_categories ,
                    'gdzSetting' => $gdzSetting,
                    'configuration' => $configuration,
                    'tab_align'   => $obj[3]->value,
                    'cols_md'   => $cols_arr[0],
                    'cols_sm'   => $cols_arr[1],
                    'cols_xs'   => $cols_arr[2],
                    'navigation' => $obj[10]->value,
                    'pagination' => $obj[11]->value,
                    'autoplay' => $obj[12]->value,
                    'rewind' => $obj[13]->value,
                    'slidebypage' => $obj[14]->value,
                    'gutter' => $obj[6]->value,
                    'view_type' => $view_type
                )
            );
            $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addoncategorytab.tpl");
            echo $html; exit;
        } elseif ($action == 'getDeals') {
            include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonhotdeal.php');
            $context = Context::getContext();
            $id_lang = $context->language->id;
            $hotdeal = new gdzAddonHotdeal();
            $setting = Tools::getValue('setting');
            $obj = json_decode(json_encode($setting));
            $_products = $hotdeal->getDeals($obj);
            if(!isset($_products) || count($_products) == 0) return;
            $cols = $obj[4]->value;
            $cols_arr = array();
            if($cols)
                $cols_arr = explode("-", $cols);
            $context->smarty->assign(
                array(
                    'gdzSetting' => $gdzSetting,
                    'configuration' => $configuration,
                    'link' => $context->link,
                    'products' => $_products,
                    'cols'  => $cols,
                    'cols_md'   => $cols_arr[0],
                    'cols_sm'   => $cols_arr[1],
                    'cols_xs'   => $cols_arr[2],
                    'navigation' => $obj[5]->value,
                    'pagination' => $obj[6]->value,
                    'autoplay' => $obj[7]->value,
                    'rewind' => $obj[8]->value,
                    'slidebypage' => $obj[9]->value,
                    'gutter' => $obj[3]->value,
                    'showviewall' => $obj[0]->value,
                    'viewall_text' => $obj[1]->value->$id_lang
                )
            );
            $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addonhotdeal.tpl");
            echo $html; exit;
        } elseif ($action == 'getFlashSales') {
            include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonflashsale.php');
            $context = Context::getContext();
            $id_lang = $context->language->id;
            $flashsale = new gdzAddonFlashSale();
            $setting = Tools::getValue('setting');
            $obj = json_decode(json_encode($setting));
            $_products = $flashsale->getFlashSales($obj);
            if(!isset($_products) || count($_products) == 0) return;
            $cols = $obj[3]->value;
            $cols_arr = array();
            if($cols)
                $cols_arr = explode("-", $cols);
            $expire_time = Configuration::get('GDZ_FLASHSALE_EXPIRETIME');
            $category_id = $obj[0]->value;
            $_category = $flashsale->getFlashCategory($category_id);
            $context->smarty->assign(
                array(
                    'gdzSetting' => $gdzSetting,
                    'configuration' => $configuration,
                    'products' => $_products,
                    'expire_time' => $expire_time,
                    'flash_category' => $_category,
                    'cols'  => $cols,
                    'cols_md'   => $cols_arr[0],
                    'cols_sm'   => $cols_arr[1],
                    'cols_xs'   => $cols_arr[2],
                    'navigation' => $obj[4]->value,
                    'pagination' => $obj[5]->value,
                    'autoplay' => $obj[6]->value,
                    'rewind' => $obj[7]->value,
                    'slidebypage' => $obj[8]->value,
                    'gutter' => $obj[2]->value,
                )
            );
            $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/hook/addonflashsale.tpl");
            echo $html; exit;
        } elseif ($action == 'importTemplate') {
            $context = Context::getContext();
            $id_template = (int)Tools::getValue('id_template');
            $template = new gdzTemplate($id_template);
            $params = $template->params;
            if(Tools::getValue('id_lang')) {
                $id_lang    = (int)Tools::getValue('id_lang');
            } else {
                $id_lang = (int)(Configuration::get('PS_LANG_DEFAULT'));
            }
            $id_shop = $context->shop->id;
            $rows = (array)Tools::jsonDecode($params);
            $bresult = array();
            $b_index = 0;
            foreach ($rows as $key => $row) {
                $row_css = '';
                $row->id = 'row-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                $row_css .= gdzPageBuilderHelper::parseStyleItem('row', $row);
                $row->class = $row->settings->custom_class;
                if($row->settings->animation) {
                  $row->class .= " animated ".$row->settings->animation;
                }
                if(isset($row->settings->content_align) && $row->settings->content_align != '') {
                  $row->class .= " ".$row->settings->content_align."-align";
                }
                if($row->settings->hidden_mobile) {
                  $row->class .= " pb-hidden-xs";
                }
                if($row->settings->hidden_tablet) {
                  $row->class .= " pb-hidden-sm";
                }
                if($row->settings->hidden_desktop) {
                  $row->class .= " pb-hidden-md";
                }
                $bresult[] = $row;
                $columns = $rows[$key]->cols;
                foreach ($columns as $ckey => $column) {
                    $column->id = 'col-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                    $row_css .= gdzPageBuilderHelper::parseStyleItem('column', $column);
                    $column->class = $column->settings->lg_col." ".$column->settings->sm_col." ".$column->settings->xs_col." ".$column->settings->custom_class;
                    if($column->settings->animation) {
                      $column->class .= " animated ".$column->settings->animation;
                    }
                    if(isset($column->settings->content_align) && $column->settings->content_align != '') {
                      $column->class .= " ".$column->settings->content_align."-align";
                    }
                    if($column->settings->hidden_mobile) {
                      $column->class .= " pb-hidden-xs";
                    }
                    if($column->settings->hidden_tablet) {
                      $column->class .= " pb-hidden-sm";
                    }
                    if($column->settings->hidden_desktop) {
                      $column->class .= " pb-hidden-md";
                    }
                    $addons = $column->addons;
                    foreach ($addons as $akey => $addon) {
                        $addon->id = 'addon-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                        $row_css .= gdzPageBuilderHelper::parseStyleItem('addon', $addon);
                        $bresult[$b_index]->cols[$ckey]->addons[$akey]->return_value = gdzPageBuilderHelper::loadAddon($addon);
                    }
                }
                $bresult[$b_index]->style = $row_css;
                $b_index++;

            }
            $context->smarty->assign(
                array(
                    'rows' => $bresult
                )
            );
            $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/admin/preview_rows.tpl");
            $rs = array(
                'html' => $html,
                'params' => $rows,
            );
            die(Tools::jsonEncode($rs));
        } elseif ($action == 'import') {
            $this->ajaxProcessImport();
        }
    }
    public function ajaxProcessImport()
    {
        $rs = array('success' => true);
        $name = Tools::getValue('name');
        $studio = Tools::getValue('studio');
        $dest = _PS_MODULE_DIR_._GDZ_PB_NAME_."/studio/{$studio}/{$name}/";
        $params = [
            'type' => 'import',
            'studio' => $studio,
            'name' =>   $name,
        ];
        if (!file_exists($dest."{$name}.xml")) {
            include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/controllers/admin/GdzPagebuilderEditor.php');
            $studio = new gdzPageBuilderHelper();
            $request = $studio->request($params);
            if ($request['success']) {
                if (!file_exists($dest)) {
                    mkdir($dest, 0777, true);
                }
                if (copy($request['url'], $dest.'tmp.zip')) {
                    $zip = new ZipArchive();

                    if ($zip->open($dest.'tmp.zip') !== true) {
                        $rs['success'] = false;
                        $rs['err'] = $this->module->l("cannot open zip");
                    } else {
                        if ($zip->extractTo($dest)) {
                            $zip->close();
                            unlink($dest.'tmp.zip');
                        }
                        if (file_exists($dest."{$name}.xml") && file_exists($dest."template.json")) {
                            $xml = simplexml_load_file($dest."{$name}.xml");
                            $base_url = (string)$xml->base_url;
                            $json = file_get_contents($dest."template.json");
                            $json = str_replace($base_url, __PS_BASE_URI__, $json);
                            file_put_contents($dest."template.json", $json);
                        }
                    }
                } else {
                    $errors= error_get_last();
                    $rs['success'] = false;
                    $rs['err'] = "fail to copy: {$errors['message']}";
                }
            }
        }

        if (!file_exists($dest."template.json")) {
            $rs['success'] = false;
            $rs['err'] = "template file not found in {$dest}";
        } else {
            $json = file_get_contents($dest."template.json");
            if (file_exists($dest."images")) {
                $this->copyImages($dest."images/");
            }
            $rs['data'] = $this->import($json);
        }
        die(Tools::jsonEncode($rs));
    }
    public function copyImages($folder)
    {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folder.'/'),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            if (!$file->isDir())
            {
                $filePath = $file->getRealPath();
                $dest = _PS_ROOT_DIR_.DIRECTORY_SEPARATOR.substr($filePath, strlen($folder));
                if(!file_exists(dirname($dest))) {
                    mkdir(dirname($dest), 0777, true);
                }
                copy($filePath, $dest);
            }
        }
    }
    public function import($json)
    {
        $context = Context::getContext();
        $rows = (array)Tools::jsonDecode($json);
        $bresult = array();
        $b_index = 0;
        foreach ($rows as $key => $row) {
            $row_css = '';
            $row->id = 'row-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
            $row_css .= gdzPageBuilderHelper::parseStyleItem('row', $row);
            $row->class = $row->settings->custom_class;
            if($row->settings->animation) {
                $row->class .= " animated ".$row->settings->animation;
            }
            if(isset($row->settings->content_align) && $row->settings->content_align != '') {
                $row->class .= " ".$row->settings->content_align."-align";
            }
            if($row->settings->hidden_mobile) {
                $row->class .= " pb-hidden-xs";
            }
            if($row->settings->hidden_tablet) {
                $row->class .= " pb-hidden-sm";
            }
            if($row->settings->hidden_desktop) {
                $row->class .= " pb-hidden-md";
            }
            $bresult[] = $row;
            $columns = $rows[$key]->cols;
            foreach ($columns as $ckey => $column) {
                $column->id = 'col-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                $row_css .= gdzPageBuilderHelper::parseStyleItem('column', $column);
                $column->class = $column->settings->lg_col." ".$column->settings->sm_col." ".$column->settings->xs_col." ".$column->settings->custom_class;
                if($column->settings->animation) {
                    $column->class .= " animated ".$column->settings->animation;
                }
                if(isset($column->settings->content_align) && $column->settings->content_align != '') {
                    $column->class .= " ".$column->settings->content_align."-align";
                }
                if($column->settings->hidden_mobile) {
                    $column->class .= " pb-hidden-xs";
                }
                if($column->settings->hidden_tablet) {
                    $column->class .= " pb-hidden-sm";
                }
                if($column->settings->hidden_desktop) {
                    $column->class .= " pb-hidden-md";
                }
                $addons = $column->addons;
                foreach ($addons as $akey => $addon) {
                    $addon->id = 'addon-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                    $row_css .= gdzPageBuilderHelper::parseStyleItem('addon', $addon);
                    $bresult[$b_index]->cols[$ckey]->addons[$akey]->return_value = gdzPageBuilderHelper::loadAddon($addon);
                }
            }
            $bresult[$b_index]->style = $row_css;
            $b_index++;

        }
        $context->smarty->assign(
            array(
                'rows' => $bresult
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/admin/preview_rows.tpl");
        $rs = array(
            'html' => $html,
            'params' => $rows,
        );
        return $rs;
    }
}
