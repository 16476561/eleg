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

//修改旧密码确认新密码
Route::get('admins/password','AdminController@password')->name('admins.password');
Route::post('admins/password1','AdminController@password1')->name('admins.password1');
//管理员资源路由
Route::resource('admins', 'AdminController');
//登陆
Route::get('login', 'LoginController@create')->name('login');
Route::post('login', 'LoginController@store')->name('login');
Route::get('logout', 'LoginController@destroy')->name('logout');
//商户管理
Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/{user}/start','UserController@start')->name('users.start');
Route::get('users/{user}/guan','UserController@guan')->name('users.guan');
////重置密码
 Route::get('users/{user}/reset','UserController@reset')->name('users.reset');
Route::post('users/{user}/broker','UserController@broker')->name('users.broker');
//活动资源路由
Route::resource('Activitys','ActivityController');
//文件上传
Route::post('/upload','ShopCategoryController@upload')->name('upload');

//会员列表
Route::group(['middleware' => ['role:会员管理员']], function () {
Route::get('Members','MemberController@index')->name('Members.index');
//查看会员订单
Route::get('Members/{member}','MemberController@show')->name('Members.show');
});

//启动，禁用
Route::get('Members/{member}/success','MemberController@success')->name('Members.success');
Route::get('Members/{member}/cancel','MemberController@cancel')->name('Members.cancel');
Route::group(['middleware' => ['role:角色管理员|权限管理员|导航管理员']], function () {
//角色管理
    Route::resource('roles', 'RoleController');
//权限管理
    Route::resource('permissions', 'PermissionController');
//导航管理
    Route::resource('navs', 'NavController');
});
//抽奖活动
Route::resource('events', 'EventController');
//活动奖品
Route::resource('eventprizes', 'EventPrizeController');
//开奖
Route::get('et/kj/{id}','EventController@kj')->name('et.kj');
//查看开奖
Route::get('et/md/{id}','EventController@md')->name('et.md');
//
Route::resource('register', 'Controller');