@extends('layouts.default')
@section('content')
        <div class="card text-center">
            <div class="card-header">
                {{$user['name']}}
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                用户列表
            </div>
            <div class="card-block">
                <table class="table">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>标题</th>
                        <th>图片</th>
                        <th>创建时间</th>
                        <th width="200">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blog as $k)

                        <tr>
                            <td>{{$k['id']}}</td>
                            <td>{{$k['title']}}</td>
                            <td>
                                <img src="{{$k['img']}}" style="height: 50px;">
                            </td>
                            <td>{{$k['created_at']}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('blog.show',$k)}}" class="btn btn-success">查看</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                {{$blog->links()}}
            </div>
        </div>
@endsection
