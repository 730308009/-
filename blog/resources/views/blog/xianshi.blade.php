@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">{{$blogs['title']}}</div>
                <div class="col-sm-6 text-right">作者 : {{$blogs->user->name}}</div>
            </div>
        </div>
        <div class="card-body">
            {!! $blogs['content'] !!}
        </div>
        <div class="card-footer text-muted">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">发布时间 : {{$blogs['created_at']}}</div>
            </div>
        </div>
    </div>





@endsection
