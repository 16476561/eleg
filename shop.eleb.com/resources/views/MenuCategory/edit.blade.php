
@extends('layout.app')
@section('content')


<form method="post" action="{{route('MenuCategorys.update',[$MenuCategory])}}" enctype="multipart/form-data">
    <div class="container">
        <h1>修改菜单分类</h1><br/>
        @include('layout._error')

        修改菜单名称：<input type="text" name="name" class="form-control" value="{{$MenuCategory->name}}" >
    </div><br/>


        <div class="container">
            修改菜单编号：<input type="text" name="type_accumulation" class="form-control" value="{{$MenuCategory->type_accumulation}}" >
        </div><br/>
        <div class="container">

            修改菜品描述：<textarea  rows="3"  class="form-control" name="description">{{$MenuCategory->description}}</textarea>
        </div><br/>

    <div class="container" name="status">
        菜品默认：<input type="radio" id="inlineCheckbox1" value="1" name="is_selected">正常

        <input type="radio" id="inlineCheckbox2" value="0" name="is_selected">默认


        {{csrf_field()}}
        {{method_field('patch')}}
        <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
   @stop