<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BindingController extends Controller
{
    public function invite(){
        return View('binding.invite',[
            'page_title' => "绑定-邀请",
            'site_title' => "记恋",
        ]);
    }

    public function index(){
        return View('binding.index',[
            'page_title' => "绑定",
            'site_title' => "记恋",
        ]);
    }
}
