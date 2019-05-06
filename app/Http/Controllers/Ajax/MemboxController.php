<?php

namespace App\Http\Controllers\Ajax;

use App\Models\AjaxResponse;
use App\Models\Binding;
use App\Models\Membox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MemboxController extends Controller
{
    public function newpost(Request $request){
        $uid = Auth::user()->id;
        $binding = new Binding();
        $bid = $binding->getBindingIdByUid($uid);
        if(!isset($bid)){
            return AjaxResponse::err(8000);
        }
        $time = intval($request->input('time'));
        $text = $request->input('text');
        $password = $request->input('password');
        $password_tip = $request->input('password-tip');
        $count = intval($request->input("pic-count"));
        $path = strval($count);
        $valid = true;
        if($count > 0){
            for($a=0;$a<$count;$a++){
                $str = "pic-".strval($a);
                if($request->file($str)->isValid()){
                    $path_temp = $request->file($str)->store('/static/img/membox','web_root');
                    $file_name = explode('/',$path_temp);
                    $file_name = $file_name[count($file_name) - 1];
                    $path .= '|'.$file_name;
                }else{
                    $valid = false;
                }
            }
        }

        if(!$valid){
            return AjaxResponse::err(5003);
        }
        $mem = new Membox;

        $mem->uid = $uid;
        $mem->title = "";
        $mem->contents = $text;
        $mem->img = $path;
        $mem->password = $password;
        $mem->tips = $password_tip;
        $mem->binding_id = $bid;
        $mem->time_see = Date('Y-m-d');
        $mem->private =1;
        if ($time == 0){
            $mem->private =0;
            $mem->new_time_see = Date('Y-m-d H:i:s');
        }elseif ($time == 1){
            $mem->new_time_see = Date('Y-m-d H:i:s',time());
        }elseif ($time == 2){
            $mem->new_time_see = Date('Y-m-d H:i:s',time() + 3600);
        }elseif ($time == 3){
            $mem->new_time_see = Date('Y-m-d H:i:s',time() + 6*3600);
        }elseif ($time == 4){
            $mem->new_time_see = Date('Y-m-d H:i:s',time() + 12*3600);
        }elseif ($time == 5){
            $mem->new_time_see = Date('Y-m-d H:i:s',time() + 24*3600);
        }elseif ($time == 6){
            $mem->new_time_see = Date('Y-m-d H:i:s',time() + 360 * 24 * 3600);
        }

        $mem->share_link = "";
        $mem->save();

        return AjaxResponse::success();
    }

    public function share(Request $request){
        $mid = $request->input('mid');
        $mem =Membox::find($mid);
        if ($mem->uid != Auth::user()->id){
            return AjaxResponse::err(2000);
        }
        if ($mem -> share_link !== ""){
            return AjaxResponse::success(201,$mem -> share_link);
        }
        $chars='abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';

        $code='';
        for ($i=0; $i<16; $i++) {
            $code.=$chars[mt_rand(0, strlen($chars)-1)];
        }
        $mem -> share_link = $code;
        $mem->save();
        return AjaxResponse::success(200,$code);
    }
}
