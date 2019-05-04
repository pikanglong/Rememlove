<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemboxController extends Controller
{
    public function square(){
        return view('membox.square',[
            'page_title' => "广场",
            'site_title' => "记恋",
        ]);
    }

    public function index(){
        return view('membox.index',[
            'page_title' => "时光宝盒",
            'site_title' => "记恋",
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
