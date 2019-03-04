<?php

namespace App\Http\Controllers;

use App\Model\MenuCategory;
use App\Model\Menus;
use App\Model\Shop;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth'

        );
    }

    public function index(){
        //登陆里面的ID等于创建的ID。直显示自己登陆看见页面
        $id=auth()->user()->shop_id;
       $shows=MenuCategory::get()->where('shop_id',$id);


//        $dd=auth()->user()->id;
//        $qq= MenuCategory::get()->where('shop_id',$dd)->all();
     // dd($id);
       // $shows=MenuCategory::all();

        return view('MenuCategory.index',['shows'=>$shows]);

    }
    public function create(){
        $shops=Shop::all();
        return view('MenuCategory.create',['shops'=>$shops]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'type_accumulation'=>'required',
            'description'=>'required',
            'is_selected'=>'required',
        ],[
            'name.required'=>'菜品必填',
            'type_accumulation.required'=>'编号要填',
            'description.required'=>'请填写菜品填写',
            'is_selected.required'=>'请选择是否默认',
        ]);


        if($request->is_selected==0){
              //一个商家分类只要一个默认值
            MenuCategory::where('is_selected','=','0')->where('shop_id','=',auth()->user()->shop_id)
                        ->update(['is_selected'=>1]);
        }
            MenuCategory::create([

               'name'=>$request->name,
               'type_accumulation'=>$request->type_accumulation,
               'description'=>$request->description,
                'shop_id'=>auth()->user()->shop_id,
                'is_selected'=>$request->is_selected,

            ]);
        $request->session()->flash('success', '添加成功');
        return redirect()->route('MenuCategorys.index');

    }

    public function edit(MenuCategory $MenuCategory){

        $shops=Shop::all();
       // var_dump($shops);exit;
        return view('MenuCategory.edit',['shops'=>$shops,'MenuCategory'=>$MenuCategory]);

    }
        public function update(Request $request ,MenuCategory $MenuCategory){

            $this->validate($request,[
                'name'=>'required',
                'type_accumulation'=>'required',
                'description'=>'required',
                'is_selected'=>'required',

            ],[
                'name.required'=>'菜品必填',
                'type_accumulation.required'=>'编号要填',
                'description.required'=>'请填写菜品填写',
                'is_selected.required'=>'请选择是否默认',

            ]);

            if($request->is_selected==0) {
                MenuCategory::where('is_selected', '=', '0')->where('shop_id', '=', auth()->user()->shop_id)
                    ->update(['is_selected' => 1]);
            }

            $MenuCategory->update([

                'name'=>$request->name,
                'type_accumulation'=>$request->type_accumulation,
                'description'=>$request->description,
                'shop_id'=>auth()->user()->shop_id,
                'is_selected'=>$request->is_selected,

            ]);


         $request->session()->flash('success', '修改成功');
          return redirect()->route('MenuCategorys.index');

        }

    public function destroy(MenuCategory $MenuCategory)
    {
        //判断不是空目录不能删除
       $men=Menus::all()->where('category_id',$MenuCategory->id)->first();
       //var_dump($men);exit;
       if($men){
           session()->flash('danger', '下面不是空目录不能删除');
       }else{
           $MenuCategory->delete();
           session()->flash('success', '删除成功');
       }



        return redirect()->route('MenuCategorys.index');
    }

    //禁止
    public function guan(MenuCategory $MenuCategory){

        DB::update("update menu_categories set is_selected=0 where id=$MenuCategory->id");
        session()->flash('success','禁止成功');
        return redirect()->route('MenuCategorys.index');
    }
    //启动
    public function start(MenuCategory $MenuCategory){
        DB::update("update menu_categories set is_selected=1 where id=$MenuCategory->id");
        session()->flash('success','启动成功');
        return redirect()->route('MenuCategorys.index');
    }
    //接受上传图片
    public function upload(Request $request){
        $img=$request->file('file');
        $path=Storage::url($img->store('public/shop'));
        return ['path'=>$path];
    }
}
