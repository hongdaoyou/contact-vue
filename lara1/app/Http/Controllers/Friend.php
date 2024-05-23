<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FriendModel;

class Friend extends Controller
{

    // 添加,朋友的信息
    public function add_friend() {
        $uid = request()->input('uid');

        $data = request()->input('data');

        $userName = $data['userName'] ?? '';
        $phone = $data['phone'] ?? '';
        $addr = $data['addr'] ?? '';

        if (!$userName) {
            return ['result'=>FAILED, 'msg'=> '信息不全'];
        }

        $inputInfo['userName'] = $userName;
        $inputInfo['phone'] = $phone;
        $inputInfo['addr'] = $addr;

        $obj = new FriendModel();
        $ret = $obj->add_friend($inputInfo );

        return $ret;
    }

    // 获取,朋友的列表
    public function get_friend_list() {
        $uid = request()->input('uid');
        $start = request()->input('start');
        $num = request()->input('num');

        // $start = 0;
        // $num = 1;

        if ($start === NULL || $num === NULL) {
            return ['result'=>FAILED];
        }

        $inputInfo['start'] = $start;
        $inputInfo['num'] = $num;

        $obj = new FriendModel();
        $ret = $obj->get_friend_list($inputInfo );

        return $ret;
    }

    // 获取,朋友的列表
    public function update_friend() {
        $uid = request()->input('uid');
        $data = request()->input('data');

        $userName = $data['userName'] ?? '';
        $phone = $data['phone'] ?? '';
        $addr = $data['addr'] ?? '';
        $friendUid = $data['uid'] ?? '';

        if (!$userName) {
            return ['result'=>FAILED, 'msg'=> '信息不全'];
        }

        $inputInfo['userName'] = $userName;
        $inputInfo['phone'] = $phone;
        $inputInfo['addr'] = $addr;
        $inputInfo['friendUid'] = $friendUid;

        $obj = new FriendModel();
        $ret = $obj->update_friend($inputInfo );

        return $ret;
    }

    
    // 删除,朋友的信息
    public function delete_friend() {
        $uid = request()->input('uid');
        $data = request()->input('data');

        $friendUid = $data['uid'] ?? '';
        if (!$friendUid) {
            return ['result'=>FAILED, 'msg'=> '信息不全'];
        }
        $inputInfo['friendUid'] = $friendUid;

        $obj = new FriendModel();
        $ret = $obj->delete_friend($inputInfo );

        return $ret;
    }

}
