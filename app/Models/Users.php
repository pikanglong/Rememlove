<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Binding;

class Users extends Model
{
    protected $table = 'users';

    public function details($uid){
        $user = static::find($uid);
        if(empty($user)){
            return null;
        }
        $binding = new Binding();
        $binding = $binding->getBindingIdByUid($uid);
        if(!empty($binding)){
            $user[$object_id] = ($binding->userA_id == $uid) ? $binding->userB_id : $binding->userA_id;
        }

    }

    public function getObject($uid){
        $binding = new Binding();
        $binding_id = $binding->getBindingIdByUid($uid);
        $binding = Binding::find($binding_id);
        if(!empty($binding)){
            return ($binding->userA_id == $uid) ? static::find($binding->userB_id) : static::find($binding->userA_id);
        }else{
            return null;
        }
    }

}
