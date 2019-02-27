<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //
    public function MenCategory(){

        $this->belongsTo(User::class,'shop_id');
    }
}
