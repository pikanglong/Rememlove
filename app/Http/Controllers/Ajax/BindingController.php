<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AjaxResponse;
use App\Models\Binding;
use App\Models\Invite;
use Auth;

class BindingController extends Controller
{
    public function newInviteCode(){
        $invite = new Invite();
        $new_code;
        do {
            $new_code = $invite->generateCode(12);
        } while ($invite->codeExist($new_code));
        $uid = Auth::user()->id;
        $invite->saveUserCode($uid,$new_code);
        return AjaxResponse::success(200,'successful',$new_code);
    }
}
