<?php

namespace App\Http\Controllers\Api;

use App\Model\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class AddressController extends Controller
{
    //
    public function index(){
        $address_shows=Address::where('user_id',auth()->user()->id)->get();
        return $address_shows;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'provence' => 'required',
            'city' => 'required',
            'area'=>'required',
            'name'=>'required',
            'tel'=>'required',
            'detail_address'=>'required',
        ], [
            'provence.required' => '省市没填写',
            'city.required' => '城市必填',
            'tel.required' => '电话必填',
            'area.required' => '县没填写',
            'name.required' => '姓名没填',
            'detail_address.required' => '请填写详细地址',
        ]);
        //判断返回数据
        if ($validator->fails()) {
            return ['status' => 'false', "message"=>$validator->errors()->all()];
        }
        Address::create([
            'name'=>$request->name,
            'tel'=>$request->tel,
            'area'=>$request->area,
            'detail_address'=>$request->detail_address,
            'provence'=>$request->provence,
            'city'=>$request->city,
            'user_id'=>auth()->user()->id,
            'is_address'=>0,
        ]);
            return ["status"=> "true",
                     "message"=> "添加成功"];
    }


        public  function update(Request $request ){
        $Address=Address::find($request->id);
     // echo 1111;
            $validator = Validator::make($request->all(), [
                'provence' => 'required',
                'city' => 'required',
                'area'=>'required',
                'name'=>'required',
                'tel'=>'required',
                'detail_address'=>'required',
            ], [
                'provence.required' => '省市没填写',
                'city.required' => '城市必填',
                'tel.required' => '电话必填',
                'area.required' => '县没填写',
                'name.required' => '姓名没填',
                'detail_address.required' => '请填写详细地址',
            ]);
            //判断返回数据
            if ($validator->fails()) {
                return ['status' => 'false', "message"=>$validator->errors()->all()];
            }
            $Address->update([
                'name'=>$request->name,
                'tel'=>$request->tel,
                'area'=>$request->area,
                'detail_address'=>$request->detail_address,
                'provence'=>$request->provence,
                'city'=>$request->city,
                'user_id'=>auth()->user()->id,
                'is_address'=>0,
            ]);

            return ["status"=> "true",
                     "message"=> "修改成功"];

        }
        public function edit(Request $request){
            $address=Address::find($request->id);

            return $address;

        }



}
