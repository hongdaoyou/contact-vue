<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class FriendModel extends Model
{
    use HasFactory;

    protected $table = 'friend';

    public function get_friend_list($inputInfo) {
        $start = $inputInfo['start'] ?? '';
        $num = $inputInfo['num'] ?? '';

        // var_dump($inputInfo);

        $data = DB::table($this->table)->limit($num)->offset($start)->orderBy('uid', 'desc')->get()->toArray();

        $totalNum = DB::table($this->table)->count();

        $ret = ['result'=>SUCCESS, 'data'=>$data, 'totalNum'=>$totalNum];
        return $ret;
        
    }

    public function add_friend($inputInfo) {
        $userName = $inputInfo['userName'];
        $phone = $inputInfo['phone'];
        $addr = $inputInfo['addr'];

        $data = DB::table($this->table)->insert([
            'userName' => $userName,
            'phone' => $phone,
            'addr' => $addr,
        ]);

        if ($data ) {
            $result = SUCCESS;
            $msg = '添加成功';
        } else {
            $result = FAILED;
            $msg = '添加失败';
        }
        return ['result'=> $result, 'msg'=>$msg];
    }
    
    public function update_friend($inputInfo) {
        $userName = $inputInfo['userName'];
        $phone = $inputInfo['phone'];
        $addr = $inputInfo['addr'];
        $friendUid = $inputInfo['friendUid'];

        $data = DB::table($this->table)->where(['uid'=>$friendUid])->update([
            'userName' => $userName,
            'phone' => $phone,
            'addr' => $addr,
        ]);

        if ($data ) {
            $result = SUCCESS;
            $msg = '更新成功';
        } else {
            $result = FAILED;
            $msg = '更新失败';
        }
        return ['result'=> $result, 'msg'=>$msg];
    }
    
    public function delete_friend($inputInfo) {
        $friendUid = $inputInfo['friendUid'];

        $data = DB::table($this->table)->where(['uid'=>$friendUid])->delete();

        if ($data ) {
            $result = SUCCESS;
            $msg = '删除成功';
        } else {
            $result = FAILED;
            $msg = '删除失败';
        }
        return ['result'=> $result, 'msg'=>$msg];

    }
}
