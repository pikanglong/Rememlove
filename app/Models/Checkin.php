<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    protected $table = 'checkin';

    public function getTodayTask($binding_id){
        return static::where('date',date('Y-m-d'))
                        ->where('binding_id',$binding_id)->first();
    }

    public function getTaskList(){
        //TODO
    }
}
