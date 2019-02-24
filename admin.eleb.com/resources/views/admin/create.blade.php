
@extends('layout.app')
@section('content')


<form method="post" action="{{route('admins.store')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>添加管理员</h1><br/>
     @include('layout._error')

      管理员账号：<input type="text" name="name" class="form-control" value="{{old('name')}}" >
    </div><br/>
    <div class="container">
        管理员密码:   <input type="password" id="disabledTextInput" class="form-control" name="password">
    </div><br/>
    <div class="container">
        管理员邮件:   <input type="text" id="disabledTextInput" class="form-control" name="email">
    </div><br/>
    {{csrf_field()}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
</table>
   @stop