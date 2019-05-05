<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Membox extends Model
{
    protected $table = 'membox';

    public function getMembox($binding_id){
        $membox = DB::table('membox') -> where('binding_id','=',$binding_id) -> get();
        foreach($membox as $m)
        {
            $m -> username = DB::table('users') -> where('id','=',$m -> uid) -> first() -> name;
        }
        return $membox;
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
