<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "console" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::middleware(['auth.console'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/configs', 'ConfigController@index');
    Route::post('/configs/save', 'ConfigController@save');
    Route::post('/configs/test', 'ConfigController@test');
    Route::get('/logout', 'UserController@logout');

    // user
    Route::resource('users', 'UserController');
    Route::get('/users/reset-password/{id}', 'UserController@resetPassword');
    Route::post('/users/active/{id}', 'UserController@active');
    Route::post('/users/profile', 'UserController@show');
    Route::put('/users/update-reset-password/{id}', 'UserController@updateResetPassword');

    // media
    Route::delete('medias/destroy-multi', 'MediaController@destroyMulti');
    Route::resource('medias', 'MediaController');

    // ckeditor
    Route::post('ckeditor/upload', 'MediaController@upload');

    // roles
    Route::get('roles', 'RoleController@index');

    // themes
    Route::get('themes', 'ThemeController@index');
    Route::get('themes/css', 'ThemeController@css');

    // order
    Route::get('orders/report', 'OrderController@report');
    Route::get('orders/get-report', 'OrderController@getReport');
    Route::resource('orders', 'OrderController');
    Route::post('orders/resent-mail/{id}', 'OrderController@resentMail');
    Route::post('orders/status/{id}', 'OrderController@status');

    Route::resource('configs', 'ConfigController');

    //post
    Route::delete('posts/destroy-multi', 'PostController@destroyMulti');
    Route::resource('posts', 'PostController');

    // post tag
    Route::delete('post_tags/destroy-multi', 'PostTagController@destroyMulti');
    Route::resource('post_tags', 'PostTagController');
    Route::resource('post_categorys', 'PostCategoryController');

    // product
    Route::delete('products/destroy-multi', 'ProductController@destroyMulti');
    Route::resource('products', 'ProductController');
    Route::resource('product_categorys', 'ProductCategoryController');

    // comment
    Route::delete('comments/destroy-multi', 'CommentController@destroyMulti');
    Route::resource('comments', 'CommentController');
    Route::post('comments/status/{id}', 'CommentController@status');

    // nav
    Route::resource('navs', 'NavController');
    Route::resource('nav_positions', 'NavPositionController');

    // page
    Route::delete('pages/destroy-multi', 'PageController@destroyMulti');
    Route::resource('pages', 'PageController');
    Route::resource('ads', 'AdsController');

    // contact
    Route::delete('contacts/destroy-multi', 'ContactController@destroyMulti');
    Route::resource('contacts', 'ContactController');
    Route::resource('contact_forms', 'ContactFormController');
});
