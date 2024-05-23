<?php

require_once  'vendor/autoload.php';

use think\Request;
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

class UserTest extends TestCase {
    
    public function test_add_user()
    {
        $client = new Client(['verify'=>false] );
        
        // 参数
        $data = [
            'uid'=>2
        ];

        // 发送http请求
        $response = $client->post('https://localhost/contact/index/index/user/get_userInfo', ['json'=> $data]);
        $ret = $response->getBody()->getContents();
        $ret = json_decode($ret, true);

        // 期望值
        $expectRet = SUCCESS;
        $this->assertEquals($expectRet, $ret['result']);
    }


    public function test_update_my_info()
    {
        $client = new Client(['verify'=>false] );
        
        // 参数
        $data = [
            // 'uid' => 2,
            'userName' => 'hdy',
            'phone' => '1231',
            'comment'=> 'commont111'
        ];
        // 发送http请求
        $response = $client->post('https://localhost/contact/index/index/user/update_my_info', ['json'=> $data]);
        $ret = $response->getBody()->getContents();
        $ret = json_decode($ret, true);

        // 期望值
        $expectRet = SUCCESS;
        $this->assertEquals($expectRet, $ret['result']);
    }

    public function testCheckLogin()
    {
        $client = new Client(['verify'=>false] );
        
        // echo md5('123456');
        
        // 参数
        $data = [
            // 'uid' => 2,
            'userName' => 'hdy',
            'passwd' => '123456',
        ];
        // 发送http请求
        $response = $client->post('https://localhost/contact/index/index/user/checkLogin', ['json'=> $data]);
        $ret = $response->getBody()->getContents();
        $ret = json_decode($ret, true);

        // 期望值
        $expectRet = SUCCESS;
        $this->assertEquals($expectRet, $ret['result']);
    }

}
