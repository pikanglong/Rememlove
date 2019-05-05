<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Binding extends Model
{
    protected $table = 'binding';

    public function getBindingIdByUid($uid){
        $binding_id = DB::table('binding') -> where('userA_id','=',$uid) -> orWhere('userB_id','=',$uid) -> first();
        return $binding_id;
    }
}
