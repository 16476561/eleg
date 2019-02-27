@extends('layout.app')
@section('content')

    <form class="navbar-form navbar-left" method="get" name="serch" action="{{route('Activitys.index')}}">
        <div class="form-group">
            <select class="form-control" style="margin-left: 1200px" name="serch">
                <option value=" ">所有活动</option>
                <option value="1">已进行</option>
                <option value="2">未进行</option>
                <option value="3">已结束</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default" >搜索</button>
    </form>
    <table class="table table-bordered">

        <tr>

            <th>活动名称</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>活动详情</th>
            <th>操作</th>
        </tr>

@foreach($Activitys as $Activity)
            <tr>
                <td>{{$Activity->title}}</td>
                <td>{{$Activity->star_time}}</td>
                <td>{{$Activity->end_time}}</td>
                <td>{!!$Activity->content!!}</td>
                <td>
                    <a href="{{route('Activitys.show',[$Activity])}}"  class="btn btn-info">查看</a>
                    <a href="{{route('Activitys.edit',[$Activity])}}"  class="btn btn-success">编辑</a>
                    <form style="display: inline" method="post" action="{{route('Activitys.destroy',[$Activity])}}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>

                </td>
            </tr>



        @endforeach
    </table>

    @stop
