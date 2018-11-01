<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
    //    图片上传
    public function update(Request $request)
    {

        $file = $request->file('file');
        $url = $this->mo($file);
        return [
            'code' => 0,
            'file' => $url,
        ];
    }

//    编辑器
    public function simditor(Request $request)
    {
        $file = $request->file('file');
        $url = $this->mo($file);
        return [
            'success' => true,
            'msg' => '上传成功',
            'file_path' => $url,
        ];
    }

//        公共类
    public function mo($file)
    {
        $dir = 'update/' . date('Ymd');
        $filename = date('Ymd') . time() . '.' . $file->getClientOriginalExtension();
        $url = $file->move($dir, $filename);

        return url($dir . '/' . $filename);
    }

//    图片列表
    public function fileList()
    {
        $files = glob('update/*/*');
        foreach ($files as $f) {
            $data[] = ['url' => asset("/" . $f), 'path' => asset('/' . $f)];
        }
//返回数据 data为文件列表 page 为分页数据，可以使用 houdunwang/page 组件生成
        return [
            'code' => 0,
            'data' => $data,
            'page' => '<ul class="pagination" role="navigation"> <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; 上一页"> <span class="page-link" aria-hidden="true">&lsaquo;</span> </li> <li class="page-item active" aria-current="page"><span class="page-link">1</span></li> <li class="page-item"><a class="page-link" href="http://dev.hdcms.com/util/upload/lists?page=2">2</a></li> <li class="page-item"><a class="page-link" href="http://dev.hdcms.com/util/upload/lists?page=3">3</a></li> <li class="page-item"> <a class="page-link" href="http://dev.hdcms.com/util/upload/lists?page=2" rel="next" aria-label="下一页 &raquo;">&rsaquo;</a> </li> </ul>',
        ];
    }
}
