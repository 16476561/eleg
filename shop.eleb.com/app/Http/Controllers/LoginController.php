<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest',[
            //只能游客登陆，登陆了就不能在登陆了
            'only'=>['create']
        ]);
    }


    //
    public function create(){
        return view('login.create');
    }
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
            'status'=>1,//禁用账号先设定状态，1为正常，当为0就禁用
        ],$request->has('remember'))){
            return redirect()->intended(route('shops.index','登陆成功'));
        }else{
            //禁用账号
            $user=User::where('name',$request->name)->first();
            if($user && $user->status==0) return back()->with('danger','账号被禁用');
            return back()->with('danger','账号密码不正确');
        }

    }
    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','退出成功');
    }

    //接受上传图片
    public function upload(Request $request){
        $img=$request->file('file');
        $path=url(Storage::url($img->store('public/shop')));
        return ['path'=>$path];
    }



}
