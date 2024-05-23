<?php

namespace app\index\controller;

use think\Request;
use think\Controller;

use app\index\model\MyInfoModel;


class User extends Controller{

    public function index() {
        return "abc";
    }

    // 检查,登录
    public function checkLogin(Request $request) {
        $userName = $request->param('userName') ?? '';
        $passwd = $request->param('passwd') ?? '';

        $info['userName'] = $userName;
        $info['passwd'] = $passwd;

        $obj = new MyInfoModel();
        $ret = $obj->checkLogin($info);
        
        return json($ret);
    }

        // 获取,用户的信息
    public function get_userInfo(Request $request) {

        $uid = $request->param('uid') ?? '';
        $info = [
            'uid'=>$uid
        ];
        $obj = new MyInfoModel();
        $ret = $obj->get_userInfo($info);

        return json($ret);
    }
    
    public function update_my_info(Request $request) {
        $obj = new MyInfoModel();

        $uid = $request->param('uid') ?? '';
        $data = $request->param('data') ?? '';

        // $uid = '2';

        // $data = ['userName'=>'hdy', 'phone'=>'2233'];

        $userName = $data['userName'] ?? '';
        $phone = $data['phone'] ?? '';
        // $addr = $request->param('addr') ?? '';
        $comment = $data['comment'] ?? '';

        $info = [
            'uid' => $uid,
            'userName' => $userName,
            'phone' => $phone,
            'comment' => $comment,
        ];

        $ret = $obj->update_myInfo($info);

        return json($ret);
    }

    public function user_list() {
        return "abc";
    }
    
    
}