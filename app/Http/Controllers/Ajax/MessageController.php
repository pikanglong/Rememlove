<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\AjaxResponse;
use Auth;


class MessageController extends Controller
{
    public function read(Request $request){
        $user = Auth::user();
        $message_id = $request->input('message_id');

        if(empty($message_id)){
            return AjaxResponse::err(1001);
        }

        $message = Message::find($message_id);
        if(empty($message)){
            return AjaxResponse::err(6002);
        }

        if($message->user_id != $user->id){
            return AjaxResponse::err(6001);
        }
        $result = [
            'title' => $message->title,
            'contents' => $message->contents,
        ];

        if(!empty($message->link)){
            $result['link'] = $message->link;
        }

        $message->already_read = true;
        $message->save();

        return AjaxResponse::success(200,null,$result);
    }
}
