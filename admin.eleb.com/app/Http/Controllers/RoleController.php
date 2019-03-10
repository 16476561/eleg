<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $roles=Role::all();
        $permissions=Permission::all();
        return view('role.index',['roles'=>$roles,'permissions'=>$permissions]);
    }
    public function create(){
       $permissions=Permission::all();

       //dd($permissions);
        return view('role.create',['permissions'=>$permissions]);
    }


    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required'
            ],[
                'name.required'=>'角色名称必填',

            ]);

        $role=Role::create([
            'name'=>$request->name,

     ]);
       //$role= new \Spatie\Permission\Models\Role();
////       $role->syncPermissions($request->per);
//        $role->name=$request->name;
//        $role->save();
        $role->syncPermissions($request->per);

        $request->session()->flash('success','添加成功');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role){
            $role->delete();
            session()->flash('success','删除成功');
            return redirect()->route('roles.index');
    }

    public function edit(Role $role){
        $permissions=Permission::all();
        return view('role.edit',['role'=>$role,'permissions'=>$permissions]);
    }

    public function update(Request $request,Role $role){
        $this->validate($request,
            [
                'name'=>'required'
            ],[
                'name.required'=>'角色名称必填',

            ]);
        $role->update([
            'name'=>$request->name,
        ]);

        $role->syncPermissions($request->per);
        session()->flash('success','修改成功');
        return redirect()->route('roles.index');
    }


}
