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

            '3005' => "Copper", // Reserved for Copper in memory of OASIS and those who contributed a lot

            //==================binding
            '4001' => '找到你的Ta再困难也不能和自己...哦',
            '4002' => 'Ta已经有对象啦,请不要做第三者',
            '4003' => '邀请码已经失效',
            '4004' => '你已经有对象了,想让Ta知道你的渣男行为吗'
        ];
        return isset($errDesc[$errCode]) ? $errDesc[$errCode] : $errDesc['1000'];
    }
}
