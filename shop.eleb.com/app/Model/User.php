<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $fillable=['name','password','status','email','remember_token','shop_id'];
}
