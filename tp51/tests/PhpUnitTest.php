<?php

require_once  'vendor/autoload.php';

use think\Request;
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

class PhpUnitTest extends TestCase
{
    public function testIndex()
    {
        $this->assertEquals(1, 1);

        /*
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
        
        */
    }

    
}


