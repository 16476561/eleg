<?php

namespace App\Http\Controllers;

use App\Model\user;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangeController extends Controller
{
    //
    public function password(User $user){
        return view('change.password',['user'=>$user]);
    }
    public function password1(Request $request,User $user)
    {
        //dd($admin);
        //dd(Auth::user()->password);

        if(Hash::check($request->hashedPassword,Auth::user()->password)) {
            // 密码对比...
            var_dump($request->hashedPassword);
            var_dump(Auth::user()->password);exit;



            $user->password=Hash::make($request->password);
            $user->save();
            var_dump($user->save());
            Auth::logout();
            session()->flash('success', '修改成功');
            return redirect()->route('login');
        } else {
            session()->flash('danger', '原始密码不一样');
            return back();
        }


    }
}
