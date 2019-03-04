<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable=['is_address','user_id','city','provence','detail_address','area','tel','name','id'];
}
