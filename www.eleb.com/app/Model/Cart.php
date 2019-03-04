<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable=['user_id','goods_id','id','amount'];
    public function menus(){
        $this->belongsTo(Menus::class,'user_id','id');
    }

}
