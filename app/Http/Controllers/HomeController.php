<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Auth::check() ? view('home',[
            'page_title'=>"主页",
            'site_title'=>"记恋",
            'navigation' => "Home"
        ]) : view('welcome',[
            'page_title' => "欢迎",
            'site_title' => "记恋",
            'navigation' => "Home",
        ]);
    }

    public function account(Request $request)
    {
        return Auth::check() ? redirect("/account/dashboard") : redirect("/login");
    }
}
