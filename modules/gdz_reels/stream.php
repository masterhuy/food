<?php

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once(dirname(__FILE__).'/lib/tiktok.php');

$module = Module::getInstanceByName('gdz_reels');
if (!Tools::isSubmit('secure_key') || Tools::getValue('secure_key') != $module->secure_key) {
    $rs['success'] = false;
    $rs['err'] = 'Invalid token';
    die(Tools::jsonEncode($rs));
}
$url = Tools::getValue('url');
$api = new RC_TikTok_Api();
$result = $api->getVideoByUrl($url);
if(isset($result->items[0]->video->playAddr)){
    $api->stream($result->items[0]->video->playAddr);
}
