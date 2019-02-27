<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品分类 <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="{{route('MenuCategorys.index')}}">菜品分类列表</a></li>
                            <li><a href="{{route('MenuCategorys.create')}}">添加菜品分类</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家列表 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('shops.index')}}">商家信息</a></li>
                            <li><a href="{{route('shops.create')}}">注册商家信息</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品列表<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('Menus.index')}}">菜品列表</a></li>
                            <li><a href="{{route('Menus.create')}}">添加菜品</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动列表<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('Activitys.index')}}">活动列表</a></li>

                        </ul>
                    </li>
                </ul>


                {{--<ul class="nav navbar-nav navbar-right">--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="">会员列表</a></li>--}}
                            {{--<li><a href="">添加会员</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}

                {{--<ul class="nav navbar-nav navbar-right">--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家用户<span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="">用户列表</a></li>--}}
                            {{--<li><a href="">添加用户</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}


            </ul>
            <form class="navbar-form navbar-left" method="get" action="{{route('Menus.index')}}" name="keyword">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="请输入关键字 " name="keyword">
                </div>
                <p></p>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Email address</label>
                    <input type="text" class="form-control" id="exampleInputEmail3" placeholder="请输入价格" name="goods_price1">
                </div>>
                <font style="font-size: 24px;background-color: white">到</font>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword3">Password</label>
                    <input type="text" class="form-control" id="exampleInputPassword3" placeholder="请输入价格" name="goods_price2">
                </div>
                <button type="submit" class="btn btn-default" >搜索</button>

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
                        <li><a href="{{route('changes.password')}}">修改密码</a></li>
                        <li><a href="{{route('logout')}}">退出登陆</a></li>

                    </ul>
                </li>
            </ul>
            @endauth
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>