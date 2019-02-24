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
//商户端注册
Route::resource('shops', 'ShopController');
//登陆
Route::get('login', 'LoginController@create')->name('login');
Route::post('login', 'LoginController@store')->name('login');
Route::get('logout', 'LoginController@destroy')->name('logout');
//修改密码
Route::get('changes/password/{user}','ChangeController@password')->name('changes.password');
Route::post('changes/password1/{user}','ChangeController@password1')->name('changes.password1');