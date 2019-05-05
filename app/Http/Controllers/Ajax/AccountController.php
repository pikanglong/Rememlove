<?php

namespace App\Http\Controllers\Ajax;

use App\Models\AjaxResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * 更新用户头像.
     *
     * @param Request $request
     * @return Response
     */
    public function updateAvatar(Request $request)
    {
        $path = $request->file('avatar')->store('public/avatars');
        $path = substr($path,6);
        Auth::user()->update(['avatar' => 'storage'.$path]);
        return AjaxResponse::success();
    }
}
