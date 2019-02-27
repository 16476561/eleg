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

Route::get('changes/password','ChangeController@password')->name('changes.password');
Route::post('changes/password1','ChangeController@password1')->name('changes.password1');
//商户端注册

Route::resource('shops', 'ShopController');
//登陆
Route::get('login', 'LoginController@create')->name('login');
Route::post('login', 'LoginController@store')->name('login');
Route::get('logout', 'LoginController@destroy')->name('logout');
//修改密码

//登陆验证
Route::get('success/{user}','LoginController@success')->name('Login.success');

//菜品分类资源路由
Route::resource('MenuCategorys','MenuCategoryController');
//默认值
Route::get('MenuCategorys/{MenuCategory}/start','MenuCategoryController@start')->name('MenuCategorys.start');
Route::get('MenuCategorys/{MenuCategory}/guan','MenuCategoryController@guan')->name('MenuCategorys.guan');
//菜品列表资源路由
Route::resource('Menus','MenusController');
//活动列表
Route::get('Activitys','ActivityController@index')->name('Activitys.index');
//显示活动列表
Route::get('Activitys/{Activity}','ActivityController@show')->name('Activitys.show');