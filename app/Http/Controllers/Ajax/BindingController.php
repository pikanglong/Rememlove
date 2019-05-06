<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AjaxResponse;
use App\Models\Binding;
use App\Models\Invite;
use App\Models\Users;
use App\Models\Message;
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
            return AjaxResponse::err(1001);
        }
        $invite_code = $request->input('invite_code');
        $invite = new Invite();
        $users = new Users();

        $self_id = Auth::user()->id;
        $user_id = $invite->getUserByCode($invite_code);
        if(!$user_id){
            return AjaxResponse::err(4003);
        }
        if($self_id == $user_id){
            return AjaxResponse::err(4001);
        }
        if($users->getObject($user_id)){
            return AjaxResponse::err(4002);
        }
        if($users->getObject($self_id)){
            return AjaxResponse::err(4004);
        }

        $binding = new Binding;
        $binding->userA_id = $user_id;
        $binding->userB_id = $self_id;
        $binding->save();
        return AjaxResponse::success(200);
    }

    public function queryCode(Request $request){
        if(!$request->has('invite_code')){
            return AjaxResponse::err(1001);
        }
        $invite_code = $request->input('invite_code');
        $invite = new Invite();
        $users = new Users();

        $self_id = Auth::user()->id;
        $user_id = $invite->getUserByCode($invite_code);
        if(!$user_id){
            return AjaxResponse::err(4003);
        }
        if($self_id == $user_id){
            return AjaxResponse::err(4001);
        }
        if($users->getObject($user_id)){
            return AjaxResponse::err(4002);
        }
        if($users->getObject($self_id)){
            return AjaxResponse::err(4004);
        }

        return AjaxResponse::success(200,null,route('binding_invite',['invite_code' => $invite_code]));
    }

    public function searchUser(Request $request){
        $search_key = $request->input('search_key');
        if(empty($search_key)){
            return AjaxResponse::err(1001);
        }

        $self_id = Auth::user()->id;
        $search_key_lower = strtolower($search_key);
        $result_elo = Users::where('email',$search_key_lower)
                      ->orWhere('name',$search_key)
                      ->get();
        $result_arr = [];

        $binding = new Binding();
        foreach($result_elo as $user){
            if($binding->getBindingIdByUid($user->id) || $user->id == $self_id){
                continue;
            }
            array_push($result_arr,[
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
            ]);
        }

        if(empty($result_arr)){
            return AjaxResponse::err(4005);
        }

        return AjaxResponse::success(200,null,$result_arr);

    }

    public function sendInvite(Request $request){
        $user_id = $request->input('user_id');
        if(empty($user_id)){
            return AjaxResponse::err(1001);
        }
        $self_id = Auth::user()->id;

        $users = new Users();
        if($self_id == $user_id){
            return AjaxResponse::err(4001);
        }
        if($users->getObject($user_id)){
            return AjaxResponse::err(4002);
        }
        if($users->getObject($self_id)){
            return AjaxResponse::err(4004);
        }
        $message = new Message();

        if($message->sendInviteMessage($self_id,$user_id)){
            return AjaxResponse::success(200);
        }else{
            return AjaxResponse::err(4006);
        }


    }
}

