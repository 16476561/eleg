
@extends('layout.app')
@section('content')
@include('vendor.ueditor.assets')

<form method="post" action="{{route('eventprizes.update',[$eventprize])}}" enctype="multipart/form-data">
    <div class="container">
        <h1>修改活动奖品</h1><br/>
     @include('layout._error')

      奖品名称：<input type="text" name="name" class="form-control" value="{{$eventprize->name}}" >
    </div><br/>


    <div class="container">
       活动分类: <select  class="form-control" name="events_id">
         @foreach($events as $event)
            <option value="{{$event->id}}">{{$event->title}}</option>
        @endforeach

        </select>
    </div><br/>


    {{--<div class="container">--}}
        {{--中奖商家ID:   <input type="text" id="disabledTextInput" class="form-control" name="member_id" value="{{old('member_id')}}">--}}
    {{--</div><br/>--}}

    <div class="container" name="description">
        奖品详情：<script type="text/javascript" name="description" value="{{old('description')}}">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>

        <!-- 编辑器容器 -->
        <script id="container"  name="description" type="text/plain" >{{$eventprize->description}}</script>
    </div>

    {{csrf_field()}}
    {{method_field('patch')}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>

   @stop