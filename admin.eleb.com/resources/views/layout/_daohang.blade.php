<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">--}}
                {{--<span class="sr-only">Toggle navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}
            {{--<a class="navbar-brand" href="">首页</a>--}}

        {{--<ul class="nav navbar-nav">--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家分类管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('shopcategorys.index')}}">商家分类列表</a></li>--}}
                        {{--<li><a href="{{route('shopcategorys.create')}}">商家添加分类</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</ul>--}}

        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家管理 <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('shops.index')}}">商家信息</a></li>--}}
                    {{--<li><a href="{{route('shops.create')}}">添加商家信息</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}

        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">角色管理 <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('roles.index')}}">角色信息</a></li>--}}
                    {{--<li><a href="{{route('roles.create')}}">添加角色</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}


        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">导航管理 <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('navs.index')}}">导航信息</a></li>--}}
                    {{--<li><a href="{{route('navs.create')}}">添加导航</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}





        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">权限管理 <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('permissions.index')}}">权限信息</a></li>--}}
                    {{--<li><a href="{{route('permissions.create')}}">添加权限</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}





        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员管理<span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('admins.index')}}">管理员列表</a></li>--}}
                    {{--<li><a href="{{route('admins.create')}}">添加管理员</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}

        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员管理<span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('Members.index')}}">会员列表</a></li>--}}

                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}

        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动管理<span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('Activitys.index')}}">活动列表</a></li>--}}
                    {{--<li><a href="{{route('Activitys.create')}}">添加活动</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}

        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家用户管理<span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('users.index')}}">商家用户列表</a></li>--}}

                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}



        {{--<ul class="nav navbar-nav navbar-right">--}}
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家用户管理<span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{{route('users.index')}}">商家用户列表</a></li>--}}

                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}








            {{--@foreach($parents as $parent)--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家用户管理<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('users.index')}}">商家用户列表</a></li>--}}

                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
            <?php
           $navs=\App\Model\Nav::all();
            $parents=\App\Model\Nav::where('pid',0)->get();
            ?>



            @foreach($parents as $parent)
                @if(auth()->user())@if(\Illuminate\Support\Facades\Auth::user()->can($parent->permission->name))
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="{{$parent->url}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{$parent->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($navs as $nav)
                    {{--判断当前用户是否有对应的权限--}}

                            @if($nav->pid == $parent->id)
                        <li><a href="{{$nav->url}}">{{$nav->name}}</a></li>

                            @endif

                        @endforeach
                    </ul>
                </li>

            </ul>
                @endif
                @endif
            @endforeach
        </div>








        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



            <form class="navbar-form navbar-left" method="get" name="keyword" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="keyword">
                </div>
                <button type="submit" class="btn btn-default" >Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}">登陆</a></li>
                @endguest
                @auth
                <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user">{{auth()->user()->name}}</span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">个人中心</a></li>
                                <li><a href="{{route('admins.password')}}">修改密码</a></li>
                                <li><a href="{{route('logout')}}">退出登陆</a></li>

                            </ul>
                        </li>
            </ul>
            @endauth
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>