<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ShopCategory;
use Illuminate\Support\Facades\Hash;

class ShopCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $shopcategorys=ShopCategory::all();
        //var_dump($shopcategorys);exit;
        return view('shopcategory.index',['shopcategorys'=>$shopcategorys]);
    }
    public  function create(){
        return view('shopcategory.create');
    }
    public function store(Request $request){
            $this->validate($request,
                [
                    'name'=>'required',
                    'img'=>'image',
                    'status'=>'required',
                    'captcha'=>'required|captcha',
                ],[
                    //错误提示
                    'name.required'=>'名称不能为空',
                    'img.image'=>'图片格式错误',
                    'status.required'=>'状态不能为空',
                    'captcha.required'=>'请填写验证码',
                    'captcha.captcha'=>'验证码不正确',
                ]);
            //获取图片上传地址
        $img=$request->file('img');
            //保存图片地址并判断是否有图片
        if($img){
            $path=$img->store('public/images');
        }else{
            $path='';
        }
        ShopCategory::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'view_times'=>0,
            'img'=>$path,
        ]);
        $request->session()->flash('success','添加成功');
        return redirect()->route('shopcategorys.index');


    }
        public function edit(ShopCategory $shopcategory){
           return view('shopcategory.edit',['shopcategory'=>$shopcategory]);
        }

        public function update(ShopCategory $shopcategory,Request $request){
            $this->validate($request,
                [
                    'name'=>'required',
                    'status'=>'required',
                    'img'=>'image',
                ],[
                    'name.required'=>'名称不能为空',
                    'status.required'=>'状态没选',
                    'img.img'=>'图片格式错误',
                ]);
                $img=$request->file('img');
                if($img){
                    $path=$img->store('public/images');
                }else{
                    $path=$shopcategory->img;
                }

                $shopcategory->update([
                   'name'=>$request->name,
                   'status'=>$request->status,
                    'view_times'=>0,
                    'img'=>$path,
                ]);

          $request->session()->flash('success','修改成功');
          return redirect()->route('shopcategorys.index');
        }

        public function destroy(ShopCategory $shopcategory){
            $shopcategory->delete();
            session()->flash('success','删除成功');
            return redirect()->route('shopcategorys.index');
        }

}
