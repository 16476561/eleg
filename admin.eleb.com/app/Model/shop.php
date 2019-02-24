<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    //

    protected $fillable=['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status'];
    public function shopsss(){
        return $this->belongsTo(ShopCategory::class,'shop_category_id','id');
        //return $this->belongsTo(\Illuminate\Foundation\Auth\User::class,'abc_id','id');
    }
//    public function shopsss(){
//    return $this->belongsTo(admin::class,'shop_category_id','id');
//}

}
