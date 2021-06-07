<?php

/**
 * Class RC_TikTok_Api
 */
class RC_TikTok_Api {
    private $_config = [];

    private $cache = false;

    private $cacheEnabled = false;

    protected $headers_sent = false;

    private $defaults = [
        "user-agent"     => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36',
        "proxy-host"     => false,
        "proxy-port"     => false,
        "proxy-username" => false,
        "proxy-password" => false,
        "cache-timeout"  => 3600, // in seconds
    ];

    public function __construct($config = array()){
        $this->_config = array_merge(['cookie_file' => sys_get_temp_dir().DIRECTORY_SEPARATOR . 'tiktok.txt'], $this->defaults, $config);
        if (isset($cacheEngine) && $cacheEngine) {
            $this->cacheEnabled = true;
            $this->cache        = $cacheEngine;
        }
    }

    public function getVideoBySnaptik($url = ''){
        if (!preg_match("/https?:\/\/([^\.]+)?\.tiktok\.com/", $url)) {
            throw new \Exception("Invalid VIDEO URL");
        }
        $snaptik = 'https://snaptik.app/action.php';
        $response = wp_remote_post( $snaptik ,array(
            'body' => array(
                'url' => $url
            ),
        ));

        if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
            return false;
        }
        $response  = wp_remote_retrieve_body( $response );

        if(preg_match("/https?:\/\/[^\.]+\.tiktokcdn\.com(\/[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)?/",$response, $matches)){
            return $matches[0];
        }
        return false;
    }

    public function getVideoByUrl($url = ''){
        if (!preg_match("/https?:\/\/([^\.]+)?\.tiktok\.com/", $url)) {
            throw new \Exception("Invalid VIDEO URL");
        }
        /*$response = wp_remote_get( $url , array(
            'referer' => 'https://www.tiktok.com/foryou?lang=en',
            'user-agent' => $this->_config['user-agent']
        ));

        if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
            return false;
        }
        $response  = wp_remote_retrieve_body( $response );*/
        $response      = $this->remote_call($url, $this->normalize($url), false);
        $result = $this->string_between($response, '{"props":{"initialProps":{', "</script>");
        if (!empty($result)) {
            $jsonData = json_decode('{"props":{"initialProps":{' . $result);
            if (isset($jsonData->props->pageProps->itemInfo)) {
                return (object) [
                    'statusCode' => 0,
                    'info'       => (object) [
                        'type'   => 'video',
                        'detail' => $url,
                    ],
                    "items"      => [$jsonData->props->pageProps->itemInfo->itemStruct],
                    "hasMore"    => false,
                    "minCursor"  => '0',
                    "maxCursor"  => ' 0',
                ];
            }
        }
        return false;
    }

    public function bodyCallback($ch, $data) {
        if (true) {
            echo $data;
            flush();
        }
        return strlen($data);
    }

    protected function sendHeader($header) {
        header($header);
    }

    public function headerCallback($ch, $data) {
        if (preg_match('/HTTP\/[\d.]+\s*(\d+)/', $data, $matches)) {
            $status_code = $matches[1];

            if (200 == $status_code || 206 == $status_code || 403 == $status_code || 404 == $status_code) {
                $this->headers_sent = true;
                $this->sendHeader(rtrim($data));
            }
        } else {

            $forward = ['content-type', 'content-length', 'accept-ranges', 'content-range'];

            $parts = explode(':', $data, 2);

            if ($this->headers_sent && count($parts) == 2 && in_array(trim(strtolower($parts[0])), $forward)) {
                $this->sendHeader(rtrim($data));
            }
        }

        return strlen($data);
    }

    public function stream($url) {
        $ch = curl_init();
        $buffer_size = 256 * 1024;
        $headers   = [];
        if (isset($_SERVER['HTTP_RANGE'])) {
            $headers[] = 'Range: ' . $_SERVER['HTTP_RANGE'];
        }
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_BUFFERSIZE, $buffer_size);
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->_config['user-agent']);
        curl_setopt($ch, CURLOPT_REFERER, "https://www.tiktok.com/");
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_config['cookie_file']);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_config['cookie_file']);

        curl_setopt($ch, CURLOPT_HEADERFUNCTION, [$this, 'headerCallback']);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, [$this, 'bodyCallback']);

        $ret = curl_exec($ch);
        curl_close($ch);
        return true;
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

    public function normalize($string)
    {
        $string = preg_replace("/([^a-z0-9])/", "-", strtolower($string));
        $string = preg_replace("/(\s+)/", "-", strtolower($string));
        $string = preg_replace("/([-]+){2,}/", "-", strtolower($string));
        return $string;
    }
    private function remote_call($url = "", $cacheKey = false, $isJson = true)
    {
        if ($this->cacheEnabled) {
            if ($this->cache->get($cacheKey)) {
                return $this->cache->get($cacheKey);
            }
        }
        $ch      = curl_init();
        $options = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT      => $this->_config['user-agent'],
            CURLOPT_ENCODING       => "utf-8",
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_HTTPHEADER     => [
                'Referer: https://www.tiktok.com/foryou?lang=en',
            ],
            CURLOPT_COOKIEJAR      => $this->_config['cookie_file'],
        ];
        if (file_exists($this->_config['cookie_file'])) {
            curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_config['cookie_file']);
        }
        curl_setopt_array($ch, $options);
        if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }
        if ($this->_config['proxy-host'] && $this->_config['proxy-port']) {
            curl_setopt($ch, CURLOPT_PROXY, $this->_config['proxy-host'] . ":" . $this->_config['proxy-port']);
            if ($this->_config['proxy-username'] && $this->_config['proxy-password']) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->_config['proxy-username'] . ":" . $this->_config['proxy-password']);
            }
        }
        $data = curl_exec($ch);
        curl_close($ch);
        if ($isJson) {
            $data = json_decode($data);
        }
        if ($this->cacheEnabled) {
            $this->cache->set($cacheKey, $data, $this->_config['cache-timeout']);
        }
        return $data;
    }

}