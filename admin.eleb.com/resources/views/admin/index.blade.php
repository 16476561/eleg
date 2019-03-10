@extends('layout.app')
@section('content')
    <table class="table table-bordered">
    <tr>
        <tr>

            <th>管理员账号</th>
            <th>管理员邮件</th>
            <th>操作</th>
        </tr>
    </tr>
  @foreach($admins as $admin)
        <tr>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>

            <td>
                <a href="{{route('admins.edit',[$admin])}}" class="btn btn-info">编辑</a>
                <form style="display: inline" method="post" action="{{ route('admins.destroy',[$admin]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                </form>

            </td>
        </tr>
        @endforeach

    </table>

    @stop
