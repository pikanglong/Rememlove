<?php

namespace App\Http\Controllers;

use DavidNineRoc\Qrcode\Factory;
use DavidNineRoc\Qrcode\QrCodePlus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard(){
        return view('account.dashboard',[
            'page_title' => "用户",
            'site_title' => "记恋",
        ]);
    }

    public function getQRCode(){
        $color = Factory::color(['#000', '#000', '#000', '#000',]);
        // $image = Factory::image(imagecreatefrompng('DavidNineRoc.png'));
        $id = Auth::id();
        return (new QrCodePlus)
            ->setText(env('APP_URL').'/invite/'.strval($id))
            ->setMargin(50)
            ->setOutput(function($handle){
                header('Content-Type: image/jpeg');
                imagejpeg($handle);
            })
            ->output($color);
    }
}
