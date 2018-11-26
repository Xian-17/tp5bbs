<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\facade\Route;

//index路由
Route::get('/','index/index/index');
//login路由
Route::post('login','index/index/login');
//quit路由
Route::get('quit','index/index/quit');
//register路由
Route::get('register','index/index/register');
Route::post('registerForm','index/index/registerForm');
//post路由
Route::get('post','index/index/post');
Route::post('postForm','index/index/postForm');
//scan路由
Route::get('scan','scan');//从一个操作数名跳到另一个操作数名
//Route::get('scan','index/index/scan');
//delete路由
Route::get('delete','delete');
//alter路由
Route::get('alter','index/index/alter');
Route::post('alterForm','index/index/alterForm');
//mainPage路由
Route::get('mainPage','index/index/mainPage');
Route::post('upload','index/index/upload');

?>