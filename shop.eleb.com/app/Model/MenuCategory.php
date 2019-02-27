<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //
    protected $fillable=['name','shop_id','type_accumulation','description','is_selected'];

    public function shop(){
        return $this->belongsTo(shop::class,'shop_id','id');
    }

}
