<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>miaosuwulimi</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/home.css">
    <script>
        window.hdjs={};
        //组件目录必须绝对路径
        window.hdjs.base = '/plugin/hdjs';
        //上传文件后台地址
        window.hdjs.uploader = '/upload?';
        //获取文件列表的后台地址
        window.hdjs.filesLists = '/fileList?';
    </script>
    <script src="/plugin/hdjs/require.js"></script>
    <script src="/plugin/hdjs/config.js"></script>

</head>
<body style="font-family:Ubuntu">
<div class="container mt-2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand" href="{{route('home')}}">首页</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link disabled" href="http://wo.miaosuwulimi.cn">秒速五厘米</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="{{route('user.index')}}">用户列表</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                @auth
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{Auth::user()->name}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="{{route('user.edit',Auth::user())}}">修改密码</a>
                            </div>
                        </div>
                        <a href="{{route('logout')}}"  class="btn btn-secondary">退出</a>
                    </div>
                @else
                    <a href="{{route('login')}}" class="btn btn-outline-success my-2 mr-2 my-sm-0">登录</a>
                    <a href="{{route('user.create')}}" class="btn btn-outline-danger my-2 my-sm-0">注册</a>
                @endauth
            </form>
        </div>
    </nav>
    @include('layouts._message')
    @include('layouts._validate')
    @yield('content')
</div>


<script src="/js/app.js"></script>
</body>
</html>
