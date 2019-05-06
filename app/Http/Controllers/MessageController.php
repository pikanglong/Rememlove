<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Auth;

class MessageController extends Controller
{
    public function index(){
        $user = Auth::user();

        $message = new Message();

        $message_list = $message->getUnreadList($user->id);

        return View('message.index',[
            'page_title' => "未读消息",
            'site_title' => "记恋",
            'message_list' => $message_list,
        ]);
    }
}
