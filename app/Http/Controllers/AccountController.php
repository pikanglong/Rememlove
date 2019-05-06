<?php

namespace App\Http\Controllers;

use DavidNineRoc\Qrcode\Factory;
use DavidNineRoc\Qrcode\QrCodePlus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Binding;
use App\Models\Users;
use App\Models\Membox;
use App\Models\Like;

class AccountController extends Controller
{
    public function dashboard(){
        $Binding = new Binding();
        $halfuid = $Binding -> getTheOtherHalfUid(Auth::user()->id);
        $Users = new Users();
        $halfdetail = $Users -> getDetail($halfuid);
        $Membox = new Membox();
        $mymemboxcount = $Membox -> countMembox(Auth::user()->id);
        $halfmemboxcount = $Membox -> countMembox($halfuid);
        $Like = new Like();
        $mylikecount = $Like -> countLike(Auth::user()->id);
        $halflikecount = $Like -> countLike($halfuid);
        return view('account.dashboard',[
            'page_title' => "用户",
            'site_title' => "记恋",
            'halfuid' => $halfuid,
            'halfdetail' => $halfdetail,
            'mymemboxcount' => $mymemboxcount,
            'halfmemboxcount' => $halfmemboxcount,
            'mylikecount' => $mylikecount,
            'halflikecount' => $halflikecount,
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
