<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Membox;
use App\Models\Binding;

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
        if(Auth::check()){
            return redirect("/membox/square");
            $Binding = new Binding();
            $binding_id = $Binding -> getBindingIdByUid(Auth::user() -> id);
            $Membox = new Membox();
            $membox = $Membox -> getMembox($binding_id);
            return view('home',[
                'page_title'=>"主页",
                'site_title'=>"记恋",
                'membox' => $membox,
            ]);
        }
        else return view('welcome',[
            'page_title' => "欢迎",
            'site_title' => "记恋",
        ]);
    }

    public function account(Request $request)
    {
        return Auth::check() ? redirect("/account/dashboard") : redirect("/login");
    }
}
