<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ContactFormController;
use App\Http\Controllers\Admin\NavController;
use App\Http\Controllers\Admin\NavPositionController;
use App\Http\Controllers\Admin\PluginController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostTagController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\CacheSystemController;
use App\Http\Controllers\Admin\BookmarkController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\LanguageController;

Route::middleware(['auth.console'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/logout', [UserController::class, 'logout']);

        // user
        Route::get('users', [UserController::class, 'index']);
        Route::get('users/create', [UserController::class, 'create']);
        Route::post('users', [UserController::class, 'store']);
        Route::get('users/{user}', [UserController::class, 'show']);
        Route::get('users/{user}/edit', [UserController::class, 'edit']);
        Route::put('users/{user}', [UserController::class, 'update']);
        Route::patch('users/{user}', [UserController::class, 'update']);
        Route::delete('users/{user}', [UserController::class, 'destroy']);
        Route::get('/users/reset-password/{id}', [UserController::class, 'resetPassword']);
        Route::post('/users/active/{id}', [UserController::class, 'active']);
        Route::post('/users/profile', [UserController::class, 'show']);
        Route::put('/users/update-reset-password/{id}', [UserController::class, 'updateResetPassword']);

        // members
        Route::get('members', [MemberController::class, 'index']);
        Route::get('members/create', [MemberController::class, 'create']);
        Route::post('members', [MemberController::class, 'store']);
        Route::get('members/{member}', [MemberController::class, 'show']);
        Route::get('members/{member}/edit', [MemberController::class, 'edit']);
        Route::put('members/{member}', [MemberController::class, 'update']);
        Route::patch('members/{member}', [MemberController::class, 'update']);
        Route::delete('members/{member}', [MemberController::class, 'destroy']);
        Route::get('members/reset-password/{id}', [MemberController::class, 'resetPassword']);
        Route::post('members/active/{id}', [MemberController::class, 'active']);
        Route::put('members/update-reset-password/{id}', [MemberController::class, 'updateResetPassword']);

        // media
        Route::delete('medias/destroy-multi', [MediaController::class, 'destroyMulti']);
        Route::get('medias', [MediaController::class, 'index']);
        Route::get('medias/create', [MediaController::class, 'create']);
        Route::post('medias', [MediaController::class, 'store']);
        Route::get('medias/{media}', [MediaController::class, 'show']);
        Route::get('medias/{media}/edit', [MediaController::class, 'edit']);
        Route::put('medias/{media}', [MediaController::class, 'update']);
        Route::patch('medias/{media}', [MediaController::class, 'update']);
        Route::delete('medias/{media}', [MediaController::class, 'destroy']);
        Route::post('media/upload', [MediaController::class, 'upload']);

        // roles
        Route::get('roles', [RoleController::class, 'index']);
        Route::get('roles/permission', [RoleController::class, 'permission']);
        Route::post('roles/permission', [RoleController::class, 'updatePermission']);

        // themes
        Route::get('themes', [ThemeController::class, 'index']);
        Route::get('themes/css', [ThemeController::class, 'css']);
        Route::post('themes/active', [ThemeController::class, 'active']);

        // plugins
        Route::get('plugins', [PluginController::class, 'index']);
        Route::put('plugins/{id}/update-status', [PluginController::class, 'updateStatus']);

        // config
        Route::get('configs', [ConfigController::class, 'index']);
        Route::get('configs/create', [ConfigController::class, 'create']);
        Route::post('configs/test', [ConfigController::class, 'test']);
        Route::post('configs/save', [ConfigController::class, 'save']);
        Route::post('configs', [ConfigController::class, 'store']);
        Route::get('configs/{id}', [ConfigController::class, 'show']);
        Route::get('configs/{id}/edit', [ConfigController::class, 'edit']);
        Route::put('configs/{id}', [ConfigController::class, 'update']);
        Route::patch('configs/{id}', [ConfigController::class, 'update']);

        //post
        Route::get('posts', [PostController::class, 'index']);
        Route::get('posts/create', [PostController::class, 'create']);
        Route::post('posts', [PostController::class, 'store']);
        Route::get('posts/{id}', [PostController::class, 'show']);
        Route::get('posts/{id}/edit', [PostController::class, 'edit']);
        Route::put('posts/{id}', [PostController::class, 'update']);
        Route::patch('posts/{id}', [PostController::class, 'update']);
        Route::patch('posts/destroy-multi', [PostController::class, 'destroyMulti']);

        // post tag
        Route::get('post_tags', [PostTagController::class, 'index']);
        Route::get('post_tags/create', [PostTagController::class, 'create']);
        Route::post('post_tags', [PostTagController::class, 'store']);
        Route::get('post_tags/{id}', [PostTagController::class, 'show']);
        Route::get('post_tags/{id}/edit', [PostTagController::class, 'edit']);
        Route::put('post_tags/{id}', [PostTagController::class, 'update']);
        Route::patch('post_tags/{id}', [PostTagController::class, 'update']);
        Route::delete('post_tags/{id}', [PostTagController::class, 'destroy']);
        Route::delete('post_tags/destroy-multi', [PostTagController::class, 'destroyMulti']);

        Route::get('post_categories', [PostCategoryController::class, 'index']);
        Route::get('post_categories/create', [PostCategoryController::class, 'create']);
        Route::post('post_categories', [PostCategoryController::class, 'store']);
        Route::get('post_categories/{id}', [PostCategoryController::class, 'show']);
        Route::get('post_categories/{id}/edit', [PostCategoryController::class, 'edit']);
        Route::put('post_categories/{id}', [PostCategoryController::class, 'update']);
        Route::patch('post_categories/{id}', [PostCategoryController::class, 'update']);
        Route::delete('post_categories/{id}', [PostCategoryController::class, 'destroy']);

        // comment
        Route::get('comments', [CommentController::class, 'index']);
        Route::get('comments/create', [CommentController::class, 'create']);
        Route::post('comments', [CommentController::class, 'store']);
        Route::get('comments/{comment}', [CommentController::class, 'show']);
        Route::get('comments/{comment}/edit', [CommentController::class, 'edit']);
        Route::put('comments/update-status', [CommentController::class, 'putStatus']);
        Route::post('comments/status/{id}', [CommentController::class, 'status']);
        Route::put('comments/{comment}', [CommentController::class, 'update']);
        Route::patch('comments/{comment}', [CommentController::class, 'update']);
        Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
        Route::delete('comments/destroy-multi', [CommentController::class, 'destroyMulti']);


        // bookmark BookmarkController
        Route::get('bookmarks', [BookmarkController::class, 'index']);
        Route::get('bookmarks/create', [BookmarkController::class, 'create']);
        Route::post('bookmarks', [BookmarkController::class, 'store']);
        Route::get('bookmarks/{bookmark}', [BookmarkController::class, 'show']);
        Route::get('bookmarks/{bookmark}/edit', [BookmarkController::class, 'edit']);
        Route::put('bookmarks/{bookmark}', [BookmarkController::class, 'update']);
        Route::patch('bookmarks/{bookmark}', [BookmarkController::class, 'update']);
        Route::delete('bookmarks/{bookmark}', [BookmarkController::class, 'destroy']);

        // nav
        Route::get('navs', [NavController::class, 'index']);
        Route::get('navs/create', [NavController::class, 'create']);
        Route::post('navs', [NavController::class, 'store']);
        Route::get('navs/{id}', [NavController::class, 'show']);
        Route::get('navs/{id}/edit', [NavController::class, 'edit']);
        Route::put('navs/{id}', [NavController::class, 'update']);
        Route::patch('navs/{id}', [NavController::class, 'update']);
        Route::delete('navs/{id}', [NavController::class, 'destroy']);

        // nav positions
        Route::get('nav_positions', [NavPositionController::class, 'index']);
        Route::get('nav_positions/create', [NavPositionController::class, 'create']);
        Route::post('nav_positions', [NavPositionController::class, 'store']);
        Route::get('nav_positions/{id}', [NavPositionController::class, 'show']);
        Route::get('nav_positions/{id}/edit', [NavPositionController::class, 'edit']);
        Route::put('nav_positions/{id}', [NavPositionController::class, 'update']);
        Route::patch('nav_positions/{id}', [NavPositionController::class, 'update']);
        Route::delete('nav_positions/{id}', [NavPositionController::class, 'destroy']);

        // ads
        Route::get('ads', [AdsController::class, 'index']);
        Route::get('ads/create', [AdsController::class, 'create']);
        Route::post('ads', [AdsController::class, 'store']);
        Route::get('ads/{id}', [AdsController::class, 'show']);
        Route::get('ads/{id}/edit', [AdsController::class, 'edit']);
        Route::put('ads/{id}', [AdsController::class, 'update']);
        Route::patch('ads/{id}', [AdsController::class, 'update']);
        Route::delete('ads/{id}', [AdsController::class, 'destroy']);

        // pages
        Route::get('pages', [PageController::class, 'index']);
        Route::get('pages/create', [PageController::class, 'create']);
        Route::post('pages', [PageController::class, 'store']);
        Route::get('pages/{id}', [PageController::class, 'show']);
        Route::get('pages/{id}/edit', [PageController::class, 'edit']);
        Route::put('pages/{id}', [PageController::class, 'update']);
        Route::patch('pages/{id}', [PageController::class, 'update']);
        Route::delete('pages/{id}', [PageController::class, 'destroy']);
        Route::delete('pages/destroy-multi', [PageController::class, 'destroyMulti']);

        // contact
        Route::get('contacts', [ContactController::class, 'index']);
        Route::get('contacts/create', [ContactController::class, 'create']);
        Route::post('contacts', [ContactController::class, 'store']);
        Route::get('contacts/{contact}', [ContactController::class, 'show']);
        Route::get('contacts/{contact}/edit', [ContactController::class, 'edit']);
        Route::put('contacts/{contact}', [ContactController::class, 'update']);
        Route::patch('contacts/{contact}', [ContactController::class, 'update']);
        Route::delete('contacts/{contact}', [ContactController::class, 'destroy']);
        Route::delete('contacts/destroy-multi', [ContactController::class, 'destroyMulti']);

        // contact forms
        Route::get('contact_forms', [ContactFormController::class, 'index']);
        Route::get('contact_forms/create', [ContactFormController::class, 'create']);
        Route::post('contact_forms', [ContactFormController::class, 'store']);
        Route::get('contact_forms/{id}', [ContactFormController::class, 'show']);
        Route::get('contact_forms/{id}/edit', [ContactFormController::class, 'edit']);
        Route::put('contact_forms/{id}', [ContactFormController::class, 'update']);
        Route::patch('contact_forms/{id}', [ContactFormController::class, 'update']);
        Route::delete('contact_forms/{id}', [ContactFormController::class, 'destroy']);

        // regions
        Route::get('regions', [RegionController::class, 'index']);
        Route::get('regions/create', [RegionController::class, 'create']);
        Route::post('regions', [RegionController::class, 'store']);
        Route::get('regions/{region}', [RegionController::class, 'show']);
        Route::get('regions/{region}/edit', [RegionController::class, 'edit']);
        Route::put('regions/{region}', [RegionController::class, 'update']);
        Route::patch('regions/{region}', [RegionController::class, 'update']);
        Route::delete('regions/{region}', [RegionController::class, 'destroy']);

        // cache-systems
        Route::get('cache-systems', [CacheSystemController::class, 'index']);
        Route::delete('cache-systems/{slug}', [CacheSystemController::class, 'delete']);

        // languages
        Route::get('languages', [LanguageController::class, 'index']);
        Route::get('languages/create', [LanguageController::class, 'create']);
        Route::post('languages', [LanguageController::class, 'store']);
        Route::get('languages/{id}', [LanguageController::class, 'show']);
        Route::get('languages/{id}/edit', [LanguageController::class, 'edit']);
        Route::put('languages/{id}', [LanguageController::class, 'update']);
        Route::patch('languages/{id}', [LanguageController::class, 'update']);
        Route::delete('languages/{id}', [LanguageController::class, 'destroy']);
    }
);
