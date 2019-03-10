<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;


class admin extends Authenticatable
{
    //
    use HasRoles;
    protected $guard_name='web';

    protected $fillable=['name','password','email','remember_token'];
}
