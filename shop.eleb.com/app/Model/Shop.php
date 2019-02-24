<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class shop extends Model
{
    //

    protected $fillable = ['shop_category_id', 'shop_name', 'shop_img', 'shop_rating', 'brand', 'on_time', 'fengniao', 'bao', 'piao', 'zhun', 'start_send', 'send_cost', 'notice', 'discount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id','shop_id');
        //return $this->belongsTo(\Illuminate\Foundation\Auth\User::class,'abc_id','id');
    }

    public function shopsss()
    {
        return $this->belongsTo(ShopCategory::class, 'shop_category_id', 'id');
//}
//     public function shopsss(){
//         $sql= DB::select("select * from shop_categories left join shops on shop_category_id=shop_category_id" );
//         //var_dump($sql);exit;
//              return  DB::mysqli_fetch_all($sql);
//     }
    }
}