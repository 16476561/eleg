<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    protected $fillable=['id','user_id','shop_id','sn','province','city','county','address','tel','name','total','status','created_at	','out_trade_no'];
}
