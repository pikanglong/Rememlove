<?php


namespace App\Http\Controllers;


use App\Models\Membox;
use Illuminate\Http\Request;

class ShareController
{
    public function view($sharelink){
        $mem = new Membox();
        $m = $mem->getshare($sharelink);
        return view('share',[
            'page_title' => "分享",
            'site_title' => "记恋",
            'm' => $m
        ]);
    }
}