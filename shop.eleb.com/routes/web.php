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
//菜品列表资源路由
Route::resource('Menus','MenusController');
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
//活动列表
Route::get('Activitys','ActivityController@index')->name('Activitys.index');
//显示活动列表
Route::get('Activitys/{Activity}','ActivityController@show')->name('Activitys.show');
//订单一周量
Route::get('Statistics','StatisticsController@index')->name('Statistics.index');
//订单菜品一周销售数量
Route::get('Statistics/sale','StatisticsController@sale')->name('Statistics.sale');
//订单一个月量
Route::get('Statistics/show','StatisticsController@index1')->name('Statistics.show');
//显示订单列表
Route::get('Orders','OrderController@index')->name('Orders.index');
//查看详情订单
Route::get('Orders/{order}','OrderController@show')->name('Orders.show');

//取消和发货
Route::get('Orders/{order}/success','OrderController@success')->name('Orders.success');
Route::get('Orders/{order}/cancel','OrderController@cancel')->name('Orders.cancel');

//活动抽奖+列表
Route::resource('events','EventController');