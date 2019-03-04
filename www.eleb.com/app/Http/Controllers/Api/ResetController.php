<?php

namespace App\Http\Controllers\Api;

use App\Model\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class ResetController extends Controller
{
    //重置密码
    public function reset(Request $request){
        $redis=new \Redis();
        $redis->connect('127.0.0.1');
        if($request->sms == $redis->get($request->tel)){
            $member=Member::where('tel','=',$request->tel)->get()->first();
            $member->password=Hash::make($request->password);
            $member->save();
            return ["status"=>"true","message"=>"重置成功"];
        }else{
            return  ["status"=>"false","message"=>"验证码错误"];
        }
         }

                //修改密码
        public function cps(Request $request){
          $validator=Validator::make($request->all(),
              [
                  'oldPassword'=>'required',
                  'newPassword'=>'required',
              ],[
                  'oldPassword.required'=>'旧密码必填',
                  'newPassword.required'=>'新密码必填',
                 // 'newPassword.confirmed'=>'输入2次密码不一致',
              ]);
                 if($validator->fails()){
              return ["status"=>"true","message"=>$validator->errors()->all()];
          }

               if(Hash::check($request->oldPassword,Auth::user()->password)){
                    $members=Member::find(Auth::user()->id);
                    $members->password=Hash::make($request->newPassword);

                    $members->update();
                   return ["status"=>"true","message"=>"修改成功"];
          }else{
                     return ["status"=>"false","message"=>"原始密码不匹配"];
          }

        }





}
