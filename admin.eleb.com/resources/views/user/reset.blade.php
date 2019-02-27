
@extends('layout.app')
@section('content')


<form method="post" action="{{route('users.broker',[$user])}}" enctype="multipart/form-data">


        <h1 class="container">重置密码</h1><br/>

        @include('layout._error')




        <div class="container">
           重置密码:   <input type="password" id="disabledTextInput" class="form-control" name="password">
        </div><br/>
    {{csrf_field()}}

        <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
   @stop