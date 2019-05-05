<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membox;
use App\Models\Binding;
use Auth;

class MemboxController extends Controller
{
    public function square(){
        $Membox = new Membox();
        $membox = $Membox -> getPublicMembox();
        dd($membox);
        return view('membox.square',[
            'page_title' => "广场",
            'site_title' => "记恋",
        ]);
    }

    public function index(){
        $Binding = new Binding();
        $binding_id = $Binding -> getBindingIdByUid(Auth::user() -> id);
        $Membox = new Membox();
        $membox = $Membox -> getMembox($binding_id);
        // dd($membox);
        return view('membox.index',[
            'page_title' => "时光宝盒",
            'site_title' => "记恋",
            'membox' => $membox,
        ]);
    }

    public function view(){
        return view('membox.view',[
            'page_title' => "title",
            'site_title' => "记恋",
        ]);
    }

    public function create(){
        return view('membox.create',[
            'page_title' => "新建",
            'site_title' => "记恋",
        ]);
    }

    public function edit(){
        return view('membox.edit',[
            'page_title' => "编辑",
            'site_title' => "记恋",
        ]);
    }
}
