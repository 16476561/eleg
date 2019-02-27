<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest',[
            //只能游客登陆，登陆了就不能在登陆了
            'only'=>['create']
        ]);
    }


    //登陆页面
    public function create(){
        return view('login.create');
    }

    //登陆
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ],[
            'name.required'=>'账号密码错误',
            'password.required'=>'账号密码错误',
            'captcha.required'=>'请填写验证码',
            'captcha.captcha'=>'验证码不正确',
        ]);
            if(Auth::attempt([
                'name'=>$request->name,
                'password'=>$request->password,
            ],$request->has('remember'))){
                return redirect()->route('shops.index','登陆成功');
            }else{
                return back()->with('danger','账号密码不正确');
            }


                    //退出登陆
            }
    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','退出成功');
    }




}
