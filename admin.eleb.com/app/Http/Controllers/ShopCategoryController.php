<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ShopCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $shopcategorys=ShopCategory::orderby('id','Asc')->paginate(2);
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
                    'img'=>'required',
                    'status'=>'required',
                    'captcha'=>'required|captcha',
                ],[
                    //错误提示
                    'name.required'=>'名称不能为空',
                    'img.required'=>'图片不能为空',
                    'status.required'=>'状态不能为空',
                    'captcha.required'=>'请填写验证码',
                    'captcha.captcha'=>'验证码不正确',
                ]);
            //获取图片上传地址
        $img=$request->img;
        ShopCategory::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'view_times'=>0,
            'img'=>$img,
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
                    'img'=>'required',
                ],[
                    'name.required'=>'名称不能为空',
                    'status.required'=>'状态没选',
                    'img.required'=>'图片必填',
                ]);

            //图片地址
                $img=$request->img;

                $shopcategory->update([
                   'name'=>$request->name,
                   'status'=>$request->status,
                    'view_times'=>0,
                    'img'=>$img,
                ]);

          $request->session()->flash('success','修改成功');
          return redirect()->route('shopcategorys.index');
        }

        public function destroy(ShopCategory $shopcategory){

            $shopcategory->delete();
            session()->flash('success','删除成功');
            return redirect()->route('shopcategorys.index');
        }

            //接受上传图片
    public function upload(Request $request){
        $img=$request->file('file');
        $path=Storage::url($img->store('public/shop'));
        return ['path'=>$path];
    }





}
