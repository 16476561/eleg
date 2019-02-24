
@extends('layout.app')
@section('content')


<form method="post" action="{{route('admins.password1',[$admin])}}" enctype="multipart/form-data">

    <div class="container">
        <h1>修改管理密码</h1><br/>
        @include('layout._error')
        旧的密码：<input type="password" name="hashedPassword" class="form-control"  >
    </div><br/>
        <div class="container">
        新的密码：<input type="password" name="password" class="form-control"  >
    </div><br/>
        <div class="container">
           确认密码:   <input type="password" id="disabledTextInput" class="form-control" name="password_confirmation">
        </div><br/>
    {{csrf_field()}}

        <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
   @stop