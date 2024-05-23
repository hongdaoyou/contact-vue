<?php

namespace app\index\model;


use think\Model;

class FriendModel extends Model {

    protected $table = 'friend';

    // 获取,用户的信息
    public function get_friend_list($info) {

        $start = $info['start'] ?? '';
        $num = $info['num'] ?? '';

        $data = [];
        $msg = '';

        $sqlRet = $this->where('')->limit($start, $num)->order('uid desc')
            ->select();
        $data = $sqlRet;
        
        // 总的函数
        $totalNum = $this->count();

        $result = SUCCESS;

        $ret = ['result'=>$result, 'data'=>$data, 'totalNum'=>$totalNum, 'msg'=>$msg];
        return $ret;
    }

    // 添加,用户的信息
    public function add_friend($info) {
        $userName = $info['userName'] ?? '';
        $phone = $info['phone'] ?? '';
        // $age = $info['age'] ?? '';
        $addr = $info['addr'] ?? '';
        $comment = $info['comment'] ?? '';

        if (! $userName) {
            $ret = ['result'=> FAILED, 'msg'=>'用户Name,未传入'];
            return $ret;
        }

        // 更新,用户的信息
        $ret = $this->insert([
                'userName' => $userName,
                // 'age'=>$age,
                'phone'=>$phone,
                'addr' => $addr,
                'comment'=>$comment,
            ]);

        if ($ret != 0) {
            $msg = '添加成功';
            $result = SUCCESS;
        } else {
            $msg = '添加失败';
            $result = FAILED;
        }
        $ret = ['result'=> $result, 'msg'=>$msg];
        return $ret;
    }

    // 更新,用户的信息
    public function update_friend($info) {
        $uid = $info['uid'] ?? '';
        $userName = $info['userName'] ?? '';
        $phone = $info['phone'] ?? '';
        $addr = $info['addr'] ?? '';
        $comment = $info['comment'] ?? '';

        if (! $userName) {
            $ret = ['result'=> FAILED, 'msg'=>'用户,未传入'];
            return $ret;
        }

        // 更新,用户的信息
        $ret = $this->where(['uid'=>$uid ] )
            ->update([
                'userName' => $userName,
                'phone'=>$phone,
                'addr'=>$addr,
                'comment'=>$comment,
            ]);

        if ($ret != 0) {
            $msg = '更新成功';
            $result = SUCCESS;
        } else {
            $msg = '更新失败';
            $result = FAILED;
        }
        $ret = ['result'=> $result, 'msg'=>$msg];
        return $ret;
    }

    // 删除朋友
    public function delete_friend($info) {
        $uid = $info['uid'] ?? '';

        if (! $uid) {
            $ret = ['result'=> FAILED, 'msg'=>'用户uid,未传入'];
            return $ret;
        }

        // 更新,用户的信息
        $ret = $this->where(['uid'=>$uid ] )
            ->delete();

        if ($ret != 0) {
            $msg = '删除成功';
            $result = SUCCESS;
        } else {
            $msg = '删除失败';
            $result = FAILED;
        }
        $ret = ['result'=> $result, 'msg'=>$msg];
        return $ret;
    }


}
