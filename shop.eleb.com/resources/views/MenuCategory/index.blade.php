@extends('layout.app')
@section('content')
    <table class="table table-bordered">

        <tr>
            <th>菜品编号</th>
            <th>菜品名称</th>
            <th>所属商家</th>
            <th>菜品描述</th>
            <th>是否默认分类</th>
            <th>操作</th>
            <th>菜品状态</th>
        </tr>

@foreach($shows as $show)

        <tr>
            <td>{{$show->type_accumulation}}</td>
            <td>{{$show->name}}</td>
            <td>{{$show->shop?$show->shop->shop_name:'-'}}</td>

            <td>{{$show->description}}</td>
            <td>@if($show->is_selected==1)正常
                @else($show->is_selected)默认
                @endif
            </td>

            <td>
                <a href="{{route('MenuCategorys.edit',[$show])}}" class="btn btn-success">编辑</a>

                <form style="display: inline" method="post" action="{{ route('MenuCategorys.destroy',[$show]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                </form>
            </td>
            <td>
                <form style="display: inline" method="get" action="{{ route('MenuCategorys.start',[$show]) }}">
                    <button type="submit" class="btn btn-info">启动</button>
                </form>

                <form style="display: inline" method="get" action="{{ route('MenuCategorys.guan',[$show]) }}">
                    <button type="submit" class="btn btn-danger">禁用</button>
                </form>
            </td>

        </tr>


@endforeach
    </table>

    @stop
