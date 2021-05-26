<?php
/**
 *
 */
include_once(dirname(__FILE__).'/LookBook.php');
include_once(dirname(__FILE__).'/../lib/tiktok.php');
include_once(dirname(__FILE__).'/../lib/instagram.php');
class gdzReel extends ObjectModel
{
    public $name;
    public $id_shop;
    public $url;
    public $autoplay;
    public $video_position;
    public $type;
    public $animate;
    public $video_width;

    public static $definition = array(
        'table' => 'gdz_reel',
        'primary' => 'id_reel',
        'multilang' => false,
        'fields' => array(
            'name' =>  array('type' => self::TYPE_STRING),
            'url' =>  array('type' => self::TYPE_STRING, 'required' => true),
            'id_shop' =>    array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt'),
            'autoplay' =>    array('type' => self::TYPE_BOOL),
            'video_position' =>  array('type' => self::TYPE_STRING),
            'animate' =>  array('type' => self::TYPE_STRING),
            'type' =>  array('type' => self::TYPE_STRING),
            'video_width' => array('type' => self::TYPE_INT),
        )
    );

    public function __construct($id = null, $id_lang = null, $id_shop = null)
    {
        parent::__construct($id, $id_lang, $id_shop);
        $this->prefix = _DB_PREFIX_;
    }
    public function delete()
    {
        $this->deleteProducts();
        $this->deleteLookBooks();
        return parent::delete();
    }
    public function deleteProducts()
    {
        $db = Db::getInstance();
        $prefix = _DB_PREFIX_;
        $sql = "DELETE lp FROM {$prefix}gdz_lookbook_product lp
        INNER JOIN {$prefix}gdz_lookbook l ON lp.id_lookbook = l.id_lookbook
        WHERE l.id_reel = {$this->id}";
        return $db->query($sql);
    }
    public function deleteLookBooks()
    {
        return Db::getInstance()->delete(
            'gdz_lookbook',
            "id_reel = {$this->id}"
        );
    }
    public function deleteLookBook($id_lookbook)
    {
        $lookbook = new gdzLookBook($id_lookbook);
        return $lookbook->delete();
    }
    public static function getList()
    {
        $db = Db::getInstance();
        $prefix = _DB_PREFIX_;
        $sql = "SELECT * FROM {$prefix}gdz_reel";
        $rs = $db->executeS($sql);
        return ObjectModel::hydrateCollection('gdzReel', $rs);
    }
    public static function getProductList()
    {
        $db = Db::getInstance();
        $prefix = _DB_PREFIX_;
        $context = Context::getContext();
        $sql = "SELECT p.id_product, pl.name FROM {$prefix}product p
        INNER JOIN {$prefix}product_lang pl ON p.id_product = pl.id_product
        WHERE pl.id_shop = {$context->shop->id} AND pl.id_lang = {$context->language->id}";
        $rs = $db->executeS($sql);
        return $rs;
    }
    public function getVideo()
    {
        $rs = array('success' => true);
        if (empty($this->url)) {
            $rs['success'] = false;
            $rs['err'] = 'Empty url';
            return $rs;
        }
        $instagram = '/instagram.com/';
        $facebook = '/facebook.com/';
        $youtube    = '/^https?:\/\/(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)(.*)/';
        $vimeo = '/^https?:\/\/vimeo\.com\/(.*)/';
        $tiktok = '/tiktok\.com.*\/video\/\d*/';
        $match = array();
        if (preg_match($instagram, $this->url)) {
            // $curlSession = curl_init();
            $params = preg_match('/\/$/', $this->url)?'?__a=1':'/?__a=1';
            $params = preg_match('/\?__a=1$/', $this->url)?'':$params;
            $a = new RC_Instagram_Api();
            $a->login();
            $json = $a->getMediaByUrl($this->url.$params);
            // curl_setopt($curlSession, CURLOPT_URL, $this->url.$params);
            // curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
            // curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
            // $json = json_decode(curl_exec($curlSession), true);
            // curl_close($curlSession);
            try {
                if (isset($json['graphql']['shortcode_media']['video_url'])) {
                    $rs['url'] = $json['graphql']['shortcode_media']['video_url'];
                    $rs['preview'] = $json['graphql']['shortcode_media']['display_url'];
                    $rs['type'] = 'video';
                } else {
                    $rs['success'] = false;
                    $rs['err'] = 'Url not found';
                }
            } catch (Exception $e) {
                $rs['success'] = false;
                $rs['err'] = $e->getMessage();
            }
        } elseif (preg_match($facebook, $this->url)) {
            $id_pattern = '/videos\/(\d+)+|v=(\d+)|vb.\d+\/(\d+)/';
            $isFbUrl = preg_match($id_pattern, $this->url, $match);
            if ($isFbUrl) {
                $id = null;
                if (!empty($match[1])) {
                    $id = $match[1];
                } elseif (!empty($match[2])) {
                    $id = $match[2];
                } elseif (!empty($match[3])) {
                    $id = $match[3];
                }
                if ($id) {
                    $url = "https://www.facebook.com/video.php?v={$id}";
                    $curlSession = curl_init();
                    curl_setopt($curlSession, CURLOPT_URL, $this->url);
                    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
                    curl_setopt($curlSession, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
                    curl_setopt($curlSession, CURLOPT_AUTOREFERER, true);
                    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curlSession, CURLOPT_FOLLOWLOCATION, 1);
                    $response = curl_exec($curlSession);
                    curl_close($curlSession);
                    if (preg_match('/hd_src:"([^"]*)"/', $response, $match)) {
                        $rs['url'] = $match[1];
                        $rs['type'] = 'video';
                    } elseif (preg_match('/data-store="([^"]*)" data-sigil="inlineVideo"/', $response, $match)) {
                        $video = json_decode(html_entity_decode($match[1]), true);
                        $rs['url'] = $video['src'];
                        $rs['type'] = 'video';
                    } else {
                        $rs['success'] = false;
                        $rs['err'] = 'Video src not found';
                    }
                } else {
                    $rs['success'] = false;
                    $rs['err'] = 'Video ID not found';
                }
            } else {
                $rs['success'] = false;
                $rs['err'] = 'Video ID not found';
            }

        } elseif (preg_match($youtube, $this->url, $match)) {
            $id = $match[1];
            $rs['url'] = "https://www.youtube.com/embed/{$id}";
            $rs['code'] = '<iframe src="'.$rs['url'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            $rs['type'] = 'embed';
        } elseif (preg_match($vimeo, $this->url, $match)) {
            $id = $match[1];
            $rs['url'] = "https://player.vimeo.com/video/{$id}";
            $rs['code'] = '<iframe src="'.$rs['url'].'" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
            $rs['type'] = 'embed';
        } elseif (preg_match($tiktok, $this->url, $match)) {
            $response = $this->request($this->url);
            $result = $this->string_between($response, '{"props":{"initialProps":{', "</script>");
            if (!empty($result)) {
                $jsonData = json_decode('{"props":{"initialProps":{' . $result, true);
                if (isset($jsonData['props']['pageProps']['itemInfo']) && isset($jsonData['props']['pageProps']['itemInfo']['itemStruct'])) {
                    $module = Module::getInstanceByName('gdz_reels');
                    $rs['url'] = $module->getBaseUrl()."modules/{$module->name}/stream.php?url={$this->url}&secure_key={$module->secure_key}";
                    $rs['type'] = 'video';
                } else {
                    $rs['success'] = false;
                    $rs['err'] = 'Video src not found';
                }
            }
        } else {
            $rs['success'] = false;
            $rs['err'] = 'Url not detected';
        }
        return $rs;
    }
    public function string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini    = strpos($string, $start);
        if (0 == $ini) {
            return '';
        }

        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    public function getLookBook()
    {
        $sql = "SELECT * FROM {$this->prefix}gdz_lookbook
        WHERE id_reel = {$this->id}";
        $rs = Db::getInstance()->executeS($sql);
        $lookbooks = array();
        foreach ($rs as $row) {
            $lookbook = new gdzLookBook($row['id_lookbook'], true);
            $lookbooks[] = $lookbook;
        }
        $this->lookbooks = $lookbooks;
    }
    public function addLookBooks()
    {
        $lookbook1 = new gdzLookBook();
        $lookbook1->id_reel = $this->id;
        $lookbook2 = new gdzLookBook();
        $lookbook2->id_reel = $this->id;
        $lookbook1->add();
        $lookbook2->add();
    }
    public function addLookbook()
    {
        $lookbook = new gdzLookBook();
        $lookbook->id_reel = $this->id;
        $lookbook->add();
        return $lookbook;
    }
    public function request($url)
    {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($curlSession, CURLOPT_AUTOREFERER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($curlSession);
        curl_close($curlSession);
        return $response;
    }

}

 ?>