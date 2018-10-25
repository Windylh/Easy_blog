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
//前台
Route::rule('cate/:id','index/index/index','GET');
Route::rule('/', 'index/index/index','GET');
Route::rule('article/:id','index/article/info','GET');
Route::rule('register', 'index/index/register','GET|POST');
Route::rule('login','index/index/login','GET|POST');
Route::rule('logout','index/index/logout','POST');
Route::rule('comment','index/article/comment','POST');
//后台
Route::group('admin',function ()
{
    Route::rule('/', 'admin/index/login','GET|POST');
    Route::rule('index', 'admin/home/index', 'GET');
    Route::rule('logout', 'admin/home/logout', 'POST');
    Route::rule('catelist', 'admin/cate/list', 'GET');
    Route::rule('cateadd', 'admin/cate/add', 'GET|POST');
    Route::rule('cateedit/[:id]', 'admin/cate/edit', 'GET|POST');
    Route::rule('catedel', 'admin/cate/del', 'POST');
    Route::rule('articlelist', 'admin/article/list', 'GET');
    Route::rule('articleadd', 'admin/article/add', 'GET|POST');
    Route::rule('articleedit/[:id]', 'admin/article/edit', 'GET|POST');
    Route::rule('articledel', 'admin/article/del', 'POST');
    Route::rule('userlist', 'admin/user/list', 'GET');
    Route::rule('useradd', 'admin/user/add', 'GET|POST');
    Route::rule('useredit/[:id]', 'admin/user/edit', 'GET|POST');
    Route::rule('userdel', 'admin/user/del', 'GET|POST');
    Route::rule('userstatus', 'admin/user/status', 'post');
    Route::rule('adminlist', 'admin/admin/list', 'GET');
    Route::rule('adminadd', 'admin/admin/add', 'GET|POST');
    Route::rule('adminedit/[:id]', 'admin/admin/edit', 'GET|POST');
    Route::rule('admindel', 'admin/admin/del', 'GET|POST');
    Route::rule('adminstatus', 'admin/admin/status', 'POST');
    Route::rule('commentlist','admin/comment/list','GET');
    Route::rule('commentdel','admin/comment/del','POST');
});

