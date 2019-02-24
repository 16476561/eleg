@extends('layout.app')
@section('content')
    <table class="table table-bordered">
    <tr>
        <tr>

            <th>商家名称</th>
            <th>商家图片</th>
            <th>商家类型</th>
            <th>商家审核</th>
            <th>商家评分</th>
            <th>商家品牌</th>
            <th>是否准时</th>
            <th>是否蜂鸟配送</th>
            <th>是否保标记</th>
            <th>是否票标记</th>
            <th>是否准标记</th>
            <th>起送金额</th>
            <th>配送费用</th>
            <th>商家公告</th>
            <th>优惠信息</th>

        </tr>
    </tr>

        <tr>

            <td>{{$shop->shop_name}}</td>
            <td><img width="50px" src="{{$shop->shop_img??''}}"></td>
            <td>{{$shop->shopsss->name}}</td>
            <td>@if($shop->status==1)正常
                @elseif($shop->status)禁用
                @else($shop->status)未审核
                @endif
                </td>
            <td>{{$shop->shop_rating}}</td>
            <td>{{$shop->brand}}</td>
            <td>{{$shop->on_time}}</td>
            <td>{{$shop->fengniao}}</td>
            <td>{{$shop->bao}}</td>
            <td>{{$shop->piao}}</td>
            <td>{{$shop->zhun}}</td>
            <td>{{$shop->start_send}}</td>
            <td>{{$shop->send_cost}}</td>
            <td>{{$shop->notice}}</td>
            <td>{{$shop->discount}}</td>



        </tr>

    </table>

    @stop
