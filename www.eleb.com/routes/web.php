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
//商家列表接口
Route::get('/business_list','Api\ApiController@business_list');
//指定商家接口
Route::get('/appoint','Api\ApiController@appoint');
//注册商家接口
Route::post('/reg','Api\ApiController@reg');

//登陆接口
Route::post('/api/login','Api\ApiController@login');
//发送短信接口
Route::get('/sms','Api\ApiController@sms');

//添加地址接口
Route::post('/address','Api\AddressController@store');

//显示地址接口
Route::get('/address_show','Api\AddressController@index');
//用户地址修改接口
Route::post('/address_update','Api\AddressController@update');
//指定用户接口回显数据接口
Route::get('/address_edit','Api\AddressController@edit');
//保存购物车
Route::post('/addCart','Api\AddCartController@keep');
//显示购物车
Route::get('/cart','Api\AddCartController@cart');
//重置密码
Route::post('/reset','Api\ResetController@reset');
//修改密码
Route::post('/cps','Api\ResetController@cps');
//添加订单列表接口
Route::post('/addOrder','Api\AddCartController@addOrder');
//添加订单显示接口
Route::get('/order','Api\AddCartController@order');
//添加订单页面接口
Route::get('/list','Api\AddCartController@list');