@extends('layout.app')
@section('content')


    <table class="table table-bordered">

        <tr>

            <th>活动名称</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>

@foreach($Activitys as $Activity)
            <tr>
                <td>{{$Activity->title}}</td>
                <td>{{$Activity->star_time}}</td>
                <td>{{$Activity->end_time}}</td>
                <td>
                    <a href="{{route('Activitys.show',[$Activity])}}"  class="btn btn-info">查看</a>


                </td>
            </tr>



        @endforeach
    </table>

    @stop
