
@extends('layout.app')
@section('content')


<form method="post" action="{{route('permissions.update',[$permission])}}" enctype="multipart/form-data">
    <div class="container">
        <h1>修改权限</h1><br/>
     @include('layout._error')

      权限名称：<input type="text" name="name" class="form-control" value="{{$permission->name}}" >
    </div><br/>

    {{csrf_field()}}
    {{method_field('patch')}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop