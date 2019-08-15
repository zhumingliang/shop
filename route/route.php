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

Route::rule('api/:version/index', 'api/:version.Index/index');
Route::rule('api/:version/send', 'api/:version.Index/send');

Route::post('api/:version/token/admin', 'api/:version.Token/getAdminToken');
Route::get('api/:version/token/user', 'api/:version.Token/getUserToken');
Route::get('api/:version/token/login/out', 'api/:version.Token/loginOut');

Route::post('api/:version/user/info', 'api/:version.User/userInfo');
Route::post('api/:version/user/public/info', 'api/:version.User/userPublicInfo');
Route::post('api/:version/user/check/bind', 'api/:version.User/checkBind');
Route::post('api/:version/user/bindPhone', 'api/:version.User/bindPhone');
Route::get('api/:version/user/login/out', 'api/:version.User/loginOut');
Route::get('api/:version/users', 'api/:version.User/users');

Route::post('api/:version/category/save', 'api/:version.Category/save');
Route::post('api/:version/category/handel', 'api/:version.Category/handel');
Route::post('api/:version/category/update', 'api/:version.Category/update');
Route::get('api/:version/categories/cms', 'api/:version.Category/CmsCategories');
Route::get('api/:version/categories', 'api/:version.Category/Categories');
Route::get('api/:version/category/sons', 'api/:version.Category/categorySons');

Route::post('api/:version/product/save', 'api/:version.Product/save');
Route::post('api/:version/product/handel', 'api/:version.Product/handel');
Route::post('api/:version/product/show', 'api/:version.Product/show');
Route::post('api/:version/product/update', 'api/:version.Product/update');
Route::get('api/:version/products/cms', 'api/:version.Product/CMSProducts');
Route::get('api/:version/product', 'api/:version.Product/product');
Route::get('api/:version/products/index', 'api/:version.Product/indexProducts');
Route::get('api/:version/products/mini', 'api/:version.Product/miniProducts');

