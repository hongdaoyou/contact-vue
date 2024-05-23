<?php

require_once  'vendor/autoload.php';

use think\Request;
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

class FriendTest extends TestCase
{
    public function test_add_friend()
    {
        $client = new Client(['verify'=>false] );
        
        // 参数
        $data = [
            'userName'=>'h113',
            'phone'=>'123',
            'addr'=>'addr1',
            'comment'=>'comm1'
        ];

        // 发送http请求
        $response = $client->post('https://localhost/contact/index/index/friend/add_friend', ['json'=> $data]);
        $ret = $response->getBody()->getContents();
        $ret = json_decode($ret, true);

        // 期望值
        $expectRet = SUCCESS;
        $this->assertEquals($expectRet, $ret['result']);
    }

    public function test_get_friend_list()
    {
        $client = new Client(['verify'=>false] );
        
        // 参数
        $data = [
            'start'=>'0',
            'num'=>'10',
        ];

        // 发送http请求
        $response = $client->post('https://localhost/contact/index/index/friend/get_friend_list', ['json'=> $data]);
        $ret = $response->getBody()->getContents();
        $ret = json_decode($ret, true);

        // 期望值
        $expectRet = SUCCESS;
        $this->assertEquals($expectRet, $ret['result']);
    }


    public function test_update_friend() {
        $client = new Client(['verify'=>false] );
        
        // 参数
        $data = [
            'uid'=>'2',
            'userName'=>'h113',
            'phone'=>'123',
            'addr'=>'addr2',
            'comment'=>'comm1'
        ];

        // 发送http请求
        $response = $client->post('https://localhost/contact/index/index/friend/update_friend', ['json'=> $data]);
        $ret = $response->getBody()->getContents();
        // var_dump($ret);
        $ret = json_decode($ret, true);

        // 期望值
        $expectRet = SUCCESS;
        $this->assertEquals($expectRet, $ret['result']);
    }

    public function test_delete_friend() {
        $client = new Client(['verify'=>false] );
        
        // 参数
        $data = [
            'uid'=>'10'
        ];

        // 发送http请求
        $response = $client->post('https://localhost/contact/index/index/friend/delete_friend', ['json'=> $data]);
        $ret = $response->getBody()->getContents();
        // var_dump($ret);
        $ret = json_decode($ret, true);

        // 期望值
        $expectRet = SUCCESS;
        $this->assertEquals($expectRet, $ret['result']);
    }
}


