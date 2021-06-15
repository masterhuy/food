<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Package
{
    public $module;

    public function __construct()
    {
        $this->module = Module::getInstanceByName('gdz_themesetting');
    }
    public function encode($domain, $subscription)
    {
      $myfile = fopen(_PS_MODULE_DIR_."/gdz_themesetting/package.txt", "w") or die("Unable to open file!");
      $txt = base64_encode($domain);
      fwrite($myfile, $txt."\n");
      $txt = base64_encode($subscription);
      fwrite($myfile, $txt);
      fclose($myfile);
    }
    public function decode()
    {
      $code = array();
      $myfile = fopen(_PS_MODULE_DIR_."/gdz_themesetting/package.txt", "r") or die("Unable to open file!");
      while (($line = fgets($myfile)) !== false) {
        $code[] = base64_decode($line);
      }
      fclose($myfile);
      return $code;
    }

    public function deactive()
    {
      $myfile = fopen(_PS_MODULE_DIR_."/gdz_themesetting/package.txt", "w") or die("Unable to open file!");
      fwrite($myfile,"");
      fclose($myfile);
    }
}
