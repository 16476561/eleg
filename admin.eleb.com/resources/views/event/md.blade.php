@extends('layout.app')
@section('content')

    <style>
        p{margin-left: 200px;font-size: 20px}
    </style>
            <p>活动名称:{{$event->title}}</p>
            <p>活动开始时间:{{$event->signup_start}}</p>
            <p>活动结束时间:{{$event->signup_end}}</p>
            <p>活动开奖时间:{{$event->prize_date}}</p>
            <p>活动报名人数:{{$event->signup_num}}</p>
            <p>活动是否报名:{{$event->is_prize?'是':'否'}}</p>
            <p>活动详情：{!!$event->content!!}</p>


    @stop
