<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\ShopCategory;
use App\Model\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['create','store']
        ]);
    }

    public function index(){
        //登陆只能看见自己的商铺
        $id=auth()->user()->shop_id;
        $shop=shop::get()->where('id',$id)->first();

        $shopcategorys=DB::select('select * from shop_categories');
        //var_dump($shopcategorys);exit;
        return view('shop.index',['shop'=>$shop,'shopcategorys'=>$shopcategorys]);
    }
    public function create(){
        $shopcategorys=DB::select('select * from shop_categories');
        //var_dump($shopcategorys);exit;
        // var_dump($shopcategorys);exit;
        return view('shop.create',['shopcategorys'=>$shopcategorys]);
    }
    public function store(Request $request){
        $this->validate($request,
            [
                'shop_category_id'=>'required',
                'shop_name'=>'required',
                'shop_img'=>'image',
                'shop_rating'=>'required|numeric',
                'brand'=>'required',
                'on_time'=>'required',
                'fengniao'=>'required',
                'bao'=>'required',
                'piao'=>'required',
                'zhun'=>'required',
                'start_send'=>'required|numeric',
                'send_cost'=>'required|numeric',
                'notice'=>'required',
                'discount'=>'required',

                'name'=>'required|unique:users,name',
                'email'=>'required|unique:users,email',
                'password'=>'required|min:6|confirmed',

            ],[
                'shop_category_id.required'=>'商家分类不能为空',
                'shop_name.required'=>'商家名称不能为空',
                'shop_img.image'=>'商家图片格式错误',
                'shop_rating.required'=>'请填写评分',
                'shop_rating.numeric'=>'请填数字',
                'brand.required'=>'请选择品牌',
                'on_time.required'=>'请选择是否准时送达',
                'fengniao.required'=>'请选择是否蜂鸟配送',
                'bao.required'=>'请选择是否保标记',
                'piao.required'=>'请选择是否票标记',
                'zhun.required'=>'请选择是否准标记',
                'start_send.required'=>'请选择起送金额',
                'start_send.numeric'=>'请填数字',
                'send_cost.required'=>'请选择配送费',
                'send_cost.numeric'=>'请填数字',
                'notice.required'=>'请填写店铺公告',
                'discount.required'=>'请填写优惠信息',

                'name.required'=>'账号必填',
                'name.unique'=>'账号已存在',
                'email.required'=>'邮箱必填',
                'email.unique'=>'邮箱已存在',
                'password.required'=>'密码必填',
                'password.confirmed'=>'二次密码不一致',

            ]);
        $img=$request->file('shop_img');

        if($img){
            $path=url(Storage::url($img->store('public/shop')));
        }else{
            $path='';
        }
       $date=[
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$path,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>0,
            'view_times'=>0,
            'img'=>$path,

        ];
        //var_dump($date);exit;
           $shops=Shop::create($date);
        //var_dump($shops);exit;
           $date1=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status'=>0,
            'remember_token'=>0,
           'shop_id'=>$shops->id,

        ];
           User::create($date1);
            //var_dump($shops->id);exit;

        $request->session()->flash('success','注册成功');
        return  back();
        //return redirect()->route('shops.login');


    }
    public function edit(Shop $shop){
                    if($shop->id!=auth()->user()->shop_id){
                            dd('只能修改自己的文章');
                 }
        $shopcategorys=DB::select('select * from shop_categories');
        return view('shop.edit',['shop'=>$shop,'shopcategorys'=>$shopcategorys]);
    }



    public function update(Request $request,Shop $shop){
        $this->validate($request,
            [
                'shop_category_id'=>'required',
                'shop_name'=>'required',
                'shop_img'=>'image',
                'shop_rating'=>'required|numeric',
                'brand'=>'required',
                'on_time'=>'required',
                'fengniao'=>'required',
                'bao'=>'required',
                'piao'=>'required',
                'zhun'=>'required',
                'start_send'=>'required|numeric',
                'send_cost'=>'required|numeric',
                'notice'=>'required',
                'discount'=>'required',

            ],[
                'shop_category_id.required'=>'商家分类不能为空',
                'shop_name.required'=>'商家名称不能为空',
                'shop_img.image'=>'商家图片格式错误',
                'shop_rating.required'=>'请填写评分',
                'shop_rating.numeric'=>'填写数字',
                'brand.required'=>'请选择品牌',
                'on_time.required'=>'请选择是否准时送达',
                'fengniao.required'=>'请选择是否蜂鸟配送',
                'bao.required'=>'请选择是否保标记',
                'piao.required'=>'请选择是否票标记',
                'zhun.required'=>'请选择是否准标记',
                'start_send.required'=>'请选择起送金额',
                'start_send.numeric'=>'请填数字',
                'send_cost.required'=>'请选择配送费',
                'send_cost.numeric'=>'请填数字',
                'notice.required'=>'请填写店铺公告',
                'discount.required'=>'请填写优惠信息',

            ]);

        $img=$request->file('shop_img');

        if($img){
            $path=url(Storage::url($img->store('public/shop')));
        }else{
            $path=$shop->shop_img;
        }

        $shop->update([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$path,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>0,
            'view_times'=>0,
            'img'=>$path,
        ]);

        $request->session()->flash('success','修改成功');
        return redirect()->route('shops.index');

    }
    public function destroy(Shop $shop){
        if($shop->id!=auth()->user()->shop_id){
            dd('只能删除自己的文章');
        }
        $shop->delete();
        session()->flash('success','删除成功');
        return redirect()->route('shops.index');
    }
    //状态启动
//    public function change(Shop $shop){
//        //var_dump($shop);exit;
//        //dd($shop);
//        DB::update("update  shops set   status=1 where id=$shop->id");
//
//        session()->flash('success','启动成功');
//        return redirect()->route('shops.index');
//    }
//    //状态禁用
//    public function off(Shop $shop){
//        DB::update("update shops set  status=-1 where id=$shop->id");
//        session()->flash('success','禁用成功');
//        return redirect()->route('shops.index');
//    }

    public function show(Shop $shop){

        return view('shop.show',['shop'=>$shop]);
    }

    //接受上传图片
    public function upload(Request $request){
        $img=$request->file('file');
        $path=Storage::url($img->store('public/shop'));
        return ['path'=>$path];
    }




}

