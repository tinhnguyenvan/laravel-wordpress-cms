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

Route::get('/', 'LoginController@index');
Route::get('/login', 'LoginController@index');
Route::get(
    '/auth',
    function () {
        return redirect(admin_url('login'));
    }
);
Route::post('/auth', 'LoginController@auth');

Route::middleware(['auth.console'])->group(
    function () {
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

        // members tag
        Route::resource('member-tags', 'MemberTagController');

        // members
        Route::resource('members', 'MemberController');
        Route::get('/members/reset-password/{id}', 'MemberController@resetPassword');
        Route::get('/members/tags/{id}', 'MemberController@tags');
        Route::put('/members/tags/{id}', 'MemberController@putTags');
        Route::post('/members/active/{id}', 'MemberController@active');
        Route::put('/members/update-reset-password/{id}', 'MemberController@updateResetPassword');
        Route::get('/members/set-member-type/{id}', function () {
            return redirect(admin_url('members'));
        });
        Route::put('/members/set-member-type/{id}', 'MemberController@setMemberType');

        // media
        Route::delete('medias/destroy-multi', 'MediaController@destroyMulti');
        Route::resource('medias', 'MediaController');

        // ckeditor
        Route::post('ckeditor/upload', 'MediaController@upload');

        // roles
        Route::get('roles', 'RoleController@index');
        Route::get('roles/permission', 'RoleController@permission');
        Route::post('roles/permission', 'RoleController@updatePermission');

        // themes
        Route::get('themes', 'ThemeController@index');
        Route::get('themes/css', 'ThemeController@css');

        // plugins
        Route::get('plugins', 'ThemeController@index');

        // order
        Route::get('orders/report', 'OrderController@report');
        Route::get('orders/get-report', 'OrderController@getReport');
        Route::resource('orders', 'OrderController');
        Route::post('orders/resent-mail/{id}', 'OrderController@resentMail');
        Route::post('orders/status/{id}', 'OrderController@status');

        // config
        Route::resource('configs', 'ConfigController');

        //post
        Route::delete('posts/destroy-multi', 'PostController@destroyMulti');
        Route::resource('posts', 'PostController');

        // post tag
        Route::delete('post_tags/destroy-multi', 'PostTagController@destroyMulti');
        Route::resource('post_tags', 'PostTagController');
        Route::resource('post_categories', 'PostCategoryController');

        // product
        Route::delete('products/destroy-multi', 'ProductController@destroyMulti');
        Route::resource('products', 'ProductController');
        Route::resource('product_categories', 'ProductCategoryController');

        // comment
        Route::delete('comments/destroy-multi', 'CommentController@destroyMulti');
        Route::put('comments/update-status', 'CommentController@putStatus');
        Route::resource('comments', 'CommentController');
        Route::post('comments/status/{id}', 'CommentController@status');

        // bookmark
        Route::resource('bookmarks', 'BookmarkController');

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

        // regions
        Route::resource('regions', 'RegionController');
    }
);
