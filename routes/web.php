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
Route::get('/','PagesController@root')->name('root');
Auth::routes();
// 用户登陆页面
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// 用户登陆-post
Route::post('login', 'Auth\LoginController@login');
// 用户退出-post
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// 用户注册页面
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// 用户注册-post
Route::post('register', 'Auth\RegisterController@register');
// 忘记密码页面
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// 发送重置密码邮件
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// 带token 的重置密码页面
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// 带token 密码重置页面 - post
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// 用户资源操作
//Route::resource('users','UsersController',['only'=>['show','update','edit']]);
Route::get('/users/{user}','UsersController@show')->name('users.show');
Route::get('/users/{user}/edit','UsersController@edit')->name('users.edit');
Route::patch('/users/{user}','UsersController@update')->name('users.update');
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::get('topics/{topic}/{slug?}','TopicsController@show')->name('topics.show');

Route::resource('categories','CategoriesController',['only'=>['show']]);

// 上传图片
Route::post('upload_image','TopicsController@uploadImage')->name('topics.upload_image');
// 上传测试
Route::get('up','TopicsController@up')->name('up');
Route::post('think_up','TopicsController@think_up')->name('think_up');
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);