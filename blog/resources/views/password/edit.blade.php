@extends('layouts.default')
@section('content')
    <form action="{{route('passwordUpdate')}}" method="post">
        @csrf
        <div class="card">
            <input type="text" name="email_token" hidden value="{{$user['email_token']}}">
            <div class="card-header">
                修改密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>邮箱</label>
                    <input type="email" class="form-control" name="email" value="{{$user['email']}}">
                </div>
                <div class="form-group">
                    <label>密码</label>
                    <input type="text" class="form-control" name="password" value="">
                </div>
                <div class="form-group">
                    <label>确认密码</label>
                    <input type="text" class="form-control" name="password_confirmation">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success mt-3">修改密码</button>
            </div>
        </div>
    </form>
@endsection
