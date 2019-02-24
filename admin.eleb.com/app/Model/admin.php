<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class admin extends Authenticatable
{
    //
    protected $fillable=['name','password','email','remember_token'];
}
