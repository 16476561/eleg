<?php

namespace App\Http\Controllers;

use App\Model\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
//中间件
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $admins = admin::all();
        return view('admin.index', ['admins' => $admins]);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|unique:admins,name',
                'email' => 'required|unique:admins,email',
                'password' => 'required'
            ], [
                'name.required' => '账号必填',
                'name.unique' => '账号已存在',
                'email.required' => '邮箱必填',
                'email.unique' => '邮箱已存在',
                'password.required' => '密码必填',
            ]);
        admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => 0,
        ]);
        $request->session()->flash('success', '添加成功');
        return redirect()->route('admins.index');

    }

//    public function edit(Admin $admin)
//    {
//
//
//        return view('admin.edit', ['admin' => $admin]);
//    }

//    public function update(Request $request, Admin $admin)
//    {
//        $this->validate($request, [
//            'name' => 'required|unique:admins,name',
//            'email' => 'required|unique:admins,email',
//            'password' => 'required'
//        ], [
//            'name.required' => '账号必填',
//            'name.unique' => '账号已存在',
//            'email.required' => '邮箱必填',
//            'email.unique' => '邮箱已存在',
//            'password.required' => '密码必填',
//        ]);
//        $admin->update([
//            'name' => $request->name,
//            'password' => Hash::make($request->password),
//            'email' => $request->email,
//        ]);
//        $request->session()->flash('success', '修改成功');
//        return redirect()->route('admins.index');
//    }

    public function destroy(Admin $admin)
    {
        //  var_dump($admin);exit;

        $admin->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('admins.index');
    }


    //修改旧密码和确认新密码


    public function password(Admin $admin)
    {

        return view('admin.password', ['admin' => $admin]);

    }


    public function password1(Request $request, Admin $admin)
    {
          //dd($admin);
          //dd(Auth::user()->password);

        if(Hash::check($request->hashedPassword,Auth::user()->password)) {
            // 密码对比...

            $admin->password=Hash::make($request->password);
           // var_dump($admin->password);exit;
            //var_dump($request->password1,$request->password2 );exit;
            $admin->save();
            Auth::logout();
            session()->flash('success', '修改成功');
            return redirect()->route('login');
        } else {
            session()->flash('danger', '原始密码不一样');
            return back();
        }


    }
}