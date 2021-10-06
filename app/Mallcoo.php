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
        $this->timestamp = date('YmdHis',time());
    }
    public function getSign($arr)
    {
        $publicKey = $this->publicKey;
        $timestamp = $this->timestamp;
        $privateKey = $this->privateKey;
        $jsonData = json_encode($arr);
        $string = "{publicKey:" . $publicKey .
            ",timestamp:" . $timestamp .
            ",data:" . $jsonData .
            ",privateKey:" . $privateKey . "}";
        return strtoupper(substr(md5($string), 8, 16));
    }
    public function getAuthRedirectUri()
    {
        $url = 'https://m.mallcoo.cn/a/open/User/V2/OAuth/BaseInfo/';
        $query = [
            'AppID' => $this->appId,
            'PublicKey' => $this->publicKey,
            'CallbackUrl' => url('/callback'),
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
    public function getUser($ticket)
    {
        $url = 'https://openapi10.mallcoo.cn/User/OAuth/v1/GetToken/ByTicket/';
        $client = new \GuzzleHttp\Client();
        $post_data = json_encode([
            'Ticket'=>$ticket
        ]);
        $sign = $this->getSign($post_data);
        $response = $client->post($url, [
            'header'=>[
                'Content-Type'=>'application/json; charset=utf-8',
                'Content-Length'=>strlen($post_data),
                'AppId'=>$this->appId,
                'TimeStamp'=>$this->timestamp,
                'PublicKey'=>$this->publicKey,
                'Sign'=>$this->sign,
            ],
            'json' => [
                'Ticket' => $this->ticket,
            ]
        ]);
        $content = $response->getBody()->getContents();
        $user = json_decode(html_entity_decode($content), true);
        // $user = new Object();
        return $user;
    }
}
