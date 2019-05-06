<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Membox extends Model
{
    protected $table = 'membox';

    public function getMembox($binding_id){
        $membox = DB::table('membox') -> where('binding_id','=',$binding_id) -> where('deleted_at','=',null) -> orderBy('created_at','desc') -> get();
        foreach($membox as $m)
        {
            $m -> user = DB::table('users') -> where('id','=',$m -> uid) -> first();
            $m -> time_see_remained = $this -> formatTime($m -> new_time_see);
        }
        return $membox;
    }

    public function getPublicMembox(){
        // 本来应该在这里判断设定时间是否超过当前时间的，改为在视图页面判断
        $membox = DB::table('membox') -> where('private','=','0') -> where('deleted_at','=',null) -> orderBy('created_at','desc') -> get();
        foreach($membox as $m)
        {
            $m -> user = DB::table('users') -> where('id','=',$m -> uid) -> first();
            $m -> username = DB::table('users') -> where('id','=',$m -> uid) -> first() -> name;
        }
        return $membox;
    }

    public function formatTime($date)
    {
        $periods=["秒", "分钟", "小时", "天", "周", "月", "年"];
        $lengths=["60", "60", "24", "7", "4.35", "12"];

        $now=time();
        $unix_date=strtotime($date);

        if (empty($unix_date)) {
            return null;
        }

        if ($now>$unix_date) {
            $difference=$now-$unix_date;
            $tense="前";
        } else {
            $difference=$unix_date-$now;
            $tense="后";
        }

        for ($j=0; $difference>=$lengths[$j] && $j<count($lengths)-1; $j++) {
            $difference/=$lengths[$j];
        }

        $difference=round($difference);

        return $now>$unix_date ? null : "$difference$periods[$j]{$tense}";
    }

    public function insertMembox($data){
        $binding_id = DB::table('binding') -> where('userA_id', $data -> uid) -> orWhere('userB_id', $data -> uid) -> first() -> id;
        $id = DB::table('membox') -> insertGetId([
            'binding_id' => $binding_id,
            'contents' => $data -> contents,
            'img' => null,
            'time_see' => "TODO",
            'uid' => $data -> uid,
        ]);
        return $id;
    }

    // public function public_list(){

    // }

    // public function list($user_id){

    // }

    // public function create(){

    // }

    // public function canViewMem($user_id,$mem_id){

    // }

    // public function add($data){

    // }

    // public function can_see($mem_id,$user_id){

    // }
}
