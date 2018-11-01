<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function home(){
//        发送邮件
//        $user=User::find(1);
//        \Mail::to($user)->send(new RegMail());
        $blogs=Blog::orderBy('id','DESC')->with('user')->paginate(6);
        return view('home',compact('blogs'));
    }
}
