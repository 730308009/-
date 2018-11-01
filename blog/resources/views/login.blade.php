@extends('layouts.default')
@section('content')
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                用户登录
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">密码</label>
                    <input type="text" name="password" class="form-control">
                </div>
                <a href="{{route('passwordShow')}}">找回密码</a>
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-success">登录</button>
            </div>
        </div>
    </form>
@endsection
