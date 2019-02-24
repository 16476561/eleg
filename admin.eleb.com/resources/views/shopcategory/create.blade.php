
@extends('layout.app')
@section('content')


<form method="post" action="{{route('shopcategorys.store')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>商品分类</h1><br/>
     @include('layout._error')

       商品名称：<input type="text" name="name" class="form-control" value="{{old('name')}}" >
    </div><br/>
    <div class="container">
        商品图片:   <input type="file" id="disabledTextInput" class="form-control" name="img">
    </div><br/>
    <div class="container">
        <input type="radio" id="inlineCheckbox1" value="1" name="status"> 上线

        <input type="radio" id="inlineCheckbox2" value="0" name="status"> 下线
    </div>
        <br/>
    <div class="form-group" style="margin-left: 200px">
        验证码：<input type="text" name="captcha"  class="form-group-sm" value="" >
        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
    </div>
    {{csrf_field()}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop