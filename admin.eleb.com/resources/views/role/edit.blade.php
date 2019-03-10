
@extends('layout.app')
@section('content')


<form method="post" action="{{route('roles.update',[$role])}}" enctype="multipart/form-data">
    <div class="container">
        <h1>修改角色</h1><br/>
     @include('layout._error')

      角色名称：<input type="text" name="name" class="form-control" value="{{$role->name}}" >
    </div><br/>

    <div class="container"> 权限选择：
        @foreach($permissions as $permission)
            <input type="checkbox" id="inlineCheckbox1" name="per[]" value="{{$permission->id}}"
            @if($role->hasPermissionTo($permission->name))checked @endif
            >{{$permission->name}}
        @endforeach
    </div>
    {{csrf_field()}}
    {{method_field('patch')}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop