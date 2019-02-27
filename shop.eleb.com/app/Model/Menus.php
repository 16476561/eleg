<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    //
    protected $fillable=['goods_name','rating','goods_price','description','month_sales','rating_count','category_id','status','tips','satisfy_count','satisfy_rate','goods_img','shop_id'];

    public function shop(){
       return $this->belongsTo(shop::class,'shop_id','id');
    }
    public function MenuCategory(){
       return $this->belongsTo(MenuCategory::class,'category_id','id');
    }

}
