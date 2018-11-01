@extends('layouts.default')
@section('content')
    <form action="{{route('user.update',$user)}}" method="post">
        @csrf @method('PUT')
        <div class="card">
            <div class="card-header">
                用户[{{$user['name']}}]编辑
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label>昵称</label>
                    <input type="text" class="form-control" name="name" value="{{$user['name']}}">
                </div>
                <div class="form-group">
                    <label>密码</label>
                    <input type="text" class="form-control" name="password" value="{{old('password')}}">
                </div>
                <div class="form-group">
                    <label>确认密码</label>
                    <input type="text" class="form-control" name="password_confirmation">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success mt-3">提交修改</button>
            </div>
        </div>
    </form>
@endsection
