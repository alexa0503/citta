<?php

namespace App;

class Mallcoo
{
    private $publicKey;
    private $timestamp;
    private $privateKey;
    public function __construct()
    {
        $this->publicKey = env('MALLCOO_PUBLIC_KEY');
        $this->privateKey = env('MALLCOO_PRIVATE_KEY');
        $this->appId = env('MALLCOO_APPID');
        $this->timestamp = date('YmdHis', time());
    }
    public function getSign($jsonData)
    {
        $publicKey = $this->publicKey;
        $timestamp = $this->timestamp;
        $privateKey = $this->privateKey;
        $string = "{publicKey:" . $publicKey . ",timeStamp:" . $timestamp . ",data:" . $jsonData . ",privateKey:" . $privateKey . "}";
        $md5 = strtoupper(substr(md5($string), 8, 16));
        return $md5;
    }
    public function oAuthRedirectUri($token = null)
    {
        $url = '/pages/oauth/oauth';
        $query = [
            'OAppID' => $this->appId,
            'OPublicKey' => $this->publicKey,
            'OIsMember' => 1
            // 'CallbackUrl' => url('/callback?token='.$token),
        ];
        $url .= '?' . http_build_query($query);
        return $url;
        // $client = new \GuzzleHttp\Client();
        // $client->get('http://httpbin.org/get', [
        //     'query' => [
        //         'AppID' => $this->appId,
        //         'PublicKey' => $this->publicKey,
        //         'CallbackUrl' => urlencode(url('/callback')),
        //     ]
        // ]);
    }
    public function fetchUser($ticket)
    {
        $url = 'https://openapi10.mallcoo.cn/User/OAuth/v1/GetToken/ByTicket/';
        $client = new \GuzzleHttp\Client();
        $post_data = json_encode([
            'Ticket' => $ticket
        ]);
        $sign = $this->getSign($post_data);
        $headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Content-Length' => strlen($post_data),
            'AppId' => $this->appId,
            'TimeStamp' => $this->timestamp,
            'PublicKey' => $this->publicKey,
            'Sign' => $sign,
        ];
        $response = $client->post($url, [
            'headers' => $headers,
            'json' => [
                'Ticket' => $ticket,
            ]
        ]);
        $content = $response->getBody()->getContents();
        $response_data = json_decode(html_entity_decode($content), true);
        if ($response_data['Code'] === 1) {
            return $response_data['Data'];
        } else {
            return null;
        }
    }
    public function fetcUserPoints($user_id)
    {
        $url = 'https://openapi10.mallcoo.cn/User/Score/v2/Get/Records/';
        $client = new \GuzzleHttp\Client();
        $post_data = json_encode([
            'OpenUserID' => $user_id
        ]);
        $sign = $this->getSign($post_data);
        $headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Content-Length' => strlen($post_data),
            'AppId' => $this->appId,
            'TimeStamp' => $this->timestamp,
            'PublicKey' => $this->publicKey,
            'Sign' => $sign,
        ];
        $response = $client->post($url, [
            'headers' => $headers,
            'json' => [
                'OpenUserID' => $user_id,
            ]
        ]);
        $content = $response->getBody()->getContents();
        $response_data = json_decode(html_entity_decode($content), true);
        if ($response_data['Code'] === 1) {
            return $response_data['Data']['ScoreDetailModel'];
        } else {
            return [];
        }
    }
    //获取券列表
    public function fetchCoupons()
    {
        $url = 'https://openapi10.mallcoo.cn/Coupon/PutIn/v4/GetAll/';
        $client = new \GuzzleHttp\Client();
        $post_data = [
            'PageSize' => 20,
            'PageIndex' => 1
        ];
        $sign = $this->getSign(json_encode($post_data));
        $headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Content-Length' => strlen(json_encode($post_data)),
            'AppId' => $this->appId,
            'TimeStamp' => $this->timestamp,
            'PublicKey' => $this->publicKey,
            'Sign' => $sign,
        ];
        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $post_data
        ]);
        $content = $response->getBody()->getContents();
        $response_data = json_decode(html_entity_decode($content), true);
        if ($response_data['Code'] === 1) {
            return $response_data['Data'];
        } else {
            return [];
        }
    }
    //用户券发送
    public function sendCoupon($user, $coupon = 1)
    {
        $url = 'https://openapi10.mallcoo.cn/Coupon/v2/Send/ByOpenUserID/';
        $client = new \GuzzleHttp\Client();
        $post_data = [
            'UserList' => [
                [
                    'BussinessID' => null,
                    'TraceID' => str_pad(env('MALLCOO_APPID') . $user->id . $coupon, 20, "0", STR_PAD_LEFT),
                    'PICMID' => env('MALLCOO_PICMID_'.$coupon),
                    'OpenUserID' => $user->mallcoo_id
                ]
            ]
        ];
        $sign = $this->getSign(json_encode($post_data));
        $headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Content-Length' => strlen(json_encode($post_data)),
            'AppId' => $this->appId,
            'TimeStamp' => $this->timestamp,
            'PublicKey' => $this->publicKey,
            'Sign' => $sign,
        ];
        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $post_data
        ]);
        $content = $response->getBody()->getContents();
        $response_data = json_decode(html_entity_decode($content), true);
        if ($response_data['Code'] === 1) {
            return $response_data['Data'][0];
        } else {
            return null;
        }
    }
}
