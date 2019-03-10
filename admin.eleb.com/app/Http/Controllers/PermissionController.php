<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $permissions=Permission::all();
        return view('permission.index',['permissions'=>$permissions]);
    }

    public function create(){
        return view('permission.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:permissions,name',
        ],[
            'name.required'=>'权限必填',
            'name.unique'=>'账号已存在',
        ]);
      $permission=Permission::create([
            'name'=>$request->name,

        ]);

        $request->session()->flash('success','添加成功');
        return redirect()->route('permissions.index');
    }

        public function destroy(Request $request,Permission $permission){
            $permission->delete();
            $request->session()->flash('success','删除成功');
            return redirect()->route('permissions.index');
        }

        public function edit(Permission $permission){
            return view('permission.edit',['permission'=>$permission]);
            }

        public function update(Request $request,Permission $permission){
            $this->validate($request,[
                'name'=>'required|unique:permissions,name',
            ],[
                'name.required'=>'权限必填',
                'name.unique'=>'账号已存在',
            ]);
           $permission->update([
                'name'=>$request->name,


            ]);
            $request->session()->flash('success','修改成功');
            return redirect()->route('permissions.index');
        }

}
