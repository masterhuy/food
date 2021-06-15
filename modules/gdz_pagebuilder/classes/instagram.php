<?php
/**
 *
*/
define('CLIENT_ID', '288659918887532');
define('CLIENT_SECRET', 'df8defcb2252da80ece7d54d5061c88c');
define('REDIRECT_URI', 'https://instagram.jmsthemes.com/');
class Instagram
{

    function __construct($accessToken)
    {
        $this->accessToken = $accessToken;

    }
    function call($method, $url, $params)
    {
        try {
            $curl = curl_init();
            $params = http_build_query($params);
            if ($method == 'POST') {
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_POSTFIELDS => $params
                    ));
            } else {
                $url = $url.'?'.$params;
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                        CURLOPT_SSL_VERIFYPEER => false,
                    ));
            }
            $resp = curl_exec($curl);
            curl_close($curl);
            $rs = json_decode($resp, true);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $rs;
    }
    function getImage($max)
    {
        $result = $this->call(
            'GET',
            'https://graph.instagram.com/me/media',
            array(
                'access_token' => $this->accessToken,
                'fields' => 'id,username,caption,media_type,media_url,permalink,thumbnail_url,timestamp',
            )
        );
        $images = array();
        if (isset($result['data']) && count($result['data'])) {
            foreach ($result['data'] as $key => $media) {
                if ($media['media_type'] == 'IMAGE') {
                    $images[] = $media;
                } elseif ($media['media_type'] == 'CAROUSEL_ALBUM') {
                    $album = $this->call(
                        'GET',
                        "https://graph.instagram.com/{$media['id']}/children",
                        array(
                            'access_token' => $this->accessToken,
                            'fields' => 'id,media_type,media_url,permalink,thumbnail_url,timestamp',
                        )
                    );
                    if (count($album['data'])) {
                        foreach ($album['data'] as $children) {
                            if ($children['media_type'] == "IMAGE") {
                                $images[] = $children;
                                if (count($images) >= $max) {
                                    break;
                                }
                            }
                        }
                    }
                }
                if (count($images) >= $max) {
                    break;
                }
            }
        } else {
        }
        return $images;
    }
    function getProfile()
    {
        $result = $this->call(
            'GET',
            'https://graph.instagram.com/me',
            array(
                'access_token' => $this->accessToken,
                'fields' => 'id,username',
            )
        );
        return $result;
    }
}

 ?>