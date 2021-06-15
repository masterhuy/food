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
class AdminGdzpagebuilderMediaController extends ModuleAdminControllerCore
{
    public function __construct()
    {
        $this->name = _GDZ_PB_NAME_;
        $this->tab = 'front_office_features';
        $this->bootstrap = true;
        $this->lang = true;
        $this->context = Context::getContext();
        $this->secure_key = Tools::encrypt($this->name);
        $_controller = Tools::getValue('controller');
        $this->classname = $_controller;
        $this->media_folder = 'img/cms/';
        $this->media_path = _PS_ROOT_DIR_.'/'.$this->media_folder;
        $this->root_url = gdzPageBuilderHelper::getRootUrl();
        $this->folders_html = '';
        parent::__construct();
    }
    public function renderList()
    {
        $this->_html = '';
        /* Validate & process */
        if (Tools::isSubmit('submitImage')) {
            if ($this->_postValidation()) {
                $this->_postProcess();
                $this->_html .= $this->renderMediaForm();
            }
        } else {
            $this->_html .= $this->renderMediaForm();
        }
        return $this->_html;
    }

    private function _postValidation()
    {
        $errors = array();
        if (count($errors)) {
            $this->_html .= Tools::displayError(implode('<br />', $errors));
            return false;
        }

        /* Returns if validation is ok */
        return true;
    }
    private function _postProcess()
    {
        $errors = array();
        if (Tools::isSubmit('submitImage')) {
            $uploadOk = 1;
            $current_folder = Tools::getValue('current_folder');
            $current_path = $this->media_path.'/'.$current_folder.'/';
            $target_file = $current_path.$_FILES['newfile']['name'];
            $type = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check file size
            if ($_FILES["newfile"]["size"] > gdzPageBuilderHelper::returnBytes(ini_get('upload_max_filesize'))) {
                $errors[] = Tools::displayError($this->l('your file is too large.'));
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $errors[] = Tools::displayError($this->l('Sorry, file already exists.'));
                $uploadOk = 0;
            }
            if (!in_array($type, array('jpg','png','gif'))) {
                $errors[] = Tools::displayError($this->l('File Type is not allowed.'));
                $uploadOk = 0;
            }
            if ($uploadOk == 1) {
                if (!move_uploaded_file($_FILES["newfile"]["tmp_name"], $target_file)) {
                    $errors[] = Tools::displayError($this->l('An error occurred during the image upload process.'));
                }
            }
        }

        if (count($errors)) {
            $this->_html .= Tools::displayError(implode('<br />', $errors));
        } else {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminGdzpagebuilderMedia', true).'&conf=18&fid='.Tools::getValue('fid'));
        }
    }
    public function listFiles($folder)
    {
        if ($folder) {
            $folder_path =  $this->media_path.'/'.$folder.'/';
        } else {
            $folder_path =  $this->media_path;
        }

        $ffs = scandir($folder_path);
        $result = array();
        $i = 0;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        foreach ($ffs as $ff) {
            $ext = pathinfo($ff, PATHINFO_EXTENSION);
            if (!is_dir($folder_path.$ff) && in_array($ext, $this->file_allowed)) {
                $result[$i]['name'] = $ff;
                $result[$i]['src'] = Context::getContext()->shop->physical_uri.$this->media_folder.$ff;
                $result[$i]['type'] = $ext;
                $result[$i]['size'] = round(filesize($folder_path.$ff)/1024, 2);
                if (in_array($ext, array('jpg','png','gif','jpeg'))) {
                    $dimensions = getimagesize($folder_path.$ff);
                    $result[$i]['width'] = $dimensions[0];
                    $result[$i]['height'] = $dimensions[1];
                }
                $result[$i]['perm'] = gdzPageBuilderHelper::getFilePermission($folder_path.$ff);
                $result[$i]['finfo'] = finfo_file($finfo, $folder_path.$ff);
                $i++;
            }
        }
        return $result;
    }
    public function listFolders($folder)
    {
        $ffs = scandir($this->media_path.'/'.$folder);
        $result = array();
        $i = 0;
        foreach ($ffs as $ff) {
            if (is_dir($this->media_path.'/'.$folder.'/'.$ff)) {
                if ($ff != '.' && $ff != '..') {
                    $result[$i]['name'] = $ff;
                    $result[$i]['perm'] = gdzPageBuilderHelper::getFilePermission($this->media_path.'/'.$folder.'/'.$ff);
                    $i++;
                }
            }
        }
        return $result;
    }
    public function listFolderTree($dir)
    {
        $ffs = scandir($dir);
        $this->folders_html .= '<ul>';
        foreach ($ffs as $ff) {
            $ff_path = $dir.'/'.$ff;
            $folder = Tools::substr($ff_path, Tools::strlen($this->media_path)+1, Tools::strlen($ff_path));
            if ($ff != '.' && $ff != '..') {
                if (is_dir($dir.'/'.$ff)) {
                    $url = $this->context->link->getAdminLink('AdminGdzpagebuilderPages', true).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&current_folder='.$folder;
                    $this->folders_html .= '<li><a href="'.$url.'"><i class="icon-folder"></i>'.$ff;
                    if (gdzPageBuilderHelper::hasSubDir($ff_path)) {
                        $this->folders_html .= '<span class="sys-plus">+</span>';
                    }
                    $this->folders_html .= '</a>';
                    $this->listFolderTree($dir.'/'.$ff);
                    $this->folders_html .= '</li>';
                }
            }
        }
        $this->folders_html .= '</ul>';
    }
    public function renderMediaForm()
    {
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/css/media.css', 'all');
        $current_folder = Tools::getValue('current_folder');
        $fid = Tools::getValue('fid');
        $previous_folder = '';
        if ($current_folder) {
            $pos = (int)strrpos($current_folder, '/');
            $previous_folder = Tools::substr($current_folder, 0, $pos);
        }
        $this->file_allowed =  explode(",", 'jpg,png,gif');

        $this->listFolderTree($this->media_path);
        $folders = $this->listFolders($current_folder);
        $files = $this->listFiles($current_folder);
        $tpl = $this->createTemplate('explorerform.tpl');
        $tpl->assign(array(
                'link' => $this->context->link,
                'fid' => Tools::getValue('fid'),
                'current_folder' => $current_folder,
                'folders_html' => $this->folders_html,
                'folders' => $folders,
                'files' => $files,
                'previous_folder' =>  $previous_folder,
                'fid' => $fid,
                'media_folder' => $this->media_folder,
                'file_url' => $this->root_url.$this->media_folder,
                'root_url' => $this->root_url
            ));
        die($tpl->fetch());
    }
}
