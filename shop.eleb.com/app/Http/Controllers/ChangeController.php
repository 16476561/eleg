<?php

namespace App\Http\Controllers;

use App\Model\user;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function password(){
        return view('change.password');
    }
    public function password1(Request $request)
    {
//        $this->validate($request,
//            [
//                'old_password'=>'required',
//                'new_password'=>'required|confirmed',
//                'new_password_confirmation'=>'required',
//
//            ],[
//                'old_password.required'=>'旧密码必填',
//                'new_password.required'=>'新密码必填',
//                'new_password.confirmed'=>'二次密码不一致',
//                'new_password_confirmation.required'=>'确认密码必填',
//
//            ]);


                //修改密码(旧密码和数据库的密码做对比)
        if(Hash::check($request->old_password,Auth::user()->password)) {
            // 密码对比...
            //var_dump($request->old_password);exit;
            //得到登陆的ID
          $user1=User::find(Auth::user()->id);
           // dd($user2);
                //把数据库的密码==修改时的密码加密
          $user1->password =Hash::make($request->new_password);
          $user1->save();
            Auth::logout();
            return redirect()->route('login')->with('success','修改成功');
        } else {
            return back()->with('danger','旧密码不正确');
        }


    }

    //接受上传图片
    public function upload(Request $request){
        $img=$request->file('file');
        $path=Storage::url($img->store('public/shop'));
        return ['path'=>$path];
    }
}
