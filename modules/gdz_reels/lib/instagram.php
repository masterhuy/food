<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/**
 * Class RC_Instagram_Api
 */
class RC_Instagram_Api {

    const BASE_URL = 'https://www.instagram.com';
    const LOGIN_URL = 'https://www.instagram.com/accounts/login/ajax/';
    const LOGOUT_URL = 'https://www.instagram.com/accounts/logout/';

    private $_config = [];

    /**
     * @var RC_CacheEngine
     */
    private $cache = false;

    /**
     * @var bool
     */
    private $cacheEnabled = false;

    /**
     * @var array
     */
    private $userSession;

    /**
     * RC_Instagram_Api constructor.
     *
     * @param array $config
     * @param bool $cacheEngine
     */
    public function __construct($config = array(), $cacheEngine = false){
        $this->context = Context::getContext();
        $this->_config = $this->get_default_options();
    }
    private function getCookie($text) {
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $text, $matches);
        $cookies = array();
        foreach($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }
        return $cookies;
    }
    private function saveCookie($cookie) {
        $_SESSION['cookie'] = $cookie;
    }
    private function get_default_options(){
        $defaults = [
            "user-agent"     => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Safari/537.36',
            "cache-timeout"  => 12 * 3600,
            "username"       => 'sontung1223@gmail.com',
            "password"       => 'st231293',
        ];
        return $defaults;
    }
    public function logout(){
        $session = true;
        if(isset($_SESSION['cookie'])){
            $header = $this->generateHeaders($_SESSION['cookie']);
            $response = $this->request(self::LOGOUT_URL , $header, false);
            session_unset();
        }
        return false;
    }
    private function parseCookies($headers) {
        $rawCookies = isset($headers['Set-Cookie']) ? $headers['Set-Cookie'] : (isset($headers['set-cookie']) ? $headers['set-cookie'] : []);

        if (!is_array($rawCookies)) {
            $rawCookies = [$rawCookies];
        }

        $not_secure_cookies = [];
        $secure_cookies = [];

        foreach ($rawCookies as $cookie) {
            $cookie_array = 'not_secure_cookies';
            $cookie_parts = explode(';', $cookie);
            foreach ($cookie_parts as $cookie_part) {
                if (trim($cookie_part) == 'Secure') {
                    $cookie_array = 'secure_cookies';
                    break;
                }
            }
            $value = array_shift($cookie_parts);
            $parts = explode('=', $value);
            if (sizeof($parts) >= 2 && !is_null($parts[1])) {
                ${$cookie_array}[$parts[0]] = $parts[1];
            }
        }

        $cookies = $secure_cookies + $not_secure_cookies;

        if (isset($cookies['csrftoken'])) {
            $this->userSession['csrftoken'] = $cookies['csrftoken'];
        }

        return $cookies;
    }
    public function login($force = false) {

        if($this->_config['username'] === '' || $this->_config['password'] === ''){
            throw new \Exception(__( 'User credentials not provided', 'reelsconnect' ));
        }

        $this->logout();

        $headers = array(
            "user-agent: {$this->_config['user-agent']}",
        );
        $response = $this->request(self::BASE_URL , $headers, false);
        preg_match( '/csrftoken=(.*?);/', $response['header'], $match );
        $csrfToken = isset( $match[1] ) ? $match[1] : '';
        $csrfToken = 'CQCI06AnpRTMnBUWKP9JDTPkaD8GGG18';
        preg_match( '/mid=(.*?);/', $response['header'], $match );
        $mid = isset( $match[1] ) ? $match[1] : '';
        $mid = 'YGRN3AALAAFDbbSN9kAJAjC9csBc';
        $cookieString = 'ig_cb=1';
        if ( $csrfToken !== '' ) {
            $cookieString .= '; csrftoken=' . $csrfToken;
        }
        if ( $mid !== '' ) {
            $cookieString .= '; mid=' . $mid;
        }

        $headers = array(
            "cookie: {$cookieString}",
            "referer: ". self::BASE_URL . '/',
            "x-csrftoken: {$csrfToken}",
            "X-CSRFToken: {$csrfToken}",
            "Content-Type: application/x-www-form-urlencoded",
            "user-agent: {$this->_config['user-agent']}",
        );
        $response = $this->request(self::LOGIN_URL, $headers);
        $cookie = $this->getCookie($response['header']);
        $cookie['mid'] = $mid;
        $this->saveCookie($cookie);
    }

    public function getMediaByUrl($url = ''){
        $header = $this->generateHeaders($_SESSION['cookie']);
        $response = $this->request($url, $header, false);
        $response = Tools::jsonDecode($response['body'], true);
        return $response;
    }

    private function generateHeaders($session, $gisToken = null)
    {
        $headers = [];
        if ($session) {
            $cookies = '';
            foreach ($session as $key => $value) {
                $cookies .= "$key=$value; ";
            }

            $csrf = empty($session['csrftoken']) ? $session['x-csrftoken'] : $session['csrftoken'];

            $headers = array(
                "cookie: {$cookies}",
                "referer: ". self::BASE_URL . '/',
                "x-csrftoken: {$csrf}",
                "X-CSRFToken: {$csrf}",
                "Content-Type: application/x-www-form-urlencoded",
                "user-agent: {$this->_config['user-agent']}",
            );

        }
        return $headers;
    }
    public function request($url, $headers, $post_method = true) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        if ($post_method) {
            curl_setopt($curl, CURLOPT_POST, true);
            $postFields = array();
            $postFields['username'] = 'sontung1223@gmail.com';
            $postFields['enc_password'] = '#PWD_INSTAGRAM_BROWSER:0:' . time() . ':st231293';
            $post = '';
            foreach($postFields as $key => $value) {
                $post .= $key . '=' . urlencode($value) . '&';
            }
            $post = substr($post, 0, -1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }

//for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $rs = array();
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header = substr($resp, 0, $header_size);
        $body = substr($resp, $header_size);
        $rs['header'] = $header;
        $rs['body'] = $body;
        curl_close($curl);
        return $rs;
    }
    private function get_headers_from_curl_response($response)
    {
        $headers = array();
        $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0)
                $headers['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                $headers[$key] = $value;
            }

        return $headers;
    }
}