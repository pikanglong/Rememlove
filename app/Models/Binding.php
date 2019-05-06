<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Binding extends Model
{
    protected $table = 'binding';

    public function getBindingIdByUid($uid){
        $binding = static::where('userA_id', $uid)->orWhere('userB_id', $uid)->first();
        return empty($binding) ? null : $binding->id;
    }

    public function getTheOtherHalfUid($uid){
        $binding = static::where('userA_id', $uid)->orWhere('userB_id', $uid)->first();
        return empty($binding) ? null : ($binding->userA_id == $uid ? $binding->userB_id : $binding->userA_id);
    }
}
