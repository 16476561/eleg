
@extends('layout.app')
@section('content')


<form method="post" action="{{route('shopcategorys.update',[$shopcategory])}}" enctype="multipart/form-data">
    <?php  //var_dump($article);exit;?>
    <div class="container">
        <h1>修改商品分类</h1><br/>
        @include('layout._error')

        修改商品名称：<input type="text" name="name" class="form-control" value="{{$shopcategory->name}}" >
    </div><br/>
        <div class="container">
            修改商品状态：<input type="radio" name="status"  class="form-group-sm" value="1"  @if($shopcategory->status==1){@echo checked="checked"} @endif>上线
                          <input type="radio" name="status"  class="form-group-sm" value="0"  @if($shopcategory->status==0){@echo checked="checked"} @endif>下线
        </div><br/>
        <div class="container">
            修改商品图片:   <input type="file" id="disabledTextInput" class="form-control" name="img">
            <img width="50px" src="{{\Illuminate\Support\Facades\Storage::url($shopcategory->img)}}">
        </div><br/>
    {{csrf_field()}}
    {{method_field('patch')}}
        <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
   @stop