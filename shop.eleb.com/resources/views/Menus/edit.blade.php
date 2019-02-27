
@extends('layout.app')
@section('content')

<form  method="post"  action="{{route('Menus.update',[$Menu])}}" enctype="multipart/form-data">
    <div class="container">
        <h1>菜品列表</h1><br/>
     @include('layout._error')

       菜品名称：<input type="text" value="{{$Menu->goods_name}}" name="goods_name" class="form-control" >
    </div><br/>
    <div class="container">
        菜品评分:   <input type="text" id="disabledTextInput" class="form-control" name="rating" value="{{$Menu->rating}}">
    </div><br/>


<div class="container">
     所属分类： <select class="form-control" name="category_id">
        @foreach($shops as $shop)
        <option value="{{$shop->id}}">{{$shop->name}}</option>
@endforeach
    </select>
    </div>

    <div class="container">
        菜品价格:   <input type="text" id="disabledTextInput" class="form-control" name="goods_price" value={{$Menu->goods_price}}>
    </div><br/>
    <div class="container">

        菜品描述：<textarea  rows="3"  class="form-control" name="description">{{$Menu->description}}</textarea>
    </div><br/>

    <div class="container">
        月销量:   <input type="text" id="disabledTextInput" class="form-control" name="month_sales" value="{{$Menu->month_sales}}">
    </div><br/>

    <div class="container">
        评分数量:   <input type="text" id="disabledTextInput" class="form-control" name="rating_count" value="{{$Menu->rating_count}}">
    </div><br/>
    <div class="container">
       提示信息:   <input type="text" id="disabledTextInput" class="form-control" name="tips" value="{{$Menu->tips}}">
    </div><br/>
    <div class="container">
        满意程度数量:   <input type="text" id="disabledTextInput" class="form-control" name="satisfy_count" value="{{$Menu->satisfy_count}}">
    </div><br/>
    <div class="container">
        满意程度评分:   <input type="text" id="disabledTextInput" class="form-control" name="satisfy_rate" value="{{$Menu->satisfy_rate}}">
    </div><br/> <div class="container">
        菜品图片:   <input type="file" id="disabledTextInput" class="form-control" name="goods_img" >
        <img width="50px" src="{{$Menu->goods_img }}">
    </div><br/>
    <div class="container">
      菜品状态：
        <input type="radio" id="inlineCheckbox2" value="1" @if($Menu->status==1){@echo checked="checked"}  @endif name="status"> 上架
        <input type="radio" id="inlineCheckbox1" value="0" @if($Menu->status==0){@echo  checked="checked"} @endif name="status"> 下架
    </div><br/>
    {{csrf_field()}}
    {{method_field('patch')}}
    <button type="submit" class="btn-primary" style="margin-left:700px;width: 100px;height: 40px">提交</button><br/>

</form>

   @stop