@extends("layouts.default")
@section('content')
    @auth()
        <div class="card">
            <div class="card-header">
                发表留言
            </div>
            <div class="card-body">
                <form action="{{route('blog.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="inputSmall" class="col-12 col-sm-3 col-form-label text-sm-right">
                            标题
                        </label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="title" value="{{ $content['title']??old('title') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSmall" class="col-12 col-sm-3 col-form-label text-sm-right">
                            图片
                        </label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <div class="input-group mb-3">
                                <button onclick="upImagePc(this)" class="btn btn-secondary" type="button">单图上传</button>
                                <input type="text" name="img" hidden value="{!! $content['thumb']??old('thumb') !!}">
                            </div>
                            <div style="display: inline-block;position: relative;">
                                <img src="{{asset('/img/00.jpg')}}" class="img-responsive img-thumbnail" width="150">
                                <em class="close" style="position: absolute;top: 3px;right: 8px;" title="删除这张图片"
                                    onclick="removeImg(this)">×</em>
                            </div>
                        </div>
                    </div>
                    <script>
                        require(['hdjs','bootstrap']);
                        //上传图片
                        function upImagePc() {
                            require(['hdjs'], function (hdjs) {
                                var options = {
                                    multiple: false,//是否允许多图上传
                                    //data是向后台服务器提交的POST数据
                                    data: {name: '后盾人', year: 2099},
                                };
                                hdjs.image(function (images) {
                                    //上传成功的图片，数组类型
                                    $("[name='img']").val(images[0]);
                                    $(".img-thumbnail").attr('src', images[0]);
                                }, options)
                            });
                        }
                        //移除图片
                        function removeImg(obj) {
                            $(obj).prev('img').attr('src', "{{asset('/img/00.jpg')}}");
                            $(obj).parent().prev().find('input').val('');
                        }
                    </script>
                    <div class="form-group row">
                        <label for="inputSmall" class="col-12 col-sm-3 col-form-label text-sm-right">
                            内容
                        </label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <div class="input-group mb-3">
                                <textarea name="content" id="container" style="height:300px;width:100%;">{{ $content['content']??old('content') }}</textarea>
                                <script>
                                    require(['hdjs'], function (hdjs) {
                                        hdjs.ueditor('container', {hash: 2, data: 'hd'}, function (editor) {
                                            console.log('编辑器执行后的回调方法1')
                                        });
                                    })
                                </script>
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="inputSmall" class="col-12 col-sm-3 col-form-label text-sm-right">
                        </label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <div class="input-group mb-3">
                                <button class="btn btn-success" type="submit" >提交</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endauth()
    <div class="card mt-3">
        <div class="card-header">
            留言列表
        </div>
        <div class="card-body">
            <div class="card-block">
                <table class="table">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>作者</th>
                        <th>图片</th>
                        <th>创建时间</th>
                        <th width="200">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $blog)

                        <tr>
                            <td>{{$blog['id']}}</td>
                            <td>{{$blog->user->name}}</td>
                            <td>
                                <img src="{{$blog['img']}}" style="height: 50px">
                            </td>
                            <td>{{$blog['created_at']}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('blog.show',$blog)}}" class="btn btn-success">查看</a>
                                    @can('delete',$blog)
                                        <form action="{{route('blog.destroy',$blog)}}" method="post">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger" type="submit">删除</button>
                                        </form>
                                    @endcan

                                    @can('update',$blog)
                                        <a href="{{route('user.edit',$blog)}}" class="btn btn-secondary">编辑</a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            {{$blogs->links()}}
        </div>
    </div>

@endsection
