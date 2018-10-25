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

Route::group('admin',function ()
{
    Route::rule('/', 'admin/index/login','GET|POST');
    Route::rule('register', 'admin/index/register','GET|POST');
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
});
