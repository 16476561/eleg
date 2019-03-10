<?php

namespace App\Http\Controllers;

use App\Model\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $users=user::all();
        return view('user.index',['users'=>$users]);
    }
    //禁止
    public function guan(User $user){

        DB::update("update users set status=0 where id=$user->id");
        session()->flash('success','禁止成功');
        return redirect()->route('users.index');
    }
        //启动
    public function start(User $user){
        DB::update("update users set status=1 where id=$user->id");
        session()->flash('success','启动成功');
        return redirect()->route('users.index');
    }
    //重置密码页面
    public function reset(User $user){
        return view('user.reset',['user'=>$user]);
    }
    //重置密码方法
    protected function broker(Request $request,User $user){
        //查看一条数据
          $user1=user::find($user->id);
          $user1->password=Hash::make($request->password);
          $user1->save();
        session()->flash('success','重置成功');
        return redirect()->route('users.index');
    }
}
