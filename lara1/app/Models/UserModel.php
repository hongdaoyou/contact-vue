<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'my_info';

    public function checkLogin($userName, $passwd) {

        $newPasswd = md5($passwd);

        $data = DB::table($this->table)->select(['uid', 'userName', 'phone'])->where(['userName'=>$userName, 'passwd'=>$newPasswd ])->first();

        if ($data) {
            $ret = ['result'=>SUCCESS, 'data'=>$data];
        } else {
            $ret = ['result'=> FAILED];
        }
        return $ret;

    }

    public function get_userInfo($uid) {
        if (! $uid) {
            $ret = ['result'=> FAILED, 'msg'=>'用户,未传入'];
            return $ret;
        }

        $data = [];
        $msg = '';
    
        $data = DB::table($this->table)->select(['uid', 'userName', 'phone'])->where(['uid'=>$uid ])->first();

        if ($data) {
            $ret = ['result'=>SUCCESS, 'data'=>$data];
        } else {
            $ret = ['result'=> FAILED];
        }
        return $ret;

    }

}
