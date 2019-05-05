<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Binding;
use App\Models\Invite;
use App\Models\Users;
use Auth;

class BindingController extends Controller
{
    public function invite($invite_code){
        $invite = new Invite();
        $users = new Users();
        $self_id = Auth::check() ? Auth::user()->id : 0;
        $user_id = $invite->getUserByCode($invite_code);
        $code_valid = true;
        $has_obeject = false;
        $oneself = $self_id == $user_id;

        if($user_id && !$users->getObject($user_id)){
            if($users->getObject($self_id)){
                $has_obeject = true;
            }
        }else{
            $code_valid = false;
        }

        $valid = $code_valid && !$has_obeject && !$oneself;

        return View('binding.invite',[
            'page_title' => "绑定-邀请",
            'site_title' => "记恋",
            'user' => ($user_id && $valid) ? Users::find($user_id) : null,
            'self' => $valid ? Users::find($self_id) : null,
            'code_valid' => $code_valid,
            'has_obeject' => $has_obeject,
            'oneself' => $oneself,
            'invite_code' => $invite_code,
        ]);
    }

    public function index(){
        $binding = new Binding();
        $invite = new Invite();
        $users = new Users();

        $user = Auth::user();
        $binding_id = $binding->getBindingIdByUid($user->id);
        if(!$binding_id){
            $invite_code = $invite->getUserCode($user->id);
        }
        return View('binding.index',[
            'page_title' => "绑定",
            'site_title' => "记恋",
            'user' => $binding_id ? $user : null,
            'user_object' => $binding_id ? $users->getObject($user->id) : null,
            'binding_id' => $binding_id,
            'invite_code' => $invite_code ?? null,
        ]);
    }
}
