<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //用户列表
        '/reg',
        //登陆
        '/api/login',
        //添加用户
        '/address',
        //修改用户
         '/address_update' ,
        //保存购物车
        '/addCart',
        //重置密码
        '/reset',
        //修改密码
        '/cps',
        //添加订单
        '/addOrder',
    ];
}
