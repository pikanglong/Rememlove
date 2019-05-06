<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Membox;
use App\Models\Binding;

class Like extends Model
{
    protected $table = 'like';

    public function countLike($uid){
        $count = 0;
        $Binding = new Binding();
        $binding_id = $Binding -> getBindingIdByUid($uid);
        $Membox = new Membox();
        $membox = $Membox -> getMembox($binding_id);
        foreach($membox as $m)
        {
            $count += DB::table('like') -> where('memboxid','=',$m -> id) -> where('deleted_at','=',null) -> count();
        }
        return $count;
    }
}
