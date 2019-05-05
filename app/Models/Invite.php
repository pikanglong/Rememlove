<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invite';

    public function getUserCode($uid){
        $invite = static::where('user_id',$uid)->first();
        return empty($invite) ? null : $invite->code;
    }

    public function getUserByCode($inviteCode){
        $invite = static::where('code',$inviteCode)->first();
        return empty($invite) ? 0 : $invite->user_id;
    }

    public function codeExist($inviteCode){
        return static::where('code',$inviteCode)->count();
    }

    public function saveUserCode($uid,$inviteCode){
        if(!empty(static::getUserCode($uid))){
            $invite = static::where('user_id',$uid)->first();
        }else{
            $invite = new Invite;
            $invite->user_id = $uid;
        }
        $invite->code = $inviteCode;
        $invite->save();
    }

    public function generateCode($length=12)
    {
        $chars='abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';

        $code='';
        for ($i=0; $i<$length; $i++) {
            $code.=$chars[mt_rand(0, strlen($chars)-1)];
        }
        return $code;
    }
}
