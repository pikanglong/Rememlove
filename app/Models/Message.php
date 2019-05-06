<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Invite;

class Message extends Model
{
    protected $table = 'message';

    public function sendInviteMessage($self_id,$user_id){
        $invite = new Invite();

        $self_name = Users::find($self_id)->name;
        $invite_code = $invite->getUserCode($self_id);

        $contents = $self_name.' 向您发起了关系绑定邀请';
        if(static::where('user_id',$user_id)->where('contents',$contents)->where('already_read',0)->count()){
            return false;
        }

        $message = new Message;
        $message->title = '关系绑定邀请';
        $message->contents = $self_name.' 向您发起了关系绑定邀请';
        $message->link = route('binding_invite',['invite_code'=>$invite_code]);
        $message->user_id = $user_id;
        $message->already_read = false;
        $message->save();
        return true;
    }

    public function getUnreadList($user_id){
        return static::where('user_id',$user_id)
                     ->where('already_read',false)
                     ->paginate(10);
    }
}
