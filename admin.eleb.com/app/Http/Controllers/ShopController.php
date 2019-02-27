<?php

namespace App\Http\Controllers;

use App\Model\shop;
use App\Model\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $shops=shop::all();
       // $shopcategorys=shopcategory::all();
        //var_dump($shopcategorys);exit;
        return view('shop.index',['shops'=>$shops]);
    }
    public function create(){
        $shopcategorys=ShopCategory::all();
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

            ]);
                $img=$request->file('shop_img');

                if($img){
                    $path=url(Storage::url($img->store('public/shop')));
                }else{
                    $path='';
                }
               // dd($path);
//                $data = $request->input();
//                $data["shop_img"]= $path;

            shop::create([
                //$data
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
                'status'=>$request->status,
                'view_times'=>0,
                //'img'=>Storage::url($path),
    ]);
                $request->session()->flash('success','添加成功');
                return redirect()->route('shops.index');


    }
                public function edit(Shop $shop){
//                    if($shop->shop_category_id!=auth()->user()->id){
//                        dd('只能修改自己的文章');
//                    }
                    $shopcategorys=ShopCategory::all();
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
                        'status'=>$request->status,
                        'view_times'=>0,
                        'img'=>$path,
                    ]);

                    $request->session()->flash('success','修改成功');
                    return redirect()->route('shops.index');

                }
                    public function destroy(Shop $shop){

                        $shop->delete();
                        session()->flash('success','删除成功');
                        return redirect()->route('shops.index');
                    }

                            //状态启动
                   public function change(Shop $shop){
                                //var_dump($shop);exit;
                       //dd($shop);
                       DB::update("update  shops set   status=1 where id=$shop->id");

                       session()->flash('success','启动成功');
                       return redirect()->route('shops.index');
                   }
                        //状态禁用
                    public function off(Shop $shop){
                        DB::update("update shops set  status=-1 where id=$shop->id");
                        session()->flash('success','禁用成功');
                        return redirect()->route('shops.index');
                    }


                    public function show(Shop $shop){
                //echo '1111';exit;
                           // $shops=shop::all();
                            //ar_dump($shops);exit;
                        return view('shop.show',['shop'=>$shop]);
                    }

}
