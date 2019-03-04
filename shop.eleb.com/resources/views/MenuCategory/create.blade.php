
@extends('layout.app')
@section('content')


<form method="post" action="{{route('MenuCategorys.store')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>菜品分类</h1><br/>
     @include('layout._error')

       菜品名称：<input type="text" name="name" class="form-control" value="{{old('name')}}" >
    </div><br/>
    <div class="container">
        菜品编号:   <input type="text" id="disabledTextInput" class="form-control" name="type_accumulation" value="{{old('type_accumulation')}}" >
    </div><br/>

    <div class="container">

        菜品描述：<textarea  rows="3"  class="form-control" name="description">{{old('description')}}</textarea>
    </div><br/>
    <div class="container" name="status">
        菜品默认：<input type="radio" id="inlineCheckbox1" value="1" name="is_selected">正常

        <input type="radio" id="inlineCheckbox2" value="0" name="is_selected">默认
    </div>





    {{csrf_field()}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>

   @stop