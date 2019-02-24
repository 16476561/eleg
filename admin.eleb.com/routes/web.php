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

Route::get('/', function () {
    return view('welcome');
});
//商家分类管理
Route::resource('shopcategorys', 'ShopCategoryController');
//Route::get('/users', 'UsersController@index')->name('users.index');//用户列表
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');//查看单个用户信息
//Route::get('/users/create', 'UsersController@create')->name('users.create');//显示添加表单
//Route::post('/users', 'UsersController@store')->name('users.store');//接收添加表单数据
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');//修改用户表单
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');//更新用户信息
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');//删除用户信息
//商家信息表
Route::resource('shops', 'ShopController');
//启动和禁用
Route::get('shops/{shop}/change','ShopController@change')->name('shops.change');
Route::get('shops/{shop}/off','ShopController@off')->name('shops.off');
//管理员列表
Route::resource('admins', 'AdminController');
Route::get('admins/password/{admin}','AdminController@password')->name('admins.password');
Route::post('admins/password1/{admin}','AdminController@password1')->name('admins.password1');
//登陆
Route::get('login', 'LoginController@create')->name('login');
Route::post('login', 'LoginController@store')->name('login');
Route::get('logout', 'LoginController@destroy')->name('logout');
//修改旧密码确认新密码
