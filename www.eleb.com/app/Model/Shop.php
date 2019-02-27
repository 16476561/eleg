<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    public function MenuCategory(){
        return $this->belongsTo(MenuCategory::class,'shop_id');
    }
}
