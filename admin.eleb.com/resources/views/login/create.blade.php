
@extends('layout.app')
@section('content')


<form method="post" action="{{route('login')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>登陆</h1><br/>
     @include('layout._error')

      账号：<input type="text" name="name" class="form-control" value="{{old('name')}}" >
    </div><br/>
    <div class="container">
        密码:   <input type="password" id="disabledTextInput" class="form-control" name="password">
    </div><br/>
    <div class="form-group" style="margin-left: 200px">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"  value="1">自动登陆
            </label>
        </div>
        验证码：<input type="text" name="captcha"  class="form-group-sm" value="" >
        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
    </div>



    {{csrf_field()}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop