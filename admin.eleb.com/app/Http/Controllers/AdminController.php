<?php

namespace App\Http\Controllers;

use App\Model\admin;
use App\User;
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


    public function destroy(Admin $admin)
    {
        //  var_dump($admin);exit;

        $admin->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('admins.index');
    }


    //修改旧密码和确认新密码

        public function password(){
        return view('admin.password');
        }

                //修改密码
        public  function password1(Request $request){
         $this->validate($request,[
                'jiu'=>'required',
                'new_password'=>'required|confirmed',
                'new_password_confirmation'
            ],[
                'jiu.required'=>'请输入旧密码',
                'new_password.required'=>'请输入新密码',
                'new_password.confirmed'=>'二次密码不一致',
                'new_password.confirmation'=>'',
            ]);

       if(Hash::check($request->jiu,Auth::user()->password)) {

                    $admin1=admin::find(Auth::user()->id);
                    $admin1->password=Hash::make($request->new_password);
                    $admin1->save();
                    Auth::logout();
                    return redirect()->route('login')->with('success','修改成功');
          }else{
              return back()->with('danger','旧密码不正确');

          }}
}



