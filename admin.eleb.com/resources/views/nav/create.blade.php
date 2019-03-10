
@extends('layout.app')
@section('content')
    @include('vendor.ueditor.assets')

<form method="post" action="{{route('navs.store')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>添加页面</h1><br/>
     @include('layout._error')

      导航名称：<input type="text" name="name" class="form-control" value="{{old('title')}}" >
    </div><br/>
    <div class="container">
        地址:   <input type="text" id="disabledTextInput" class="form-control" name="url" value="">
    </div>  <br/>
    <div class="container"> 权限选择：
        @foreach($permissions as $permission)
            <input type="radio" id="inlineCheckbox1" name="permission_id" value="{{$permission->id}}"
            >{{$permission->name}}
        @endforeach

        <br/><br/>
        导航分类：

        <div class="container" style="margin-left: -19px">
        <select class="form-control" name="pid">
            <option name="pid" class="container" value="0">顶级分类</option>
            @foreach($navs as $nav)
            <option name="pid" class="container" value="{{$nav->id}}">{{$nav->name}}</option>
            @endforeach
        </select>
        </div>
            <br/>

    {{csrf_field()}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop