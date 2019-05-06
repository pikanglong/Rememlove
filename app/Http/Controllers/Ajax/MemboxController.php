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

        $mem->uid = $uid;
        $mem->title = "";
        $mem->contents = $text;
        $mem->img = $path;
        $mem->password = $password;
        $mem->tips = $password_tip;
        $mem->binding_id = $bid;
        $mem->private =0;
        $mem->new_time_see = Date('Y-m-d');
        $mem->time_see = Date('Y-m-d');
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
