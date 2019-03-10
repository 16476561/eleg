@extends('layout.app')
@section('content')
    <table class="table table-bordered">

        <tr>

            <th>会员账号</th>
            <th>会员电话</th>
            <th>会员状态</th>
        </tr>
        <tr>

            <td>{{$member->username}}</td>
            <td>{{$member->tel}}</td>
                <td>@if($member->status==1)正常
                    @else($member->status==0)禁用
                    @endif
                </td>

    </table>

    @stop
