@extends('layout.app')
@section('content')
    <table class="table table-bordered">
    <tr>
        <tr>

            <th>商家账号</th>
            <th>商家状态</th>
            <th>操作</th>
            <th>重置密码</th>
        </tr>
    </tr>
  @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>@if($user->status==1)正常
                @else($user->status==0)禁止
                    @endif
            </td>
            <td>
            <form style="display: inline" method="get" action="{{ route('users.start',[$user]) }}">
                <button type="submit" class="btn btn-info">启动</button>
            </form>

            <form style="display: inline" method="get" action="{{ route('users.guan',[$user]) }}">
                <button type="submit" class="btn btn-danger">禁用</button>
            </form>
            </td>
            <td>
                <a href="{{route('users.reset',[$user])}}" class="btn btn-success">重置密码</a>
            </td>
        </tr>
        @endforeach

    </table>

    @stop
