<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class AjaxResponse extends Model
{
    public static function success($statusCode=200, $desc=null, $data=null)
    {
        if (($statusCode>=1000)) {
            $statusCode=200;
        }
        $output=[
             'ret' => $statusCode,
            'desc' => is_null($desc) ? self::desc($statusCode) : $desc,
            'data' => $data
        ];
        return response()->json($output);
    }

    public static function err($statusCode, $desc=null, $data=null)
    {
        if (($statusCode<1000)) {
            $statusCode=1000;
        }
        $output=[
             'ret' => $statusCode,
            'desc' => is_null($desc) ? self::desc($statusCode) : $desc,
            'data' => $data
        ];
        return response()->json($output);
    }

    private static function desc($errCode)
    {
        $errDesc=[

            '200'  => "Successful",
            '403'  => "Forbidden",
            '451'  => "Unavailable For Legal Reasons",

            '1001' => 'parms missing',

            '2000' => "Account-Related Error",
            '2001' => "Permission Denied",
            '2002' => "Please Login First",

            '3005' => "Copper", // Reserved for Copper , Don't ask me why , I love copper forever.

            //==================binding
            '4001' => '找到你的Ta再困难也不能和自己...哦',
            '4002' => 'Ta已经有对象啦,请不要做第三者',
            '4003' => '邀请码已经失效',
            '4004' => '你已经有对象了,想让Ta知道你的渣男行为吗',
            '4005' => '找不到符合条件的用户',
            '4006' => '你已经向Ta发送过邀请了哦',

            //==================checkin
            '5001' => '今天的任务已经分配了哦',
            '5002' => '请先找到你的Ta吧',
            '5003' => '上传的文件是无效文件',
            '5004' => '今天的任务还没有分配哦',
            '5005' => '慢着...你提交的好像不是你的任务',

            //==================message
            '6001' => '不能偷看别人的消息',
            '6002' => '指定的消息不存在',
            '7000' => ' 已经分享过了',
            '8000' => '你还没绑定你的另一半呢',
        ];
        return isset($errDesc[$errCode]) ? $errDesc[$errCode] : $errDesc['1000'];
    }
}
