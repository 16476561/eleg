@extends('layout.app')
@section('content')
    <table class="table table-bordered">

        <tr>

            <th>活动名称</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>活动详情</th>

        </tr>


            <tr>
                <td>{{$Activity->title}}</td>
                <td>{{$Activity->star_time}}</td>
                <td>{{$Activity->end_time}}</td>
                <td>{!!$Activity->content!!}</td>

            </tr>




    </table>

    @stop
