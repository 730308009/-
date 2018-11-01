<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['show','index','create','store','confirmMail']
        ]);
    }


    /**
     * Display a listing of the resource.
     *  用户列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id','ASC')->paginate(10);
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *  用户注册
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name'=>'required|min:5',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|confirmed'
        ]);
        $data['password']=bcrypt($data['password']);
        $user=User::create($data);
        \Mail::to($user)->send(new RegMail($user));
//        \Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
        session()->flash('success','验证邮件已发送到您的邮箱..请查收....');
        return redirect()->route('home');


    }

    /**
     * Display the specified resource.
     * 用户信息显示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $blog=Blog::where('user_id',$user['id'])->orderBy('id','DESC')->with('user')->paginate(6);
        return view('user.show',compact('user','blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *  用户编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *  用户更新
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
//        调用策略模型
        $this->authorize('update',$user);
        $data=$this->validate($request,[
            'name'=>'required|min:2',
            'password'=>'nullable|min:5|confirmed'
        ]);
        $user->name=$request->name;
        if ($request->password){
            $user->password=bcrypt($request->password);
        }
        $user->update();
        session()->flash('success','修改成功');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     * 用户删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
//        调用当前用户表user的策略
        $this->authorize('delete',$user);
        $user->delete();
        session()->flash('success','删除成功');
        return redirect()->route('user.index');
    }

    public function confirmMail($token){
        $user=User::where('email_token',$token)->first();
        if ($user){
            $user['email_active']=true;
            $user->save();
            session()->flash('success','激活成功');
            \Auth::login($user);
            return redirect('/');
        }
        session()->flash('danger','激活码失效');
        return redirect('/');
    }
}
