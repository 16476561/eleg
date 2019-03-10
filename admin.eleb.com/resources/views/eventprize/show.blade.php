@extends('layout.app')
@section('content')
    <table class="table table-bordered">
        <tr>
        <tr>

            <th>中奖商品</th>
            <th>中奖商家</th>


        </tr>

        @foreach($eps as $ep)
            <tr>
                <td>{{$ep->name}}</td>
                <td>{{$ep->user->name??''}}</td>


            </tr>
        @endforeach

    </table>

@stop
