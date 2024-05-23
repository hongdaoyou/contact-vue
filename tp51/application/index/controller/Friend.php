<?php

namespace app\index\controller;

use think\Controller;

use GuzzleHttp\Client;

use think\Request;

use app\index\model\FriendModel;

class Friend extends Controller{

     // 添加,用户的信息
     public function add_friend(Request $request) {

        $data = $request->param('data') ;

        // $data = [
        //     'userName'=> '11',
        //     'phone'=>11,
        //     'addr'=>33,
        // ];
        $userName = $data['userName'] ?? '';
        // $age = $data['age'] ?? '';
        $phone = $data['phone'] ?? '';
        $addr = $data['addr'] ?? '';
        $comment = $data['comment'] ?? '';

            
        $info = [
            'userName' => $userName,
            // 'age'=>$age,
            'phone'=>$phone,
            'addr' => $addr,
            'comment'=>$comment,
        ];

        $obj = new FriendModel();
        $ret = $obj->add_friend($info);

        return json($ret);
    }

    
     // 获取,朋友的列表
     public function get_friend_list(Request $request) {

        // $start = 0;
        // $num = 10;
        $start = $request->param('start') ?? '';
        $num = $request->param('num') ?? '';

        if ($num  >= 10) { // 一次只能是,10个
            $num = 10; 
        }
        $info['start'] = $start;
        $info['num'] = $num;

        $obj = new FriendModel();
        $ret = $obj->get_friend_list($info);

        return json($ret);
    }
    
    
    // 更新,用户的信息
    public function update_friend(Request $request) {

        $uid = $request->param('uid') ?? '';
        $data = $request->param('data') ?? '';

        $friendUID = $data['uid'] ?? '';
        $userName = $data['userName'] ?? '';
        $phone = $data['phone'] ?? '';
        $addr = $data['addr'] ?? '';
        $comment = $data['comment'] ?? '';

        /*
        // 参数
        $paraArr = [
            'uid'=>'2',
            'userName'=>'h113',
            'phone'=>'123',
            'addr'=>'addr1',
            'comment'=>'comm1'
        ];
        foreach ($paraArr as $key => $value) {
            $$key = $value;
        }
        */
        

        // var_dump($request->param());
        // return json(['result'=>SUCCESS]);
        // return ;

        $info = [
            'uid' => $friendUID,
            'userName' => $userName,
            'phone'=>$phone,
            'addr' => $addr,
            'comment'=>$comment,
        ];

        $obj = new FriendModel();
        $ret = $obj->update_friend($info);

        return json($ret);
    }

    // 删除,用户
    public function delete_friend(Request $request) {
        $obj = new FriendModel();

        $uid = $request->param('uid') ?? '';

        $data = $request->param('data') ?? '';
        $friendUID = $data['uid'] ?? '';

        $info = [
            'uid' => $friendUID,
        ];
        $ret = $obj->delete_friend($info);

        return json($ret);
    }
    
}
