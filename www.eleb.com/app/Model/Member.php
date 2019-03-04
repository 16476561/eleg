<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Member extends Authenticatable
{
    //
    protected $fillable=['password','username','tel','rememberToken'];
}
