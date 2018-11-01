<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//首页路由
Route::get('/','indexController@home')->name('home');

//用户注册路由
Route::resource('user','UserController');

//用户登录
Route::get('login','LoginController@login')->name('login');
//用户登录方法
Route::post('login',"LoginController@store")->name('login');
//用户注册
Route::get('logout','LoginController@logout')->name('logout');

//博客资源路由
Route::resource('blog','BlogController');

//邮箱验证
Route::get('confirmMail/{token}','UserController@confirmMail')->name('confirmMail');


//显示界面
Route::get('passwordShow','PasswordController@show')->name('passwordShow');
//修改密码发送
Route::post('passwordSend','PasswordController@send')->name('passwordSend');
//修改密码显示方法
Route::get('passwordEdit/{token}','PasswordController@edit')->name('passwordEdit');
//修改密码方法
Route::post("passwordUpdate",'PasswordController@update')->name('passwordUpdate');

//图片上传
Route::any('/upload','UpdateController@update');
//图片列表
Route::any('/fileList','UpdateController@fileList');
