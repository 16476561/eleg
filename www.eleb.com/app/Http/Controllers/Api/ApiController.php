<?php

namespace App\Http\Controllers\Api;

use App\Model\MenuCategory;
use App\Model\Menus;
use App\Model\shop;
use App\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    //商家接口
    public function business_list(Request $request){


        $keyword=$request->keyword;
        if($keyword){
            $shops=Shop::where('shop_name','like',"%$keyword%")->get();
        }else{
             $shops=Shop::all();
        }
            return $shops;
    }
        //指定商家接口
    public function appoint(Request $request){
        //当前登陆用户的ID等于点击的ID
      $shop=Shop::where('id',$request->id)->get();
      //商品分类的ID等于点击的ID
      $MenuCategories=MenuCategory::where('shop_id',$request->id)->get();
     // dd($MenuCategories);
      //遍历
      foreach($MenuCategories as  $MenuCategory){
          //菜品分类的ID等于文档里面的分类 = 所属分类的ID
          $MenuCategory['goods_list']=Menus::where('category_id',$MenuCategory->id)->get();

      }
        //商家里面文档的分类=自己写的分类
        $shop['commodity']=$MenuCategories;
      return $shop;
    }



}
