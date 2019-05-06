<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkin;
use App\Models\Binding;

use Auth;

class CheckinController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $checkin = new Checkin();
        $binding = new Binding();

        $binding_id = $binding->getBindingIdByUid($user_id);
        if($binding_id){
            $today_task = $checkin->getTodayTask($binding_id);
        }else{
            return redirect()->route('binding_index');
        }

        if(!empty($today_task)){
            $img = $today_task->img;
            $img = explode('|',$img);
            array_pop($img);
            foreach ($img as &$value) {
                $value = '/static/img/membox/'.$value;
            }
        }

        return View('checkin.index',[
            'page_title' => "打卡",
            'site_title' => "记恋",
            'today_task' => $today_task,
            'binding_id' => $binding_id,
            'img_list' => $img ?? null,
        ]);
    }
}
