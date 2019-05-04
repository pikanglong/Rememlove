<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard(){
        return view('account.dashboard',[
            'page_title' => "用户",
            'site_title' => "记恋",
        ]);
    }
}
