<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //
    protected $fillable=['name','description','member_id','events_id'];

    public function event(){
        return $this->belongsTo(Event::class,'events_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'member_id','id');
    }


}
