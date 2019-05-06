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
        $time = $request->input('time');
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
        $uid = Auth::user()->id;
        $mem->uid = $uid;
        $mem->title = "";
        $mem->contents = $text;
        $mem->img = $path;
        $mem->password = $password;
        $mem->tips = $password_tip;
        $binding = new Binding();
        $mem->binding_id = $binding->getBindingIdByUid($uid);
        $mem->private =0;
        $mem->new_time_see = Date('Y-m-d');
        $mem->time_see = Date('Y-m-d');
        $mem->share_link = "";
        $mem->save();

        return AjaxResponse::success();
    }
}
