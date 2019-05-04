<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index(){
        return View('checkin.index',[
            'page_title' => "打卡",
            'site_title' => "记恋",
        ]);
    }
}
