<?php

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once(dirname(__FILE__).'/object/Reel.php');


$module = Module::getInstanceByName('gdz_reels');
$context = Context::getContext();
$rs = array('success' => true);

if (!Tools::isSubmit('secure_key') || Tools::getValue('secure_key') != $module->secure_key) {
    $rs['success'] = false;
    $rs['err'] = 'Invalid token';
    die(Tools::jsonEncode($rs));
}

$action = Tools::getValue('action');
switch ($action) {
    case 'addProduct':
        $id_lookbook = (int)Tools::getValue('id_lookbook');
        $id_product = (int)Tools::getValue('product');
        $duration = (int)Tools::getValue('duration');
        $lookbook = new gdzLookBook($id_lookbook);
        if (!Validate::isLoadedObject($lookbook)) {
            $rs['success'] = false;
            $rs['err'] = 'Look book not found';
            die(Tools::jsonEncode($rs));
        }
        if ($lookbook->isProductExist($id_product)) {
            $rs['success'] = false;
            $rs['err'] = 'This product is exist';
            die(Tools::jsonEncode($rs));
        }
        try {
            $product = new product($id_product);
            $product->duration = $duration;
            $rs['success'] = $lookbook->addProduct($product);

            $template = $context->smarty->createTemplate(
                _PS_MODULE_DIR_ . $module->name.'/views/templates/hook/product.tpl'
            );
            $template->assign(array(
                'product' => $product,
                'id_lang' => $context->language->id,
            ));
            $rs['html'] = $template->fetch();
        } catch (Exception $e) {
            $rs['success'] = false;
            $rs['err'] = $e->getMessage();
        }
        die(Tools::jsonEncode($rs));
        # code...
        break;

    case 'deleteProduct':
        $id_lookbook = (int)Tools::getValue('id_lookbook');
        $id_product = (int)Tools::getValue('id_product');
        $lookbook = new gdzLookBook($id_lookbook);
        if (!Validate::isLoadedObject($lookbook)) {
            $rs['success'] = false;
            $rs['err'] = 'Look book not found';
            die(Tools::jsonEncode($rs));
        }
        try {
            $rs['success'] = $lookbook->deleteProduct($id_product);
        } catch (Exception $e) {
            $rs['success'] = false;
            $rs['err'] = $e->getMessage();
        }
        die(Tools::jsonEncode($rs));
        break;
    case 'updateProduct':
        $id_lookbook = (int)Tools::getValue('id_lookbook');
        $id_product = (int)Tools::getValue('id_product');
        $duration = (int)Tools::getValue('duration');
        $lookbook = new gdzLookBook($id_lookbook);
        if (!Validate::isLoadedObject($lookbook)) {
            $rs['success'] = false;
            $rs['err'] = 'Look book not found';
            die(Tools::jsonEncode($rs));
        }
        try {
            $rs['success'] = $lookbook->updateProduct($id_product, $duration);
        } catch (Exception $e) {
            $rs['success'] = false;
            $rs['err'] = $e->getMessage();
        }
        die(Tools::jsonEncode($rs));
        break;
    case 'deleteReel':
        $id_reel = (int)Tools::getValue('id_reel');
        $reel = new gdzReel($id_reel);
        if (!Validate::isLoadedObject($reel)) {
            $rs['success'] = false;
            $rs['err'] = 'Reel not found';
            die(Tools::jsonEncode($rs));
        }
        try {
            $reel->delete();
        } catch (Exception $e) {
            $rs['success'] = false;
            $rs['err'] = $e->getMessage();
        }
        die(Tools::jsonEncode($rs));
        break;
    case 'addLookbook':
        $id_reel = (int)Tools::getValue('id_reel');
        $reel = new gdzReel($id_reel);
        if (!Validate::isLoadedObject($reel)) {
            $rs['success'] = false;
            $rs['err'] = 'Reel not found';
            die(Tools::jsonEncode($rs));
        }
        try {
            $lookbook = $reel->addLookbook();
            $products = gdzReel::getProductList();
            $template = $context->smarty->createTemplate(
                _PS_MODULE_DIR_ . $module->name.'/views/templates/hook/lookbook.tpl'
            );
            $template->assign(array(
                'lookbook' => $lookbook,
                'products' => $products,
                'secure_key' => $module->secure_key,
                'link' => $context->link,
            ));
            $rs['success'] = true;
            $rs['html'] = $template->fetch();
        } catch (Exception $e) {
            $rs['success'] = false;
            $rs['err'] = $e->getMessage();
        }
        die(Tools::jsonEncode($rs));
        break;
    case 'deleteLookbook':
        $id_reel = (int)Tools::getValue('id_reel');
        $id_lookbook = (int)Tools::getValue('id_lookbook');
        $reel = new gdzReel($id_reel);
        if (!Validate::isLoadedObject($reel)) {
            $rs['success'] = false;
            $rs['err'] = 'Reel not found';
            die(Tools::jsonEncode($rs));
        }
        try {
            $rs['success'] = $reel->deleteLookbook($id_lookbook);
        } catch (Exception $e) {
            $rs['success'] = false;
            $rs['err'] = $e->getMessage();
        }
        die(Tools::jsonEncode($rs));
        break;
    default:
        # code...
        break;
}


