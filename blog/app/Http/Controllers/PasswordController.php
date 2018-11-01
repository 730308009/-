<?php

namespace App\Http\Controllers;

use App\Notifications\FindPassword;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
//    显示界面
    public function show(){
        return view('password.show');
    }

//    更改密码发送方法
    public function send(Request $request){
        $email=$this->validate($request,[
           'email'=>'email|required'
        ]);
        $user=User::where('email',$email)->first();
        if (!$user){
            session()->flash('danger','邮箱输入有误');
            return back();
        }
        \Notification::send($user,new FindPassword($user->email_token));
        session()->flash('success','邮件发送成功');
        return redirect('/');
    }

//    密码更新页面
    public function edit($token){
        $user=$this->getUserByToken($token);
       if (!$user){
           session()->flash('danger','用户不存在');
           return redirect('/');
       }
       return view('password.edit',compact('user'));
    }

    public function getUserByToken($token){
        return User::where('email_token',$token)->first();
    }

//    密码更新方法
    public function update(Request $request){
        $password=$this->validate($request,[
            'password'=>'required|min:5|confirmed'
        ]);
        $user=$this->getUserByToken($request->email_token);
        $user['password']=bcrypt($request->password);
        $user->save();
        session()->flash('success','密码修改成功');
        return redirect('login');
    }
}
