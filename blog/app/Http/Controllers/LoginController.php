<?php

namespace App\Http\Controllers;

use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
    }

//    用户登录页面
    public function login(){
        return view('login');
    }

//    用户登录方法
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user=User::where('email',$request->email)->first();
        if ($user['email_active']==0){
            \Mail::to($user)->send(new RegMail($user));
            session()->flash('success','邮件已发送...请激活邮箱在登录...');
            return redirect('/');
        }
//        传递数组
        if (\Auth::attempt($data)){
            session()->flash('success','用户登录成功');
            return redirect('/');
        }
        session()->flash('danger','用户或密码错误');
        return back();

    }

//    用户退出
    public function logout(){
        \Auth::logout();
        session()->flash('success','用户退出成功');
        return redirect('/');
    }
}
