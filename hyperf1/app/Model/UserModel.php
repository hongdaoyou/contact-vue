<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;

use Hyperf\DbConnection\Db;

/**
 */
class UserModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'my_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

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