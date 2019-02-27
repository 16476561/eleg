
@extends('layout.app')
@section('content')
    @include('vendor.ueditor.assets')

<form method="post" action="{{route('Activitys.store')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>添加活动</h1><br/>
     @include('layout._error')

       活动名称：<input type="text" name="title" class="form-control" value="{{old('title')}}" >
    </div><br/>
    <div class="container">
        开始时间:   <input type="datetime-local" id="disabledTextInput" class="form-control" name="star_time" value="{{old('star_time')}}">
    </div>
    <div class="container">
        结束时间:   <input type="datetime-local" id="disabledTextInput" class="form-control" name="end_time" value="{{old('end_time')}}">
    </div>
        <br/>


    <div class="container" name="content">
        活动详情：<script type="text/javascript" name="content" value="{{old('content')}}">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>

        <!-- 编辑器容器 -->
        <script id="container"  name="content" type="text/plain" >{{old('content')}}</script>
    </div>
    <br/>


    {{csrf_field()}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop