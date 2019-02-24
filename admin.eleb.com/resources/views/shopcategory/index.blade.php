@extends('layout.app')
@section('content')
    <table class="table table-bordered">
    <tr>
        <tr>
            <th>序号</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品状态</th>
            <th>操作</th>
        </tr>
    </tr>
        @foreach($shopcategorys as $shopcategory)
        <tr>
            <td>{{$shopcategory->id}}</td>
            <td>{{$shopcategory->name}}</td>
            <td><img width="50px" src="{{\Illuminate\Support\Facades\Storage::url($shopcategory->img)}}"></td>

            <td>{{$shopcategory->status?'上线':'下线'}}</td>
            <td>
                <a href="{{route('shopcategorys.edit',[$shopcategory])}}" class="btn btn-info">编辑</a>
                <form style="display: inline" method="post" action="{{ route('shopcategorys.destroy',[$shopcategory]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
        @endforeach


            </td>
        </tr>


    </table>

    @stop
