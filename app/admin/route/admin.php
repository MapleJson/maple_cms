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

$namespace = '\app\admin\controller\\';

Route::get('login/index',$namespace . 'index\Login@index')->name('login.index');
Route::group(function () use ($namespace) {
    Route::get('/',$namespace . 'index\Index@index')->name('home');
    Route::get('index',$namespace . 'index\Index@index');
    Route::post('online/account',$namespace . 'index\Index@adminOnlineList')->middleware('super')->name('online.account');
    Route::get('pwd/change',$namespace . 'index\Login@changePwd')->name('pwd.change');
    Route::post('pwd/change',$namespace . 'index\Login@changePwdDo')->name('pwd.changeDo');
})->middleware('auth', 'admin');
