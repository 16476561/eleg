@extends('layout.app')
@section('content')
    <style>
        p{font-size: 20px; text-align: center}
    </style>
    <table class="table table-bordered">





        <p>菜品名称: {{$Menu->goods_name}}</p>
            <p>评分: {{$Menu->rating}}</p>
        <p> 价格:{{$Menu->goods_price}}</p>
        <p> 所属商家:{{$Menu->shop?$Menu->shop->shop_name:'-'}}</p>
        <p>   所属分类:{{$Menu->MenuCategory?$Menu->MenuCategory->name:'不在了'}}</p>
        <p>提示信息：{{$Menu->tips}}</p>
        <p>  评分数量: {{$Menu->rating_count}}</p>
        <p>  满意度数量:{{$Menu->satisfy_count}}</p>
        <p>   满意度评分:{{$Menu->satisfy_rate}}</p>
        <p>  月销量: {{$Menu->month_sales}}</p>
        <p> 菜品图片:<img width="50px" src="{{$Menu->goods_img??''}}"></p>
        <p>  菜品状态:@if($Menu->status==1)上架
                @else($Menu->status)下架
                @endif
        <p>描述:{{$Menu->description}}</p>


        {{--</tr>--}}



    </table>

    @stop
