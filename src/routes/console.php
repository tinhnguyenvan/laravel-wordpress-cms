<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth.console'])->group(
    function () {
        Route::get('/dashboard', 'DashboardController@index');
        Route::get('/logout', 'UserController@logout');

        // user
        Route::resource('users', 'UserController');
        Route::get('/users/reset-password/{id}', 'UserController@resetPassword');
        Route::post('/users/active/{id}', 'UserController@active');
        Route::post('/users/profile', 'UserController@show');
        Route::put('/users/update-reset-password/{id}', 'UserController@updateResetPassword');

        // members
        Route::resource('members', 'MemberController');
        Route::get('/members/reset-password/{id}', 'MemberController@resetPassword');
        Route::post('/members/active/{id}', 'MemberController@active');
        Route::put('/members/update-reset-password/{id}', 'MemberController@updateResetPassword');

        // media
        Route::delete('medias/destroy-multi', 'MediaController@destroyMulti');
        Route::resource('medias', 'MediaController');

        // media
        Route::post('media/upload', 'MediaController@upload');

        // roles
        Route::get('roles', 'RoleController@index');
        Route::get('roles/permission', 'RoleController@permission');
        Route::post('roles/permission', 'RoleController@updatePermission');

        // themes
        Route::get('themes', 'ThemeController@index');
        Route::get('themes/css', 'ThemeController@css');
        Route::post('themes/active', 'ThemeController@active');

        // plugins
        Route::get('plugins', 'PluginController@index')->name('admin.plugins.index');

        Route::put('plugins/{id}/update-status', 'PluginController@updateStatus')->name('admin.plugins.updateStatus');

        // config
        Route::post('/configs/save', 'ConfigController@save');
        Route::post('/configs/test', 'ConfigController@test');
        Route::resource('configs', 'ConfigController');

        //post
        Route::delete('posts/destroy-multi', 'PostController@destroyMulti');
        Route::resource('posts', 'PostController');

        // post tag
        Route::delete('post_tags/destroy-multi', 'PostTagController@destroyMulti');
        Route::resource('post_tags', 'PostTagController');
        Route::resource('post_categories', 'PostCategoryController');

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

        // cache-systems
        Route::get('cache-systems', 'CacheSystemController@index');
        Route::delete('cache-systems/{slug}', 'CacheSystemController@delete');
    }
);
