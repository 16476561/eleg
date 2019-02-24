
@extends('layout.app')
@section('content')


<form method="post" action="{{route('shops.store')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>商家信息</h1><br/>
     @include('layout._error')

       商家分类：<select class="form-control" name="shop_category_id">
            @foreach($shopcategorys as $shopcategory)
                    <option value="{{$shopcategory->id}}"  @if(old('shop_category_id') == $shopcategory->id) selected @endif>{{$shopcategory->name}}</option>
                @endforeach

        </select>
    </div><br/>
    <div class="container">
        商家名称:   <input type="text" id="disabledTextInput" class="form-control" name="shop_name" value="{{old('shop_name')}}">
    </div><br/>
    <div class="container">
        商品图片:   <input type="file" id="disabledTextInput" class="form-control" name="shop_img">
    </div><br/>

    <div class="container">
        商家评分:   <input type="text" id="disabledTextInput" class="form-control" name="shop_rating" {{old('shop_rating')}}>
    </div><br/>

    <div class="container" name="brand">
        是否品牌：<input type="radio" id="inlineCheckbox1" value="1" name="brand">是

        <input type="radio" id="inlineCheckbox2" value="0" name="brand">否
    </div>

    <div class="container" name="on_time">
        是否准时：<input type="radio" id="inlineCheckbox1" value="1" name="on_time">是

        <input type="radio" id="inlineCheckbox2" value="0" name="on_time">否
    </div>
    <div class="container" name="fengniao">
        是否蜂鸟配送：<input type="radio" id="inlineCheckbox1" value="1" name="fengniao">是

        <input type="radio" id="inlineCheckbox2" value="0" name="fengniao">否
    </div>
    <div class="container" name="bao">
        是否保标记：<input type="radio" id="inlineCheckbox1" value="1" name="bao">是

        <input type="radio" id="inlineCheckbox2" value="0" name="bao">否
    </div>
    <div class="container" name="piao">
        是否票标记：<input type="radio" id="inlineCheckbox1" value="1" name="piao">是

        <input type="radio" id="inlineCheckbox2" value="0" name="piao">否
    </div>

    <div class="container" name="zhun">
        是否准标记：<input type="radio" id="inlineCheckbox1" value="1" name="zhun">是

        <input type="radio" id="inlineCheckbox2" value="0" name="zhun">否
    </div>
    <div class="container" name="start_send">
       起送金额:   <input type="text" id="disabledTextInput" class="form-control" name="start_send">
    </div><br/>
    <div class="container">
       配送费用:   <input type="text" id="disabledTextInput" class="form-control" name="send_cost">
    </div><br/>
    <div class="container">
    商家公告：<textarea class="form-control" rows="3" name="notice">{{old('notice')}}</textarea>
    </div>
    <div class="container">
        优惠信息:   <input type="text" id="disabledTextInput" class="form-control" name="discount" value="{{old('discount')}}">
    </div><br/>
    <h1 class="container">商家账号注册</h1>
    <div class="container">
    账号注册：<input type="text" name="name" class="form-control" value="{{old('name')}}" >
    </div><br/>
    <div class="container">
        密码:   <input type="password" id="disabledTextInput" class="form-control" name="password">
    </div><br/>
    <div class="container">
        确认密码:   <input type="password" id="disabledTextInput" class="form-control" name="password_confirmation">
    </div><br/>
    <div class="container">
        商家邮件:   <input type="text" id="disabledTextInput" class="form-control" name="email">
    </div><br/>
    <div class="container">
    验证码：<input type="text" name="captcha"  class="form-group-sm" value="" >
    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
    </div>
    {{csrf_field()}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop