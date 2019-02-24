@extends('layout.app')
@section('content')
    <table class="table table-bordered">
    <tr>
        <th>序号</th>
        <th>标题</th>
        <th>内容</th>
        <th>新闻分类</th>
        <th>新闻作者</th>
        <th>操作</th>
    </tr>
    @foreach($articles as $article)
        <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->title}}</td>
            <td>{{$article->content}}</td>
            <td>{{$article->abc->sort}}</td>
            <td>{{$article->user?$article->user->name:'作者已注销'}}</td>
            <td>
                <a href="{{route('articles.edit',[$article])}}">编辑</a>
                {{--<a href="{{route('article.Show',['id'=>$article->id])}}">查看</a>--}}
                <form style="display: inline" method="post" action="{{ route('articles.destroy',[$article]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                </form>

            </td>
        </tr>

    @endforeach
    </table>
    {{$articles->appends(['keyword'=>$keyword])->links()}}
    @stop
