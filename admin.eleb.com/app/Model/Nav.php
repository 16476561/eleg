<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Nav extends Model
{
    //
    protected  $fillable=['name','pid','permission_id','url'];
    use HasPermissions;
    protected $gured_name='web';

    //导航菜单和权限的关系
 public function permission(){
     return $this->belongsTo(Permission::class,'permission_id','id');
 }

}
