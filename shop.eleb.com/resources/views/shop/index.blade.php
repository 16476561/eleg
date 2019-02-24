@extends('layout.app')
@section('content')
    <table class="table table-bordered">

        <tr>

            <th>商家名称</th>
            <th>商家图片</th>
            <th>商家管理</th>
            <th>商家分类</th>
            <th>商家状态</th>
            <th>操作</th>

        </tr>

        @if(!$shop)无店铺
    @else
        <tr>

            <td>{{$shop->shop_name}}</td>
            <td><img width="50px" src="{{$shop->shop_img??''}}"></td>
            <td>{{$shop->user?$shop->user->name:'死了'}}</td>
            <td>{{$shop->shopsss->name}}</td>
            <td>@if($shop->status==1)正常
                @elseif($shop->status)禁用
                @else($shop->status)未审核
                @endif
                </td>

            <td>
                <a href="{{route('shops.show',[$shop])}}" class="btn btn-success">查看</a>
                <a href="{{route('shops.edit',[$shop])}}" class="btn btn-info">编辑</a>
                <form style="display: inline" method="post" action="{{ route('shops.destroy',[$shop]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                </form>
            </td>
            {{--<td>--}}
                {{--<form style="display: inline" method="get" action="{{ route('shops.change',[$shop]) }}">--}}
                    {{--<button type="submit" class="btn btn-info">启动</button>--}}
                {{--</form>--}}

                {{--<form style="display: inline" method="get" action="{{ route('shops.off',[$shop]) }}">--}}
                    {{--<button type="submit" class="btn btn-danger">禁用</button>--}}
                {{--</form>--}}
            {{--</td>--}}

        </tr>
@endif
    </table>

    @stop
