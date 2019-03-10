@extends('layout.app')
@section('content')

    <table class="table table-bordered">

        <tr>
            <th>导航名称</th>
            <th>导航地址</th>
            <th>导航分类</th>
            <th>操作</th>
        </tr>

            @foreach($navs as $nav)
            <tr>
                <td>{{$nav->name}}</td>
                <td>{{$nav->url}}</td>
                {{--<td>{{$nav->permission_id}}</td>--}}
                <td>@if($nav->pid ==0)顶级菜单
                    @else
                    @foreach($parents as $parent)
                    @if($nav->pid == $parent->id){{$parent->name }}
                      @endif
                        @endforeach
                        @endif
                </td>
                <td>

                    <a href="{{route('navs.edit',[$nav])}}"  class="btn btn-success">编辑</a>
                    <form style="display: inline" method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>

                </td>
            </tr>
            @endforeach


    </table>
{{$navs->links()}}
    @stop
