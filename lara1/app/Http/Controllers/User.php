<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserModel;

class User extends Controller
{
    // 用户登录
    public function checkLogin() {

        $userName = request()->input("userName");
        $passwd = request()->input("passwd");

        // $userName = 'hdy';
        // $passwd = '123456';

        if (! $userName || !$passwd) {
            return ['result'=>FAILED, 'msg'=> '传入的信息,错误' ];
        }

        $obj = new UserModel();

        $ret = $obj->checkLogin($userName, $passwd);

        return $ret;
    }

    // 获取,用户的信息
    public function get_userInfo() {
        $uid = request()->input("uid");

        // $uid = 2;
    
        $obj = new UserModel();
        $ret = $obj->get_userInfo($uid);

        return $ret;
    }
    
    

}
