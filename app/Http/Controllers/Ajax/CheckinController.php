<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\AjaxResponse;
use App\Models\Binding;
use Auth;

class CheckinController extends Controller
{
    private static function randomTask()
    {
        $list=[
            '一起找个地方坐一段时间',
            '一起去逛街,不许玩手机',
            '一起运动,跑跑步,打打球,推推太极(雾',
            '对视三分钟,不许看别的地方',
            '像遛狗一样牵着对方到处走走'
        ];
        return $list[mt_rand(0,count($list) - 1)];
    }

    public function submit(Request $request){
        if(!$request->has('binding_id')){
            return AjaxResponse::err(1001);
        }
        $remarks = $request->input('remarks');
        $binding_id = $request->input('binding_id');
        $user_id = Auth::user()->id;

        $checkin = new Checkin();
        $binding = new Binding();

        $binding_id_user = $binding->getBindingIdByUid($user_id);
        if($binding_id_user != $binding_id){
            return AjaxResponse::err(5005);
        }

        $today_task =$checkin->getTodayTask($user_id);
        if(empty($today_task)){
            return AjaxResponse::err(5004);
        }

        $path = '';
        $valid = false;
        $pic_list = ['pic_0', 'pic_1', 'pic_2', 'pic_3'];
        foreach ($pic_list as $value) {
            if(!empty($request->file($value)) && $request->file($value)->isValid()){
                $path_temp = $request->file($value)->store('/static/img/upload','web_root');
                $file_name = explode('/',$path_temp);
                $file_name = $file_name[count($file_name) - 1];
                $path .= $file_name.'|';
                $valid = true;
            }
        }
        if(!$valid){
            return AjaxResponse::err(5003);
        }

        $task = Checkin::find($today_task->id);
        $task->img = $path;
        $task->complete = true;
        $task->remarks = $remarks;

        $task->save();

        return AjaxResponse::success(200,null,route('checkin_index'));
    }

    public function newTask($mode){
        if($mode == 'spec'){
            $task_spec = $request->input('want_to_do');
            if(empty($task_spec)){
                return AjaxResponse::err(1001);
            }
        }
        $user_id = Auth::user()->id;

        $checkin = new Checkin();
        $binding = new Binding();

        $binding_id = $binding->getBindingIdByUid($user_id);
        if(!$binding_id){
            return AjaxResponse::err(5002);
        }

        $today_task =$checkin->getTodayTask($binding_id);
        if(!empty($today_task)){
            return AjaxResponse::err(5001);
        }

        $new_task = new Checkin;

        $new_task->binding_id = $binding_id;
        $new_task->do = ($mode == 'spec') ? $task_spec : static::randomTask();
        $new_task->date = date('Y-m-d');
        $new_task->complete = 0;
        $new_task->img = null;
        $new_task->share_link = null;
        $new_task->remarks = '';

        $new_task->save();

        return AjaxResponse::success(200,null,route('checkin_index'));
    }
}
