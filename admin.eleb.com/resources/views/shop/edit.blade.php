
@extends('layout.app')
@section('content')


<form method="post" action="{{route('shops.update',[$shop])}}" enctype="multipart/form-data">
    <div class="container">
        <h1>修改商家信息</h1><br/>
     @include('layout._error')

       商家分类：<select class="form-control" name="shop_category_id" >

            @foreach($shopcategorys as $shopcategory)
                <option value="{{$shopcategory->id}}"@if($shopcategory->id ==$shop->shop_category_id)selected @endif>{{$shopcategory->name}}</option>
            @endforeach
                        </select>
                           </div><br/>
       <div class="container">
        商家名称:   <input type="text" id="disabledTextInput" class="form-control" name="shop_name" value="{{$shop->shop_name}}">
    </div><br/>
    <div class="container">
        商品图片:   <input type="file" id="disabledTextInput" class="form-control" name="shop_img">
        <img width="50px" src="{{$shop->shop_img??''}}">

    </div><br/>

    <div class="container">
        商家评分:   <input type="text" id="disabledTextInput" class="form-control" name="shop_rating" value="{{$shop->shop_rating}}">
    </div><br/>

    <div class="container" name="brand">
        是否品牌：
        <input type="radio" id="inlineCheckbox1" value="1" @if($shop->brand==1){@echo checked="checked"} @endif  name="brand">是
        <input type="radio" id="inlineCheckbox2" value="0" @if($shop->brand==0){@echo checked="checked"} @endif name="brand">否
    </div>

    <div class="container" name="on_time">
        是否准时：
        <input type="radio" id="inlineCheckbox1" value="1" @if($shop->on_time==1){@echo checked="checked"} @endif name="on_time">是
        <input type="radio" id="inlineCheckbox2" value="0" @if($shop->on_time==0){@echo checked="checked"} @endif  name="on_time">否
    </div>
    <div class="container" name="fengniao">
        是否蜂鸟配送：
        <input type="radio" id="inlineCheckbox1" value="1" @if($shop->fengniao==1){@echo checked="checked"} @endif name="fengniao">是
        <input type="radio" id="inlineCheckbox2" value="0" @if($shop->fengniao==0){@echo checked="checked"} @endif name="fengniao">否
    </div>
    <div class="container" name="bao">
        是否保标记：
        <input type="radio" id="inlineCheckbox1" value="1" @if($shop->bao==1){@echo checked="checked"} @endif name="bao">是
        <input type="radio" id="inlineCheckbox2" value="0" @if($shop->bao==0){@echo checked="checked"} @endif name="bao">否
    </div>
    <div class="container" name="piao">
        是否票标记：
        <input type="radio" id="inlineCheckbox1" value="1" @if($shop->piao==1){@echo checked="checked"} @endif name="piao">是
        <input type="radio" id="inlineCheckbox2" value="0" @if($shop->piao==0){@echo checked="checked"} @endif name="piao">否
    </div>

    <div class="container" name="zhun">
        是否准标记：
        <input type="radio" id="inlineCheckbox1" value="1" @if($shop->zhun==1){@echo checked="checked"} @endif name="zhun">是
        <input type="radio" id="inlineCheckbox2" value="0" @if($shop->zhun==0){@echo checked="checked"} @endif name="zhun">否
    </div>
    <div class="container" name="start_send">
       起送金额:   <input type="text" id="disabledTextInput" class="form-control" name="start_send" value="{{$shop->start_send}}">
    </div><br/>
    <div class="container">
       配送费用:   <input type="text" id="disabledTextInput" class="form-control" name="send_cost" value="{{$shop->send_cost}}">
    </div><br/>
    <div class="container">
    商家公告：<textarea class="form-control" rows="3" name="notice">{{$shop->shop_name}}</textarea>
    </div>
    <div class="container">
        优惠信息:   <input type="text" id="disabledTextInput" class="form-control" name="discount" value="{{$shop->discount}}"">
    </div><br/>


    <div class="container" name="status">
        商家审核：
        <input type="radio" id="inlineCheckbox1" value="1" @if($shop->status==1){@echo checked="checked"} @endif name="status">正常
        <input type="radio" id="inlineCheckbox2" value="0" @if($shop->status==0){@echo checked="checked"} @endif  name="status">未审核
        <input type="radio" id="inlineCheckbox2" value="-1" @if($shop->status==-1){@echo checked="checked"} @endif name="status">禁用
    </div>
    {{csrf_field()}}
    {{method_field('patch')}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop