<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Binding;
use App\Models\Invite;
use Auth;

class BindingController extends Controller
{
    public function invite(){
        return View('binding.invite',[
            'page_title' => "绑定-邀请",
            'site_title' => "记恋",
        ]);
    }

    public function index(){
        $binding = new Binding();
        $invite = new Invite();
        $binding_id = $binding->getBindingIdByUid(Auth::user()->id);
        if(!$binding_id){
            $invite_code = $invite->getUserCode(Auth::user()->id);
        }
        return View('binding.index',[
            'page_title' => "绑定",
            'site_title' => "记恋",
            'binding_id' => $binding_id,
            'invite_code' => $invite_code,
        ]);
    }
}
