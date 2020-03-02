<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::namespace('Site')->group(function () {
    Route::get('/', 'HomeController@index');

    // post
    Route::get('/'.config('constant.URL_PREFIX_POST').'/{slugProductCategory}/{slugPost}.html', 'PostController@view');
    Route::get('/'.config('constant.URL_PREFIX_POST').'/{slugPost}.html', 'PostController@view');
    Route::get('/'.config('constant.URL_PREFIX_POST').'/{slugCategory}', 'PostController@index');

    // product
    Route::get('/'.config('constant.URL_PREFIX_PRODUCT').'/{slugProductCategory}/{slugProduct}.html', 'ProductController@view');
    Route::get('/'.config('constant.URL_PREFIX_PRODUCT').'/{slugProduct}.html', 'ProductController@view');
    Route::get('/'.config('constant.URL_PREFIX_PRODUCT').'/{slugCategory}', 'ProductController@index');
    Route::get('/'.config('constant.URL_PREFIX_PRODUCT'), 'ProductController@index');

    // page
    Route::get('/'.config('constant.URL_PREFIX_PAGE').'/{slugCategory}', 'PageController@view');
    Route::get('/404.html', 'PageController@notfound');
    Route::get('/maintenance', 'PageController@maintenance');

    // tag
    Route::get('/'.config('constant.URL_PREFIX_TAG').'/{slug}', 'TagController@index');
    Route::get('/search', 'SearchController@index');

    // cart
    Route::get('/cart', 'CartController@index');
    Route::get('/cart/delete/{id}', 'CartController@delete');
    Route::get('/cart/checkout/{token_checkout}', 'CartController@checkout');
    Route::get('/cart/checkout-success/{token_checkout}', 'CartController@checkoutSuccess');
    Route::post('/cart/add', 'CartController@add');
    Route::post('/cart/checkout/{token_checkout}', 'CartController@checkoutSave');

    // sitemap
    Route::get('sitemap.xml', 'SitemapController@index');

    // contact
    Route::post('contact/register-email', 'ContactController@registerEmail');
    Route::post('contact', 'ContactController@addContact');

    // comment
    Route::post('comment/create', 'CommentController@addComment');

    // user
    Route::get('/users/activemail', 'UserController@activeMail');
});
