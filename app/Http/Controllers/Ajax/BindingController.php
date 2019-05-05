<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AjaxResponse;
use App\Models\Binding;
use App\Models\Invite;
use App\Models\Users;
use Auth;

class BindingController extends Controller
{
    public function newInviteCode(){
        $invite = new Invite();
        $new_code;
        do {
            $new_code = $invite->generateCode(12);
        } while ($invite->codeExist($new_code));
        $uid = Auth::user()->id;
        $invite->saveUserCode($uid,$new_code);
        return AjaxResponse::success(200,'successful',$new_code);
    }

    public function confirmInvite(Request $request){
        if(!$request->has('invite_code')){
            return AjaxResponse::error(1001);
        }
        $invite_code = $request->input('invite_code');
        $invite = new Invite();
        $users = new Users();

        $self_id = Auth::user()->id;
        $user_id = $invite->getUserByCode($invite_code);
        if(!$user_id){
            return AjaxResponse::error(4003);
        }
        if($self_id == $user_id){
            return AjaxResponse::error(4001);
        }
        if($users->hasObejct($user_id)){
            return AjaxResponse::error(4002);
        }
        if($users->hasObejct($self_id)){
            return AjaxResponse::error(4004);
        }

        $binding = new Binding;
        $binding->userA_id = $user_id;
        $binding->userB_id = $self_id;
        $binding->save();
        return AjaxResponse::success(200);
    }
}
