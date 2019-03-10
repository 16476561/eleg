<?php

namespace App\Http\Controllers;
use App\Model\MenuCategory;
use App\Model\user;
use Illuminate\Support\Facades\Auth;
use App\Model\Menus;
use App\Model\shop;
use App\Model\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenusController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth'

        );
    }

    public function create(){

        $shops=MenuCategory::all()->where('shop_id',auth()->user()->shop_id);
       // dd($shops);
        return view('Menus.create',['shops'=>$shops]);
    }

    public function store(Request $request){
        $this->validate($request,
            [

                'goods_name'=>'required',
                'rating'=>'required|numeric',
                'status'=>'required',
                'category_id'=>'required',
                'description'=>'required',
                'month_sales'=>'required|numeric',
                'rating_count'=>'required|numeric',
                'tips'=>'required',
                'satisfy_count'=>'required|numeric',
                'satisfy_rate'=>'required|numeric',
                'goods_img'=>'image',

            ],[
                'goods_name.required'=>'名称必填',
                'rating.required'=>'评分必填',
                'rating.numeric'=>'评分填写数字',
                'category_id.required'=>'所属菜品没选',
                'status.required'=>'菜品状态未选',
                'goods_price.required'=>'价格必填',
                'description.required'=>'描述必填',
                'month_sales.required'=>'月销量',
                'rating_count.required'=>'	评分数量',
                'tips.required'=>'	提示信息',
                'satisfy_count.required'=>'	满意度数量',
                'satisfy_rate.required'=>'	满意度评分',
                'goods_img.required'=>'商品图片请上传',
                'goods_price.numeric'=>'价格填写数字',
                'month_sales.numeric'=>'月销量填写数字',
                'rating_count.numeric'=>'	评分数量填写数字',
                'satisfy_count.numeric'=>'满意度数量填写数字',
                'satisfy_rate.numeric'=>'满意度评分填写数字',
                'goods_img.image'=>'图片格式不对'

            ]);

        $img=$request->file('goods_img');

        if($img){
            $path=url(Storage::url($img->store('public/shop')));
        }else{
            $path='';
        }


           Menus::create([
                'goods_name'=>$request->goods_name,
                'rating'=>$request->rating,
                'goods_price'=>$request->goods_price,
                'description'=>$request->description,
                'month_sales'=>$request->month_sales,
                'rating_count'=>$request->rating_count,
                'tips'=>$request->tips,
                'satisfy_count'=>$request->satisfy_count,
                'satisfy_rate'=>$request->satisfy_rate,
                'goods_img'=>$path,
               'shop_id'=>auth()->user()->id,
               'category_id'=>$request->category_id,
               'status'=>$request->status,
               'view_times'=>0,
               'img'=>$path,
           ]);
        //var_dump($img);exit;

        $request->session()->flash('success','注册成功');
        return  redirect()->route('Menus.index');


    }

    public function index(Request $request){

        //$menus=Menus::all();
        //价格+搜索+分页
        $keyword=$request->keyword;
        $goods_price1=$request->goods_price1;
        $goods_price2=$request->goods_price2;
        $wheres=[];
        //var_dump($wheres);exit;
        if($keyword) $wheres[]=['goods_name','like',"%$keyword%"];
        if($goods_price1) $wheres[]=['goods_price','>=',$goods_price1];
        if($goods_price2) $wheres[]=['goods_price','<=',$goods_price2];
        $menus= Menus::where($wheres)->where('shop_id','=',auth()->user()->id)->paginate(2);

        //dd($menus);
        //dd($wheres);
        return view('Menus.index',['menus'=>$menus]);
    }

        public function edit(Menus $Menu){
            $a=auth()->user()->shop_id;
            $shops=MenuCategory::all()->where('shop_id',$a)->all();
        return view('Menus.edit',compact('Menu'),compact('shops'));

        }

        public function update(Request $request,Menus $Menu){
            $this->validate($request,
                [

                    'goods_name'=>'required',
                    'rating'=>'required|numeric',
                    'status'=>'required',
                    'category_id'=>'required',
                    'description'=>'required',
                    'month_sales'=>'required|numeric',
                    'rating_count'=>'required|numeric',
                    'tips'=>'required',
                    'satisfy_count'=>'required|numeric',
                    'satisfy_rate'=>'required|numeric',
                    'goods_img'=>'image',

                ],[
                    'goods_name.required'=>'名称必填',
                    'rating.required'=>'评分必填',
                    'rating.numeric'=>'评分填写数字',
                    'category_id.required'=>'所属菜品没选',
                    'status.required'=>'菜品状态未选',
                    'goods_price.required'=>'价格必填',
                    'description.required'=>'描述必填',
                    'month_sales.required'=>'月销量',
                    'rating_count.required'=>'	评分数量',
                    'tips.required'=>'	提示信息',
                    'satisfy_count.required'=>'	满意度数量',
                    'satisfy_rate.required'=>'	满意度评分',
                    'goods_img.required'=>'商品图片请上传',
                    'goods_price.numeric'=>'价格填写数字',
                    'month_sales.numeric'=>'月销量填写数字',
                    'rating_count.numeric'=>'	评分数量填写数字',
                    'satisfy_count.numeric'=>'满意度数量填写数字',
                    'satisfy_rate.numeric'=>'满意度评分填写数字',
                    'goods_img.image'=>'图片格式不对'

                ]);

            $img=$request->file('goods_img');

            if($img){
                $path=url(Storage::url($img->store('public/shop')));
            }else{
                $path=$Menu->goods_img;
            }

             $Menu->update([
                'goods_name'=>$request->goods_name,
                'rating'=>$request->rating,
                'goods_price'=>$request->goods_price,
                'description'=>$request->description,
                'month_sales'=>$request->month_sales,
                'rating_count'=>$request->rating_count,
                'tips'=>$request->tips,
                'satisfy_count'=>$request->satisfy_count,
                'satisfy_rate'=>$request->satisfy_rate,
                'goods_img'=>$path,
                'shop_id'=>auth()->user()->id,
                'category_id'=>$request->category_id,
                'status'=>$request->status,
                'view_times'=>0,
                'img'=>$path,
            ]);
            //var_dump($img);exit;

            $request->session()->flash('success','修改成功');
            return  redirect()->route('Menus.index');

        }

            public function show(Menus $Menu){

                return view('Menus.show',['Menu'=>$Menu]);
            }
    public function destroy(Menus $Menu)
    {
        //var_dump($MenuCategory);exit;

        $Menu->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('Menus.index');
    }

    //接受上传图片
    public function upload(Request $request){
        $img=$request->file('file');
        $path=Storage::url($img->store('public/shop'));
        return ['path'=>$path];
    }


}
