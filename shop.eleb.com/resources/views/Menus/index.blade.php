@extends('layout.app')

@section('content')

    <table class="table table-bordered">

        <tr>

            <th>菜品名称</th>
            <th>评分</th>
            <th>价格</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>评分数量</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>月销量</th>
            <th>菜品图片</th>
            <th>菜品状态</th>
            <th>操作</th>
        </tr>

@foreach($menus as $menu)

        <tr>

            <td>{{$menu->goods_name}}</td>
            <td>{{$menu->rating}}</td>
            <td>{{$menu->goods_price}}</td>
            <td>{{$menu->shop?$menu->shop->shop_name:'-'}}</td>
            <td>{{$menu->MenuCategory?$menu->MenuCategory->name:'不在了'}}</td>
            <td>{{$menu->rating_count}}</td>
            <td>{{$menu->satisfy_count}}</td>
            <td>{{$menu->satisfy_rate}}</td>
            <td>{{$menu->month_sales}}</td>
            <td><img width="50px" src="{{$menu->goods_img??''}}"></td>
            <td>@if($menu->status==1)上架
                @else($menu->status)下架
                @endif
            </td>

            <td>
                <a href="{{route('Menus.show',[$menu])}}" class="btn btn-info">查看</a>
                <a href="{{route('Menus.edit',[$menu])}}" class="btn btn-success">编辑</a>



            <form style="display: inline" method="post" action="{{ route('Menus.destroy',[$menu]) }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="btn btn-danger">删除</button>
            </form>

            </td>
        </tr>


@endforeach
    </table>
   {{$menus->links()}}
    @stop
