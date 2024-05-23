<?php

namespace app\index\model;


use think\Model;

class MyInfoModel extends Model {

    protected $table = 'my_info';


        // 获取,用户的信息
        public function checkLogin($info) {
            $userName = $info['userName'] ?? '';
            $passwd = $info['passwd'] ?? '';

            if (! $userName) {
                $ret = ['result'=> FAILED, 'msg'=>'用户,未传入'];
                return $ret;
            }
    
            $data = [];
            $msg = '';
            
            $passwd = md5($passwd);
            
            $sqlRet = $this->where(['userName'=> $userName, 'passwd'=>$passwd ] )->limit(1)
                -> select();
            if (count($sqlRet ) ) {
                $data['uid'] = $sqlRet[0]['uid'];
                $data['userName'] = $sqlRet[0]['userName'];
                $data['phone'] = $sqlRet[0]['phone'];

                $result = SUCCESS;
            } else {
                $result = FAILED;
                $msg = '获取,失败';
            }
            $ret = ['result'=>$result, 'data'=>$data, 'msg'=>$msg];
            return $ret;
        }

        
    // 获取,用户的信息
    public function get_userInfo($uid) {
        if (! $uid) {
            $ret = ['result'=> FAILED, 'msg'=>'用户,未传入'];
            return $ret;
        }

        $data = [];
        $msg = '';

        $sqlRet = $this->where(['uid'=> $uid] )->limit(1)
            -> select();
        if (count($sqlRet ) ) {
            $data = $sqlRet[0];
            $result = SUCCESS;
        } else {
            $result = FAILED;
            $msg = '获取,失败';
        }
        $ret = ['result'=>$result, 'data'=>$data, 'msg'=>$msg];
        return $ret;
    }

    // 更新,用户的信息
    public function update_myInfo($info) {
        $uid = $info['uid'] ?? '';
        $userName = $info['userName'] ?? '';
        $phone = $info['phone'] ?? '';
        $comment = $info['comment'] ?? '';

        if (! $userName) {
            $ret = ['result'=> FAILED, 'msg'=>'用户,未传入'];
            return $ret;
        }

        // 更新,用户的信息
        $ret = $this->where(['uid'=>$uid ] )
            ->update([
                'userName'=>$userName,
                'phone'=>$phone,
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

    

}
